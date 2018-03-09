<?php
    include "include/conexao.php";
    include "include/config.php";
    include "include/funcoes.php";
    include "include/verifica_usuario.php";


    if(isset($_POST['btnacao'])){
        $iteracao_id              =   fncTrataDados($_POST['iteracao']);
		$procedimento             =   fncTrataDados($_POST['procedimento']);
        $paciente_id              =   fncTrataDados($_POST['paciente']);
        $empresa_id               =   fncTrataDados($_POST["empresa_id"]);
		
		 if(strlen(trim($procedimento)) == 0){
            $erro .= "O campo Procedimento deve ser preenchido. <br>";
        }
		if(empty($erro)){
			if($iteracao_id == 0){
				$sql = "INSERT INTO tbl_iteracao (procedimento, paciente_id, empresa_id, usuario_id) VALUES ('$procedimento', $paciente_id, ".EMPRESA.", $usuario) returning iteracao";
			}else{
				$sql = "UPDATE tbl_iteracao SET procedimento = '$procedimento', paciente_id = '$paciente_id', empresa_id = ".EMPRESA.",
						usuario_id = '$usuario' WHERE iteracao = $iteracao_id returning iteracao";
			}
			
			$res = pg_query($con, $sql);
			$iteracao_id       = pg_fetch_result($res, 0, 'iteracao');
			//echo $sql;

			if(strlen(trim(pg_last_error($con)))==0){
				$ok .= 'Cadastro realizado com sucesso. <Br>';
			}else{
				$erro .= "Falha ao gravar procedimento. <br>";
			}
		}
	}
	

    if(isset($_GET['paciente'])){
        $paciente_id = (int)$_GET['paciente'];

        $sql_paciente = "select * from tbl_paciente where paciente = $paciente_id ";
        $res_paciente = pg_query($con, $sql_paciente);
        if(pg_num_rows($res_paciente) > 0){
            $nome           = pg_fetch_result($res_paciente, 0, 'nome');
            $cpf            = pg_fetch_result($res_paciente, 0, 'cpf');
            $rg             = pg_fetch_result($res_paciente, 0, 'rg');
            $profissao      = pg_fetch_result($res_paciente, 0, 'profissao');
            $idade          = pg_fetch_result($res_paciente, 0, 'idade');
            $email          = pg_fetch_result($res_paciente, 0, 'email');
            $rua_av         = pg_fetch_result($res_paciente, 0, 'rua_av');
            $numero         = pg_fetch_result($res_paciente, 0, 'numero');
            $complemento    = pg_fetch_result($res_paciente, 0, 'complemento');
            $bairro         = pg_fetch_result($res_paciente, 0, 'bairro');
            $cep            = pg_fetch_result($res_paciente, 0, 'cep');
            $cidade_id      = pg_fetch_result($res_paciente, 0, 'cidade_id');
            $estado_civil   = pg_fetch_result($res_paciente, 0, 'estado_civil');
            $sexo           = pg_fetch_result($res_paciente, 0, 'sexo');
        }
    }
	
	if(isset($_GET['iteracao'])){
        $iteracao_id = (int)$_GET['iteracao'];

        $sql_iteracao = "select * from tbl_iteracao where paciente_id = $paciente_id and iteracao = $iteracao_id ";
        $res_iteracao = pg_query($con, $sql_iteracao);
        if(pg_num_rows($res_iteracao) > 0){
            $procedimento          = pg_fetch_result($res_iteracao, 0, 'procedimento');
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
        <link href="<?php echo RAIZ ?>css/ficha_medica.css" rel="stylesheet">
        <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
        <script type="text/javascript" src="js/jquery.js"></script>
        <script type="text/javascript" src="js/jquery.maskedinput.js"></script>
        
        <!-- Just for debugging purposes. Don't actually copy this line! -->
        <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
       <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]--> 
        
        <script type="text/javascript">
            $(document).ready(function(){
                $("#campoData").mask("99/99/9999");
                $("#campoCpf").mask("999.999.999-99");
                $("#campoCep").mask("99.999-999");
                $("#campoRg").mask("99.999.999-*");
                $("#campoDdd").mask("999");
                $("#campoTel").mask("9999-9999");
                $("#campoCel").mask("99999-9999")
            });
        </script>
        
        <script src="include/funcoes.js"></script>
        <script src="js/script.js" ></script>

        <style>
            .teste{
                height: 25px;
                padding-top: 0px;
                margin-bottom: 3px;
            }
            .sel{
                height: 25px;   
            }       
        </style>
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
                            <div class=" col-md-7 titulo_tela" >Ficha Médica</div>
							<div class="col-md-1 link_tela">
                                <a href="admissao_listar.php?paciente=<?php echo $paciente_id?>" class="btn btn-success btn-sm"><i class="fa fa-list-alt"></i>Admissão</a>       
                            </div>
                            <div class="col-md-1 link_tela">
                                <a href="atestado_listar.php?paciente=<?php echo $paciente_id?>" class="btn btn-success btn-sm"><i class="fa fa-list-alt"></i>Atestado</a>       
                            </div>
                            <div class="col-md-1 link_tela">
                                <a href="receitas_listar.php?paciente=<?php echo $paciente_id?>" class="btn btn-success btn-sm"><i class="fa fa-list-alt"></i>Declaração</a>        
                            </div>
							<div class="col-md-1 link_tela">
                                <a href="medicamento_quantidade.php?paciente=<?php echo $paciente_id?>" class="btn btn-success btn-sm"><i class="fa fa-list-alt"></i>Prescrição</a>       
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
                                          Dados do Paciente
                                        </a>
                                      </h4>
                                    </div>
                                    <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                                      <div class="panel-body">
                                        <div class="row teste">
                                            <div class="col-md-5 sel">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Nome</label>
                                                    <?php echo $nome ?>
                                                </div>
                                            </div>
                                            <div class="col-md-3 sel">
                                                <div class="form-group ">
                                                    <label for="exampleInputEmail1">CPF</label>
                                                    <?php echo $cpf?>
                                                </div>
                                            </div>
                                            <div class="col-md-3 sel">
                                                <div class="form-group">
                                                    <label  for="exampleInputEmail1">RG</label>
                                                    <?php echo $rg?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row teste">                                         
                                            <div class="col-md-5 sel">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">E-mail</label>
                                                    <?php echo $email ?>
                                                </div>
                                            </div>
                                            <div class="col-md-3 sel">
                                                <div class="form-group">
                                                    <label  for="exampleInputEmail1">Idade</label>
                                                    <?php echo $idade?>
                                                </div>
                                            </div>
                                            <div class="col-md-3 sel">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Sexo</label>  
                                                    <?php if($sexo == "F"){echo " Feminino ";}?>
                                                    <?php if($sexo == "M"){echo " Masculino ";}?> 
                                               </div>
                                            </div>                                          
                                        </div>
                                        <div class="row teste">
                                            <div class="col-md-5 sel">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Profissão</label>
                                                    "<?php echo $profissao?>
                                                </div>
                                            </div>
                                            <div class="col-md-3 sel">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Estado Civil</label>
                                                    <?php echo $estado_civil ?>
                                                </div>
                                            </div> 
                                            <div class="col-md-3 sel">
                                                <div class="form-group">
                                                    <label  for="exampleInputEmail1">CEP</label>
                                                    <?php echo $cep ?>
                                                </div>
                                            </div>
                                        </div> 
                                        <div class="row teste">
                                            <div class="col-md-5 sel">
                                                <div class="form-group">
                                                    <label  for="exampleInputEmail1">Rua/Av</label>
                                                    <?php echo $rua_av ?>
                                                </div>
                                            </div>
                                            <div class="col-md-3 sel">
                                                <div class="form-group">
                                                   <label  for="exampleInputEmail1">Número</label>
                                                   <?php echo $numero ?>
                                                </div>
                                            </div>
                                            <div class="col-md-3 sel">
                                                <div class="form-group">
                                                    <label  for="exampleInputEmail1">Compl.</label>
                                                    <?php echo $complemento ?>
                                                </div>
                                            </div>                                            
                                        </div>
                                        <div class="row teste">                                             
                                            <div class="col-md-5 sel">
                                                <div class="form-group">
                                                    <label  for="exampleInputEmail1">Bairro</label>
                                                    <?php echo $bairro ?>
                                                </div>
                                            </div>
                                            <div class="col-md-4 sel">
                                                <div class="form-group">
                                                    <label  for="exampleInputEmail1">Cidade</label>
                                                        <?php 
                                                            $sql_cidade = "SELECT cidade, descricao, estado FROM tbl_cidade where cidade = $cidade_id ";
                                                            $res_cidade = pg_query($con, $sql_cidade); 
                                                            if(pg_num_rows($res_cidade) >0){
                                                                $estado     = pg_fetch_result($res_cidade, 0, 'estado');
                                                                $descricao  = pg_fetch_result($res_cidade, 0, 'descricao');
                                                            }
                                                                echo $descricao."-".$estado;
                                                        ?>
                                                </div>
                                            </div>                                    
                                        </div>    
                                    </div>

                                      </div>
                                    </div>
                                  </div>
                                  <!--<div class="panel panel-default">
                                    <div class="panel-heading" role="tab" id="headingTwo">
                                      <h4 class="panel-title">
                                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                          Collapsible Group Item #2
                                        </a>
                                      </h4>
                                    </div>
                                    <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                                      <div class="panel-body">
                                        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                                      </div>
                                    </div>
                                  </div>-->
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
                                <form id="frm_ficha" method="POST" action="">
                                    <div class="row" id="procedimento">
                                        <div class="col-md-4">
											<div class="col-md-4 link_tela">
													<a href="ficha_medica.php?paciente=<?php echo $paciente_id?>" class="btn btn-success btn-sm"><i class="fa fa-list-alt"></i>Nova Evolução</a>       
											</div>
											<div class="col-md-1 link_tela">
													<a href="pesquisa_evolucao.php?paciente=<?php echo $paciente_id?>" class="btn btn-success btn-sm"><i class="fa fa-list-alt"></i>Imprimir Evoluções</a>       
											</div>
										</div>
									 </div>	
									 
									<br>
									
									<div class="row">	
                                        <div class="col-md-offset-2 col-md-8">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Evolução</label>
                                                <textarea class="form-control" name="procedimento" rows="6" width='100%'><?php echo $procedimento ?></textarea>                                            
                                            </div>
                                        </div>
									</div>
                                   
									
                                    <div class="row">
                                        <div class="col-md-12 botao">
                                            <input class="btn btn-success" type="submit" name="btnacao" value="Gravar">
                                            <input type="hidden" name="paciente" value="<?php echo $paciente_id ?>">
											 <input type="hidden" name="iteracao" value="<?php echo $iteracao_id ?>">
                                        </div>
                                    </div>
                                    <div class="page-header">
                                        <div class=" col-md-12 titulo_tela" >Conduta e Evolução</div>
                                    </div>
                               
                                    <div class="row">
                                        <div class="col-md-12 botao">
                                            <table class="table table-hover">
                                                <tr>
													<th class="col-md-1">#</th>
                                                    <th class="col-md-1">Data</th>
                                                    <th>Procedimento</th>
                                                    <th class="col-md-2">Usuário</th>
													<th class="col-md-1">Ações</th>
                                                </tr>
                                                <?php 
                                                    $sql = "select tbl_iteracao.iteracao, tbl_iteracao.data, tbl_iteracao.procedimento, tbl_usuario.login from tbl_iteracao 
                                                            inner join tbl_usuario on tbl_usuario.usuario = tbl_iteracao.usuario_id
                                                            where paciente_id = $paciente_id ORDER BY data DESC";
                                                    $res = pg_query($con, $sql);
                                                    if(pg_num_rows($res)>0){
                                                        for($i=0; $i<pg_num_rows($res); $i++){
															$iteracao_id = (pg_fetch_result($res, $i, 'iteracao'));
                                                            $data = fnc_data_formatada(pg_fetch_result($res, $i, 'data'));
                                                            $procedimento = pg_fetch_result($res, $i, 'procedimento');
                                                            $login = pg_fetch_result($res, $i, 'login');

                                                            echo "<tr>";
																echo "<td align='left'>$iteracao_id</td>";
                                                                echo "<td align='left'>$data</td>";
                                                                echo "<td align='left'>$procedimento</td>";
                                                                echo "<td align='left'>$login</td>";
																echo "<td class='col-md-1'><a href='./ficha_medica.php?paciente=$paciente_id&iteracao=$iteracao_id' title='Editar'><i class='fa fa-pencil-square-o'></i></a></td>";
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
            
               
                <!-- Modal -->
                <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Agendamento</h4>
                      </div>
                      <div id="horarioConsulta"></div>
                      <div class="modal-body">
                        <div class='row'>
                            <div class="col-md-7">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Nome*</label>
                                    <input type="text" name="nome" value="<?php echo $nome ?>" class="form-control" id="nome_agendamento" placeholder="Nome">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">RG</label>
                                    <input type="text" name="rg" value="<?php echo $rg?>" maxlength="14"  onkeypress='return SomenteNumero(event)' class="form-control" id="rg_agendamento" placeholder="RG">
                                </div>
                            </div>
                        </div>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="salvar_agendamento">Save changes</button>
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