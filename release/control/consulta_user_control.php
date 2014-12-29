
<?php 

include_once("../dao/funcionario_dao.php");


if(isset($_GET['sem_botao']))
{

	$funcionario_dao = new FuncionarioDAO();



	 $stmt_funcionario = $funcionario_dao->buscaFuncionario(null,null);
	 while($dados = $stmt_funcionario->fetch(PDO::FETCH_ASSOC))
	 {

	 		if($dados['TIPO'] != 1)
	 		{
	 			$senha = base64_decode($dados['SENHA']);
	 			$tipo_label = "";
	 			if($dados['TIPO'] == 1)
	 				$tipo_label = "Admin";
	 			else if($dados['TIPO'] == 2)
	 				$tipo_label = "Manager";
	 			else if($dados['TIPO'] == 3)
	 				$tipo_label = "Valuer";
	 			echo "<tr >
		        	<th id='".$dados['ID_FUNCIONARIO']."'>".$dados['NOME']."</th>
		        	<th>".$tipo_label."</th>
		        	<th>".$dados['LOGIN']."</th>
					<th>".$senha."</th>
		        	<th>".$dados['EMAIL']."</th>
		        	<th>".$dados['TELEFONE']."</th>
		        	<th>".$dados['UF']."</th>
		        	<th>".$dados['CIDADE']."</th>
		        	<th><em class='fa fa-edit editar' data-toggle='modal' data-target='#edit'>&nbsp;&nbsp;</em></th>
		        	<th><em class='fa fa-trash-o deletar'>&nbsp;&nbsp;</em></th>
		        	</tr>";

	 		}

	 }

	 script();

}


if(isset($_GET['busca']))
{

	$funcionario_dao = new FuncionarioDAO();


	 $stmt_funcionario = $funcionario_dao->buscaFuncionario_2("NOME",$_POST['nome_buscado']);
	 while($dados = $stmt_funcionario->fetch(PDO::FETCH_ASSOC))
	 {

	 		if($dados['TIPO'] != 1)
	 		{
	 			$senha = base64_decode($dados['SENHA']);
	 			$tipo_label = "";
	 			if($dados['TIPO'] == 1)
	 				$tipo_label = "Admin";
	 			else if($dados['TIPO'] == 2)
	 				$tipo_label = "Manager";
	 			else if($dados['TIPO'] == 3)
	 				$tipo_label = "Valuer";

	 			echo "<tr >
		        	<th id='".$dados['ID_FUNCIONARIO']."'>".$dados['NOME']."</th>
		        	<th>".$tipo_label."</th>
		        	<th>".$dados['LOGIN']."</th>
		        	<th>".$senha."</th>
		        	<th>".$dados['EMAIL']."</th>
		        	<th>".$dados['TELEFONE']."</th>
		        	<th>".$dados['UF']."</th>
		        	<th>".$dados['CIDADE']."</th>
		        	<th><em class='fa fa-edit editar' data-toggle='modal' data-target='#edit'>&nbsp;&nbsp;</em></th>
		        	<th><em class='fa fa-trash-o deletar'>&nbsp;&nbsp;</em></th>
		        	</tr>";

	 		}

	 }


	script();


}

if(isset($_GET['editar_user']))
{

		$funcionario_dao = new FuncionarioDAO();

		$senha_2 = base64_encode($_POST['senha']);

		if($funcionario_dao->editaUserAdmin($_POST['codigo_usuario'],$_POST['nome'],$_POST['tipo_gerente']
										,$_POST['login'],$senha_2,$_POST['email'],$_POST['tel']
										,$_POST['uf'],$_POST['cidade']))
		{
			echo "1";
		}
		else echo "0";

}


if(isset($_GET['deleteUser']))
{
	$funcionario_dao = new FuncionarioDAO();
	if($funcionario_dao->deletaFuncionario($_POST['codigo']))
	{
		echo "1";
	}
	else
		echo "0";
}


function script()
{
	echo "<script>

	$('.editar').on('click',function(){

		var codigo = $(this).parents('tr').children('th:eq(0)').attr('id');
		var nome = $(this).parents('tr').children('th:eq(0)').text();
		var login = $(this).parents('tr').children('th:eq(2)').text();
		var senha = $(this).parents('tr').children('th:eq(3)').text();
		var email = $(this).parents('tr').children('th:eq(4)').text();
		var tel = $(this).parents('tr').children('th:eq(5)').text();
		var uf = $(this).parents('tr').children('th:eq(6)').text();
		var cidade = $(this).parents('tr').children('th:eq(7)').text();
		$('#codigo_usuario').val(codigo);
		$('#nome').val(nome);
		$('#login').val(login);
		$('#senha').val(senha);
		$('#email').val(email);
		$('#tel').val(tel);
		$('#uf').val(uf);
		$('#cidade').val(cidade);


	});


	$('.deletar').on('click',function(){
		var codigo = $(this).parents('tr').children('th:eq(0)').attr('id');

					$.ajax({

								type:'POST',
								url:'../control/consulta_user_control.php?deleteUser',
								data:{codigo:codigo}

							}).done(function(html){
								
								if(parseInt(html,10) == 1)
								{
									novaMensagem('sucesso','Completed remove!');
									$('#corp').empty();
									$('#corp').load('../view/view_consulta_user.php');

								}
								if(parseInt(html,10) == 0)
								{
									novaMensagem('erro','Operation failed!');
								}

					        });

	});
</script> ";


}



 ?>

