<?php
    include "include/conexao.php";
    include "include/config.php";
    include "include/funcoes.php";
    include "include/verifica_usuario.php";
    include "calendario.php";

    if(!isset($_POST["ano"])){
        $ano = date("Y");
    }else{
        $ano = $_POST["ano"];
    }
	
	
	if(isset($_POST["btnacao_salvar"])){
		
		
        $medico             = $_POST["medico"];
        $horario            = $_POST["horario"];
        $nome_agendamento   = $_POST["nome_agendamento"];
        $telefone           = $_POST["telefone"];
        $data               = $_POST["data"];
		$celular			= $_POST["celular"];
        $paciente_id        = (int)$_POST["paciente_id"];
        $convenio_id        = (int)$_POST["convenio_id"];

        $horario = str_pad($horario, 4, "0", STR_PAD_LEFT);
        $horario = substr($horario, 0, 2) .":". substr($horario, 2, 2);
		
		$data_hora_ag = $data. " ". $horario;

        if($paciente_id == 0){
            $paciente_id = 'null';
        }	
		
		$arr_retirar = array("(", ")", " ", ".", "-");
		$celular 		= str_replace($arr_retirar, "", $celular);
		$telefone		= str_replace($arr_retirar, "", $telefone);
        
		$res = pg_query($con,"BEGIN");
		
        $empresa = EMPRESA;
        $sql = "INSERT INTO tbl_agendamento (nome, telefone, horario, data, medico, empresa, paciente_id, convenio_id, celular) 
                VALUES ('$nome_agendamento', '$telefone', '$horario', '$data', $medico, $empresa, $paciente_id, $convenio_id, '$celular')";
        $res = pg_query($con, $sql);		
				
		$sql_curval= "select currval('seq_agendamento') as agendamento";
		$res_curval = pg_query($con, $sql_curval);
		$agendamento = pg_fetch_result($res_curval, 0, "agendamento");
				
		$sql_verifica_convenio = "select isento, convenio from tbl_convenio where convenio = $convenio_id";
		$res_verifica_convenio = pg_query($con, $sql_verifica_convenio);
		if(strlen(trim(pg_last_error()))>0){
			$erro .= pg_last_error();
		}		
		
		if(pg_num_rows($res_verifica_convenio)> 0 ){
			$isento = pg_fetch_result($res_verifica_convenio, 0, "isento"); 
			if($isento == 't'){
				$valor = '0.00';
				$data_pagamento = 'now()';
			}else{
				$valor = VALOR_CONSULTA;
				$data_pagamento = 'null';
			}			
		}
		
		$sql_pagto_consulta = "INSERT into tbl_pagamento_consulta (agendamento, data_hora_ag, convenio, descricao, valor, data_pagamento) 
								VALUES ($agendamento, '$data_hora_ag', $convenio_id, 'Lançamento automático no agendamento', '$valor', $data_pagamento) "; 
		$res_pagto_consulta = pg_query($con, $sql_pagto_consulta);	

		if(strlen(trim(pg_last_error()))>0){
			$erro .= pg_last_error();
			$ok = "";
		}else{
			$ok = "Agendamento realizado com sucesso.";
			$erro = "";
		}
		
		$retorno = array("ok" => "$ok", "error" => "$erro");
		
		if(!empty($erro)){
			$res = pg_query($con,"ROLLBACK");
		} else {
			$res = pg_query($con,"COMMIT");
		}
						
		echo json_encode($retorno, true);
		 
		exit;
    }
	
	

    if(isset($_POST["pesquisa_paciente"])){
        $nome = $_POST["nome"];

        $sql = "SELECT nome, ddd_cel, ddd_tel, telefone, celular, cidade_id, paciente, tbl_cidade.descricao 
                FROM TBL_PACIENTE
                inner join tbl_cidade on tbl_cidade.cidade = tbl_paciente.cidade_id 
                WHERE paciente > 0 and nome ~* '$nome' ";
        $res = pg_query($con, $sql);

        if(pg_num_rows($res)>0){
            echo "<div class='table-responsive'>
                    <table class='table table-striped'>
                        <thead>
                            <tr>
                                <th class='col-md-1' align='center' style='font-size:12px'>#</th>
                                <th class='col-md-4' style='font-size:12px'>Nome</th>
                                <th class='col-md-2' style='font-size:12px'>Cidade</th>
                                <th class='col-md-3' style='font-size:12px'>Telefone</th>
								<th class='col-md-3' style='font-size:12px'>Celular</th>
                            </tr>
                        </thead>
                        <body";
            for($i=0; $i<pg_num_rows($res); $i++){
                $paciente = pg_fetch_result($res, $i, 'paciente');
                $nome   = pg_fetch_result($res, $i, 'nome');
                $cidade  = pg_fetch_result($res, $i, 'descricao');
                $ddd_cel    = pg_fetch_result($res, $i, 'ddd_cel');
                $ddd_tel    = pg_fetch_result($res, $i, 'ddd_tel');
                $telefone   = pg_fetch_result($res, $i, 'telefone');
                $celular    = pg_fetch_result($res, $i, 'celular');

                $numeros = "";

                $num_telefone   = $ddd_tel."-".$telefone;
                $num_celular    = $ddd_cel."-".$celular;
				
				$arr_retirar = array("(", ")", " ", ".", "-");
				$num_celular 		= str_replace($arr_retirar, "", $num_celular);
				$num_telefone		= str_replace($arr_retirar, "", $num_telefone);             

                echo "<tr>";
                    echo "<td class='col-md-1' style='font-size:12px' id='codigo_paciente_lista_$i'>".$paciente."</td>";
                    echo "<td class='col-md-4' style='font-size:12px' onclick='pegar_nome($i)' id='nome_paciente_lista_$i'>$nome</td>";
                    echo "<td class='col-md-3' style='font-size:12px' >$cidade</td>";
                    echo "<td class='col-md-3' style='font-size:12px' id='telefone_lista_$i'>$num_telefone</td>";
					echo "<td class='col-md-3' style='font-size:12px' id='celular_lista_$i'>$num_celular</td>";
                echo "</tr>";
            }
            echo "</body>";
            echo "</table>";
            echo "</div>";
        }

        exit;
    }

        
    if(isset($_POST["btnacao"])){   

        $dia            = $_POST['dia'];
        $mes            = $_POST['mes'];
        $ano            = $_POST['ano'];
        $mes            = str_pad($mes, 2, "0", STR_PAD_LEFT);
        $dia            = str_pad($dia, 2, "0", STR_PAD_LEFT);
        $data_pesquisa  = "$ano-$mes-$dia";

        $medico_array       = array();
        $nome_medico_array  = array();
        //$sql_medico = "SELECT medico, nome FROM tbl_medico WHERE empresa = ".EMPRESA;
		$sql_medico = "SELECT tbl_funcionario.nome, tbl_funcionario.sexo, tbl_funcionario.funcionario,tbl_grupo_usuario.descricao FROM tbl_funcionario 
						inner join tbl_grupo_usuario on tbl_grupo_usuario.grupo_usuario = tbl_funcionario.grupo_usuario_id 
						where empresa_id = ".EMPRESA." and tbl_funcionario.ativo = 't' and (tbl_funcionario.grupo_usuario_id = 6 or tbl_funcionario.grupo_usuario_id = 1) ";
        $res_medico = pg_query($con, $sql_medico);
        if(pg_num_rows($res_medico)>0){
            for($i=0; $i<pg_num_rows($res_medico); $i++){
                $nome   = pg_fetch_result($res_medico, $i, "nome");
                $medico = pg_fetch_result($res_medico, $i, "funcionario");
				$sexo = pg_fetch_result($res_medico, $i, "sexo");
				
				if($sexo == 'M'){
					$nome = "Dr. ".$nome;					
				}else{
					$nome = "Dra. ".$nome;
				}

                array_push($nome_medico_array, $nome);
                array_push($medico_array, $medico);
            }
        }

        $sql = "select * from tbl_agendamento where empresa = ".EMPRESA." and confirmado is null or confirmado = 't' ";
        $res = pg_query($con, $sql);
        for($i=0; $i<pg_num_rows($res); $i++){
            $nome       = pg_fetch_result($res, $i, "nome");
            $horario    = substr(pg_fetch_result($res, $i, "horario"), 0, 5);
            $data       = pg_fetch_result($res, $i, "data");
            $medico     = pg_fetch_result($res, $i, "medico");

            //$agendar = ;
            //terar que fazer agendamento[horario][medico] se náo mais de um agendado no mesmo horario vai sobreescrever. 
            $agendamento["$horario"]["$medico"]["$data"] =  $nome;
            //array_push($agendamento["$horario"], array('nome' => $nome, 'horario'=> $horario, 'data'=> $data, 'medico'=> 10));                                

        }

        $qtd_medico =  count($nome_medico_array)+ 1;

        echo "<table class='table table-hover agendamentos'>";
            echo "<thead>";
                echo "<tr>";
                    echo "<th colspan='$qtd_medico' id='data_agenda_pesquisa'>".fnc_data_formatada($data_pesquisa)." </th>";
                echo "</tr>";
                echo "<tr>";
                    echo "<th>Horário</th>";
                    foreach($nome_medico_array as $linNome){
                        echo "<th>$linNome</th>";
                    }
                echo "</tr>";
            echo "</thead>";
            echo "<tbody>";
  
            //$inicio = converteSegundos($valorinicio);
            //$fim = converteSegundos($valorfim);
            //$soma = converteSegundos($valorsoma);			
						
			foreach($horarios as $horario_agenda){				
				$i = converteSegundos($horario_agenda);

            //for($i=$inicio; $i<=$fim; $i+=$soma){ retirado pois esse clinica trabalha com horarios fixos
               $tempoVisivel = converteHoras($i);
               $tempo = str_replace(":", "", $tempoVisivel);
               $tempo = (int)$tempo;

                if($tempoVisivel == $horaMarcada){
                    $bgcolor = "blue";
                }else{
                    $bgcolor = "";
                }

                echo "<tr>";
                    echo "<td class='col-md-1'>$tempoVisivel</td>";                
                    foreach ($medico_array as $linMedico){

                        if(strtotime($data_pesquisa) >= strtotime('today')){
                            $fnc_agendar = "onclick='agendar(this, $tempo, $linMedico)'";
                        }else{
                            $fnc_agendar = "";
                        }                        

                        if(isset($agendamento["$tempoVisivel"]["$linMedico"]["$data_pesquisa"])){                            
                            echo "<td id='td_".$tempo."_".$linMedico."' >". $agendamento["$tempoVisivel"]["$linMedico"]["$data_pesquisa"] ."</td>";
                        }else{
                            echo "<td id='td_".$tempo."_".$linMedico."' $fnc_agendar></td>";
                        }
                    }
                echo "</tr>";               
            }                
            echo "</tbody>";
        echo "</table>";
        echo "<table class='table'>";
            echo "<tr>";
                echo "<td align=center><a href='./relatorio_agenda.php?data_inicio=".fnc_data_formatada($data_pesquisa)."&data_fim=".fnc_data_formatada($data_pesquisa)."' target='_blank'><i class='fa fa-print fa-lg'></i>Imprimir Agenda Do Dia</a></td>";
            echo "</tr>";
        echo "</table>";
    exit;
    }

     


?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="author" content="<?php echo AUTOR ?>">
        <title><?php echo TITLE_ADMIN ?></title>
        <link rel="shortcut icon" href="<?php echo RAIZ?>/images/<?php echo LOGO_FAVICON ?>" type="image/x-icon" /> 
        <!-- Bootstrap core CSS -->
        <link href="<?php echo RAIZ ?>css/bootstrap.css" rel="stylesheet">
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
        <link rel="stylesheet" type="text/css" href="js/jquery.autocomplete.css" />
        <meta charset="utf-8"> 
				
		<style >
			.td_dia:hover{
				background-color: #cccccc;
			}

			.td_dia{
				color:blue;
			}

			.td_feriado:hover{
				background-color: #cccccc;
			}

			.td_feriado{
				color:orange;
				font-weight: bold;
			}

			.td_finalsemana:hover{
				background-color: #cccccc;
			}
			.td_finalsemana{
				color:red;
			}
		</style>
		
		
        <script type="text/javascript">

            function pegar_nome(i){              
                nome = $("#nome_paciente_lista_"+i).text();
				telefone = $("#telefone_lista_"+i).text();
				celular = $("#celular_lista_"+i).text();
                codigo = $("#codigo_paciente_lista_"+i).text();
                $("#paciente_agendamento").val(codigo);
                $("#nome_agendamento").val(nome);
				$("#telefone_agendamento").val(telefone);
				$("#celular_agendamento").val(celular);				
            }

            function agendar(code, horario, medico){
                $("#dados_medico").val(medico);
                $("#dados_horario").val(horario);

                $("#telefone_agendamento").val('');
				$("#celular_agendamento").val('');
				$("#convenio_id").val('');
				$("#nome_agendamento").val('');
                $("#resultado_modal").html('');
                $("#jacliente").prop('checked', false)
				$("#msg_erro_modal").hide();
				$("#msg_erro_modal").html('');
				
				$("#convenio_label_modal").css('color', 'black');
				$("#nome_label_modal").css('color', 'black');
			

                $('#myModal').modal({
                    keyboard: false,
                    show:true,
                    backdrop:true
                })
            }

            function buscarDia(dia, mes, ano){
                $("#dados_data").val(ano+'-'+mes+'-'+dia);
                $.ajax({
                    url: 'agenda.php',
                    data: {btnacao : true, dia: dia, mes: mes, ano: ano},
                    type: 'POST',
                    context: jQuery('#resultado'),
                    //dataType: 'json',
                    success: function(data){
                        this.html(data);
                    }
                }); 
            }
        </script> 
    </head>
    <style type="text/css">
        #calendario{
            margin: 0 auto;
            width: auto;
        }
    </style>
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
                            <div class="col-md-10 titulo_tela" >Agendamento</div>
                            <div class="col-md-2 link_tela">
                                <!--<a href="cidade_cadastrar.php" class="btn btn-info btn-sm"><i class="fa fa-list-alt"></i>Novo</a>-->
                            </div>
                        </div>
                        <div class="conteudo">
                            <div class='row'>
                                <div class='col-md-3'>
                                    <form name="frm_ano" method="POST" action="">
                                        Ano:
                                        <select name="ano" id="ano" onchange="submit()">
											<option value='2018'  <?php if($ano == "2018"){ echo " selected ";} ?> >2018</option>
											<option value='2017'  <?php if($ano == "2017"){ echo " selected ";} ?> >2017</option>
                                            <option value='2016'  <?php if($ano == "2016"){ echo " selected ";} ?> >2016</option>
                                            <option value='2015'  <?php if($ano == "2015"){ echo " selected ";} ?> >2015</option>
                                            <option value='2014'  <?php if($ano == "2014"){ echo " selected ";} ?> >2014</option>
                                        </select>
                                    </form>                                    
                                </div>
                                <div class="col-md-1 legenda">
                                    Legenda:
                                </div>
                                <div class="col-md-1 finalsemana">
                                    Final de Semana:
                                </div>
                                <div class="col-md-2 diasemana">
                                    Dia Útil:
                                </div>
                                <div class="col-md-1 feriado">
                                    Feriado:
                                </div>
                            </div>

                            <div class="row">
                                <!--<div class='col-md-12'>-->
                                    <div class="col-md-2" id="div_anterior" style="text-align:center; top:90px;">
                                        <img src='./images/left.jpg' onclick="mostrarMes('menor', <?php echo $ano ?>)">
                                    </div>
                                    <div class="col-md-8" id="calendario"></div>
                                    <div class="col-md-2" id="div_posterior" style="text-align:center;  top:90px;">
                                        <img src='./images/right.jpg' onclick="mostrarMes('maior', <?php echo $ano ?>)">
                                        <input type="hidden" name="mesVigente" id="mesVigente" value="<?php echo date("m")?>">
                                    </div>
                                <!--</div>-->
                            </div>         

                            
                            <div class='row'>
                                <div class='col-md-12'>
                                    <div id="resultado"></div>
                                </div>
                            </div>
                            
                       </div>
                    </div>
                </div>
                <!-- Modal -->
                <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                  <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Agendamento</h4>
                      </div>
                      <div class="modal-body">
						<div class='row'>
							<div class="col-md-12">
								<div class="alert alert-danger" id="msg_erro_modal" style='display:none;' role="alert">teste</div>
							</div>
						</div>
                        <div class='row'>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Já Cliente
                                        <input type="checkbox" name="ja_cliente"  value="<?php echo $jacliente ?>" id="jacliente">
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail1" id="convenio_label_modal"><span class='asterisco'>*</span> Convênio</label>
                                    <select name="convenio_id" id="convenio_id" class="form-control" tabindex="4">
                                        <option value="">convenio</option>       
                                        <?php 
                                        $sql_convenio = "SELECT convenio, descricao, empresa FROM tbl_convenio where status_id = 1 ORDER BY descricao ";
                                        $res_convenio = pg_query($con, $sql_convenio);
                                        for($i =0; $i<pg_num_rows($res_convenio); $i++){
                                            $convenio   = pg_fetch_result($res_convenio, $i, 'convenio');
                                            $descricao  = pg_fetch_result($res_convenio, $i, 'descricao');
                                            $empresa    = pg_fetch_result($res_convenio, $i, 'empresa');

                                                if($convenio_id == $convenio){
                                                    $selected = " selected ";
                                                }else{
                                                    $selected = " ";
                                                }
                                            echo "<option value='$convenio' $selected >$descricao</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
							<div class="col-md-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail1" >Celular</label>
                                    <input type="text" name="celular" value="<?php echo $celular?>"  maxlength="11" class="form-control" id="celular_agendamento" placeholder="Celular" tabindex="3">
                                </div>
                            </div>
                        </div>


                        <div class='row'>
                            <div class="col-md-7">
                                <div class="form-group">
                                    <label for="exampleInputEmail1" id='nome_label_modal'><span class='asterisco'>*</span> Nome</label>
                                    <input type="text" name="nome"  value="<?php echo $nome ?>" class="form-control" id="nome_agendamento" placeholder="Nome" autofocus="autofocus" tabindex="1">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Telefone</label>
                                    <input type="text" name="telefone" value="<?php echo $telefone?>" onBlur="validaTel(telefone);" onkeyPress="MascaraTel(telefone);" maxlength="9" class="form-control" id="telefone_agendamento" placeholder="Telefone" tabindex="2">
                                    <input type="hidden" name="paciente_id" value="<?php echo $telefone?>" id="paciente_agendamento">
                                </div>
                            </div>
                        </div>
                      </div>
                      <div id="resultado_modal"></div>
                      <div class="modal-footer">
                        <input type="hidden" name="medico" id="dados_medico" value="">
                        <input type="hidden" name="horario" id="dados_horario" value="">
                        <input type="hidden" name="data" id="dados_data" value="">
                        <button type="button" class="btn btn-default" id="fechar" data-dismiss="modal">Fechar</button>
                        <button type="button" class="btn btn-primary" id="salvar_agendamento">Salvar</button>
                      </div>
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
            
            <script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
			<script src = "https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
            <script src="<?php echo RAIZ ?>js/bootstrap.min.js"></script>
            
			<script type="text/javascript" src="js/jquery.maskedinput.min.js"></script>
        

            <script type="text/javascript">
                $("#salvar_agendamento").click(function(){
                    var medico              = $("#dados_medico").val();
                    var horario             = $("#dados_horario").val();
                    var nome_agendamento    = $("#nome_agendamento").val();
                    var telefone            = $("#telefone_agendamento").val();
                    var data                = $("#dados_data").val();
                    var paciente_id         = $("#paciente_agendamento").val();
                    var convenio_id         = $("#convenio_id").val();
					var celular				= $("#celular_agendamento").val();
					var erro 				= '';                 

                    if(paciente_id.length == 0){
                        paciente_id = '';    
                    }					
					if(convenio_id.length ==0){
						erro += "O campo Convênio deve ser preenchido. <br>";
						$("#convenio_label_modal").css('color', 'red');
					}					
					if(nome_agendamento.length ==0){
						erro += "O campo Nome deve ser preenchido. ";
						$("#nome_label_modal").css('color', 'red');
					}
						
					if(erro.length > 0){
						$("#msg_erro_modal").show();
						$("#msg_erro_modal").html(erro);						
					}					
						if(erro.length == 0){
							$.ajax({
							url: 'agenda.php',
							data: {btnacao_salvar : true, medico: medico, horario: horario, nome_agendamento: nome_agendamento, telefone: telefone, data:data, paciente_id:paciente_id, convenio_id:convenio_id, celular:celular},
							type: 'POST',
							context: jQuery('#outro'),
							dataType: 'json',
								success: function(data){
									erro 	= data.error;
									ok 		= data.ok;
									
									if(erro.length > 0 ){
										//alert("Erro ao fazer agendamento.");
										$("#msg_erro_modal").html('Erro ao fazer agendamento.');
										$("#msg_erro_modal").show();
									}
									if(ok.length > 0){
										$('#td_'+horario+'_'+medico).html(nome_agendamento);						
										$("#fechar").click();
									}			
									//this.html(data);								
								}							
							});   
						//$('#td_'+horario+'_'+medico).html(nome_agendamento);						
						//$("#fechar").click();
					}
                });

                $("#nome_agendamento").keyup(function(){                    
                    var nome = $("#nome_agendamento").val();

                    if($('#jacliente').is(':checked')) {
                        $.ajax({
                            url: 'agenda.php',
                            data: {pesquisa_paciente : true, nome: nome},
                            type: 'POST',
                            context: jQuery('#resultado_modal'),
                            //dataType: 'json',
                            success: function(data){
                                this.html(data);
                            }
                        });       
                    }else{
                        $("#resultado_modal").html('');
                    }                 
                });

                $(document).ready(function() {
					$("#celular_agendamento").mask("(99) 99999-9999");
					$("#telefone_agendamento").mask("(99) 9999-9999");
					
                    mes = $("#mesVigente").val();
                    ano = <?= $ano ?>;
                    mostrarMes(mes, ano);
                    /*
                    alert("teste autoComplete");
                    $("#course").autocomplete("autoComplete.php", {
                        width: 260,
                        matchContains: true,
                        //mustMatch: true,
                        //minChars: 0,
                        multiple: true,
                        //highlight: false,
                        //multipleSeparator: ",",
                        selectFirst: false
                    });
                    */
                    $("#nome_pesquisado").click(function(){
                        alert("chegou aqui");
                    });

                });

                           
                function mostrarMes(param, ano){
                    var mes = param;
                    if(param == "menor"){
                        mes = $("#mesVigente").val();
                        mes = parseInt(mes) - 1;
                        $("#mesVigente").val(mes);
                    }else if(param == "maior"){
                        mes = $("#mesVigente").val();
                        mes = parseInt(mes) + 1;
                        $("#mesVigente").val(mes);
                    }

                    $.ajax({
                        url: 'calendario.php',
                        data: {btnacao_calendario : true, mes:mes, ano: ano},
                        type: 'POST',
                        context: jQuery('#calendario'),
                        //dataType: 'json',
                        success: function(data){
                            this.html(data);
                        }
                    });
                }

            </script>
        </div>
    </body>
</html>