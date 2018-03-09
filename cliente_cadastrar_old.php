<?php
    include "include/conexao.php";
    include "include/config.php";
    include "include/funcoes.php";
    include "include/verifica_usuario.php";

    if(isset($_POST['pesquisa_cliente'])){

        $rg =   fncTrataDados($_POST["rg"]);

        $sql = "SELECT *  FROM tbl_paciente WHERE rg = '$rg' ";
        $res = pg_query($con, $sql);
        if(pg_num_rows($res)> 0){
            $nome           = pg_fetch_result($res, 0, 'nome');
            $cpf            = pg_fetch_result($res, 0, 'cpf');
            $rg             = pg_fetch_result($res, 0, 'rg');
            $profissao      = pg_fetch_result($res, 0, 'profissao');
            $idade          = pg_fetch_result($res, 0, 'idade');
            $email          = pg_fetch_result($res, 0, 'email');
            $rua_av         = pg_fetch_result($res, 0, 'rua_av');
            $numero         = pg_fetch_result($res, 0, 'numero');
            $complemento    = pg_fetch_result($res, 0, 'complemento');
            $bairro         = pg_fetch_result($res, 0, 'bairro');
            $cep            = pg_fetch_result($res, 0, 'cep');
            $cidade_id      = pg_fetch_result($res, 0, 'cidade_id');
            $estado_civil   = pg_fetch_result($res, 0, 'estado_civil');
            $sexo           = pg_fetch_result($res, 0, 'sexo');
            $ddd_tel        = pg_fetch_result($res, 0, 'ddd_tel');
            $telefone       = pg_fetch_result($res, 0, 'telefone');
            $ddd_cel        = pg_fetch_result($res, 0, 'ddd_cel');
            $celular        = pg_fetch_result($res, 0, 'celular');
            $data_nasc      = fnc_data_formatada(pg_fetch_result($res, 0, 'data_nasc'));
            $convenio_id    = pg_fetch_result($res, 0, 'convenio_id');
            $paciente_id    = pg_fetch_result($res, 0, 'paciente');
        }

        $dados = array("paciente_id" => $paciente_id, "nome" => $nome, 'cpf' => $cpf, 'rg' => $rg, 'profissao' => $profissao, 'idade'=> $idade, 'email'=> $email, 'rua_av' => $rua_av, 'numero' => $numero, 'complemento' => $complemento, 'bairro' => $bairro, 'cep' => $cep, 'cidade_id' => $cidade_id, 'estado_civil' => $estado_civil, 'sexo' => $sexo, 'ddd_tel' => $ddd_tel, 'telefone' => $telefone, 'ddd_cel' => $ddd_cel, 'celular' => $celular, 'data_nasc' => $data_nasc, 'convenio_id' => $convenio_id );
        echo json_encode($dados);

        exit;
    }

    if(isset($_POST["btnacao"])){
        $nome               =   fncTrataDados($_POST["nome"]);
        $cpf                =   fncTrataDados($_POST["cpf"]);
        $email              =   fncTrataDados($_POST["email"]);
        $rg                 =   fncTrataDados($_POST["rg"]);
        $idade              =   fncTrataDados($_POST["idade"]);
        $sexo               =   fncTrataDados($_POST["sexo"]);
        $profissao          =   fncTrataDados($_POST["profissao"]);
        $estado_civil       =   fncTrataDados($_POST["estado_civil"]);
        $rua_av             =   fncTrataDados($_POST["rua_av"]);
        $numero             =   fncTrataDados($_POST["numero"]);
        $complemento        =   fncTrataDados($_POST["complemento"]);
        $bairro             =   fncTrataDados($_POST["bairro"]);
        $cidade_id          =   fncTrataDados($_POST["cidade_id"]);
        $cep                =   fncTrataDados($_POST["cep"]);
        $paciente_id        =   fncTrataDados($_POST["paciente_id"]);
		$ddd_tel 			=   fncTrataDados($_POST["ddd_tel"]);
		$telefone 			=   fncTrataDados($_POST["telefone"]);
		$ddd_cel 			=   fncTrataDados($_POST["ddd_cel"]);
		$celular 			=   fncTrataDados($_POST["celular"]);
        //a FORMATAÇÃO DA DATA ESTA SENDO FEITA NA QUERY
        $data_nasc          =   $_POST["data_nasc"];
		
        $agendamento_id     =   (int)$_POST['agendamento_id'];
		$convenio_id		=	(int)$_POST["convenio_id"];

        if(strlen(trim($nome)) == 0){
            $erro .= "O campo Nome deve ser preenchido. <br>";
        }    
       
        if($cidade_id == 0){
            $erro .= "O campo Cidade deve ser preenchido. <br>";
        }
		if(strlen(trim($data_nasc)) == 0){
            $erro .= "O campo Data de Nascimento deve ser preenchido. <br>";
        }

        if(strlen(trim($rua_av)) == 0){
            $erro .= "O campo Rua/Av deve ser preenchido. <br>";
        }

        if(strlen(trim($numero)) == 0){
            $erro .= "O campo Número deve ser preenchido. <br>";
        }

        if((strlen(trim($ddd_cel)) == 0) and (strlen(trim($celular))== 0) ) {
            $erro .= "O campo Celuar deve ser preenchido. <br>";
        }

        if(strlen(trim($rg)) == 0){
            $erro .= "O campo RG deve ser preenchido. <br>";
        }
		
        if($paciente_id == 0 and strlen(trim($cpf))>0){
            //verifica se esse cliente já esta cadastrado.
            $sql = "SELECT cpf, rg FROM tbl_paciente where cpf = '$cpf' or rg = '$rg'";
            $res = pg_query($con, $sql);
            if(pg_num_rows($res)>0){
                $erro .= "CPF ou RG já cadastrado.";
            }
        }

        if(empty($erro)){
            if($paciente_id == 0){
                $sql = "INSERT INTO tbl_paciente (nome, cpf, rg, profissao, idade, email, estado_civil, sexo, rua_av, numero,
				complemento, bairro, cidade_id, cep, ddd_tel, telefone, ddd_cel, celular, data_nasc, convenio_id)  
                VALUES ('$nome', '$cpf', '$rg', '$profissao', '$idade', '$email', '$estado_civil', '$sexo', '$rua_av',
				'$numero', '$complemento', '$bairro', $cidade_id, '$cep', '$ddd_tel', '$telefone', '$ddd_cel', '$celular',
				'".fnc_formata_data($_POST["data_nasc"])."', '$convenio_id')";
            }else{
                $sql = "UPDATE tbl_paciente SET nome = '$nome', cpf = '$cpf', rg = '$rg', profissao = '$profissao',
				idade = '$idade', email = '$email', estado_civil = '$estado_civil', sexo = '$sexo', rua_av = '$rua_av',
				numero = '$numero', complemento = '$complemento', bairro = '$bairro',  cidade_id = $cidade_id, cep = '$cep',
				ddd_tel = '$ddd_tel', telefone = '$telefone', ddd_cel = '$ddd_cel', celular = '$celular',
				data_nasc = '".fnc_formata_data($_POST["data_nasc"])."', convenio_id = '$convenio_id' 
                WHERE paciente = $paciente_id";
            }
            $res = pg_query($con, $sql);

            if($agendamento_id > 0){
                $telefone_agendamento = $ddd_tel.$telefone;

                $sql_ag = "UPDATE tbl_agendamento SET nome = '$nome', telefone= '$telefone_agendamento' WHERE agendamento = $agendamento_id";
                $res_ag = pg_query($con, $sql_ag);
            }

            if(strlen(trim(pg_last_error($con))) == 0 and empty($erro)){
                $ok .= "Cadastro Realizado com Sucesso.";
            }
        }
    }

    if(isset($_GET['paciente'])){
        $paciente_id = (int)$_GET['paciente'];

        $sql_paciente = "select * from tbl_paciente where paciente = $paciente_id ";
        $res_paciente = pg_query($con, $sql_paciente);
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
			$ddd_tel        = pg_fetch_result($res_paciente, 0, 'ddd_tel');
			$telefone       = pg_fetch_result($res_paciente, 0, 'telefone');
			$ddd_cel        = pg_fetch_result($res_paciente, 0, 'ddd_cel');
			$celular        = pg_fetch_result($res_paciente, 0, 'celular');
			$data_nasc		= fnc_data_formatada(pg_fetch_result($res_paciente, 0, 'data_nasc'));
			$convenio_id	= pg_fetch_result($res_paciente, 0, 'convenio_id');
    }
	
    if(isset($_GET['excluir'])){
        $paciente = (int)$_GET['excluir'];

        $sql = "DELETE from tbl_paciente where paciente = $paciente";
        $res = pg_query($con, $sql);

        if(strlen(trim(pg_last_error($con))) == 0 and empty($erro)){
            $ok .= "Cliente excluído com Sucesso.";
        }else{
            $erro .= "Falha ao excluir o cliente. <br>Consulte o administrador do sistema. ";
        }
    }

    if(isset($_GET["agendamento"])){
        $agendamento = (int)$_GET["agendamento"];

        $sql_agendamento = "SELECT nome, telefone FROM tbl_agendamento 
                            WHERE agendamento = $agendamento ";
        $res_agendamento = pg_query($con, $sql_agendamento);
        if(pg_num_rows($res_agendamento)> 0){
            $nome       = pg_fetch_result($res_agendamento, 0, nome);
            $telefone   = pg_fetch_result($res_agendamento, 0, telefone);

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

        <script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
        <script>        
        $(document).ready(function(){
            $('#cep').blur(function(){
                var cep = $('#cep').val();
                $.ajax({
                    url: 'consulta_cep.php',
                    type: 'POST',
                    data: {btnacao:true, cep:cep},                  
                    dataType: 'json',
                    success: function(data){
                            $('#rua').val(data.rua);
                            $('#bairro').val(data.bairro);
                            $('#cidade').val(data.cidade);
                            $('#estado').val(data.estado);  
                    }
                });
                return false;
            })

            $("#rg").blur(function(){
                
                var rg = $("#rg").val();
                alert("teste"+ rg);
                $.ajax({
                    url: 'cliente_cadastrar.php',
                    data: {pesquisa_cliente : true, rg:rg },
                    type: 'POST',
                    //context: jQuery('#resultado'),
                    dataType: 'json',
                    success: function(data){
                        //this.html(data);

                        alert("resultado "+ data.paciente_id);
                        $("#nome").val(data.nome);
                        $("#cpf").val(data.cpf);
                        $("#rg").val(data.rg);
                        $("#profissao").val(data.profissao);
                        $("#email").val(data.email);
                        $("#sexo").val(data.sexo);
                        $("#estado_civil").val(data.estado_civil);
                        $("#data_nasc").val(data.data_nasc);
                        $("#idade").val(data.idade);
                        $('#rua').val(data.rua_av);
                        $('#bairro').val(data.bairro);
                        $("#numero").val(data.numero);
                        $("#ddd_tel").val(data.ddd_tel);
                        $("#telefone").val(data.telefone);
                        $("#ddd_cel").val(data.ddd_cel);
                        $("#celular").val(data.celular);
                        $("#paciente_id").val(data.paciente_id);
                        $("#cep").val(data.cep);
                        $("#complemento").val(data.complemento);

                        $('#cidade_id option[value='+data.cidade_id+']').attr('selected','selected');
                        $('#sexo option[value='+data.sexo+']').attr('selected','selected');
                        $('#convenio_id option[value='+data.convenio_id+']').attr('selected','selected');

                        //$('#cidade').val(data.cidade);
                        //$('#estado').val(data.estado); 
                    }
                }); 

            })
        });     
        </script>
        
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
                            <div class=" col-md-10 titulo_tela" >Cliente</div>
                            <div class="col-md-2 link_tela">
                                <a href="cliente_pesquisa.php" class="btn btn-info btn-sm"><i class="fa fa-list-alt"></i>Pesquisa</a>		
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
                                            <div class='row'>
                                                <div class="col-md-7">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">Nome*</label>
                                                        <input type="text" name="nome" value="<?php echo $nome ?>" maxlength="50" class="form-control" id="nome" placeholder="Nome">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label  for="exampleInputEmail1">RG*</label>
                                                        <input type="text" name="rg" id="rg" value="<?php echo $rg?>" maxlength="9" onkeypress='return SomenteNumero(event)' class="form-control"  placeholder="RG">
                                                    </div>
                                                    
                                                </div>
                                            </div>
                                            <div class='row'>
                                                <div class="col-md-7">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">E-mail*</label>
                                                        <input type="text" name="email" value="<?php echo $email ?>" class="form-control" maxlength="50" id="email" placeholder="E-Mail">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">CPF*</label>
                                                        <input type="text" name="cpf" value="<?php echo $cpf?>" maxlength="11"  onkeypress='return SomenteNumero(event)' class="form-control" id="cpf" placeholder="CPF">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class='row'>
                                                <div class="col-md-7">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">Profissão</label>
                                                        <input type="text" name="profissao" value="<?php echo $profissao?>" maxlength="50" class="form-control" id="profissao" placeholder="Profissão">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">Sexo*</label><br>
                                                        <select name="sexo" id="sexo" class="form-control" style="height: 37px" >
                                                            <option value="">Sexo</option>
                                                            <option value="F" <?php if($sexo == "F"){echo " selected ";}?> >Feminino</option>
                                                            <option value="M" <?php if($sexo == "M"){echo " selected ";}?> >Masculino</option>
                                                        </select>
                                                   </div>
                                                </div>
                                            </div>
                                            <div class='row'>
                                                
												<div class="col-md-7">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">Estado Civil</label>
                                                        <input type="text" name="estado_civil" value="<?php echo $estado_civil ?>" maxlength="15"  class="form-control" id="estado_civil" placeholder="Estado Civil">
                                                    </div>
                                                </div>
												<div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">Data de Nascimento*</label>
                                                        <input type="text" name="data_nasc" value="<?php echo $data_nasc ?>" maxlength="10"  class="form-control" onkeypress="Formatadata(this,event)" id="data_nasc" placeholder="Data de Nascimento">
                                                    </div>
                                                </div>
                                                
												
                                            </div>
                                        </div>
										
										<div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label  for="exampleInputEmail1">Idade</label>
                                                    <input type="text" name="idade" value="<?php echo $idade?>" maxlength="3" onkeypress='return SomenteNumero(event)' class="form-control" id="idade" placeholder="Idade">
                                                </div>
                                            </div>
											<div class="col-md-4">
												<div class="form-group">
													<label  for="exampleInputEmail1">Convênio</label>
													<select name="convenio_id" id="convenio_id" class="form-control">
														<option value="">convenio</option>       
														<?php 
														$sql_convenio = "SELECT convenio, descricao, empresa FROM tbl_convenio ";
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
															echo "<option value='$convenio' $selected >$descricao-$empresa</option>";
														}
														?>
													</select>
												</div>
											</div>
										</div>
                                    <div class="row">									
										<div class="col-md-3">
											<div class="form-group">
												<label  for="exampleInputEmail1">CEP</label>
												<input type="text" name="cep" id="cep" value="<?php echo $cep ?>" maxlength="9" class="form-control">
											</div>
										</div>
                                    
									</div>
									<div class="row">
										<div class="col-md-7">
											<div class="form-group">
												<label  for="exampleInputEmail1">Rua/Av</label>
												<input type="text" name="rua_av" id="rua" value="<?php echo $rua_av ?>" maxlength="50" class="form-control">
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label  for="exampleInputEmail1">Complemento</label>
												<input type="text" name="complemento" value="<?php echo $complemento ?>" id="complemento" maxlength="20" class="form-control">
											</div>
										</div>
                                    
									</div>
									<div class="row"> 
										<div class="col-md-2">
											<div class="form-group">
											   <label  for="exampleInputEmail1">Número</label>
												<input type="text" name="numero" value="<?php echo $numero ?>" id="numero" maxlength="5" class="form-control">
											</div>
										</div>
										<div class="col-md-5">
											<div class="form-group">
												<label  for="exampleInputEmail1">Bairro</label>
												<input type="text" name="bairro" id="bairro" value="<?php echo $bairro ?>" maxlength="30" class="form-control">
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label  for="exampleInputEmail1">Cidade</label>
												<select name="cidade_id" id="cidade_id" class="form-control">
													<option value="">Cidade</option>       
													<?php 
														$sql_cidade = "SELECT cidade, descricao, estado FROM tbl_cidade ";
														$res_cidade = pg_query($con, $sql_cidade);
														for($i =0; $i<pg_num_rows($res_cidade); $i++){
															$cidade     = pg_fetch_result($res_cidade, $i, 'cidade');
															$estado     = pg_fetch_result($res_cidade, $i, 'estado');
															$descricao  = pg_fetch_result($res_cidade, $i, 'descricao');

																if($cidade_id == $cidade){
																	$selected = " selected ";
																}else{
																	$selected = " ";
																}
															echo "<option value='$cidade' $selected >$descricao-$estado</option>";
														}

													?>

												</select>
											</div>
										</div>
                                    
									</div>
								<div class="row">
									<div class="col-md-1">
                                        <div class="form-group">
                                            <label  for="exampleInputEmail1">DDD</label>
                                            <input type="text" name="ddd_tel"  id="ddd_tel" value="<?php echo $ddd_tel ?>" maxlength="3" class="form-control">
                                        </div>
                                    </div>
									<div class="col-md-2">
                                        <div class="form-group">
                                            <label  for="exampleInputEmail1">Telefone</label>
                                            <input type="text" name="telefone" id="telefone" value="<?php echo $telefone ?>" maxlength="10" class="form-control">
                                        </div>
                                    </div>
									<div class="col-md-1">
                                        <div class="form-group">
                                            <label  for="exampleInputEmail1">DDD</label>
                                            <input type="text" name="ddd_cel" id="ddd_cel" value="<?php echo $ddd_cel ?>" maxlength="3" class="form-control">
                                        </div>
                                    </div>
									<div class="col-md-2">
                                        <div class="form-group">
                                            <label  for="exampleInputEmail1">Celular</label>
                                            <input type="text" name="celular" id="celular" value="<?php echo $celular ?>" maxlength="10" class="form-control">
                                        </div>
                                    </div>
								</div>
                                <div class="row">
                                    <div class="col-md-12 botao">
                                        <input class="btn btn-info" type="submit" name="btnacao" value="Gravar">
                                        <input type="hidden" name="paciente_id" id="paciente_id" value="<?php echo $paciente_id ?>">

                                        <input type="hidden" name="agendamento_id" value="<?php echo $agendamento ?>">
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
        </div>
    </body>
</html>