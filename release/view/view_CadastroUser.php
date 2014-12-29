<br /><br /><br /><br /><br />
	<head>
		<link rel="stylesheet" type="text/css" href="../css/general.css" media="screen" />
	    <script type="text/javascript" src="../js/jquery-1.10.2.min.js"></script>
	    <script type="text/ecmascript" src="../js/funcionario.js"></script>
	</head>
	<div class="navigationBar">Admin &#62;&#62;<strong>&nbsp;Register User</strong></div>
<div style="padding-top: 2%;">
	
		<div class = "panel" style="width:  36%; margin:  auto; border:  1px solid gray;">
			<div class="panel-body" style="margin: 5px;">
				<form role="form" name="formInsertUser" id="formInsertUser">
			        <div class="form-group has-success">
			            <span style="color:  red; font-weight: bold;">*&nbsp;</span><label for="name">Name:</label>
			            <input type="text" class="form-control" name="nome_funcionario" id="nome_funcionario" required="required" placeholder="Enter the Name">
			        </div>
			        <div class="form-group has-success">
			            <span style="color:  red; font-weight: bold;">*&nbsp;</span><label for="name">Login:</label>
			            <input type="text" class="form-control" name="login_funcionario" id="login_funcionario" required="required" placeholder="Enter the Name">
			        </div>
			        <div class="form-group has-success">
			            <span style="color:  red; font-weight: bold;">*&nbsp;</span><label for="pw">Password:</label>
			            <input type="password" class="form-control" name="senha_funcionario" id="senha_funcionario" required="required" placeholder="Enter the password">
			        </div>
			        <div class="form-group has-success">
			            <span style="color:  red; font-weight: bold;">*&nbsp;</span><label for="cpw">Confirm password:</label>
			            <input type="password" class="form-control"  required="required" id="confirma_senha_funcionario" placeholder="Confirm the password" >
			        </div>
	
			        <div class="form-group has-success">
			            <span style="color:  red; font-weight: bold;">*&nbsp;</span><label for="name">Email:</label>
			            <input type="text" class="form-control" name="email" id="email" required="required" placeholder="Enter the email">
			        </div>
			        <div class="form-group has-success">
			            <span style="color:  red; font-weight: bold;">*&nbsp;</span><label for="name">Telefone:</label>
			            <input type="text" class="form-control" name="telefone" id="telefone" data-mask="(99)9999-9999" required="required" placeholder="Enter the telefone">
			        </div>
			        <div class="form-group has-success">
			            <span style="color:  red; font-weight: bold;">*&nbsp;</span><label for="name">City:</label>
			            <input type="text" class="form-control" name="cidade" id="cidade" required="required" placeholder="Enter the city">
			        </div>
			        <div class="form-group has-success">
			            <span style="color:  red; font-weight: bold;">*&nbsp;</span><label for="name">UF:</label>
			            <input type="text" class="form-control" name="uf" id="uf" required="required" placeholder="Enter the uf" maxlength="2">
			        </div>
					<!-- <div class="form-group has-success">
					    <label for="imagem_perfil">profile image</label>
					    <input type="file" id="imagem_perfil" name="imagem_perfil">
					    
					</div> -->
			        <br /><br />
			        <span style="color:  red; font-weight: bold;">*&nbsp;</span><label>Access Level:</label><br />
			        <input type="radio" name="privilegio_usuario" value="1" required="required"><label>&nbsp;Admin</label>&nbsp;&nbsp; 
			        <input type="radio" name="privilegio_usuario" value="2" required="required"><label>&nbsp;Manager</label>&nbsp;&nbsp;
  			        <input type="radio" name="privilegio_usuario" value="3" required="required"><label>&nbsp;Avaliator</label>&nbsp;&nbsp;
                    <br />
                    <span style="color:  red; font-weight: bold; font-size: 11px;">*&nbsp;Required itens</span><br /><br />
			        <button type="button" class="btn btn-success btn-lg" id="enviaFuncionario">Submit</button>
			    </form>
			</div>
		
	</div>
	
</div>