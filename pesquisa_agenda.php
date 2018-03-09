<?php   
    require './include/conexao.php';
    require './include/config.php';
    require './include/funcoes.php';
	
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

        <script type="text/javascript">
            function fnc_pesquisa(){
                var data_inicio    = $("#data_inicio").val();
                var data_fim       = $("#data_fim").val();
                var status         = $("#status").val();
             
                $.ajax({
                    url: 'pesquisa_agenda.php',
                    data: {btnacao : true, data_inicio: data_inicio, data_fim: data_fim, status: status},
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
                            <div class=" col-md-10 titulo_tela" >Relatório de Agendamento</div>                         
                        </div>
                        <div class="conteudo">
                            <div id="grava"></div>
                            <form name="frm_relatorio_agendamento" id="frm_relatorio_agendamento" method="POST" action="relatorio_agenda.php" target="_blank">
                                 <div class='row'>
                                    <div class="col-md-2 col-md-offset-4">                                        
                                        <div class="form-group">
                                            <label>Data Inicio</label>
                                            <input type="text" name="data_inicio" id="data_inicio" maxlength="10" class="form-control" value="<?php echo $data_inicio?>" onkeypress="Formatadata(this,event)" >
                                        </div>
                                    </div>
									<div class="col-md-2">                                        
                                        <div class="form-group">
                                            <label>Data Fim</label>
                                            <input type="text" name="data_fim" id="data_fim" maxlength="10" class="form-control" value="<?php echo $data_fim?>" onkeypress="Formatadata(this,event)">
                                        </div>
                                    </div>
								</div>
                            <!--  <div class='row'>
                                    <div class="col-md-4 col-md-offset-4">
                                         <div class="form-group" >
                                             <label for="exampleInputEmail1">Convênio</label><br>
                                             <select name="convenio_id" class="form-control">
                                                <option value="">Selecione um Convênio</option>       
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
                                                    echo "<option value='$convenio' $selected >$descricao</option>";
                                                }
                                                ?>
                                            </select>
                                         </div>
                                     </div>
                                </div>  -->
								<div class='row'>
                                    <div class="col-md-4 col-md-offset-4">
                                         <div class="form-group" >
                                             <label for="exampleInputEmail1">Status</label><br>
                                                 <select name="status" class="form-control" style="height: 37px" id="status">
                                                     <option value="">Selecione um Status</option>
                                                     <!--<option value="" <?php if($status == "t"){echo " selected ";}?>>Aguard. Confirmação</option> -->
                                                     <option value="t" <?php if($status == "t"){echo " selected ";}?>>Confirmada/Realizada</option>
                                                     <option value="f" <?php if($status == "f"){echo " selected ";}?>>Cancelado</option>
                                                  </select>
                                         </div>
                                     </div>
								</div>
                                  
							<div class="row">
                                <div class="col-md-12">
                                    <div class="form-group" style="text-align: center">
                                         <input type="submit" name="btnacao" onclick="fnc_pesquisa()" value="Gerar" class="btn btn-success" > 
                                    </div>
                                </div>
							</div>							
                           </form> 
                            

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