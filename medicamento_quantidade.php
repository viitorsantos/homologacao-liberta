<?php
    include "include/conexao.php";
    include "include/config.php";
    include "include/funcoes.php";
    include "include/verifica_usuario.php";
	
	

    if(isset($_POST["btnacao"])){
		
		if(isset($_GET['paciente'])){
			$paciente_id = (int)$_GET['paciente'];
		}	
	
		$paciente_id              =   fncTrataDados($_POST["paciente"]);
        $medicamento_id           =   fncTrataDados($_POST["medicamento_id"]);
        $medicamento_paciente     =   fncTrataDados($_POST["medicamento_paciente"]);
        $qtde                     =   fncTrataDados($_POST["qtde"]);      


        if(strlen(trim($qtde)) == 0){
            $erro .= "O campo Quantidade deve ser preenchido. <br>";
        }
			
		if(strlen(trim($medicamento_id)) == 0){
            $erro .= "O campo Medicamento deve ser preenchido. <br>";
        }
		

        if(empty($erro)){
            if($medicamento_paciente == 0){
                $sql = "INSERT INTO tbl_medicamento_paciente (paciente_id, medicamento_id, qtde)  
                VALUES ($paciente_id, '$medicamento_id', '$qtde') returning medicamento_paciente";
            }else{
                $sql = "UPDATE tbl_medicamento_paciente SET paciente_id = '$paciente_id', medicamento_id = '$medicamento_id',   qtde = '$qtde'
                WHERE medicamento_paciente = $medicamento_paciente returning medicamento_paciente";
            }
            
     		
            $res = pg_query($con, $sql);
			$medicamento_paciente       = pg_fetch_result($res, 0, 'medicamento_paciente');
			//echo $sql;
            if(strlen(trim(pg_last_error($con))) == 0 and empty($erro)){
                $ok .= "Cadastro Realizado com Sucesso.";
				 
            }
        }
    }

	if(isset($_GET['paciente'])){
        $paciente_id = (int)$_GET['paciente'];

        $sql_paciente = "select * from tbl_paciente where paciente = $paciente_id ";
        $res_paciente = pg_query($con, $sql_paciente);
        if(pg_num_rows($res_paciente) > 0){
             $nome           = pg_fetch_result($res_paciente, 0, 'nome');
             $ddd_tel        = pg_fetch_result($res_paciente, 0, 'ddd_tel');
             $telefone       = pg_fetch_result($res_paciente, 0, 'telefone');
        }
    }
	
	if(isset($_GET['medicamento_paciente'])){
        $medicamento_paciente = (int)$_GET['medicamento_paciente'];
		$sql_med_paciente = "select medicamento_paciente, paciente_id, medicamento_id, qtde from tbl_medicamento_paciente
		where medicamento_paciente=$medicamento_paciente";
		//echo $sql_med_paciente;
		$res_med_paciente = pg_query($con, $sql_med_paciente);
		if(pg_num_rows($res_med_paciente)>0){
			$medicamento_paciente = pg_fetch_result($res_med_paciente, 0, 'medicamento_paciente');
			$paciente_id          = pg_fetch_result($res_med_paciente, 0, 'paciente_id');
			$medicamento_id       = pg_fetch_result($res_med_paciente, 0, 'medicamento_id');
			$qtde                 = pg_fetch_result($res_med_paciente, 0, 'qtde');
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
                            <div class=" col-md-8 titulo_tela" >Prescrição</div>
                            <div class="col-md-4 link_tela">
                                <a href="ficha_medica.php?paciente=<?php echo $paciente_id?>" class="btn btn-success btn-sm">
									<i class="fa fa-list-alt"></i>Paciente</a>															
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
                                 <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                                  <div class="panel panel-default">
                                    <div class="panel-heading" role="tab" id="headingOne">
                                      <h4 class="panel-title">
                                        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                         Paciente
                                        </a>
                                      </h4>
                                    </div>
                                    <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                                      <div class="panel-body">
                                        <div class='row'>
                                            <div class="col-md-7">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Nome</label>
                                                    <?php echo $nome?>
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label  for="exampleInputEmail1">Telefone</label>
													<?php echo "($ddd_tel) "?>
                                                    <?php echo $telefone?>
													
													
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                      </div>
                                    </div>
                                  </div>
                                  
                                </div>
								
								 <div class="row"> 
									<div class="col-md-4 link_tela">
										<a href="medicamento_quantidade.php?paciente=<?php echo $paciente_id?>" class="btn btn-success btn-sm"><i class="fa fa-list-alt"></i>Novo Medicamento</a>       
									</div>
								</div>
								
                                <form method="POST" action="">
									
                                    <div class="row"> 
                                        <div class="col-md-offset-4 col-md-2">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Quantidade</label>
                                                 <input type="text" name="qtde" value="<?php echo $qtde ?>" maxlength="2"  class="form-control" id="exampleInputEmail1">
                                            </div>
                                        </div>
										 <div class="col-md-3">
													<div class="form-group">
														<label  for="exampleInputEmail1">Medicamento</label>
														<select name="medicamento_id" class="form-control">
															<option value="">Medicamento</option>       
															<?php 
															$sql_medicamento = "SELECT medicamento, descricao FROM tbl_medicamento ORDER BY descricao";
															$res_medicamento = pg_query($con, $sql_medicamento);
															for($i =0; $i<pg_num_rows($res_medicamento); $i++){
																$medicamento   = pg_fetch_result($res_medicamento, $i, 'medicamento');
																$descricao     = pg_fetch_result($res_medicamento, $i, 'descricao');

																	if($medicamento_id == $medicamento){
																		$selected = " selected ";
																	}else{
																		$selected = " ";
																	}
																echo "<option value='$medicamento' $selected >$descricao</option>";
															}
															?>
														</select>
													</div>
												</div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 botao">
                                            <input class="btn btn-success" type="submit" name="btnacao" value="Gravar">
                                            <input type="hidden" name="paciente" value="<?php echo $paciente_id ?>">
											<input type="hidden" name="medicamento_paciente" value="<?php echo $medicamento_paciente ?>">
	
                                        </div>
                                    </div>
									
									<div class="page-header">
                                        <div class=" col-md-12 titulo_tela" >Lista</div>
                                    </div>
                               
                                    <div class="row">
                                        <div class="col-md-12 botao">
                                            <table class="table table-hover">
                                                <tr>
													<th class="col-md-4">Paciente</th>
                                                    <th class="col-md-3">Medicamento</th>
                                                    <th class="col-md-3">Quantidade</th>
													<th class="col-md-1">Ações</th>
                                                </tr>
                                                <?php 
                                                    $sql_medicamento_paciente = "SELECT medicamento_paciente, paciente_id, medicamento_id, qtde, tbl_medicamento.descricao as medicamento FROM tbl_medicamento_paciente 
													INNER JOIN tbl_medicamento ON tbl_medicamento.medicamento = tbl_medicamento_paciente.medicamento_id
													WHERE paciente_id= $paciente_id order by medicamento_paciente desc";
													//echo $sql_medicamento_paciente;
													$res_medicamento_paciente = pg_query($con, $sql_medicamento_paciente);
                                                      if(pg_num_rows($res_medicamento_paciente)>0){
                                                        for($i=0; $i<pg_num_rows($res_medicamento_paciente); $i++){
															$medicamento_paciente = pg_fetch_result($res_medicamento_paciente, $i, 'medicamento_paciente');
															$paciente_id          = pg_fetch_result($res_medicamento_paciente, $i, 'paciente_id');
															$medicamento          = pg_fetch_result($res_medicamento_paciente, $i, 'medicamento');
															$qtde                 = pg_fetch_result($res_medicamento_paciente, $i, 'qtde');
                                                     
                                                            echo "<tr>";
																echo "<td align='left'>$nome</td>";
                                                                echo "<td align='left'>$medicamento </td>";
                                                                echo "<td align='left'>$qtde</td>";
																echo "<td align='left'><a href='./medicamento_quantidade.php?paciente=$paciente_id&medicamento_paciente=$medicamento_paciente' title='Editar'><i class='fa fa-pencil-square-o'></i></a></td>";
																echo "<td align='left'><a href='./prescricao.php?paciente=$paciente_id&medicamento_paciente=$medicamento_paciente' title='Prescrição'><i class='fa fa-list-alt'></i></a></td>";
                                                            echo "</tr>";
                                                        }
                                                    }
													

                                                ?>
                                              


                                            </table>
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
			

			
        </div>
    </body>
</html>