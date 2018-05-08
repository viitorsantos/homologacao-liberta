<?php
    include "include/conexao.php";
    include "include/config.php";
    include "include/funcoes.php";
    include "include/verifica_usuario.php";
	

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
		}
		
		
	
     if(isset($_POST["btnacao"])){
		
		$dia1 		= 		(fncTrataDados($_POST["dia1"]) == 't') ? 't' : 'f';
        $dia2 		= 		(fncTrataDados($_POST["dia2"]) == 't') ? 't' : 'f';
		$dia3 		= 		(fncTrataDados($_POST["dia3"]) == 't') ? 't' : 'f';
		$dia4 		= 		(fncTrataDados($_POST["dia4"]) == 't') ? 't' : 'f';
		$dia5 		= 		(fncTrataDados($_POST["dia5"]) == 't') ? 't' : 'f';
		$dia6 		= 		(fncTrataDados($_POST["dia6"]) == 't') ? 't' : 'f';
		$dia7 		= 		(fncTrataDados($_POST["dia7"]) == 't') ? 't' : 'f';
		$dia8 		= 		(fncTrataDados($_POST["dia8"]) == 't') ? 't' : 'f';
		$dia9 		= 		(fncTrataDados($_POST["dia9"]) == 't') ? 't' : 'f';
		$dia10 		= 		(fncTrataDados($_POST["dia10"]) == 't') ? 't' : 'f';
		$dia11 		= 		(fncTrataDados($_POST["dia11"]) == 't') ? 't' : 'f';
		$dia12 		= 		(fncTrataDados($_POST["dia12"]) == 't') ? 't' : 'f';
		$dia13 		= 		(fncTrataDados($_POST["dia13"]) == 't') ? 't' : 'f';
		$dia14 		= 		(fncTrataDados($_POST["dia14"]) == 't') ? 't' : 'f';
		$dia15 		= 		(fncTrataDados($_POST["dia15"]) == 't') ? 't' : 'f';
		$dia16 		= 		(fncTrataDados($_POST["dia16"]) == 't') ? 't' : 'f';
		$dia17 		= 		(fncTrataDados($_POST["dia17"]) == 't') ? 't' : 'f';
		$dia18 		= 		(fncTrataDados($_POST["dia18"]) == 't') ? 't' : 'f';
		$dia19 		= 		(fncTrataDados($_POST["dia19"]) == 't') ? 't' : 'f';
		$dia20 		= 		(fncTrataDados($_POST["dia20"]) == 't') ? 't' : 'f';
		$dia21 		= 		(fncTrataDados($_POST["dia21"]) == 't') ? 't' : 'f';
		$dia22 		= 		(fncTrataDados($_POST["dia22"]) == 't') ? 't' : 'f';
		$dia23 		= 		(fncTrataDados($_POST["dia23"]) == 't') ? 't' : 'f';
		$dia24 		= 		(fncTrataDados($_POST["dia24"]) == 't') ? 't' : 'f';
		$dia25 		= 		(fncTrataDados($_POST["dia25"]) == 't') ? 't' : 'f';
		$dia26 		= 		(fncTrataDados($_POST["dia26"]) == 't') ? 't' : 'f';
		$dia27 		= 		(fncTrataDados($_POST["dia27"]) == 't') ? 't' : 'f';
		$dia28 		= 		(fncTrataDados($_POST["dia28"]) == 't') ? 't' : 'f';
		$dia29 		= 		(fncTrataDados($_POST["dia29"]) == 't') ? 't' : 'f';
		$dia30 		= 		(fncTrataDados($_POST["dia30"]) == 't') ? 't' : 'f';
		$dia31 		= 		(fncTrataDados($_POST["dia31"]) == 't') ? 't' : 'f';
	    $prescricao_id		= 		fncTrataDados($_POST["prescricao"]);
		
		
		if(empty($erro)){
			if($prescricao_id == 0){
			$sql_prescricao = "INSERT INTO tbl_prescricao(
							   dia1,
							   dia2,
							   dia3,
							   dia4,
							   dia5,
							   dia6,
							   dia7,
							   dia8,
							   dia9,
							   dia10,
							   dia11,
							   dia12,
							   dia13,
							   dia14,
							   dia15,
							   dia16,
							   dia17,
							   dia18,
							   dia19,
							   dia20,
							   dia21,
							   dia22,
							   dia23,
							   dia24,
							   dia25,
							   dia26,
							   dia27,
							   dia28,
							   dia29,
							   dia30,
							   dia31,
							   medicamento_paciente_id,
							   paciente_id)
							   VALUES(
							   '$dia1',
							   '$dia2',
							   '$dia3',
							   '$dia4',
							   '$dia5',
							   '$dia6',
							   '$dia7',
							   '$dia8',
							   '$dia9',
							   '$dia10',
							   '$dia11',
							   '$dia12',
							   '$dia13',
							   '$dia14',
							   '$dia15',
							   '$dia16',
							   '$dia17',
							   '$dia18',
							   '$dia19',
							   '$dia20',
							   '$dia21',
							   '$dia22',
							   '$dia23',
							   '$dia24',
							   '$dia25',
							   '$dia26',
							   '$dia27',
							   '$dia28',
							   '$dia29',
							   '$dia30',
							   '$dia31',
							   '$medicamento_paciente',
							   '$paciente_id'
							   )";
			}else{
				$sql_prescricao = "UPDATE tbl_prescricao SET dia1 = '$dia1',
															 dia2 = '$dia2',
															 dia3 = '$dia3',
															 dia4 = '$dia4',
															 dia5 = '$dia5',
															 dia6 = '$dia6',
															 dia7 = '$dia7',
															 dia8 = '$dia8',
															 dia9 = '$dia9',
															 dia10 = '$dia10',
															 dia11 = '$dia11',
															 dia12 = '$dia12',
															 dia13 = '$dia13',
															 dia14 = '$dia14',
															 dia15 = '$dia15',
															 dia16 = '$dia16',
															 dia17 = '$dia17',
															 dia18 = '$dia18',
															 dia19 = '$dia19',
															 dia20 = '$dia20',
															 dia21 = '$dia21',
															 dia22 = '$dia22',
															 dia23 = '$dia23',
															 dia24 = '$dia24',
															 dia25 = '$dia25',
															 dia26 = '$dia26',
															 dia27 = '$dia27',
															 dia28 = '$dia28',
															 dia29 = '$dia29',
															 dia30 = '$dia30',
															 dia31 = '$dia31' 
															 WHERE prescricao = '$prescricao_id'
															 AND status_id = 1";
			}
			//echo $sql_prescricao;
			$res = pg_query($con, $sql_prescricao);
			if(strlen(trim(pg_last_error($con))) == 0 and empty($erro)){
				$ok .= "Cadastro Realizado com Sucesso.";
			 }
		}
	}
	

	$sql_lista = "SELECT *FROM tbl_prescricao WHERE paciente_id = $paciente_id AND medicamento_paciente_id = $medicamento_paciente";
	$res_lista = pg_query($con, $sql_lista);
	if(pg_num_rows($res_lista) > 0){
		$prescricao_id        = pg_fetch_result($res_lista, 0, 'prescricao');
		$dia1                 = pg_fetch_result($res_lista, 0, 'dia1');
		$dia2                 = pg_fetch_result($res_lista, 0, 'dia2');
		$dia3                 = pg_fetch_result($res_lista, 0, 'dia3');
		$dia4                 = pg_fetch_result($res_lista, 0, 'dia4');
		$dia5                 = pg_fetch_result($res_lista, 0, 'dia5');
		$dia6                 = pg_fetch_result($res_lista, 0, 'dia6');
		$dia7                 = pg_fetch_result($res_lista, 0, 'dia7');
		$dia8                 = pg_fetch_result($res_lista, 0, 'dia8');
		$dia9                 = pg_fetch_result($res_lista, 0, 'dia9');
		$dia10                = pg_fetch_result($res_lista, 0, 'dia10');
		$dia11                = pg_fetch_result($res_lista, 0, 'dia11');
		$dia12                = pg_fetch_result($res_lista, 0, 'dia12');
		$dia13                = pg_fetch_result($res_lista, 0, 'dia13');
		$dia14                = pg_fetch_result($res_lista, 0, 'dia14');
		$dia15                = pg_fetch_result($res_lista, 0, 'dia15');
		$dia16                = pg_fetch_result($res_lista, 0, 'dia16');
		$dia17                = pg_fetch_result($res_lista, 0, 'dia17');
		$dia18                = pg_fetch_result($res_lista, 0, 'dia18');
		$dia19                = pg_fetch_result($res_lista, 0, 'dia19');
		$dia20                = pg_fetch_result($res_lista, 0, 'dia20');
		$dia21                = pg_fetch_result($res_lista, 0, 'dia21');
		$dia22                = pg_fetch_result($res_lista, 0, 'dia22');
		$dia23                = pg_fetch_result($res_lista, 0, 'dia23');
		$dia24                = pg_fetch_result($res_lista, 0, 'dia24');
		$dia25                = pg_fetch_result($res_lista, 0, 'dia25');
		$dia26                = pg_fetch_result($res_lista, 0, 'dia26');
		$dia27                = pg_fetch_result($res_lista, 0, 'dia27');
		$dia28                = pg_fetch_result($res_lista, 0, 'dia28');
		$dia29                = pg_fetch_result($res_lista, 0, 'dia29');
		$dia30                = pg_fetch_result($res_lista, 0, 'dia30');
		$dia31                = pg_fetch_result($res_lista, 0, 'dia31');
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
                                <a href="medicamento_quantidade.php?paciente=<?php echo $paciente_id?>" class="btn btn-success btn-sm"><i class="fa fa-list-alt"></i>Voltar</a>     
                            </div>
                            <div class="col-md-1 link_tela">
                                <a href="ficha_medica.php?paciente=<?php echo $paciente_id?>" class="btn btn-success btn-sm"><i class="fa fa-list-alt"></i>Paciente</a>     
                            </div>
                        </div>
						<form method="POST" action="">
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
                                    <div class="row">
                                        <div class="col-md-12 botao">
                                            <table class="table table-hover">
                                                <tr>
													<th class="col-md-3">Paciente</th>
													<th class="col-md-2">Mês-Ano-Horario</th>
                                                    <th class="col-md-3">Medicamento</th>
                                                    <th class="col-md-3">Quantidade</th>
													
                                                </tr>
                                                <?php 
                                                    $sql_medicamento_paciente = "SELECT medicamento_paciente, paciente_id, medicamento_id, qtde, mes, ano, horario,
													tbl_medicamento.descricao as medicamento FROM tbl_medicamento_paciente 
													INNER JOIN tbl_medicamento ON tbl_medicamento.medicamento = tbl_medicamento_paciente.medicamento_id
													WHERE medicamento_paciente = $medicamento_paciente";
													//echo $sql_medicamento_paciente;
													$res_medicamento_paciente = pg_query($con, $sql_medicamento_paciente);
                                                      if(pg_num_rows($res_medicamento_paciente)>0){
                                                        for($i=0; $i<pg_num_rows($res_medicamento_paciente); $i++){
															$medicamento_paciente = pg_fetch_result($res_medicamento_paciente, $i, 'medicamento_paciente');
															$medicamento          = pg_fetch_result($res_medicamento_paciente, $i, 'medicamento');
															$qtde                 = pg_fetch_result($res_medicamento_paciente, $i, 'qtde');
															$mes                  = pg_fetch_result($res_medicamento_paciente, $i, 'mes');
															$ano                  = pg_fetch_result($res_medicamento_paciente, $i, 'ano');
															$horario              = pg_fetch_result($res_medicamento_paciente, $i, 'horario');
                                                     
                                                            echo "<tr>";
																echo "<td align='left'>$nome</td>";
																echo "<td align='left'>$mes - $ano - $horario</td>";
                                                                echo "<td align='left'>$medicamento </td>";
                                                                echo "<td align='left'>$qtde</td>";
                                                            echo "</tr>";
                                                        }
                                                    }
                                                ?>
                                            </table>
                                        </div>
                                    </div>
									
									<div class = "row">
										<div class="col-md-offset-5 col-md-2">
											<h2>Dias</h2>
										</div>
									</div>
									<br>
									<div class="row">
										<div class="col-md-offset-2 col-md-1">
											<label>1<br>
											<input type="checkbox" name="dia1" value="t" <?php  if($dia1 == t) echo " checked "; ?>>
											</label>
										</div>
										<div class="col-md-1">
											<label>2<br>
											<input type="checkbox" name="dia2" value="t" <?php  if($dia2 == t) echo " checked "; ?>>
											</label>
										</div>
										<div class="col-md-1">
											<label>3<br>
											<input type="checkbox" name="dia3" value="t" <?php  if($dia3 == t) echo " checked "; ?>>
											</label>
										</div>
										<div class="col-md-1">
											<label>4<br>
											<input type="checkbox" name="dia4" value="t" <?php  if($dia4 == t) echo " checked "; ?>>
											</label>
										</div>
										<div class="col-md-1">
											<label>5<br>
											<input type="checkbox" name="dia5" value="t" <?php  if($dia5 == t) echo " checked "; ?>>
											</label>
										</div>
										<div class="col-md-1">
											<label>6<br>
											<input type="checkbox" name="dia6" value="t" <?php  if($dia6 == t) echo " checked "; ?>>
											</label>
										</div>
										<div class="col-md-1">
											<label>7<br>
											<input type="checkbox" name="dia7" value="t" <?php  if($dia7 == t) echo " checked "; ?>>
											</label>
										</div>
									</div>
									<div class="row">
										<div class="col-md-offset-2 col-md-1">
											<label>8<br>
											<input type="checkbox" name="dia8" value="t" <?php  if($dia8 == t) echo "checked"; ?>>
											</label>
										</div>
										<div class="col-md-1">
											<label>9<br>
											<input type="checkbox" name="dia9" value="t" <?php  if($dia9 == t) echo " checked "; ?>>
											</label>
										</div>
										<div class="col-md-1">
											<label>10<br>
											<input type="checkbox" name="dia10" value="t" <?php  if($dia10 == t) echo " checked "; ?>>
											</label>
										</div>
										<div class="col-md-1">
											<label>11<br>
											<input type="checkbox" name="dia11" value="t" <?php  if($dia11 == t) echo " checked "; ?>>
											</label>
										</div>
										<div class="col-md-1">
											<label>12<br>
											<input type="checkbox" name="dia12" value="t" <?php  if($dia12 == t) echo " checked "; ?>>
											</label>
										</div>
										<div class="col-md-1">
											<label>13<br>
											<input type="checkbox" name="dia13" value="t" <?php  if($dia13 == t) echo " checked "; ?>>
											</label>
										</div>
										<div class="col-md-1">
											<label>14<br>
											<input type="checkbox" name="dia14" value="t" <?php  if($dia14 == t) echo " checked "; ?>>
											</label>
										</div>
									</div>
									<div class="row">
										<div class="col-md-offset-2 col-md-1">
											<label>15<br>
											<input type="checkbox" name="dia15" value="t" <?php  if($dia15 == t) echo " checked "; ?>>
											</label>
										</div>
										<div class="col-md-1">
											<label>16<br>
											<input type="checkbox" name="dia16" value="t" <?php  if($dia16 == t) echo " checked "; ?>>
											</label>
										</div>
										<div class="col-md-1">
											<label>17<br>
											<input type="checkbox" name="dia17" value="t" <?php  if($dia17 == t) echo " checked "; ?>>
											</label>
										</div>
										<div class="col-md-1">
											<label>18<br>
											<input type="checkbox" name="dia18" value="t" <?php  if($dia18 == t) echo " checked "; ?>>
											</label>
										</div>
										<div class="col-md-1">
											<label>19<br>
											<input type="checkbox" name="dia19" value="t" <?php  if($dia19 == t) echo " checked "; ?>>
											</label>
										</div>
										<div class="col-md-1">
											<label>20<br>
											<input type="checkbox" name="dia20" value="t" <?php  if($dia20 == t) echo " checked "; ?>>
											</label>
										</div>
										<div class="col-md-1">
											<label>21<br>
											<input type="checkbox" name="dia21" value="t" <?php  if($dia21 == t) echo " checked "; ?>>
											</label>
										</div>
									</div>
									<div class="row">
										<div class="col-md-offset-2 col-md-1">
											<label>22<br>
											<input type="checkbox" name="dia22" value="t" <?php  if($dia22 == t) echo " checked "; ?>>
											</label>
										</div>
										<div class="col-md-1">
											<label>23<br>
											<input type="checkbox" name="dia23" value="t" <?php  if($dia23 == t) echo " checked "; ?>>
											</label>
										</div>
										<div class="col-md-1">
											<label>24<br>
											<input type="checkbox" name="dia24" value="t" <?php  if($dia24 == t) echo " checked "; ?>>
											</label>
										</div>
										<div class="col-md-1">
											<label>25<br>
											<input type="checkbox" name="dia25" value="t" <?php  if($dia25 == t) echo " checked "; ?>>
											</label>
										</div>
										<div class="col-md-1">
											<label>26<br>
											<input type="checkbox" name="dia26" value="t" <?php  if($dia26 == t) echo " checked "; ?>>
											</label>
										</div>
										<div class="col-md-1">
											<label>27<br>
											<input type="checkbox" name="dia27" value="t" <?php  if($dia27 == t) echo " checked "; ?>>
											</label>
										</div>
										<div class="col-md-1">
											<label>28<br>
											<input type="checkbox" name="dia28" value="t" <?php  if($dia28 == t) echo " checked "; ?>>
											</label>
										</div>
									</div>
									<div class="row">
										<div class="col-md-offset-2 col-md-1">
											<label>29<br>
											<input type="checkbox" name="dia29" value="t" <?php  if($dia29 == t) echo " checked "; ?>>
											</label>
										</div>
										<div class="col-md-1">
											<label>30<br>
											<input type="checkbox" name="dia30" value="t" <?php  if($dia30 == t) echo " checked "; ?>>
											</label>
										</div>
										<div class="col-md-1">
											<label>31<br>
											<input type="checkbox" name="dia31" value="t" <?php  if($dia31 == t) echo " checked "; ?>>
											</label>
										</div>
									</div>
		
								 <div class="row">
                                        <div class="col-md-12 botao">
                                            <input class="btn btn-success" type="submit" name="btnacao" value="Gravar">
                                            <input type="hidden" name="prescricao" value="<?php echo $prescricao_id ?>">
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