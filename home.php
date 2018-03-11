<?php
    include "include/conexao.php";
    include "include/config.php";
    include "include/funcoes.php";
    include "include/verifica_usuario.php";


if(isset($_GET["confirma"])){
    $confirmar = (int)$_GET["confirma"];

    $sql_confirmar = "UPDATE tbl_agendamento SET confirmado = 't', data_confirmacao = now() where agendamento = $confirmar";
    $res_confirmar = pg_query($con, $sql_confirmar);
}

if(isset($_GET["cancela"])){
    $cancelar = (int)$_GET["cancela"];

    $sql_confirmar = "UPDATE tbl_agendamento SET confirmado = 'f', data_confirmacao = now() where agendamento = $cancelar";
    $res_confirmar = pg_query($con, $sql_confirmar);
}

if(isset($_GET["realizar"])){
    $realizar = (int)$_GET["realizar"];

    $sql_confirmar = "UPDATE tbl_agendamento SET finalizado = now() where agendamento = $realizar";
    $res_confirmar = pg_query($con, $sql_confirmar);
}

/*
if($_descricao_usuario == $_clinica_atendente){
	//$complemento_where = "";
}

if($_descricao_usuario == $_clinica_medico){
	$complemento_where = " and tbl_agendamento.medico = $_funcionario_id and tbl_grupo_usuario.descricao = 'Podóloga'";	
}
*/

$sql_agendamento = "
select tbl_agendamento.agendamento, tbl_agendamento.paciente_id, tbl_agendamento.nome, horario, data, medico, tbl_agendamento.telefone, 
confirmado, finalizado, tbl_funcionario.nome as nome_medico from tbl_agendamento 
inner join tbl_funcionario on tbl_funcionario.funcionario = tbl_agendamento.medico
inner join tbl_grupo_usuario on tbl_grupo_usuario.grupo_usuario = tbl_funcionario.grupo_usuario_id
where empresa = ".EMPRESA."  $complemento_where and data >= current_date order by data, horario ";
$res_agendamento = pg_query($con, $sql_agendamento);

//echo nl2br($sql_agendamento);

  
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
		<script type="text/javascript">
			function confirmada(){
				
			   var press = confirm("Deseja confirmar esta consulta ?");
				if(press){
					alert("Consulta Confirmada com sucesso");
					return true;
				}else{
					return false;
				}
			}
			
			function cancelada(){
				
			   var press = confirm("Deseja cancelar esta consulta ?");
				if(press){
					alert("Consulta Cancelada com sucesso");
					return true;
				}else{
					return false;
				}
			}
			
			function realizada(){
				
			   var press = confirm("A consulta foi realizada ?");
				if(press){
					alert("Consulta Realizada com sucesso");
					return true;
				}else{
					return false;
				}
			}
		</script>
		<style >
			#confirmada{
				color:green;
				font-weight: bold;
			}
			#cancelada{
				color:red;
				font-weight: bold;
			}
			#realizada{
				color:blue;
				font-weight: bold;
			}
			
		</style>
    </head>
    <body>
        <div class="container">
            <div class="container-fluid">
                <div class="row">
                   <?php include RAIZ."include/cabecalho.php" ?>
                    <div class="col-md-2 col-sm-12" >
                        <?php include RAIZ."include/menu_admin.php" ?>
                    </div>
                    <div class="col-md-10 corpo  col-sm-12" >
                        <div class="page-header">
                            <div class=" col-md-10 titulo_tela" >Home</div>
                            <div class="col-md-2 link_tela">
                                <!--<a href="cliente_listar.php" class="btn btn-info btn-sm"><i class="fa fa-list-alt"></i>Lista</a>-->
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
                            <div class="row">
                                <div class="col-md-12" id="home">
                                    Olá <?= $login ?> sejá bem-vindo ao FiveClinic.
                                </div>
                            </div>
							<div class='row'>
                                <div class="col-md-offset-2 col-md-1 legenda">
                                    Legenda:
                                </div>
                                <div class="col-md-3 " id="confirmada">
                                    Consultas Confirmadas
                                </div>
                                <div class="col-md-3 " id="cancelada">
                                    Consultas Canceladas
                                </div>
                                <div class="col-md-2 " id="realizada">
                                    Consultas Realizadas
                                </div>
                            </div>
                            <div class="row">
                                <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                                  <div class="panel panel-default">
                                    <div class="panel-heading" role="tab" id="headingOne">
                                      <h4 class="panel-title">
                                        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                          <i class="fa fa-clock-o"></i> Consultas Agendadas
                                        </a>
                                      </h4>
                                    </div>
                                    <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                                        <div class="panel-body">
                                            <div class="panel-body" style="max-height:500px; overflow:auto">
                                                <table class="table  agendamento">
                                                  <thead>
                                                    <tr>
                                                        <th align="center" class="col-md-1" style="text-align:center; width:25px;">#</th>
                                                        <th align='center' class="col-md-1" style="text-align:center;">Horario</th>
                                                        <th align='center' class="col-md-5" style="text-align:center;">Nome</th>
                                                        <th align='center' class="col-md-2" style="text-align:center;">Telefone</th>
                                                        <th align='center' class="col-md-2" style="text-align:center;"><?php 
                                                                                                        echo "$_agenda_fitra_por";
                                                                                                     ?></th>
                                                        <th align='center' class="col-md-1" style="text-align:center; width:25px "><i class='fa fa-check fa-lg'></i></th>
                                                        <th align='center' class="col-md-1" style="text-align:center; width:25px "><i class='fa fa-ban fa-lg'></i></th>
                                                        <th align='center' class="col-md-1" style="text-align:center; width:25px "><i class='fa fa-sign-out fa-lg'></i></th>                                          
                                                    </tr>
                                                  </thead>
                                                  <tbody>
                                                    <?php 

                                                    for($i=0; $i<pg_num_rows($res_agendamento); $i++){
                                                        $agendamento    = pg_fetch_result($res_agendamento, $i, 'agendamento');
                                                        $nome           = pg_fetch_result($res_agendamento, $i, 'nome');
                                                        $data           = fnc_data_formatada(pg_fetch_result($res_agendamento, $i, 'data'));
                                                        $horario        = substr(pg_fetch_result($res_agendamento, $i, 'horario'),0,5);
                                                        $telefone       = pg_fetch_result($res_agendamento, $i, 'telefone');
                                                        $confirmado     = pg_fetch_result($res_agendamento, $i, 'confirmado');
                                                        $nome_medico    = pg_fetch_result($res_agendamento, $i, 'nome_medico');
                                                        $paciente_id    = pg_fetch_result($res_agendamento, $i, 'paciente_id');
														$finalizado     = pg_fetch_result($res_agendamento, $i, 'finalizado');

                                                        if((int)$paciente_id > 0){
                                                            $dadosPaciente = "&paciente=$paciente_id";
                                                        }else{
                                                            $dadosPaciente = "";
                                                        }

                                                        if($confirmado == 'f'){
                                                            continue;
                                                        }

                                                        if($confirmado == 't'){
                                                            $cor = 'background-color:#C1FFC1 !important';
                                                        }elseif($confirmado == 'f'){
                                                            $cor = 'background-color:#FFE4E1 !important';
                                                        }else{
                                                            $cor = "";
                                                        }
																
														if($finalizado > 0){
															$cor = 'background-color:#ADD8E6 !important';
														}

                                                        if($data != $data_anterior){
                                                            echo "<tr>";
                                                                echo "<td colspan='8' align='center' bgcolor='#f8f8f8'><b>$data<b></td>";
                                                            echo "</tr>";
                                                        }                                                                                
                                                        echo "<tr >";
                                                            echo "<td style='text-align:center; width:25px; $cor'>".($i+1)."</td>";
                                                            echo "<td style='$cor' align='center'>$horario</td>";
                                                            echo "<td style='$cor' ><a href='./cliente_cadastrar.php?agendamento=$agendamento$dadosPaciente'>$nome</a></td>";
                                                            echo "<td style='$cor' align='center'>$telefone</td>";
                                                            echo "<td style='$cor' align='center'>$nome_medico</td>";
                                                            echo "<td style='$cor' align='center'><a href='?confirma=$agendamento' title='Paciente confirma que virá na consulta' onclick='return confirmada()'><i class='fa fa-check fa-fw'></i></a></td>";
                                                            echo "<td style='$cor' align='center'><a href='?cancela=$agendamento' title='Paciente cancelou a consulta' onclick='return cancelada()'><i class='fa fa-ban fa-fw'></i></a></td>";
                                                            echo "<td style='$cor' align='center'><a href='?realizar=$agendamento' title='Consulta realizada' onclick='return realizada()'><i class='fa fa-sign-out fa-fw'></i></a></td>";

                                                        echo "</tr>";
                                                        $data_anterior = $data;
                                                    }
                                                    ?>                                                    
                                                  </tbody>
                                                </table>
                                              </div>
                                        </div>

                                      </div>
                                    </div>
                                  </div>             
                                

                                <div class="panel panel-default" > 
                                    <div class="panel-heading" role="tab" id="headingTwo" >
                                      <h4 class="panel-title">
                                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                                          <i class="fa fa-clock-o"></i> Consultas Canceladas
                                        </a>
                                      </h4>
                                    </div>
                                    <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                                      <div class="panel-body">
                                        <div class="panel-body" style="max-height:250px; overflow:auto">
                                            <table class="table  agendamento" >
                                              <thead>
                                                <tr>
                                                    <th align="center" class="col-md-1">#</th>
                                                    <th align='center' class="col-md-1">Data/Horario</th>
                                                    <th align='center' class="col-md-5">Nome</th>
                                                    <th align='center' class="col-md-2">Telefone</th>
                                                    <th align='center' class="col-md-2">Médico</th>
                                                    <th align='center' class="col-md-1">Confirmar</th>
                                                    <th align='center' class="col-md-1">Cancelar</th>                                          
                                                </tr>
                                              </thead>
                                              <tbody>
                                                <?php 

                                                for($i=0; $i<pg_num_rows($res_agendamento); $i++){
                                                    $agendamento    = pg_fetch_result($res_agendamento, $i, 'agendamento');
                                                    $nome           = pg_fetch_result($res_agendamento, $i, 'nome');
                                                    $data           = fnc_data_formatada(pg_fetch_result($res_agendamento, $i, 'data'));
                                                    $horario        = substr(pg_fetch_result($res_agendamento, $i, 'horario'),0,5);
                                                    $telefone       = pg_fetch_result($res_agendamento, $i, 'telefone');
                                                    $confirmado     = pg_fetch_result($res_agendamento, $i, 'confirmado');
                                                    $nome_medico    = pg_fetch_result($res_agendamento, $i, 'nome_medico');

                                                    if($confirmado != 'f'){
                                                        continue;
                                                    }

                                                    if($confirmado == 't'){
                                                        $cor = 'background-color:#C1FFC1 !important';
                                                    }elseif($confirmado == 'f'){
                                                        $cor = 'background-color:#FFE4E1 !important';
                                                    }else{
                                                        $cor = "";
                                                    }

                                                    if($data != $data_anterior){
                                                        echo "<tr>";
                                                            echo "<td colspan='7' align='center' bgcolor='#f8f8f8'><b>$data<b></td>";
                                                        echo "</tr>";
                                                    }                                                                                
                                                    echo "<tr >";
                                                        echo "<td style='$cor'>".($i+1)."</td>";
                                                        echo "<td style='$cor' align='center'>$horario</td>";
                                                        echo "<td style='$cor'>$nome</td>";
                                                        echo "<td style='$cor'>$telefone</td>";
                                                        echo "<td style='$cor'>$nome_medico</td>";
                                                        echo "<td style='$cor' align='center' title='Confirmar'><a href='?confirma=$agendamento' onclick='return confirmada()'><i class='fa fa-check fa-lg'></i></a></td>";
                                                        echo "<td style='$cor' align='center' title='Cancelar'><a href='?cancela=$agendamento'><i class='fa fa-ban fa-lg'></i></a></td>";
                                                    echo "</tr>";
                                                    $data_anterior = $data;
                                                }
                                                ?>                                                
                                              </tbody>
                                            </table>
                                          </div>                                        
                                      </div>
                                    </div>
                                  </div>
                                  <!--<div class="panel panel-default">
                                    <div class="panel-heading" role="tab" id="headingThree">
                                      <h4 class="panel-title">
                                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                          Collapsible Group Item #3
                                        </a>
                                      </h4>
                                    </div>
                                    <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                                      <div class="panel-body">
                                        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                                      </div>
                                    </div>
                                  </div>-->
                                
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
        </div>
    </body>
</html>