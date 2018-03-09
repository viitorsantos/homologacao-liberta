<?php
    include "include/conexao.php";
    include "include/config.php";
    include "include/funcoes.php";
    include "include/verifica_usuario.php";
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
		<script type="text/javascript">
			function confirma(){
			   var press = confirm("Tem certeza que deseja excluir este Fornecedor ?");
				if(press){
					alert("fornecedor excluído com sucesso");
					return true;
				}else{
					return false;
				}
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
                    <div class="col-md-10 corpo">
                        <div class="page-header">
                            <div class=" col-md-10 titulo_tela" >Fornecedor</div>
                            <div class="col-md-2 link_tela">
                                <a href="fornecedor_cadastrar.php" class="btn btn-success btn-sm"><i class="fa fa-list-alt"></i>Novo</a>      
                            </div>
                        </div>
                        <div class="conteudo">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th class="col-md-1" align="center">#</th>
                                            <th class="col-md-5">Nome</th>
											<th>Telefone</th>
											<th>Celular</th>
                                            <th class="col-md-1"> Ações </th>
                                        </tr>
                                    </thead>
                                    <tbody>
										 <?php
                                            $sql = "SELECT fornecedor, nome, ddd_tel, telefone, ddd_cel, celular from tbl_fornecedor where status_id = 1 order by nome; ";

                                            $res = pg_query($con, $sql);
                                            for($i=0; $i<pg_num_rows($res); $i++){
                                                $fornecedor_id   = pg_fetch_result($res, $i, 'fornecedor'); 
                                                $nome            = pg_fetch_result($res, $i, 'nome'); 
												$ddd_tel         = pg_fetch_result($res, $i, 'ddd_tel'); 
												$telefone        = pg_fetch_result($res, $i, 'telefone'); 
												$ddd_cel         = pg_fetch_result($res, $i, 'ddd_cel');
												$celular         = pg_fetch_result($res, $i, 'celular');

                                                echo "<tr>";
                                                    echo "<td>".($i+1)."</td>";
                                                    echo "<td>$nome</td>";
													echo "<td>$ddd_tel-$telefone</td>";
													echo "<td>$ddd_cel-$celular</td>";
                                                    echo "<td class='col-md-1'><a href='./fornecedor_cadastrar.php?fornecedor=$fornecedor_id' title='Editar'><i class='fa fa-pencil-square-o'></i></a></td>";
													echo "<td class='col-md-1'><a href='./fornecedor_cadastrar.php?excluir=$fornecedor_id' onclick='return confirma()' title='Excluir'><i class='fa fa-trash-o'></i></a></td>";
                                                echo "</tr>";
                                            }
                                         ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                   </div>
                </div>
                <div class="row">
                    <?php include RAIZ."/include/footer.php" ?>
                </div>///
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