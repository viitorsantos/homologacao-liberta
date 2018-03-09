<?php   
    require './include/conexao.php';
    require './include/config.php';
    require './include/funcoes.php';
    include "include/verifica_usuario.php";
	
?>

<!DOCTYPE html>

<html lang="pt-br">
    <head>
	<meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="author" content="<?php echo AUTOR ?>">
        <meta charset="UTF-8">
       <title><?php echo TITLE_ADMIN ?></title>
        <!-- Bootstrap core CSS -->
        <link href="<?php echo RAIZ ?>/css/bootstrap.css" rel="stylesheet">
        <link rel="shortcut icon" href="<?php echo RAIZ?>/images/<?php echo LOGO_FAVICON ?>" type="image/x-icon" />
        <!-- Custom styles for this template -->
        <link href="<?php echo RAIZ ?>css/dashboard.css" rel="stylesheet">
        <link href="<?php echo RAIZ ?>css/style_admin.css" rel="stylesheet">
        <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
		
        
        <!-- Just for debugging purposes. Don't actually copy this line! -->
        <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
       <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]--> 
        <script src="include/funcoes.js"></script>
        <script src="js/script.js" ></script>

 	    
    </head>
    <body>
        
        <div class="container">
            <div class="container-fluid">
                <div class="row">
                    <?php include RAIZ."include/cabecalho.php" ?>
                    <div class="col-md-2">
                        <?php include RAIZ."include/menu_admin.php" ?>
                    </div>
                    <div class="col-md-10 corpo">
                        <div class="page-header">                            
                            <div class=" col-md-10 titulo_tela" >Residentes</div>
                            <div class="col-md-2 link_tela">
                                <a href="cliente_pesquisa.php" class="btn btn-success btn-sm"><i class="fa fa-list-alt"></i>Voltar</a>        
                            </div>                          
                        </div>
                        <div class="conteudo">
                               <div class="table-responsive">
                                <table class="table table-striped">  
									<thead>
										<tr>
											<th>#</th>
											<th>Nome</th>
											<th>Status</th>
											<th colspan="2">Ações</th>
										</tr>
									</thead>
                                    <tbody>
                                         <?php
                                            $sql = "SELECT paciente, nome, status_id from tbl_paciente WHERE status_id = 3 AND empresa_id = ".EMPRESA." order by nome";
											$res = pg_query($con, $sql);
                                            for($i=0; $i<pg_num_rows($res); $i++){
                                                $paciente	    = pg_fetch_result($res, $i, 'paciente');
                                                $nome		    = pg_fetch_result($res, $i, 'nome');
												$status		    = pg_fetch_result($res, $i, 'status_id');
												 				
                                               if($status == 3){
												   $residente = "Residente";
											   }else{
												   $residentes = " ";
											   }
											   
                                                echo "<tr>";
                                                    echo "<td class='col-md-1'>".($i+1)."</td>";
                                                    echo "<td>$nome</td>"; 
													echo "<td>$residente</td>"; 
                                                    echo "<td class='col-md-1'><a href='./ficha_medica.php?paciente=$paciente' title='Abrir' target='_blank'><i class='fa fa-list-alt'></i></a></td>";
                                                echo "</tr>";
                                            }
                                         ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <?php include RAIZ."include/footer.php" ?>
                </div>
            </div>
            <!-- Bootstrap core JavaScript
            ================================================== -->
            <!-- Placed at the end of the document so the pages load faster -->
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
            <script src="<?php echo RAIZ ?>js/bootstrap.min.js"></script>
            
        </div>
    </body>
</html>