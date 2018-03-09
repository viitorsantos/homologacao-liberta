<?php
    include "include/conexao.php";
    include "include/config.php";
    include "include/funcoes.php";
    include "include/verifica_usuario.php";
	
	 $medicamento_paciente_id = $_GET["medicamento_paciente"];
	 
	 if(isset($_GET['paciente'])){
			$paciente_id = (int)$_GET['paciente'];
		}	

    if(isset($_POST["btnacao"])){
		
		$medicamento_paciente_horario = fncTrataDados($_POST["medicamento_paciente_horario "]);
   
		$number = count($_POST["hora"]);  
		for($i=0; $i<$number; $i++)  {  
           if(trim($_POST["hora"][$i] != '')) {  
               $horario .= $_POST["hora"][$i]." ";
           }  
		}  
		
		 if(empty($erro)){
            if($medicamento_paciente_horario == 0){
                $sql = "INSERT INTO tbl_medicamento_paciente_horario (medicamento_paciente_id, horario)  
                VALUES ($medicamento_paciente_id, '$horario')";
            }
			echo $sql;
			$res = pg_query($con, $sql);
			if(strlen(trim(pg_last_error($con))) == 0 and empty($erro)){
                $ok .= "Cadastro Realizado com Sucesso.";
				 
            }
		}
	}
	
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="author" content="<?php echo AUTOR ?>">

        <title><?php echo TITLE_ADMIN ?></title>
        <link rel="shortcut icon" href="<?php echo RAIZ?>/images/<?php echo LOGO_FAVICON ?>" type="image/x-icon" /> 
        <!-- Bootstrap core CSS -->
        <link href="<?php echo RAIZ ?>css/bootstrap.css" rel="stylesheet">
        <!-- Custom styles for this template -->
        <link href="<?php echo RAIZ ?>css/dashboard.css" rel="stylesheet">
        <link href="<?php echo RAIZ ?>css/style.css" rel="stylesheet">
        <link href="<?php echo RAIZ ?>css/style_admin.css" rel="stylesheet">
        <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
        <!-- Just for debugging purposes. Don't actually copy this line! -->
        <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->    
        <meta charset="utf-8">
		
		<script src="http://code.jquery.com/jquery-1.11.2.min.js"></script>
		<script type="text/javascript">
	    

			$(function () {
			    var scntDiv = $('#adiciona');

			    $(document).on('click', '#addInput', function () {
			        $('<p>'+
		        		'<input type="text" id="hora" name="hora[]" size="20" value="" placeholder="Hora" /> '+
		        		'<a class="btn btn-danger" href="javascript:void(0)" id="remInput">'+
							'<span class="glyphicon glyphicon-minus" aria-hidden="true"></span> '+
							
		        		'</a>'+
					'</p>').appendTo(scntDiv);
			        return false;
			    });

			    $(document).on('click', '#remInput', function () {
		            $(this).parents('p').remove();
			        return false;
			    });
			});
		</script>
		
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
                            <div class=" col-md-9 titulo_tela" >Prescrição</div>
                            <div class="col-md-1 link_tela">
                                <a href="ficha_medica.php?paciente=<?php echo $paciente_id?>" class="btn btn-success btn-sm"><i class="fa fa-list-alt"></i>Paciente</a>     
                            </div>
                        </div>
						<form method="POST" action="">
							<div class="conteudo">
								<a class="btn btn-success" href="javascript:void(0)" id="addInput">
									<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
									
								</a>
								<br/>
								<div id="adiciona">
									<p>
										<input type="text" id="hora" name="hora[]" value="<?php echo $horario?>" placeholder="Hora" maxlength="5"/>
										<a class="btn btn-danger" href="javascript:void(0)" id="remInput">
											<span class="glyphicon glyphicon-minus" aria-hidden="true"></span>
											
										</a>
									</p>
								</div>
		
								 <div class="row">
                                        <div class="col-md-12 botao">
                                            <input class="btn btn-success" type="submit" name="btnacao" value="Gravar">
                                            <input type="hidden" name="paciente" value="<?php echo $paciente_id ?>">
											
	
                                        </div>
                                    </div>
                            </div>
						</form>
                        </div>
                   </div>
                </div>
                <div class="row">
                    <?php include RAIZ."/include/footer.php" ?>
                </div>
            </div>
            <!-- Bootstrap core JavaScript
            ================================================== -->
            <!-- Placed at the end of the document so the pages load faster -->
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
            <script src="<?php echo RAIZ ?>js/bootstrap.min.js"></script>
            <script src="<?php echo RAIZ ?>js/docs.min.js"></script>
        </div>
    </body>
</html>