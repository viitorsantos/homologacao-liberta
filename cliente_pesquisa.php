<?php   
    require './include/conexao.php';
    require './include/config.php';
    require './include/funcoes.php';
    include "include/verifica_usuario.php";

    if($_POST['btnacao']){
        $nome_cliente   = $_POST['nome'];
        $ddd            = $_POST['ddd'];
        $telefone       = $_POST['telefone'];

        if(strlen(trim($nome_cliente)) == 0 and strlen(trim($telefone)) == 0){
            $erro .= "Os campos Nome ou Telefone devem ser preenchidos. <br>";
        }

        if(strlen(trim($nome_cliente))>0 ){
            $where .= " and nome ilike '%$nome_cliente%' ";
        }

        if(strlen(trim($ddd))>0 ){
            $where .= " and (ddd_tel = '$ddd' or ddd_cel = '$ddd') ";
        }

        if(strlen(trim($telefone))>0 ){
             //$where .= "and cpf ilike '$cpf%'";
            $where .= " and (telefone = '$telefone' or celular = '$telefone')";
        }       

        if(strlen(trim($erro)) == 0){
            $sql = "SELECT nome, idade, ddd_cel, telefone, celular, cidade_id, paciente, tbl_cidade.descricao FROM TBL_PACIENTE
                    inner join tbl_cidade on tbl_cidade.cidade = tbl_paciente.cidade_id 
                    WHERE paciente > 0  $where and tbl_paciente.empresa_id = ".EMPRESA ;
            $res = pg_query($con, $sql);
 
            if(pg_num_rows($res)>0){
                echo "<div class='table-responsive'>
                        <table class='table table-striped'>
                            <thead>
                                <tr>
                                    <th class='col-md-1' align='center'></th>
                                    <th class='col-md-4'>Nome</th>
                                    <th class='col-md-2'>Cidade</th>
                                    <th class='col-md-3'>Telefone</th>
                                    <th class='col-md-1'>Idade</th>
                                    <th class='col-md-1' align='center' colspan='2'>Ações</th>
                                </tr>
                            </thead>
                            <body";
                for($i=0; $i<pg_num_rows($res); $i++){
                    $paciente = pg_fetch_result($res, $i, 'paciente');
                    $nome   = pg_fetch_result($res, $i, 'nome');
                    $idade  = pg_fetch_result($res, $i, 'idade');
                    $cidade  = pg_fetch_result($res, $i, 'descricao');
                    $ddd_cel    = pg_fetch_result($res, $i, 'ddd_cel');
                    $ddd_tel    = pg_fetch_result($res, $i, 'ddd_tel');
                    $telefone   = pg_fetch_result($res, $i, 'telefone');
                    $celular    = pg_fetch_result($res, $i, 'celular');

                    $numeros = "";
                    $num_telefone   = $telefone;
                    $num_celular    = $ddd_cel."-".$celular;

                    if(strlen(trim($celular))>0){
                        $numeros .= "   ".$num_celular;
                    }

                    if(strlen(trim($telefone))>0){
                        $numeros .= "   ".$num_telefone;
                    }

                    echo "<tr>";
                        echo "<td class='col-md-1'>".($i+1)."</td>";
                        echo "<td class='col-md-4'>$nome</td>";
                        echo "<td class='col-md-3'>$cidade</td>";
                        echo "<td class='col-md-3'>$numeros</td>";
                        echo "<td class='col-md-1'>$idade</td>";
                        echo "<td class='col-md-1' align='center'><a href='./cliente_cadastrar.php?paciente=$paciente' title='Editar'><i class='fa fa-pencil-square-o'></i></a></td>";
                        echo "<td class='col-md-1' align='center'><a href='./ficha_medica.php?paciente=$paciente' title='Procedimentos e Consultas'><i class='fa fa-list-alt'></i></a></td>";
                    echo "</tr>";
                }
                echo "</body>";
                echo "</table>";
                echo "</div>";
            }else{
				echo "<div class='alert alert-danger'>Nenhum Registro Encontrado</div>"; 
			}
        }else{
            echo "<div class='alert alert-danger'>$erro</div>";
        }
       
       exit;
    }


?>

<!DOCTYPE html>

<html lang="pt-br">
    <head>
	<meta charset="UTF-8">
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
			
            function fnc_pesquisa(){
                var nome    = $("#nome_cliente").val();
                var ddd         = $("#ddd").val();
                var telefone    = $("#telefone").val();
             
                $.ajax({
                    url: 'cliente_pesquisa.php',
                    data: {btnacao : true, nome: nome, ddd: ddd, telefone: telefone},
                    type: 'POST',
                    context: jQuery('#resultado'),
                    //dataType: 'json',
                    success: function(data){
                        this.html(data);
                    }
                }); 
                

            };

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
                    <div class="col-md-10 corpo">
                        <div class="page-header">                            
                            <div class=" col-md-8 titulo_tela" >Pesquisa de Cliente</div>
							<div class="col-md-2 link_tela">
                                <a href="listar_residentes.php" class="btn btn-success btn-sm"><i class="fa fa-list-alt"></i>Residentes</a>        
                            </div>
                            <div class="col-md-2 link_tela">
                                <a href="cliente_cadastrar.php" class="btn btn-success btn-sm"><i class="fa fa-list-alt"></i>Novo</a>        
                            </div>                          
                        </div>
                        <div class="conteudo">
                            <div id="grava"></div>
                            <form name="frm_cliente_pesquisa" id="frm_cliente_pesquisa" method="POST" action="">
                                 <div class='row'>
                                    <div class="col-md-8">                                        
                                        <div class="form-group">
                                            <label>Nome do Cliente</label>
                                            <input type="text" name="nome_cliente" id="nome_cliente" maxlength="30" class="form-control" value="<?php echo $nome_cliente?>">
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                         <div class="form-group">
                                            <label>DDD</label>
                                            <input type="text" name="ddd" maxlength="2" id="ddd" onkeypress='return SomenteNumero(event)' value="<?php echo $ddd ?>" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                         <div class="form-group">
                                            <label>Telefone</label>
                                            <input type="text" name="telefone" maxlength="8" id="telefone" onkeypress='return SomenteNumero(event)' value="<?php echo $telefone ?>" class="form-control">
                                        </div>
                                    </div>
                                </div>                                
                            </form> 
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group" style="text-align: center">
                                         <input type="submit" name="btnacao" onclick="fnc_pesquisa()" value="Pesquisar" class="btn btn-success">
                                    </div>
                                </div>
                            </div>
                            <div id="resultado"></div>
                            <br>
                            <?php if($qtd > 0 ){?>
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th class="col-md-1" align="center">#</th>
                                            <th class="col-md-5">Descrição</th>
                                            <th class="col-md-2">CPF/CNPJ</th>
                                            <th class="col-md-1"> </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 1;
                                        foreach ($resultado as $linha) {                                            
                                            echo "<tr>";
                                                echo "<td>$i</td>";
                                                echo "<td>$linha[nome]</td>";
                                                echo "<td>$linha[cpf_cnpj]</td>";
                                                echo "<td><a href='cliente_cadastrar.php?cliente=$linha[cliente]'><i class='fa fa-pencil-square-o'></i></a></td>";                                            
                                            echo "</tr>";
                                            $i++;
                                        }
                                        ?>      	
                                    </tbody>
                                </table>
                            </div>
                            <?php }
                            echo "$conteudo";
                            ?>
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
            
        </div>
    </body>
</html>