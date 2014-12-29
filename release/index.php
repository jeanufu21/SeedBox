
<!doctype html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8" />
    <title>Seed Box v1.0</title>
    <link rel="shortcut icon" href="img/seedbox.png"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap3.css" type="text/css" media="screen" charset="utf-8"/>
    <link rel="stylesheet" href="css/main.css" type="text/css" media="screen" charset="utf-8"/>
    <script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>
    <link rel="stylesheet" href="css/alerts.css" type="text/css" media="screen" charset="utf-8"/>
    <script type="text/javascript" src="js/alerta.js"></script>
</head>
<body>
    
        
    </header>
         <div class="container">
        <div class="alert alert-danger col-md-10" id="error"><p class="text-center">Sorry! User or Password invalid</p></div> 
    
      <form action="control/enter_control.php" class="form-signin" method="post" accept-charset="utf-8">
        <div class="col-md-12"><img src="img/logo.png" alt="Eagle Flores"></div>
        
         <h1>Seed Box</h1>
        <br>
        <input name="login" type="text" class="form-control" placeholder="User" required autofocus>
        <br>
        <input name="senha" type="password" class="form-control" placeholder="Password" required>
        <br><br>
        <button class="btn btn-lg btn-success btn-block" type="submit">Login</button>
      </form>

    </div>  
    <div class="panel little" id="alerta"></div>

    
     
    <!-- JAVASCRIPT DO BOOTSTRAP -->
    <script type="text/javascript" src="js/bootstrap.js"></script>
</body>


<?php 
        if(isset($_GET["erro"])){
            if($_GET["erro"] == "invalido")
                {
                    echo '<script>novaMensagem("erro","User or Pass wasn\'t valid");</script>';
                }
            }
    ?>


</html>