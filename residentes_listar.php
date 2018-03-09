<?php
    include "include/conexao.php";
    include "include/config.php";
    include "include/funcoes.php";
	include "include/verifica_usuario.php";
	//include "include/verifica_permissao.php";
    
	$nome = 'Sala do Médico';
	
	//verifica_permissao($nome);

	$sql_permissao = "SELECT *FROM tbl_permissao";
	$res_permissao = pg_query($con, $sql_permissao);
	for($i=0; $i<pg_num_rows($res_permissao); $i++){
		$id_permissao = pg_fetch_result($res_permissao, $i, 'permissao');
		$nome = pg_fetch_result($res_permissao, $i, 'descricao');
		$array_permissao[] = $id_permissao;
		if($nome == 'Sala do Médico'){
			$id_pagina = $id_permissao;
		}
	}
	
	$sql_permissao_grupo = "SELECT *FROM tbl_grupo_usuario_permissao WHERE grupo_usuario_id = ".GRUPO."";
	$res_permissao_grupo = pg_query($con, $sql_permissao_grupo);
	for($j=0; $j<pg_num_rows($res_permissao_grupo); $j++){
		$id_permissao_grupo = pg_fetch_result($res_permissao_grupo, $j, 'permissao_id');
		$array_grupo_permissao[] = $id_permissao_grupo;
	}
    $compara = array_diff($array_permissao, $array_grupo_permissao); //Dentro do array compara estão os ids que este grupo NÃO possui permissão
	
	$encontrou = array_search($id_pagina, $compara); //verifica se o id da permissão que esta na variavel $id_pagina está dentro do array compara
													 //se o id for encontrado no array ele retorna a posição do array que aquele id está

	if(($encontrou != false) || ($encontrou === 0)){ //se encontrou for zero ou possui valor é pq ele não tem permissão para acessar está página
		header("Location: home.php");
	}
	
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
			   var press = confirm("Tem certeza que deseja excluir ?");
				if(press){
					alert("Excluído com sucesso");
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
                            <div class=" col-md-9 titulo_tela" >Sala do Médico</div>
                            <div class="col-md-1 link_tela">
                                <a href="residentes_cadastrar.php?" class="btn btn-success btn-sm"><i class="fa fa-list-alt"></i>Novo</a>     
                            </div>
                        </div>
                        <div class="conteudo">
                            <div class="table-responsive">
                                <table class="table table-striped">  
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Nome</th>
                                            <th>Data</th>
											<th>Convênio</th>
											<th>Data 1</th>
										    <th>Data 2</th>
											<th>Data 3</th>
                                            <th colspan="2">Ações</th>
                                        </tr>
                                    </thead
                                    <tbody>
                                         <?php
                                            $sql = "SELECT * from tbl_sala_medico";
                                            $res = pg_query($con, $sql);
                                            for($i=0; $i<pg_num_rows($res); $i++){
												$sala_medico_id          = pg_fetch_result($res, $i, 'sala_medico');
                                                $nome                    = pg_fetch_result($res, $i, 'nome');   
                                               	$data                    = fnc_data_formatada(pg_fetch_result($res, $i, 'data'));
												$convenio                = pg_fetch_result($res, $i, 'convenio'); 
												$data1                   = fnc_data_formatada(pg_fetch_result($res, $i, 'data1'));
												$data2                   = fnc_data_formatada(pg_fetch_result($res, $i, 'data2'));
												$data3                   = fnc_data_formatada(pg_fetch_result($res, $i, 'data3'));
                                               
                                                echo "<tr>";
                                                    echo "<td class='col-md-1'>".($i+1)."</td>";
                                                    echo "<td>$nome</td>"; 
                                                    echo "<td>$data</td>"; 
													echo "<td>$convenio</td>"; 
													echo "<td>$data1</td>"; 
													echo "<td>$data2</td>"; 
									     			echo "<td>$data3</td>"; 
                                                    echo "<td class='col-md-1'><a href='./residentes_cadastrar.php?sala_medico=$sala_medico_id' title='Editar'><i class='fa fa-pencil-square-o'></i></a></td>";
													echo "<td class='col-md-1'><a href='./residentes_cadastrar.php?excluir=$sala_medico_id' onclick='return confirma()' title='Excluir'><i class='fa fa-trash-o'></i></a></td>";
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