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
		$fax 			    =   fncTrataDados($_POST["fax"]);
		$ddd_fax 			=   fncTrataDados($_POST["ddd_fax"]);
		$cor			    =   fncTrataDados($_POST["cor"]);
		$org_exp			=   fncTrataDados($_POST["org_exp"]);
		$uf_rg 			    =   fncTrataDados($_POST["uf_rg"]);
		$natural_de			=   fncTrataDados($_POST["natural_de"]);
		$nome_mae 			=   fncTrataDados($_POST["nome_mae"]);
		$nome_pai 			=   fncTrataDados($_POST["nome_pai"]);
		$tipo_sangue	    =   fncTrataDados($_POST["tipo_sangue"]);
		$cns	            =   fncTrataDados($_POST["cns"]);
		$indicado_por       =   fncTrataDados($_POST["indicado_por"]);
		$responsavel	    =   fncTrataDados($_POST["responsavel"]);
		$resp_telefone	    =   fncTrataDados($_POST["resp_telefone"]);
		$ddd_resp_telefone  =   fncTrataDados($_POST["ddd_resp_telefone"]);
		$agendamento_id 		=   (int)$_POST["agendamento_id"];
        //a FORMATAÇÃO DA DATA ESTA SENDO FEITA NA QUERY
        $data_nasc          =   $_POST["data_nasc"];	
		$emissao_rg         =   $_POST["emissao_rg"];	
		$convenio_id		=	(int)$_POST["convenio_id"];
		$data_internacao    =   fncTrataDados($_POST["data_internacao"]);
		$status_id          =   fncTrataDados($_POST["status_id"]);
		$foto               =   fncTrataDados($_POST["foto"]);
		$tel_nome           =   fncTrataDados($_POST["tel_nome"]);
		$tel_nome_2         =   fncTrataDados($_POST["tel_nome_2"]);
				
		$retirar = array(".", "-", ",", "*", "/", "_");

		$cpf               = str_replace($retirar, "", $cpf);		
		
		$telefone          = str_replace($retirar, "", $telefone);
		$resp_telefone     = str_replace($retirar, "", $resp_telefone);
		$celular           = str_replace($retirar, "", $celular);		
		$cep               = str_replace($retirar, "", $cep);
		$data_nasc2        = str_replace($retirar, "", $data_nasc);
		$data_internacao   = str_replace($retirar, "", $data_internacao);
		$emissao_rg        = str_replace($retirar, "", $emissao_rg);

	
			
        if(strlen(trim($nome)) == 0){
            $erro .="O campo Nome deve ser preenchido.<br>";
        }    
		if(strlen(trim($data_nasc2)) == 0){
            $erro .= "O campo Data de Nascimento deve ser preenchido.<br>";
        }
		if(strlen(trim($cidade_id)) == 0){
            $erro .= "O campo Cidade deve ser preenchido.<br>";
        }
		if(strlen(trim($status_id)) == 0){
            $erro .= "O campo Status deve ser preenchido.<br>";
        }
		
		//Upload da Imagem
				$dir = "upload/"; //variavel que armazena onde será feito o upload

					$extensoes = array('jpg', 'gif', 'png', '');
					$arquivo = $_FILES['arquivo']; //$_FILES faz referencia a qualquer arquivo enviado ao php
					$file = $dir.$arquivo['name']; //dentro da variavel file está o local onde o upload vai ser salvo
					$ext = strtolower(end(explode(".", $arquivo['name']))); //strtolower tranforma para minusculo e explode pela o ponto e gera um array
					
					if(array_search($ext, $extensoes) === false){
						echo "O tipo do arquivo esta incorreto. Permitidos apenas imagens(JPG, PNG e GIF).";
						echo "<br><a href='cliente_cadastrar.php?paciente=$paciente_id'>Voltar</a>";
						return false;
					}

					if(move_uploaded_file($arquivo['tmp_name'], $file)) {
						//echo "O Arquivo foi enviado corretamente!<br/>";
						$foto = $arquivo['name'];
						
						//print_r($_FILES);
						
					} else {
						//echo "O envio do arquivo falhou!";
						//print_r($_FILES);
					}
		
       
        if($paciente_id == 0 and strlen(trim($cpf))>0){
            //verifica se esse cliente já esta cadastrado.
            $sql = "SELECT cpf, rg FROM tbl_paciente where cpf = '$cpf' or rg = '$rg'";
            $res = pg_query($con, $sql);
            if(pg_num_rows($res)>0){
                $erro .= "CPF ou RG já cadastrado.";
            }
        }
		$caracter	= array(".","/","-","(",")");
		
		$cpf 		         = str_replace($caracter,"",$_POST['cpf']);
		
		$ddd_tel 	         = str_replace($caracter,"",$_POST['ddd_tel']);
		$ddd_cel 	         = str_replace($caracter,"",$_POST['ddd_cel']);
		$telefone            = str_replace($caracter,"",$_POST['telefone']);
		$resp_telefone 	     = str_replace($caracter,"",$_POST['resp_telefone']);
		$celular 	         = str_replace($caracter,"",$_POST['celular']);
		
        if(empty($erro)){
            if($paciente_id == 0){
                $sql = "INSERT INTO tbl_paciente (nome, cpf, rg, profissao, idade, email, estado_civil, sexo, rua_av, numero,
				complemento, bairro, cidade_id, cep, ddd_tel, telefone, ddd_cel, celular, data_nasc, convenio_id, empresa_id,
				fax, ddd_fax, cor, org_exp, uf_rg, emissao_rg, natural_de, nome_mae, nome_pai, tipo_sangue, cns, indicado_por,
				responsavel, resp_telefone, ddd_resp_telefone, data_internacao, status_id, foto, tel_nome, tel_nome_2)  
                VALUES ('$nome', '$cpf', '$rg', '$profissao', '$idade', '$email', '$estado_civil', '$sexo', '$rua_av',
				'$numero', '$complemento', '$bairro', $cidade_id, '$cep', '$ddd_tel', '$telefone', '$ddd_cel', '$celular',
				'".fnc_formata_data($_POST["data_nasc"])."', '$convenio_id', ".EMPRESA.", '$fax', '$ddd_fax', '$cor', '$org_exp',
				'$uf_rg', '".fnc_formata_data($_POST["emissao_rg"])."', '$natural_de', '$nome_mae', '$nome_pai', '$tipo_sangue',
				'$cns', '$indicado_por', '$responsavel', '$resp_telefone', '$ddd_resp_telefone', '".fnc_formata_data($_POST["data_internacao"])."',
				'$status_id', '$foto', '$tel_nome', '$tel_nome_2')";
            }else{
                $sql = "UPDATE tbl_paciente SET nome = '$nome', cpf = '$cpf', rg = '$rg', profissao = '$profissao',
				idade = '$idade', email = '$email', estado_civil = '$estado_civil', sexo = '$sexo', rua_av = '$rua_av',
				numero = '$numero', complemento = '$complemento', bairro = '$bairro',  cidade_id = $cidade_id, cep = '$cep',
				ddd_tel = '$ddd_tel', telefone = '$telefone', ddd_cel = '$ddd_cel', celular = '$celular',
				data_nasc = '".fnc_formata_data($_POST["data_nasc"])."', convenio_id = '$convenio_id', empresa_id = ".EMPRESA.",
				fax = '$fax', ddd_fax = '$ddd_fax', cor = '$cor', org_exp = '$org_exp', uf_rg = '$uf_rg', 
				emissao_rg = '".fnc_formata_data($_POST["emissao_rg"])."', natural_de = '$natural_de', nome_mae = '$nome_mae',
				nome_pai = '$nome_pai', tipo_sangue = '$tipo_sangue', cns = '$cns', indicado_por = '$indicado_por', 
				responsavel = '$responsavel', resp_telefone = '$resp_telefone', ddd_resp_telefone = '$ddd_resp_telefone',
				data_internacao = '".fnc_formata_data($_POST["data_internacao"])."', status_id = '$status_id', foto = '$foto',
				tel_nome = '$tel_nome', tel_nome_2 = '$tel_nome_2'
                WHERE paciente = $paciente_id";
            }
			//echo $sql;
            $res = pg_query($con, $sql);
			
			if((int)$paciente_id == 0){ 
				$sql_curval		= "select currval('seq_paciente') as paciente_id";
				$res_curval 	= pg_query($con, $sql_curval);
				$paciente_id 	= pg_fetch_result($res_curval, 0, "paciente_id");	
			}		    
			
			if($agendamento_id > 0){
                $telefone_agendamento = $ddd_tel.$telefone;
				$celular_agendamento = $ddd_cel.$celular;

                $sql_ag = "UPDATE tbl_agendamento SET nome = '$nome', paciente_id=$paciente_id, telefone= '$telefone_agendamento', celular='$celular_agendamento' WHERE agendamento = $agendamento_id";
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
            $nome               = pg_fetch_result($res_paciente, 0, 'nome');
            $cpf                = pg_fetch_result($res_paciente, 0, 'cpf');
            $rg                 = pg_fetch_result($res_paciente, 0, 'rg');
            $profissao          = pg_fetch_result($res_paciente, 0, 'profissao');
            $idade              = pg_fetch_result($res_paciente, 0, 'idade');
            $email              = pg_fetch_result($res_paciente, 0, 'email');
            $rua_av             = pg_fetch_result($res_paciente, 0, 'rua_av');
            $numero             = pg_fetch_result($res_paciente, 0, 'numero');
            $complemento        = pg_fetch_result($res_paciente, 0, 'complemento');
            $bairro             = pg_fetch_result($res_paciente, 0, 'bairro');
            $cep                = pg_fetch_result($res_paciente, 0, 'cep');
            $cidade_id          = pg_fetch_result($res_paciente, 0, 'cidade_id');
            $estado_civil       = pg_fetch_result($res_paciente, 0, 'estado_civil');
            $sexo               = pg_fetch_result($res_paciente, 0, 'sexo');
			$ddd_tel            = pg_fetch_result($res_paciente, 0, 'ddd_tel');
			$telefone           = pg_fetch_result($res_paciente, 0, 'telefone');
			$ddd_cel            = pg_fetch_result($res_paciente, 0, 'ddd_cel');
			$celular            = pg_fetch_result($res_paciente, 0, 'celular');
			$data_nasc		    = fnc_data_formatada(pg_fetch_result($res_paciente, 0, 'data_nasc'));
			$convenio_id	    = pg_fetch_result($res_paciente, 0, 'convenio_id');
			$fax	            = pg_fetch_result($res_paciente, 0, 'fax');
			$ddd_fax    	    = pg_fetch_result($res_paciente, 0, 'ddd_fax');
			$cor    	        = pg_fetch_result($res_paciente, 0, 'cor');
			$org_exp    	    = pg_fetch_result($res_paciente, 0, 'org_exp');
			$uf_rg       	    = pg_fetch_result($res_paciente, 0, 'uf_rg');
			$emissao_rg		    = fnc_data_formatada(pg_fetch_result($res_paciente, 0, 'emissao_rg'));
			$natural_de    	    = pg_fetch_result($res_paciente, 0, 'natural_de');
			$nome_mae      	    = pg_fetch_result($res_paciente, 0, 'nome_mae');
			$nome_pai           = pg_fetch_result($res_paciente, 0, 'nome_pai');
			$tipo_sangue     	= pg_fetch_result($res_paciente, 0, 'tipo_sangue');
			$cns        	    = pg_fetch_result($res_paciente, 0, 'cns');
			$indicado_por       = pg_fetch_result($res_paciente, 0, 'indicado_por');
			$responsavel        = pg_fetch_result($res_paciente, 0, 'responsavel');
			$resp_telefone 	    = pg_fetch_result($res_paciente, 0, 'resp_telefone');
			$ddd_resp_telefone  = pg_fetch_result($res_paciente, 0, 'ddd_resp_telefone');
			$data_internacao    = fnc_data_formatada(pg_fetch_result($res_paciente, 0, 'data_internacao'));
			$status_id   	    = pg_fetch_result($res_paciente, 0, 'status_id');
			$foto        	    = pg_fetch_result($res_paciente, 0, 'foto');
			$tel_nome       	= pg_fetch_result($res_paciente, 0, 'tel_nome');
			$tel_nome_2         = pg_fetch_result($res_paciente, 0, 'tel_nome_2');
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

		$sql_agendamento = "SELECT nome, telefone, celular, convenio_id FROM tbl_agendamento 
							WHERE agendamento = $agendamento ";
		$res_agendamento = pg_query($con, $sql_agendamento);
		if(pg_num_rows($res_agendamento)> 0){
			$nome       = pg_fetch_result($res_agendamento, 0, nome);
			$telefone   = pg_fetch_result($res_agendamento, 0, telefone);
			$celular   = pg_fetch_result($res_agendamento, 0, celular);
			$convenio_id   = pg_fetch_result($res_agendamento, 0, convenio_id);


			if(strlen(trim($telefone))==10){
				$ddd = substr($telefone, 0,2);
				$telefone = substr($telefone, 2,8); 
				
			}
			
			if(strlen(trim($celular))>=10){
				$ddd_cel = substr($celular, 0,2);
				$celular = substr($celular, 2,9); 				
			}
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
		<link href="<?php echo RAIZ ?>css/estilo.css" rel="stylesheet">
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
			$("#telefone").mask("(99)9999-9999");
			$("#emissao_rg").mask("99/99/9999");
			$("#resp_telefone").mask("(99)9999-9999");
			$("#data_internacao").mask("99/99/9999");
			
		   
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
                            <div class=" col-md-10 titulo_tela" >Cliente</div>
                            <div class="col-md-2 link_tela">
                                <a href="cliente_pesquisa.php" class="btn btn-success btn-sm"><i class="fa fa-list-alt"></i>Pesquisa</a>		
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
                                   <form name="frm_tipo_imovel" id="frm_tipo_imovel" method="POST" action="" enctype="multipart/form-data"> <!--atributo enctype permite a comunicação entre o su computador e o servidor onde será mandada a imagem-->
                                        <div id="funcionario_2">
											<div method="POST" id="upload"> 
														Selecione o Arquivo :
														<input type="file" name="arquivo">
														<input type="hidden" name="MAX_FILE_SIZE" value="1000" /> <!--Poderá enviar para o servidor no maximo 30MB-->
														<?php
														   echo " <img width='200' height='185' src= 'upload/".$foto."'>" ;
														
														?>
														
											</div>
                                            <div class='row'>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">Nome*</label>
                                                        <input type="text" name="nome" value="<?php echo $nome ?>" maxlength="50" class="form-control" id="exampleInputEmail1" placeholder="Nome">
                                                    </div>
                                                </div>
												<div class="col-md-2">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">CPF</label>
                                                        <input type="text" name="cpf" id="cpf" value="<?php echo $cpf?>"  maxlength="14" class="form-control" placeholder="CPF">
                                                    </div>
                                                </div>
											</div>
												
												
                                            <div class='row'>
                                                <div class="col-md-8">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">E-mail</label>
                                                        <input type="email" name="email" value="<?php echo $email ?>" class="form-control" maxlength="50"  placeholder="E-Mail">
                                                    </div>
                                                </div>
                                            </div>
											
											<br><br><br><br>
											
                                            <div class='row'>
												<div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">Profissão</label>
                                                        <input type="text" name="profissao" value="<?php echo $profissao?>" maxlength="50" class="form-control" id="exampleInputEmail1" placeholder="Profissão">
                                                    </div>
                                                </div>
												<div class="col-md-3">
                                                    <div class="form-group">
                                                        <label  for="exampleInputEmail1">RG</label>
                                                        <input type="text" name="rg"  value="<?php echo $rg?>"   maxlength="12" class="form-control" id="RG" placeholder="RG">
                                                    </div>
                                                </div>
												<div class="col-md-2">
                                                    <div class="form-group">
                                                        <label  for="exampleInputEmail1">Orgão Exp</label>
                                                        <input type="text" name="org_exp"  value="<?php echo $org_exp?>"   maxlength="6" class="form-control"  placeholder="Orgão">
                                                    </div>
                                                </div>
												<div class="col-md-1">
                                                    <div class="form-group">
                                                        <label  for="exampleInputEmail1">UF RG</label>
                                                        <input type="text" name="uf_rg"  value="<?php echo $uf_rg?>"   maxlength="2" class="form-control"  placeholder="">
                                                    </div>
                                                </div>
												<div class="col-md-2">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">Emissão</label>
                                                        <input type="text" name="emissao_rg" value="<?php echo $emissao_rg ?>" maxlength="10"  class="form-control"  id="emissao_rg" placeholder="Emissão">
                                                    </div>
                                                </div>
												<!--<div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">Cor</label>
                                                        <input type="text" name="cor" value="<?php //echo $cor?>" maxlength="20" class="form-control" id="exampleInputEmail1" placeholder="Cor">
                                                    </div>
                                                </div>-->
                                              
                                              
                                            </div>
                                            <div class='row'>
												 <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">Sexo</label><br>
                                                        <select name="sexo" class="form-control" style="height: 37px" >
                                                            <option value="">Sexo</option>
                                                            <option value="F" <?php if($sexo == "F"){echo " selected ";}?> >Feminino</option>
                                                            <option value="M" <?php if($sexo == "M"){echo " selected ";}?> >Masculino</option>
                                                        </select>
                                                   </div>
                                                </div>
                                                
												<div class="col-md-2">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">Estado Civil</label>
                                                        <input type="text" name="estado_civil" value="<?php echo $estado_civil ?>" maxlength="15"  class="form-control" id="exampleInputEmail1" placeholder="Estado Civil">
                                                    </div>
                                                </div>
												<div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">Data de Nascimento*</label>
                                                        <input type="text" name="data_nasc" value="<?php echo $data_nasc ?>" maxlength="10"  class="form-control"  id="data_nasc" placeholder="Data de Nascimento" onblur="calcular()">
                                                    </div>
                                                </div>
                                                <div class="col-md-1">
													<div class="form-group">
														<label  for="exampleInputEmail1">Idade</label>
														<input type="text" name="idade" value="<?php echo $idade?>" maxlength="3" onkeypress='return SomenteNumero(event)' class="form-control" id="idade" placeholder="Idade">
													</div>
												</div>
												<div class="col-md-2">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">Natural</label>
                                                        <input type="text" name="natural_de" value="<?php echo $natural_de ?>" maxlength="20"  class="form-control" id="exampleInputEmail1" placeholder="Natural">
                                                    </div>
												</div>
                                            </div>
											
											<div class='row'>
												 <div class="col-md-4">
														<div class="form-group">
															<label for="exampleInputEmail1">Nome da Mãe</label>
															<input type="text" name="nome_mae" value="<?php echo $nome_mae ?>" maxlength="50" class="form-control" id="exampleInputEmail1" placeholder="Mãe">
														</div>
												  </div>
												   <div class="col-md-4">
														<div class="form-group">
															<label for="exampleInputEmail1">Nome do Pai</label>
															<input type="text" name="nome_pai" value="<?php echo $nome_pai ?>" maxlength="50" class="form-control" id="exampleInputEmail1" placeholder="Pai">
														</div>
												  </div>
												  <div class="col-md-3">
													<div class="form-group">
														<label  for="exampleInputEmail1">Convênio</label>
														<select name="convenio_id" class="form-control">
															<option value="">convenio</option>       
															<?php 
															$sql_convenio = "SELECT convenio, descricao, empresa FROM tbl_convenio where status_id = 1 ORDER BY descricao";
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
											</div>
												
                                        </div>
										
									<div class='row'>
										<div class="col-md-2">
											<div class="form-group">
												<label  for="exampleInputEmail1">Sangue</label>
												<input type="text" name="tipo_sangue"  value="<?php echo $tipo_sangue ?>" maxlength="5" class="form-control" >
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-group">
												<label  for="exampleInputEmail1">CNS</label>
												<input type="text" name="cns" value="<?php echo $cns ?>" maxlength="10" class="form-control" Placeholder = "CNS">
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label  for="exampleInputEmail1">Indicado Por:</label>
												<input type="text" name="indicado_por" value="<?php echo $indicado_por ?>" maxlength="50" class="form-control" Placeholder = "Indicação">
											</div>
										</div>
									</div>
									
									<div class='row'>
										<div class="col-md-7">
											<div class="form-group">
												<label  for="exampleInputEmail1">Responsável</label>
												<input type="text" name="responsavel" value="<?php echo $responsavel ?>" maxlength="50" class="form-control" Placeholder = "Responsável">
											</div>
										</div>
										<!--
										<div class="col-md-1">
											<div class="form-group">
												<label  for="exampleInputEmail1">DDD</label>
												<input type="text" name="ddd_resp_telefone" value="<?php echo $ddd_resp_telefone ?>" maxlength="2" class="form-control">
											</div>
										</div>
										-->
										<div class="col-md-2">
											<div class="form-group">
												<label  for="exampleInputEmail1">Tel. Responsável</label>
												<input type="text" name="resp_telefone" id="resp_telefone" value="<?php echo $resp_telefone ?>" maxlength="9" class="form-control">
											</div>
										</div>
										<div class="col-md-2">
											<div class="form-group">
												<label  for="exampleInputEmail1">Obs Telefone</label>
												<input type="text" name="tel_nome_2" value="<?php echo $tel_nome_2 ?>" maxlength="30" class="form-control">
											</div>
										</div>
									</div>
										
                                    <div class="row">									
										<div class="col-md-3">
											<div class="form-group">
												<label  for="exampleInputEmail1">CEP</label>
												<input type="text" name="cep" id="cep" value="<?php echo $cep ?>" maxlength="9" class="form-control" >
											</div>
										</div>
                                    
									</div>
									<div class="row">
										<div class="col-md-7">
											<div class="form-group">
												<label  for="exampleInputEmail1">Rua/Av</label>
												<input type="text" name="rua_av" id="rua" value="<?php echo $rua_av ?>" maxlength="50" class="form-control" >
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label  for="exampleInputEmail1">Complemento</label>
												<input type="text" name="complemento" value="<?php echo $complemento ?>" maxlength="20" class="form-control">
											</div>
										</div>
                                    
									</div>
									<div class="row"> 
										<div class="col-md-2">
											<div class="form-group">
											   <label  for="exampleInputEmail1">Número</label>
												<input type="text" name="numero" value="<?php echo $numero ?>" maxlength="5" class="form-control">
											</div>
										</div>
										<div class="col-md-5">
											<div class="form-group">
												<label  for="exampleInputEmail1">Bairro</label>
												<input type="text" name="bairro" id="bairro" value="<?php echo $bairro ?>" maxlength="70" class="form-control">
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label  for="exampleInputEmail1">Cidade*</label>
												<select name="cidade_id" class="form-control">
													<option value="">Cidade</option>       
													<?php 
														$sql_cidade = "SELECT cidade, descricao, estado FROM tbl_cidade where status_id = 1 ORDER BY descricao";
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
									<!--<div class="col-md-1">
                                        <div class="form-group">
                                            <label  for="exampleInputEmail1">DDD</label>
                                            <input type="text" name="ddd_tel" value="<?php echo $ddd_tel ?>" maxlength="2" class="form-control">
                                        </div>
                                    </div>-->
									
									<div class="col-md-2">
                                        <div class="form-group">
                                            <label  for="exampleInputEmail1">Telefone</label>
                                            <input type="text" name="telefone" id="telefone" value="<?php echo $telefone ?>" maxlength="50" class="form-control">
                                        </div>
                                    </div>
									<div class="col-md-2">
                                        <div class="form-group">
                                            <label  for="exampleInputEmail1">Obs Telefone</label>
                                            <input type="text" name="tel_nome"  value="<?php echo $tel_nome ?>" maxlength="30" class="form-control">
                                        </div>
                                    </div>
									<div class="col-md-1">
                                        <div class="form-group">
                                            <label  for="exampleInputEmail1">DDD</label>
                                            <input type="text" name="ddd_cel" value="<?php echo $ddd_cel ?>" maxlength="2"  class="form-control">
                                        </div>
                                    </div>
									<div class="col-md-2">
                                        <div class="form-group">
                                            <label  for="exampleInputEmail1">Celular</label>
                                            <input type="text" name="celular" id="celular" value="<?php echo $celular ?>" maxlength="10" class="form-control">
                                        </div>
                                    </div>	
									<div class="col-md-2">
											<div class="form-group">
												<label  for="exampleInputEmail1">Status*</label>
												<select name="status_id" class="form-control">
													<option value="">Status</option>       
													<?php 
														$sql_status = "SELECT status, descricao FROM tbl_status where status = 4 or status = 3 or status = 2 order by descricao";
														$res_status = pg_query($con, $sql_status);
														for($i =0; $i<pg_num_rows($res_status); $i++){
															$status     = pg_fetch_result($res_status, $i, 'status');
															$descricao  = pg_fetch_result($res_status, $i, 'descricao');
														
															if($status_id == $status){
																	$selected = " selected ";
																}else{
																	$selected = " ";
																}
																
															echo "<option value='$status' $selected>$descricao</option>";
														}

													?>

												</select>
											</div>
										</div>
										<div class="col-md-2">
                                        <div class="form-group">
                                            <label  for="exampleInputEmail1">Data Internação</label>
                                            <input type="text" name="data_internacao" id="data_internacao" value="<?php echo $data_internacao ?>" maxlength="10" class="form-control">
                                        </div>
                                    </div>
								<!--	<div class="col-md-1">
                                        <div class="form-group">
                                            <label  for="exampleInputEmail1">DDD</label>
                                            <input type="text" name="ddd_fax" value="<?php echo $ddd_fax ?>" maxlength="2"  class="form-control">
                                        </div>
                                    </div>
									<div class="col-md-2">
                                        <div class="form-group">
                                            <label  for="exampleInputEmail1">Fax</label>
                                            <input type="text" name="fax" id="fax" value="<?php echo $fax ?>" maxlength="10" class="form-control">
                                        </div>
                                    </div>	
								</div>-->
                                <div class="row">
                                    <div class="col-md-12 botao">
                                        <input class="btn btn-success" type="submit" name="btnacao" value="Gravar">
                                        <input type="hidden" name="paciente_id" value="<?php echo $paciente_id ?>">
										<input type="hidden" name="agendamento_id" value="<?=$agendamento?>">
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