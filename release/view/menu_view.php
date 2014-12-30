 
<?php 
      
  include_once("../validaLogin.php");
  include_once("../control/menu_control.php");
?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <title>SeedBox v1.0</title>
        <link rel="shortcut icon" href="../img/seedbox.png"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="stylesheet" href="../css/general.css" type="text/css" media="screen" />
        <link rel="stylesheet" href="../css/bootstrap3.css" type="text/css" media="screen" />
        <link rel="stylesheet" href="../css/control.css" type="text/css" media="screen" />
        <link rel="stylesheet" type="text/css" href="../css/font/css/font-awesome.min.css" />    
        <link href="../jquery-ui-1.10.4.custom/css/ui-lightness/jquery-ui-1.10.4.custom.css" rel="stylesheet">
        <link rel="stylesheet" href="../css/jasny-bootstrap.css" type="text/css" media="screen" />
        <link rel="stylesheet" href="../css/alerts.css" type="text/css" media="screen" />
        <script type="text/javascript" src="../js/jquery-1.10.2.min.js"></script>
        <script type="text/javascript" src="../js/ajax.js"></script>
        <script type="text/javascript" src="../js/menu.js"></script>

        <link rel="stylesheet" type="text/css" href="../css/validationEngine.jquery.css" />
        
        <script type="text/javascript" src="../js/jquery.validationEngine.js?version=<?php echo rand(); ?>"></script>
        <script type="text/javascript" src="../js/jquery.validationEngine-en.js?version=<?php echo rand(); ?>"></script>

        <script type="text/javascript" src="../JQueryMaskPlugin/jquery.mask.min.js"></script>
        
    </head>
    <body>
        <header>
            <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                <img src="../img/logo.png" alt="eagleflores" style="height: 50px;"/>
                <a href="../ValidaLogin.php?acao=deslogar"><span  class="label label-success top-words" id='logout'>Logout</span></a>
                </div>
            </nav>
        </header>
  
        <div class="navbar navbar-default navbar-fixed-top" role="navigation" style='top:50px;' >
            <!-- Brand and toggle get grouped for better mobile display -->
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bar-nav">
                <ul class="nav navbar-nav" id="menu">
                <?php
                    criaMenu();
                ?>
                </ul>
            </div><!-- /.navbar-collapse -->
        </div>
        <div id="corp" class="col-md-12">
            <h1 id="baner">Seed Box - Eagle</h1>
        </div>
        
        <div class="panel little" id="alerta"></div>

        <!-- JAVASCRIPT DO BOOTSTRAP -->

        <script type="text/javascript" src="../js/bootstrap.js"></script>
        <script type="text/javascript" src="../js/jasny-bootstrap.js"></script>
        <script type="text/javascript" src="../jquery-ui-1.10.4.custom/js/jquery-ui-1.10.4.custom.min.js"></script>
        <script type="text/javascript" src="../js/alerta.js"></script>

    </body>
</html>
