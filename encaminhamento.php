<?php
    include "include/conexao.php";
    include "include/config.php";
    include "include/funcoes.php";
    include "include/verifica_usuario.php";
	
	
	 if(isset($_POST['especialidade'])){
		 
		 
		 $especialidade = (int)$_POST['especialidade'];
		 
		
		$sql_profissional = "SELECT * FROM tbl_profissional WHERE especialidade_id = '$especialidade' ORDER BY nome ";
		$res_profissional = pg_query($con, $sql_profissional);
			for($i =0; $i<pg_num_rows($res_profissional); $i++){
				$profissional   = pg_fetch_result($res_profissional, $i, 'profissional');
				$nome  = pg_fetch_result($res_profissional, $i, 'nome');
				$especialidade_id  = pg_fetch_result($res_profissional, $i, 'especialidade_id');
																										
				
			    echo"<option value='$profissional'>$nome</option>";
			}
		 exit;
		 
	 }
	
	
	


	 if(isset($_POST['btnacao'])){
        $paciente_id              =   fncTrataDados($_POST['paciente']);
		$encaminhamento_id        =   fncTrataDados($_POST['encaminhamento']);
        $observacao               =   fncTrataDados($_POST['observacao']);
		$profissional_id	=	(int)$_POST["profissional_id"];

        if(strlen(trim($observacao)) == 0){
            $erro .= "O campo Encaminhamento deve ser preenchido. <br>";
        } 
		if(strlen(trim($profissional_id)) == 0){
            $erro .= "O campo Especialidade deve ser preenchido. <br>";
        } 

        if(empty($erro)){
            if($encaminhamento_id == 0){
                $sql = "INSERT INTO tbl_encaminhamento (paciente_id, profissional_id, observacao)  
                VALUES ($paciente_id, $profissional_id,'$observacao')returning encaminhamento";
            }else{
                $sql = "UPDATE tbl_encaminhamento SET paciente_id = '$paciente_id', profissional_id = '$profissional_id', observacao = '$observacao'
                WHERE encaminhamento = $encaminhamento_id returning encaminhamento";
            }
             
            $res = pg_query($con, $sql);
			$encaminhamento_id       = pg_fetch_result($res, 0, 'encaminhamento');
		
            if(strlen(trim(pg_last_error($con))) == 0 and empty($erro)){
                $ok .= "Cadastro Realizado com Sucesso.";
				 header("Location: imprimir_encaminhamento.php?encaminhamento=$encaminhamento_id&paciente=$paciente_id");
				
            }
        }
    }

    if(isset($_GET['paciente'])){
        $paciente_id = (int)$_GET['paciente'];

        $sql_paciente = "select * from tbl_paciente where paciente = $paciente_id ";
        $res_paciente = pg_query($con, $sql_paciente);
        if(pg_num_rows($res_paciente) > 0){
           
        }
    }

	 if(isset($_GET["encaminhamento"])){
        $encaminhamento = (int)$_GET["encaminhamento"];
        $sql_encaminhamento = "SELECT profissional_id, observacao FROM tbl_encaminhamento 
                        WHERE paciente_id= $paciente_id and encaminhamento = $encaminhamento";
        $res_encaminhamento = pg_query($con, $sql_encaminhamento);
        if(pg_num_rows($res_encaminhamento) > 0){
             $observacao           = pg_fetch_result($res_encaminhamento, 0, 'observacao');
			 $profissional_id      = pg_fetch_result($res_encaminhamento, 0, 'profissional_id');
        }	
    }
	
	

?>
<!DOCTYPE html>
<html lang="PT-BR">
    <head> 
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
        <link href="<?php echo RAIZ ?>css/style.css" rel="stylesheet">
        <link href="<?php echo RAIZ ?>css/style_admin.css" rel="stylesheet">
        <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
		

        
		 <link rel="stylesheet" type="text/css" href="./editor/bootstrap3-wysihtml5.min.css"></link>
		 <style type="text/css" media="screen">
          .btn.jumbo {
            font-size: 20px;
            font-weight: normal;
            padding: 14px 24px;
            margin-right: 10px;
            -webkit-border-radius: 6px;
            -moz-border-radius: 6px;
            border-radius: 6px;
          }
        </style>

        
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
                    <div class="col-md-10 corpo" >
                        <div class="page-header">
                            <div class=" col-md-9 titulo_tela" >Encaminhamento</div>
                            <div class="col-md-3 link_tela">
                              <a href="ficha_medica.php?paciente=<?php echo $paciente_id?>" class="btn btn-success btn-sm"><i class="fa fa-list-alt"></i>Paciente</a>		
							  <a href="encaminhamento_listar.php?paciente=<?php echo $paciente_id ?>" class="btn btn-success btn-sm"><i class="fa fa-list-alt"></i>Lista</a>
                            </div>
                        </div>
                        <?php if (strlen(trim($erro)) > 0): ?>
                            <div class="alert alert-danger">
                                <i class="icon-remove-sign"></i>
                                <?php echo $erro ?>
                            </div>
                        <?php endif; ?>
                        <?php if (strlen(trim($ok)) > 0): ?>
                            <div class="alert alert-success">
                                <i class="icon-ok"></i>
                                <?php echo $ok ?>
                            </div>
                        <?php endif; ?>
                        <div class="conteudo">
                            <div class="col-md-12" id="home">
                                   <form name="frm_tipo_imovel" id="frm_tipo_imovel" method="POST" action="">
                                      <div id="funcionario_2">
										<div class="row">
										
											<div class="col-md-offset-3 col-md-3">
												<div class="form-group">
													<label  for="exampleInputEmail1">Especialidade</label>
													<select name="especialidade_id" id="especialidade" class="form-control" >
														<option value="">Especialidade</option>       
														<?php 													
															
															$sql_especialidade = "SELECT especialidade, descricao FROM tbl_especialidade ORDER BY descricao";
															$res_especialidade = pg_query($con, $sql_especialidade);
															for($i =0; $i<pg_num_rows($res_especialidade); $i++){
																$especialidade       = pg_fetch_result($res_especialidade, $i, 'especialidade');
																$descricao           = pg_fetch_result($res_especialidade, $i, 'descricao');
																		

																echo"<option value='$especialidade'>$descricao</option>";
															
															}
														
														?>
													</select>
												</div>
											</div>
												
												
												<div class="col-md-3">
												<div class="form-group">
													<label  for="exampleInputEmail1">Profissional</label>
													<select name="profissional_id" id="profissional" class="form-control">
														<option value="">Profissional</option>       
														
													</select>
												</div>
											</div>
                                            
											
											
										</div>
										<br>
										<br>
								   <form id="frm_ficha" method="POST" action="">
                                    <div class="row" id="observacao">
                                        <div class="col-md-1"></div>
                                        <div class="col-md-9">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Encaminhamento</label>
                                                <textarea name='observacao' class="textarea" placeholder="Enter text ..." style="width: 100%; height: 200px; font-size: 14px; line-height: 18px;">
													
													<?php
														echo $observacao;
													?>
												
												</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 botao">
                                            <input class="btn btn-success" type="submit" name="btnacao" value="Gravar" >
                                            <input type="hidden" name="paciente" value="<?php echo $paciente_id ?>">
											<input type="hidden" name="encaminhamento" value="<?php echo $encaminhamento ?>">
                                        </div>
                                    </div>
                                   
                                </form>

									   </div>

									</div>
								
                               </form>

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
            <script src="<?php echo RAIZ ?>js/docs.min.js"></script>

            <script src="./editor/wysihtml5x-toolbar.min.js"></script>
            <!--<script src="./editor/jquery.min.js"></script>
            <script src="./editor/bootstrap.min.js"></script>-->
            <script src="./editor/runtime.min.js"></script>
            <script src="./editor/bootstrap3-wysihtml5.min.js"></script>
			
			<script type="text/javascript">
			
			$(document).ready(function(){
				
				$("#especialidade").change(function(){
					
					var especialidade = $("#especialidade").val(); 
					//alert('teste'+especialidade);
					
					$.ajax({
						type: 'POST',
						URL: 'encaminhamento.php',
						data: {especialidade:true, especialidade:especialidade},
						dataType: 'text',
						success: function(res){
							$("#profissional").html(res);
							//alert(especialidade);
							
						}
					});
					
				});
			});
			
			</script>
			
			<!--
			 <script type="text/javascript"> 
		$(document).ready(function(){
			$("#especialidade").change(function(){
				var especialidade = $(this).val(); 
				alert("especialidade"+especialidade);
				$.ajax({
					type: 'POST',
					URL: 'encaminhamento.php',
					data: {especialidade:true, }
					dataType: 'text',
					success: function(res){
						$("#especialidade").append(res);
						
					}
				});
			});
		});
			
        </script>-->

            <script>
              $('.textarea').wysihtml5();
            </script>
        </div>
    </body>
</html>