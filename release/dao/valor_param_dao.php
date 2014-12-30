
<?php 
		
		/*
			Cadastro de Valores para os Parametros
			Author: Jean Fabrício
			date:22/02/2014
		*/
include_once("conexao.php");
include_once("../model/valor_param_model.php");
		
class ValorParamDao {
	function insere_valore(ValorParametros $valor_param, $size)
	{
		try{
		$conecta = Conexao::getInstance();
			for($i=0;$i<$size;$i++)
			{
				
				$sql = "INSERT INTO valor_par_especie (COD_PAR_ESPECIE,VALOR)
						VALUES(:codparam, :valor)";
				
				$stmt = $conecta->prepare($sql);
				$stmt->bindParam(':codparam',$valor_param->getCodParamEspecie());
				$stmt->bindParam(':valor',$valor_param->getValorParam()[$i]);
				$stmt->execute();
			}
			return 1;
		} 
		catch(PDOExecption $erro){
			echo $erro->getMessage();

			return 0;
		}
	}
	function busca_valores($cod_param)
	{
		try{
		$conecta = Conexao::getInstance();
				$sql = "SELECT * FROM `valor_par_especie` WHERE COD_PAR_ESPECIE=".$cod_param;
				
				$stmt = $conecta->prepare($sql);
				$stmt->execute();
			return $stmt;
		} 
		catch(PDOExecption $erro){
			echo $erro->getMessage();

			return 0;
		}
	}
}		
?>