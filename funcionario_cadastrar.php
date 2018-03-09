<?php
    include "include/conexao.php";
    include "include/config.php";
    include "include/funcoes.php";
	include "include/verifica_usuario.php";

    if(isset($_POST["btnacao"])){     

        $nome               =   fncTrataDados($_POST["nome"]);
        $cpf                =   fncTrataDados($_POST["cpf"]);
        $email              =   fncTrataDados($_POST["email"]);
        $rg                 =   fncTrataDados($_POST["rg"]);
        $profissao          =   fncTrataDados($_POST["profissao"]);
        $sexo               =   fncTrataDados($_POST["sexo"]);
        $estado_civil       =   fncTrataDados($_POST["estado_civil"]);
        $data_nasc          =   $_POST["data_nasc"];
        $idade              =   fncTrataDados($_POST["idade"]);
        $cep                =   fncTrataDados($_POST["cep"]);
        $rua_av             =   fncTrataDados($_POST["rua_av"]);
        $complemento        =   fncTrataDados($_POST["complemento"]);
        $numero             =   fncTrataDados($_POST["numero"]);
        $bairro             =   fncTrataDados($_POST["bairro"]);
        $ddd_tel            =   fncTrataDados($_POST["ddd_tel"]);
        $telefone           =   fncTrataDados($_POST["telefone"]);
        $ddd_cel            =   fncTrataDados($_POST["ddd_cel"]);
        $celular            =   fncTrataDados($_POST["celular"]);
		$crm				=	fncTrataDados($_POST["crm"]);
        $cidade_id          =   fncTrataDados($_POST["cidade_id"]);
        $funcionario_id     =   fncTrataDados($_POST["funcionario_id"]);
		$grupo_usuario_id	=   fncTrataDados($_POST["grupo_usuario_id"]);		
	
       
        
        if(strlen(trim($nome)) == 0){
            $erro .= "O campo Nome deve ser preenchido. <br>";
        }
        if(strlen(trim($data_nasc)) == 0){
            $erro .= "O campo Data de Nascimento deve ser preenchido. <br>";
        }
		if(strlen(trim($cidade_id)) == 0){
            $erro .= "O campo Cidade deve ser preenchido. <br>";
        }
		if(strlen(trim($grupo_usuario_id)) == 0){
            $erro .= "O campo Tipo Funcionário deve ser preenchido. <br>";
        }
       
		
		$caracter	= array(".","/","-","(",")");
		
		$cpf 		= str_replace($caracter,"",$_POST['cpf']);
		
		$ddd_tel 	= str_replace($caracter,"",$_POST['ddd_tel']);
		$ddd_cel 	= str_replace($caracter,"",$_POST['ddd_cel']);
		$telefone 	= str_replace($caracter,"",$_POST['telefone']);
		$celular 	= str_replace($caracter,"",$_POST['celular']);
		$crm	 	= str_replace($caracter,"",$_POST['crm']);


        if(empty($erro)){
            if($funcionario_id == 0){
                $sql = "INSERT INTO tbl_funcionario (nome, cpf, rg, idade, sexo, estado_civil, rua_av, numero, complemento, cep, cidade_id, bairro, profissao, email, ddd_tel, telefone, ddd_cel, celular, data_nasc, grupo_usuario_id, empresa_id, crm)  
                VALUES ('$nome', '$cpf', '$rg', '$idade', '$sexo', '$estado_civil', '$rua_av', '$numero', '$complemento', '$cep', '$cidade_id', '$bairro', '$profissao', '$email', '$ddd_tel', '$telefone', '$ddd_cel', '$celular', '".fnc_formata_data($_POST["data_nasc"])."', $grupo_usuario_id, ".EMPRESA.", '$crm')";
            }else{
                $sql = "UPDATE tbl_funcionario SET nome = '$nome', cpf = '$cpf', rg = '$rg', idade = '$idade', sexo = '$sexo', estado_civil = '$estado_civil', rua_av = '$rua_av', numero = '$numero', complemento = '$complemnto', grupo_usuario_id = $grupo_usuario_id, 
                cep = '$cep', cidade_id = $cidade_id, bairro = '$bairro', profissao = '$profissao',  email = '$email', ddd_tel = '$ddd_tel', telefone = '$telefone', ddd_cel = '$ddd_cel', celular = '$celular', data_nasc = '".fnc_formata_data($_POST["data_nasc"])."', crm = '$crm', empresa_id = ".EMPRESA."
                WHERE funcionario = $funcionario_id";
            }
			//echo $sql;
            $res = pg_query($con, $sql);
            if(strlen(trim(pg_last_error($con))) == 0 and empty($erro)){
                $ok .= "Cadastro Realizado com Sucesso.";
            }
        }
    }

    if(isset($_GET['funcionario'])){
        $funcionario_id = (int)$_GET['funcionario'];

        $sql_funcionario = "select * from tbl_funcionario where funcionario = $funcionario_id ";
			$res_funcionario 	= pg_query($con, $sql_funcionario);
            $nome           	= pg_fetch_result($res_funcionario, 0, 'nome');
            $cpf            	= pg_fetch_result($res_funcionario, 0, 'cpf');
            $rg             	= pg_fetch_result($res_funcionario, 0, 'rg');
            $idade         	 	= pg_fetch_result($res_funcionario, 0, 'idade'); 
            $sexo           	= pg_fetch_result($res_funcionario, 0, 'sexo');
            $estado_civil   	= pg_fetch_result($res_funcionario, 0, 'estado_civil');
            $rua_av         	= pg_fetch_result($res_funcionario, 0, 'rua_av');
            $numero         	= pg_fetch_result($res_funcionario, 0, 'numero');
            $complemento    	= pg_fetch_result($res_funcionario, 0, 'complemento');
            $cep            	= pg_fetch_result($res_funcionario, 0, 'cep');
            $cidade_id      	= pg_fetch_result($res_funcionario, 0, 'cidade_id');
            $bairro         	= pg_fetch_result($res_funcionario, 0, 'bairro');
            $profissao      	= pg_fetch_result($res_funcionario, 0, 'profissao');
            $email          	= pg_fetch_result($res_funcionario, 0, 'email');
            $ddd_tel        	= pg_fetch_result($res_funcionario, 0, 'ddd_tel');
            $telefone       	= pg_fetch_result($res_funcionario, 0, 'telefone');
            $ddd_cel        	= pg_fetch_result($res_funcionario, 0, 'ddd_cel');
            $celular        	= pg_fetch_result($res_funcionario, 0, 'celular');
            $data_nasc      	= fnc_data_formatada(pg_fetch_result($res_funcionario, 0, 'data_nasc'));
			$grupo_usuario_id 	= pg_fetch_result($res_funcionario, 0, 'grupo_usuario_id');			
			$crm				= pg_fetch_result($res_funcionario, 0, 'crm');          
    }

    if(isset($_GET['excluir'])){
        $funcionario = (int)$_GET['excluir'];

        $sql = "UPDATE tbl_funcionario SET ativo = 'f' where funcionario = $funcionario";
        $res = pg_query($con, $sql);
        
        if(strlen(trim(pg_last_error($con))) == 0 and empty($erro)){
            $ok .= "Funcionário excluído com Sucesso.";
			header("Location: funcionario_listar.php");
        }else{
            $erro .= "Falha ao excluir o funcionario. <br>Consulte o administrador do sistema. ";
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
        <link href="<?php echo RAIZ ?>css/style_admin.css" rel="stylesheet">
        <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
		<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
        <script src = "https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<script type="text/javascript" src="js/jquery.maskedinput.min.js"></script>			
		
        <script>        
       $(document).ready(function(){
			$("#cpf").mask("999.999.999-99");
			
			$("#data_nasc").mask("99/99/9999");
			$("#cep").mask("99999-999");
			$("#celular").mask("99999-9999");
			$("#telefone").mask("9999-9999");
			
		   
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
							
							//$('#element option[value="no"]').attr("selected", "selected");
                    }
                });
                return false;
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
		
		<script>
				function calculateAge(dobString) {
				var dob = new Date(dobString);
				var currentDate = new Date(); //pega o dia, mes, ano e hora de hoje.
				var currentYear = currentDate.getFullYear(); //pega apenas o ano
				var birthdayThisYear = new Date(currentYear, dob.getMonth(), dob.getDate());
				var age = currentYear - dob.getFullYear();
				if(birthdayThisYear > currentDate) {
				age--;
				}
				return age;
				}
				function calcular(data) {
				var data = document.frm_tipo_imovel.data_nasc.value; //pega a data digitada
				var partes = data.split("/"); 
				var junta = partes[2]+"-"+partes[1]+"-"+partes[0]; //formata data
				document.frm_tipo_imovel.idade.value = (calculateAge(junta)); //calcula data e mostra no campo idade
				}
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
                    <div class="col-md-10 corpo" >
                        <div class="page-header">
                            <div class=" col-md-10 titulo_tela" >Funcionário</div>
                            <div class="col-md-2 link_tela">
                                <a href="funcionario_listar.php" class="btn btn-success btn-sm"><i class="fa fa-list-alt"></i>Listar</a>       
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
                                                        <input type="text" name="nome" value="<?php echo $nome ?>" class="form-control" id="exampleInputEmail1" placeholder="Nome">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">CPF</label>
																		  <input type="text" name="cpf" id="cpf" value="<?php echo $cpf?>"  maxlength="14" class="form-control" placeholder="CPF">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class='row'>
                                                <div class="col-md-7">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">E-mail</label>
                                                        <input type="text" name="email" value="<?php echo $email ?>" class="form-control" id="exampleInputEmail1" placeholder="E-Mail">
                                                    </div>
                                                </div>
                                                 <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label  for="exampleInputEmail1">RG</label>
																		<input type="text" name="rg"  value="<?php echo $rg?>"   maxlength="12" class="form-control" id="RG" placeholder="RG">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class='row'>
                                                <div class="col-md-7">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">Profissão</label>
                                                        <input type="text" name="profissao" value="<?php echo $profissao?>" class="form-control" id="exampleInputEmail1" placeholder="Profissão">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">Sexo</label><br>
                                                        <select name="sexo" class="form-control" style="height: 37px" >
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
                                                        <input type="text" name="estado_civil" value="<?php echo $estado_civil ?>" maxlength="20"  class="form-control" id="exampleInputEmail1" placeholder="Estado Civil">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label  for="exampleInputEmail1">Data de Nascimento*</label>
																		  <input type="text" name="data_nasc" value="<?php echo $data_nasc ?>" maxlength="10"  class="form-control"  id="data_nasc" placeholder="Data de Nascimento" onblur="calcular()">
                                                    </div>
                                                </div>
                                                <div class="col-md-1">
                                                    <div class="form-group">
                                                        <label  for="exampleInputEmail1">Idade</label>
                                                        <input type="text" name="idade" value="<?php echo $idade?>" maxlength="3" onkeypress='return SomenteNumero(event)' class="form-control" id="exampleInputEmail1">
                                                    </div>
                                                </div>
                                            </div>

                                             <div class="row">
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label  for="exampleInputEmail1">CEP</label>
                                                        <input type="text" name="cep" id="cep" value="<?php echo $cep ?>" maxlength="9" class="form-control" placeholder="CEP">
                                                    </div>
                                                </div>
												<div class="col-md-5">
                                                    <div class="form-group">
                                                        <label  for="exampleInputEmail1">Rua/Av</label>
                                                        <input type="text" name="rua_av" id="rua" value="<?php echo $rua_av ?>" maxlength="50" class="form-control" placeholder="Rua/Av">
                                                    </div>
                                                </div>
												<div class="col-md-2">
                                                    <div class="form-group">
                                                        <label  for="exampleInputEmail1">Número</label>
                                                        <input type="text" name="numero" value="<?php echo $numero ?>" maxlength="10" class="form-control" placeholder="Número">
                                                    </div>
                                                </div>
												<div class="col-md-2">
                                                    <div class="form-group">
                                                        <label  for="exampleInputEmail1">Complemento</label>
                                                        <input type="text" name="complemento" value="<?php echo $complemento ?>" maxlength="20" class="form-control" placeholder="Complemento">
                                                    </div>
                                                </div>
                                            </div>
											<div class="row">
												<div class="col-md-7">
                                                    <div class="form-group">
                                                        <label  for="exampleInputEmail1">Bairro</label>
                                                        <input type="text" name="bairro" id="bairro" value="<?php echo $bairro ?>" maxlength="70" class="form-control" placeholder="Bairro">
                                                    </div>
                                                 </div>
												 <div class="col-md-4">
													<div class="form-group">
														<label  for="exampleInputEmail1">Cidade*</label>
														<select name="cidade_id" id="cidade_id" class="form-control">
														<option value="">Cidade</option>       
														<?php 
															$sql_cidade = "SELECT cidade, descricao, estado FROM tbl_cidade where status_id = 1 ORDER BY descricao ";
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
                                            <div class='row'>
                                                <div class="col-md-1">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">DDD</label>
																		  <input type="text" name="ddd_tel" value="<?php echo $ddd_tel ?>" maxlength="2" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">Telefone</label>
																		  <input type="text" name="telefone" id="telefone" value="<?php echo $telefone ?>" maxlength="9" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-md-1">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">DDD*</label>
																		  <input type="text" name="ddd_cel" id="ddd_cel" value="<?php echo $ddd_cel ?>" maxlength="2"  class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">Celular</label>
																		  <input type="text" name="celular" id="celular" value="<?php echo $celular ?>" maxlength="10" class="form-control">
																	</div>
                                                </div>
												
												<div class="col-md-3">
													<div class="form-group">
														<label  for="exampleInputEmail1">Tipo Funcionário*</label>
														<select name="grupo_usuario_id" class="form-control">
														<option value="">Tipos</option>       
														<?php 
														$sql_cidade = "SELECT grupo_usuario, descricao FROM tbl_grupo_usuario where status_id = 1 order by descricao";
														 $res_cidade = pg_query($con, $sql_cidade);
														 for($i =0; $i<pg_num_rows($res_cidade); $i++){
															$grupo_usuario     = pg_fetch_result($res_cidade, $i, 'grupo_usuario');
															$descricao  = pg_fetch_result($res_cidade, $i, 'descricao');

																if($grupo_usuario_id == $grupo_usuario){
																	$selected = " selected ";
																}else{
																	$selected = " ";
																}
															echo "<option value='$grupo_usuario' $selected >$descricao</option>";
														}
														?>
														</select>
													</div>
                                                </div>												
											<div class="col-md-2">
												<div class="form-group">
													<label  for="exampleInputEmail1">CRM</label>
													<input type="text" name="crm" id="crm" value="<?php echo $crm ?>" maxlength="10" class="form-control">
												</div>
											</div>
                                            </div>
                                 
                                        </div>
                                                                       
                                </div>
                                <div class="row">
                                    <div class="col-md-12 botao">
                                        <input class="btn btn-success" type="submit" name="btnacao" value="Gravar">
                                        <input type="hidden" name="funcionario_id" value="<?php echo $funcionario_id ?>">
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
				<script src="<?php echo RAIZ ?>js/bootstrap.min.js"></script>
        </div>
    </body>
</html>