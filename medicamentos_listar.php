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
                            <div class=" col-md-10 titulo_tela" >Medicamentos</div>
                            <div class="col-md-2 link_tela">
                                <a href="medicamentos_cadastrar.php" class="btn btn-success btn-sm"><i class="fa fa-list-alt"></i>Novo</a>      
                            </div>
                        </div>
                        <div class="conteudo">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th class="col-md-1" align="center">#</th>
                                            <th>Descrição</th>
                                            <th class="col-md-1"> Ações </th>
                                        </tr>
                                    </thead>
                                    <tbody>
										 <?php
                                            $sql = "SELECT medicamento, descricao from tbl_medicamento order by descricao; ";

                                            $res = pg_query($con, $sql);
                                            for($i=0; $i<pg_num_rows($res); $i++){
                                                $medicamento_id       = pg_fetch_result($res, $i, 'medicamento'); 
                                                $descricao            = pg_fetch_result($res, $i, 'descricao'); 

                                                echo "<tr>";
                                                    echo "<td>".($i+1)."</td>";
                                                    echo "<td>$descricao</td>";
													echo "<td class='col-md-1'><a href='./medicamentos_cadastrar.php?medicamento=$medicamento_id' title='Editar'><i class='fa fa-pencil-square-o'></i></a></td>";
													
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