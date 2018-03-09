<?php
    include "include/conexao.php";
    include "include/config.php";
    include "include/funcoes.php";
	

   
    if(isset($_POST["btnacao"])){
		 
		$tipo 				= 		fncTrataDados($_POST["tipo"]);
		$inicio				= 		fncTrataDados($_POST["inicio"]);
		$final			    = 		fncTrataDados($_POST["final"]);
		$intervalo 		    = 		fncTrataDados($_POST["intervalo"]);
		$cad_cidade		    = 		(fncTrataDados($_POST["cad_cidade"]) == 't') ? 't' : 'f';
		$cad_convenio 		= 		(fncTrataDados($_POST["cad_convenio"]) == 't') ? 't' : 'f';
		$fornecedor 		= 		(fncTrataDados($_POST["fornecedor"]) == 't') ? 't' : 'f';
		$funcionario		= 		(fncTrataDados($_POST["funcionario"]) == 't') ? 't' : 'f';
		$grupo			    = 		(fncTrataDados($_POST["grupo"]) == 't') ? 't' : 'f';
		$produto		    = 		(fncTrataDados($_POST["produto"]) == 't') ? 't' : 'f';
		$nome		        = 		(fncTrataDados($_POST["nome"]) == 't') ? 't' : 'f';
		$cpf	            = 		(fncTrataDados($_POST["cpf"]) == 't') ? 't' : 'f';
		$email              = 		(fncTrataDados($_POST["email"]) == 't') ? 't' : 'f'; 
		$rg                 = 		(fncTrataDados($_POST["rg"]) == 't') ? 't' : 'f';
		$profissao      	= 		(fncTrataDados($_POST["profissao"]) == 't') ? 't' : 'f';
		$sexo               = 		(fncTrataDados($_POST["sexo"]) == 't') ? 't' : 'f';
		$estado_civil       = 		(fncTrataDados($_POST["estado_civil"]) == 't') ? 't' : 'f';
		$data_nascimento	= 		(fncTrataDados($_POST["data_nascimento"]) == 't') ? 't' : 'f'; 
		$idade			    = 		(fncTrataDados($_POST["idade"]) == 't') ? 't' : 'f';
		$convenio			= 		(fncTrataDados($_POST["convenio"]) == 't') ? 't' : 'f';
		$cep			    = 		(fncTrataDados($_POST["cep"]) == 't') ? 't' : 'f';
		$rua			    = 		(fncTrataDados($_POST["rua"]) == 't') ? 't' : 'f';
		$complemento		= 		(fncTrataDados($_POST["complemento"]) == 't') ? 't' : 'f';
		$numero			    = 		(fncTrataDados($_POST["numero"]) == 't') ? 't' : 'f';
		$bairro			    = 		(fncTrataDados($_POST["bairro"]) == 't') ? 't' : 'f';
		$cidade		        = 		(fncTrataDados($_POST["cidade"]) == 't') ? 't' : 'f';
		$telefone			= 		(fncTrataDados($_POST["telefone"]) == 't') ? 't' : 'f';
		$celular			= 		(fncTrataDados($_POST["celular"]) == 't') ? 't' : 'f';
		 
           
        }

  	  echo $tipo;
	  echo $inicio;
	  echo $final;
      echo $intervalo;
      echo $cad_cidade;
      echo $cad_convenio;
      echo $fornecedor;
	  echo $funcionario;
	  echo $grupo;
	  echo $produto;
	  echo $nome;
	  echo $cpf;
	  echo $email;
	  echo $rg;            
	  echo $profissao;      	
	  echo $sexo;       
	  echo $estado_civil;  
	  echo $data_nascimento;
	  echo $idade;		
	  echo $convenio;		
	  echo $cep;		
	  echo $rua;			
	  echo $complemento;	
	  echo $numero;		
	  echo $bairro;			    
	  echo $cidade;		
	  echo $telefone;
	  echo $celular;
				  
				   
            
	

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
		<script>
			function imprime(text){
				text=document
				print(text)
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
                            <div class=" col-md-9 titulo_tela" >Configurações - Empresas</div>
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
											 <h3>Atividade</h3>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <input type="radio" name="tipo" value="Podologia" <?php if($tipo == "Podologia"){echo " checked ";}?>> Podologia &nbsp;&nbsp;&nbsp;
														<input type="radio" name="tipo" value="Medica" <?php if($tipo == "Medica"){echo " checked ";}?>> Médica &nbsp;&nbsp;&nbsp;
														<input type="radio" name="tipo" value="Dentista" <?php if($tipo == "Dentista"){echo " checked ";}?>> Dentista &nbsp;&nbsp;&nbsp;
														<input type="radio" name="tipo" value="Outros" <?php if($tipo == "Outros"){echo " checked ";}?>> Outros
                                                    </div>
                                                </div>
                                            </div>
											<div class="row">
											 <h3>Agendamento</h3>
												<div class="col-md-2">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">Início</label>
                                                        <input type="text" name="inicio" value="<?php echo $inicio?>" class="form-control" id="exampleInputEmail1">
                                                    </div>
                                                </div>
												<div class="col-md-2">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">Final</label>
                                                        <input type="text" name="final" value="<?php echo $final?>" class="form-control" id="exampleInputEmail1">
                                                    </div>
                                                </div>
												<div class="col-md-2">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">Intervalo</label>
                                                        <input type="text" name="intervalo" value="<?php echo $intervalo?>" class="form-control" id="exampleInputEmail1">
                                                    </div>
                                                </div>
											</div>
											<div class="row">
												<h3>Funcionalidades</h3>
												<div class="checkbox disabled">
													<label>
													 <input type="checkbox" name="cad_cidade" value="t"  <?php if($cad_cidade == 't') echo " checked "?>>Cadastro de Cidade
													</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
													<label>
													 <input type="checkbox" name="cad_convenio" value="t"  <?php if($cad_convenio == 't') echo " checked "?>>Cadastro de Convênio
													</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
													<label>
													 <input type="checkbox" name="fornecedor" value="t"  <?php if($fornecedor == 't') echo " checked "?>>Cadastro de Fornecedor
													</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
													<label>
													 <input type="checkbox" name="funcionario" value="t"  <?php if($funcionario == 't') echo " checked "?>>Cadastro de Funcionário
													</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
													<label>
													 <input type="checkbox" name="grupo" value="t"  <?php if($grupo == 't') echo " checked "?>>Grupo de Usuário
													</label>
													<label>
													 <input type="checkbox" name="produto" value="t"  <?php if($produto == 't') echo " checked "?>>Cadastro de Produto
													</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
											    </div>
											</div>
			
											<div class="row">
												<h3>Cadastro de Cliente</h3>
												<div class="checkbox disabled">
													<label>
													 <input type="checkbox" name="nome" value="t"  <?php if($nome == 't') echo " checked "?>>Nome
													</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
													<label>
													 <input type="checkbox" name="cpf" value="t"  <?php if($cpf == 't') echo " checked "?>>CPF
													</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
													<label>
													 <input type="checkbox" name="email" value="t"  <?php if($email == 't') echo " checked "?>>Email
													</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
													<label>
													 <input type="checkbox" name="rg" value="t"  <?php if($rg == 't') echo " checked "?>>RG
													</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
													<label>
													 <input type="checkbox" name="profissao" value="t"  <?php if($profissao == 't') echo " checked "?>>Profissão
													</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
													<label>
													 <input type="checkbox" name="sexo" value="t"  <?php if($sexo == 't') echo " checked "?>>Sexo
													</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
													<label>
													 <input type="checkbox" name="estado_civil" value="t"  <?php if($estado_civil == 't') echo " checked "?>>Estado Civil
													</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
													<label>
													 <input type="checkbox" name="data_nascimento" value="t"  <?php if($data_nascimento == 't') echo " checked "?>>Data Nasc.
													</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
													<label>
													 <input type="checkbox" name="idade" value="t"  <?php if($idade == 't') echo " checked "?>>Idade
													</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
													<label>
													 <input type="checkbox" name="convenio" value="t"  <?php if($convenio == 't') echo " checked "?>>Convênio
													</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
													<label>
													 <input type="checkbox" name="cep" value="t"  <?php if($cep == 't') echo " checked "?>>CEP
													</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
													<label>
													 <input type="checkbox" name="rua" value="t"  <?php if($rua == 't') echo " checked "?>>Rua
													</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
													<label>
													 <input type="checkbox" name="complemento" value="t"  <?php if($complemento == 't') echo " checked "?>>Complemento
													</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
													<label>
													 <input type="checkbox" name="numero" value="t"  <?php if($numero == 't') echo " checked "?>>Número
													</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
													<label>
													 <input type="checkbox" name="bairro" value="t"  <?php if($bairro == 't') echo " checked "?>>Bairro
													</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
													<label>
													 <input type="checkbox" name="cidade" value="t"  <?php if($cidade == 't') echo " checked "?>>Cidade
													</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
													<label>
													 <input type="checkbox" name="telefone" value="t"  <?php if($telefone == 't') echo " checked "?>>Telefone
													</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
													<label>
													 <input type="checkbox" name="celular" value="t"  <?php if($celular == 't') echo " checked "?>>Celular
													</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
											    </div>
											</div>
											
                                        <br>

                                    <div class="row">
                                        <div class="col-md-12 botao">
                                            <input class="btn btn-info" type="submit" name="btnacao" value="Gravar">
                                        </div>
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
            <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>-->
            <script src="<?php echo RAIZ ?>js/bootstrap.min.js"></script>
            <script src="<?php echo RAIZ ?>js/docs.min.js"></script>
        </div>
    </body>
</html>