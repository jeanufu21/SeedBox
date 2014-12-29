<?php 
	
require 'PassHash.php';
require 'DbHandler.php';
require '../Slim/Slim/Slim.php';


\Slim\Slim::registerAutoloader();
$app = new \Slim\Slim();
// $app->response()->header('Content-Type', 'application/json;charset=utf-8');


function verifyRequiredParams($campos_requeridos) {
    $error = false; // status do erro
    $error_fields = "";// string que retorna os campos com erro no json
    $request_params = array();
    $request_params = $_REQUEST;// valor dos parametros do POST
    // Handling PUT request params
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $app = \Slim\Slim::getInstance();
        parse_str($app->request()->getBody(), $request_params);
    }

    foreach ($campos_requeridos as $field) {
        if (!isset($request_params[$field]) || strlen(trim($request_params[$field])) <= 0) {
            $error = true;
            $error_fields .= $field . ', ';
        }
    }
 
    if ($error) {
        // Required field(s) are missing or empty
        // echo error json and stop the app
        $response = array();
        $app = \Slim\Slim::getInstance();
        $response["error"] = true;
        $response["message"] = 'Required field(s) ' . substr($error_fields, 0, -2) . ' is missing or empty';
        echoResponse(400, $response);
        $app->stop();
    }
}

function echoResponse($status_code, $response) {
    $app = \Slim\Slim::getInstance();
    // Http response code
    $app->status($status_code);
 
    // setting response content type to json
    $app->contentType('application/json');
 	$app->response()->header('Content-Type', 'application/json;charset=utf-8');
    echo json_encode($response);
}

/**
 * User Login
 * url - /login
 * method - POST
 * params - login, senha
 */
$app->post('/login', function() use ($app) {
            // check for required params
            verifyRequiredParams(array('login', 'senha'));
 
            // reading post params
            $login = $app->request()->post('login');
            $senha = base64_encode($app->request()->post('senha'));
            $response = array();
 		
            $db = new DbHandler();
           
            // check for correct login and senha
            if($db->checkLogin($login,$senha)) {
                // get the user by login
                $user = $db->getUser($login,$senha);
 	
                if ($user != NULL) {
                	
                    $response["error"] = false;
                    $response['id_funcionario'] = $user['ID_FUNCIONARIO'];
                    $response['nome'] = $user['NOME'];

                } else {
                    // unknown error occurred
                    $response['error'] = true;
                    $response['message'] = "Erro na função GetUser!";
                }
            } else {
                // user credentials are wrong
                $response['error'] = true;
                $response['message'] = 'Falha no Login!. Dados Incorretos!';
            }
 
            echoResponse(200, $response);
        });


$app->get('/campos', function() use ($app) {
            
            $response = array();
        
            $db = new DbHandler();
            
            $stmt = $db->getAllCampos();

            if($stmt == null || $stmt->rowCount() == 0)
                $response["error"] = true;
            else
                $response["error"] = false;

             $response["campos"] = array();

            while($campo = $stmt->fetch(PDO::FETCH_ASSOC)){
                $tmp = array();
                $tmp["COD_CAMPO"] = $campo["COD_CAMPO"];
                $tmp["NOME"] = $campo["NOME"];
                $tmp["CIDADE"] = $campo["CIDADE"];
                $tmp["UF"] = $campo["UF"];
                $tmp["ALTITUDE"] = $campo["ALTITUDE"];
                $tmp["LATITUDE"] = $campo["LATITUDE"];
                $tmp["LONGITUDE"] = $campo["LONGITUDE"];

                array_push($response["campos"], $tmp);

            }
            echoResponse(200, $response);
        });

$app->post('/ensaios', function() use ($app) {

            verifyRequiredParams(array('cod_campo','cod_user'));

            $cod_campo = $app->request()->post('cod_campo');
            $cod_user = $app->request()->post('cod_user');

            $response = array();
        
            $db = new DbHandler();
            
            $stmt = $db->getAllEnsaios($cod_campo,$cod_user);

            if($stmt == null || $stmt->rowCount() == 0)
                $response["error"] = true;
            else
                $response["error"] = false;
            
             $response["ensaios"] = array();

            while($ensaio = $stmt->fetch(PDO::FETCH_ASSOC)){

                $tmp = array();

                $tmp["cod_ensaio"] = $ensaio["COD_ENSAIO"];
                $tmp["cod_campo"] = $ensaio["COD_CAMPO"];
                $tmp["cod_especie"] = $ensaio["COD_ESPECIE"];
                $tmp["nome_especie"] = $ensaio["NOME"];
                $tmp["status"] = $ensaio["STATUS"];
                $tmp["id_funcionario"] = $ensaio["ID_FUNCIONARIO"];
                $tmp["data_transplante"] = $ensaio["DATA_TRANSPLANTE"];
                $tmp["data_colheita"] = $ensaio["DATA_COLHEITA"];
                $tmp["quantidade_amostras"] = $ensaio["QUANTIDADE_AMOSTRAS"];
                $tmp["amostras"] = array();
                
                $stmt_ensaio = $db->getAmostras_Ensaio($ensaio["COD_ENSAIO"]);

                while($amostra = $stmt_ensaio->fetch(PDO::FETCH_ASSOC))
                {
                        $amt = array();
                        $amt["cod_amostra"] = $amostra["COD_AMOSTRA"];
                        $amt["nome_produto"] = $amostra["NOME"];

                        array_push($tmp["amostras"], $amt);
                    
                }
                array_push($response["ensaios"], $tmp);

            }
            echoResponse(200, $response);
        });

// $app->post('/produtos','addProduto');

// $app->delete('/produtodel/:id','deleteProduto');
// $app->get('/produtos/:id','getProduto');
$app->run();



// function getUsuarios()
// {
// 	$conexao = Conexao::getInstance();
// $stmt = $conexao->query("SELECT * FROM `funcionario`");
// $ensaios = $stmt->fetchAll(PDO::FETCH_OBJ);
// echo "{ensaios:".json_encode($ensaios)."}";
// }

// function addProduto()
// {
// 	$request = \Slim\Slim::getInstance()->request();
	
// 	$produto = json_encode($request->getBody());
// 	// $sql = "INSERT INTO Produtos (nome,preco,dataInclusao,idCategoria) values (:nome,:preco,:dataInclusao,:idCategoria) ";
// 	// $conn = getConn();
// 	// $stmt = $conn->prepare($sql);
// 	// $stmt->bindParam("nome",$produto->nome);
// 	// $stmt->bindParam("preco",$produto->preco);
// 	// $stmt->bindParam("dataInclusao",$produto->dataInclusao);
// 	// $stmt->bindParam("idCategoria",$produto->idCategoria);
// 	// $stmt->execute();
// 	// $produto->id = $conn->lastInsertId();
// 	echo json_encode($produto);
// 	// }
// 	// else
// 	// {
// 	// 		$app->render(404);
// 	// }
// }


// function deleteProduto($id)
// {

// 	$sql = "DELETE FROM produtos WHERE id=:id";
// 	$conn = getConn();
// 	$stmt = $conn->prepare($sql);
// 	$stmt->bindParam("id",$id);
// 	$stmt->execute();
// 	echo "{'message':'Produto apagado'}";
// }

// function getProduto($id)
// {
// $conn = getConn();
// $sql = "SELECT * FROM produtos WHERE id=:id";
// $stmt = $conn->prepare($sql);
// $stmt->bindParam("id",$id);
// $stmt->execute();
// $produto = $stmt->fetchObject();

// //categoria
// $sql = "SELECT * FROM categorias WHERE id=:id";
// $stmt = $conn->prepare($sql);
// $stmt->bindParam("id",$produto->idCategoria);
// $stmt->execute();
// $produto->categoria = $stmt->fetchObject();

// echo json_encode($produto);
// }
?>