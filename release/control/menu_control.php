<?php
    
    /*
		*	Title: menu_control.php
		*	Author: Frederico
		*	Date: 17/07/2014
	*/
	
    include_once("../dao/menu_dao.php");
	
	function criaMenu(){
		$menuDao = new MenuDao();

		$tipoUser = $menuDao->getTipoUser();

	    if($tipoUser == 1){

	    	echo'<li class="opcao" id="admin">';

		    	//<!-- Single button -->;
		    	echo'<div class="btn-group">';
		    		echo'<button type="button" class="btn btn-default dropdown-toggle drop" data-toggle="dropdown">';
		    			echo'<img src="../img/admin.png" alt="Tools" width="45"><br><span>Admin</span>';
		    		echo'</button>';
		    		echo'<ul class="dropdown-menu" role="menu">';
		    			echo'<li><a href="#cadastro_user"><em class="fa fa-male">&nbsp;&nbsp;</em>Register User</a></li>';
		    			//echo'<li><a href="#"><i class="fa fa-exchange">&nbsp;&nbsp;</i>Change/Remove</a></li>';
		    		echo'</ul>';
		    	echo'</div>';
	    	echo'</li>';

	    }
		//<!--   Perfil         -->
		echo'<li class="opcao" id="user"><a href="#perfil"><img src="../img/user.png"  alt="User" width="45"><br /><span>User</span></a></li>';
    	
    	//<!--   Historico      -->
    	echo'<li class="opcao" id="logs"><a href="#historico" ><img src="../img/historic.png" alt="Historic" width="45"><br><span>Logs</span></a></li>';
    	
    	//<!--   Cadastros      -->
    	echo'<li class="opcao" id="register">';

    		//<!-- Single button -->
    		echo'<div class="btn-group">';
    			echo'<button type="button" class="btn btn-default dropdown-toggle drop" data-toggle="dropdown">';
					echo'<img src="../img/cadastro.png" alt="Register" width="45" /><br /><span>Registering</span>';
				echo'</button>';
				echo'<ul class="dropdown-menu" style="z-index:1000;" role="menu">';
					
					// Opções para o Administrador Geral, Gerente e o Geraldo
					if($tipoUser == 1 || $tipoUser == 2 || $tipoUser == 4){
						echo'<li><a href="#cadastro_especie"><em class="fa fa-leaf">&nbsp;&nbsp;</em>Species</a></li>';
						echo'<li><a href="#configuracao"><em class="fa fa-list">&nbsp;&nbsp;</em>Parameters of Species</a></li>';	
						echo'<li><a href="#avaliacao"><em class="fa fa-columns">&nbsp;&nbsp;</em>Trials</a></li>';
						echo'<li role="presentation" class="divider"></li>';
						echo'<li><a href="#produto"><em class="fa fa-barcode">&nbsp;&nbsp;</em>Product</a></li>';
						echo'<li><a href="#parceiros"><em class="fa fa-group">&nbsp;&nbsp;</em>Partners</a></li>';
						echo'<li><a href="#marca"><em class="fa fa-building-o">&nbsp;&nbsp;</em>Brand</a></li>';
						echo'<li role="presentation" class="divider"></li>';
						echo'<li><a href="#campo"><em class="fa fa-picture-o">&nbsp;&nbsp;</em>Countryside</a></li>';					
					}
					
					/*
					//Opções para o Gerente
					else if($tipoUser == 2){
						echo'<li><a href="#parceiros"><em class="fa fa-group">&nbsp;&nbsp;</em>Partners</a></li>';
						echo'<li><a href="#produto"><em class="fa fa-barcode">&nbsp;&nbsp;</em>Sign Product</a></li>';
						echo'<li><a href="#marca"><em class="fa fa-share-square">&nbsp;&nbsp;</em>Sign Brand</a></li>';
						echo'<li><a href="#avaliacao"><em class="fa fa-leaf">&nbsp;&nbsp;</em>Register of trials</a></li>';
						echo'<li><a href="#campo"><em class="fa fa-share-square">&nbsp;&nbsp;</em>Sign countryside</a></li>';
					}*/

					// Opções para o Avaliador
					else{
						echo'<li><a href="#parceiros"><em class="fa fa-group">&nbsp;&nbsp;</em>Partners</a></li>';
						echo'<li><a href="#campo"><em class="fa fa-picture-o">&nbsp;&nbsp;</em>Sign Countryside</a></li>';
					}

					/* Todas as opções para Registering
					echo'<li><a href="#parceiros"><em class="fa fa-group">&nbsp;&nbsp;</em>Partners</a></li>';
					echo'<li><a href="#cadastro_especie"><em class="fa fa-share-square">&nbsp;&nbsp;</em>Register of Species</a></li>';
					echo'<li><a href="#produto"><em class="fa fa-barcode">&nbsp;&nbsp;</em>Sign Product</a></li>';
					echo'<li><a href="#marca"><em class="fa fa-share-square">&nbsp;&nbsp;</em>Sign Brand</a></li>';
					echo'<li><a href="#avaliacao"><em class="fa fa-leaf">&nbsp;&nbsp;</em>Register of trials</a></li>';
					echo'<li><a href="#campo"><em class="fa fa-share-square">&nbsp;&nbsp;</em>Sign countryside</a></li>';
					echo'<li><a href="#configuracao"><em class="fa fa-cogs">&nbsp;&nbsp;</em>Register Parameters of Species</a></li>';
					*/
				echo'</ul>';
			echo'</div>';
		echo'</li>';

		//<!--   Consultas      -->
		// Opções disponívels para o adm geral, os gerentes e o usuário geraldo
		if($tipoUser == 1 || $tipoUser == 2 || $tipoUser == 3){
	    	echo'<li class="opcao" id="search">';

	    		//<!-- Single button -->;
	    		echo'<div class="btn-group">';
	    			echo'<button type="button" class="btn btn-default dropdown-toggle  drop" data-toggle="dropdown">';
	    				echo'<img src="../img/search.png" alt="Search" width="45"><br /><span>Search</span>';
	    			echo'</button>';
	    			echo'<ul class="dropdown-menu" role="menu">';
                        echo'<li><a href="#buscas_estoque"><em class="fa fa-dropbox">&nbsp;&nbsp;</em>Stock</a></li>';
                        echo'<li><a href="#busca_produto"><em class="fa fa-barcode">&nbsp;&nbsp;</em>Products</a></li>';
                        echo'<li><a href="#busca_parceiro"><em class="fa fa-users">&nbsp;&nbsp;</em>Partners</a></li>';
	            		echo'<li><a href="#busca_marca"><em class="fa fa-building-o">&nbsp;&nbsp;</em>Brand</a></li>';
	            		echo'<li role="presentation" class="divider"></li>';
                        echo'<li><a href="#busca_campo"><em class="fa fa-picture-o">&nbsp;&nbsp;</em>Countryside</a></li>';
                        echo'<li role="presentation" class="divider"></li>';
	            		echo'<li><a href="#busca_usuario"><em class="fa fa-users">&nbsp;&nbsp;</em>Users</a></li>';
                        echo'<li><a href="#busca_gerente"><em class="fa fa-briefcase">&nbsp;&nbsp;</em>Manager</a></li>';
                        
                        
	            		//echo'<li><a href="#busca_trial"><i class="fa fa-leaf">&nbsp;&nbsp;</i>Search Trials</a></li>';
	            		//echo'<li><a href="#busca_geral"><i class="fa fa-search">&nbsp;&nbsp;</i>General Searches</a></li>';
	            	echo'</ul>';
	            echo'</div>';
	        echo'</li>';
	    }
            
	/*
      <!--  <li>

        <div class="btn-group">
          <button type="button" class="btn btn-default dropdown-toggle drop" data-toggle="dropdown">
           <img src="../img/report.png" alt="Reports" width="45"><br><span>Reports</span>
          </button>
          <ul class="dropdown-menu" role="menu">
            <li><a href="#"><i class="fa fa-bug">&nbsp;&nbsp;</i>Reports of Tests</a></li>
            <li><a href="#"><i class="fa fa-pencil-square-o">&nbsp;&nbsp;</i>Others Reports</a></li>
            
          </ul>
        </div>

      </li> -->
    */

    // Seção admin somente será exibida se o administrador geral do sistema estiver logado


    echo'<li class="opcao" id="request">';
    	echo'<div class="btn-group">';
	    	echo'<button type="button" class="btn btn-default dropdown-toggle drop" data-toggle="dropdown">';
	    		echo'<img src="../img/estoque.png" alt="Pedido" width="45"><br /><span>Request</span>';
	    	echo'</button>';
	    	echo'<ul class="dropdown-menu" role="menu">';
	    		
	    		
	
	    			echo'<li><a href="#pedidos"><em class="fa fa-envelope-o">&nbsp;&nbsp;</em>Send Request</a></li>';
	    			echo'<li role="presentation" class="divider"></li>';
	    			echo'<li><a href="#caixa_pedidos"><em class="fa fa-inbox">&nbsp;&nbsp;</em>Order Box</a></li>';
                    echo'<li><a href="#detalhes_pedido"><em class="fa fa-eye">&nbsp;&nbsp;</em>Request Details</a></li>';
                    echo'<li role="presentation" class="divider"></li>';
	    			echo'<li><a href="#nota_fiscal_entrada"><em class="fa fa-sign-in">&nbsp;&nbsp;</em>Entrance Invoice</a></li>';
	    			echo'<li><a href="#nota_fiscal"><em class="fa fa-sign-out">&nbsp;&nbsp;</em>Invoice</a></li>';
	    		
	    		
	    		/* Todas as opções para Request
	    		echo'<li><a href="#pedidos"><em class="fa fa-edit">&nbsp;&nbsp;</em>Create Request</a></li>';
	    		echo'<li><a href="#caixa_pedidos"><em class="fa fa-eye">&nbsp;&nbsp;</em>Order Box</a></li>';
	    		echo'<li><a href="#nota_fiscal"><em class="fa fa-bars">&nbsp;&nbsp;</em>Invoice</a></li>';
	    		echo'<li><a href="#nota_fiscal_entrada"><em class="fa fa-truck">&nbsp;&nbsp;</em>Entrance Invoice</a></li>';
	    		*/
	    	echo'</ul>';
	    echo'</div>';
	echo'</li>';

    //<!-- Amostra -->
    echo'<li class="opcao" id="evaluation">';
    	echo'<div class="btn-group">';
    		echo'<button type="button" class="btn btn-default dropdown-toggle drop" data-toggle="dropdown">';
    			echo'<img src="../img/test.png" alt="Pedido" width="45"><br /><span>Evaluation</span>';
    		echo'</button>';
    		echo'<ul class="dropdown-menu" role="menu">';

    			// Opções que seram exibidas para o gerente e o avaliador
    				echo'<li><a href="#avaliacao_ensaio"><em class="fa fa-check">&nbsp;&nbsp;</em>Evaluations</a></li>';
	                echo'<li><a href="#data_semeio_ensaio"><em class="fa fa-calendar">&nbsp;&nbsp;</em>Date of Sowing Submit</a></li>';
    				echo'<li role="presentation" class="divider"></li>';

                //<!-- Perguntar para o Tacio -->
	                echo'<li><a href="#ensaio_perdido"><em class="fa fa-times">&nbsp;&nbsp;</em>Lost Assay</a></li>';
	                echo'<li><a href="#cancelar_ensaio"><em class="fa fa-times">&nbsp;&nbsp;</em>Canceled Assay</a></li>';
	                echo'<li role="presentation" class="divider"></li>';
    				echo'<li><a href="#pdf"><em class="fa fa-print">&nbsp;&nbsp;</em>PDF</a></li>';
	    			
                /* Todas as opções para Evaluation
    			echo'<li><a href="#pdf"><em class="fa fa-edit">&nbsp;&nbsp;</em>PDF</a></li>';
    			echo'<li><a href="#avaliacao_ensaio"><em class="fa fa-edit">&nbsp;&nbsp;</em>Evaluations</a></li>';
    			*/
    		echo'</ul>';
    	echo'</div>';
    echo'</li>';

	}
	
?>