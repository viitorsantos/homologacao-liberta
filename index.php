<?php

   include "include/conexao.php";
    include "include/config.php";
    include "include/funcoes.php";

    session_start();
    require 'include/config.php';    
       
    if(isset($_POST["btnacao"])){
        
        $login          = fncTrataDados(fnc_maiusculas($_POST["login"]));
        $senha          = fncTrataDados($_POST["senha"]);

        if(strlen(trim($login)) == 0){
            $erro .= "O campo login deve ser preenchido. <br>";
        }
        if(strlen(trim($senha)) == 0){
            $erro .= "O campo senha deve ser preenchido. <br>";
        }
        if(empty($erro)){
            $sql = "SELECT usuario, login, senha FROM tbl_usuario WHERE login='$login' and senha='$senha' and ativo='t'";
            $res = pg_query($con, $sql);
            if(pg_num_rows($res)==1){
                $usuario = pg_fetch_result($res, 0, 'usuario');
                $_SESSION["usuario"]    = $usuario;
                $_SESSION["hash"]       = md5($login."sistemasclinicaETECINFO");
                header('Location: home.php');
            }else{
                $erro .= "Falha na autenticação. <br>";
            }
        }       
            
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <title><?php echo TITLE_ADMIN ?></title>
        <meta name="description" content="" />
        <meta name="author" content="Lucas" />
       <meta name="viewport" content="width=device-width; initial-scale=1.0" />
        <!-- Replace favicon.ico & apple-touch-icon.png in the root of your domain and delete these references -->
        <link rel="shortcut icon" href="<?php echo RAIZ?>/images/<?php echo LOGO_FAVICON ?>" type="image/x-icon" />     
        <!-- Bootstrap core CSS -->
       <link href="<?php echo RAIZ ?>css/bootstrap.css" rel="stylesheet">
        <!-- Custom styles for this template -->
        <link href="<?php echo RAIZ ?>css/style_admin.css" rel="stylesheet">
        <script type="text/javascript" src="https://code.jquery.com/jquery.js"></script>
        <script type="text/javascript" src="<?php echo RAIZ ?>js/bootstrap.min.js"></script>
    </head>

    <body class="body_admin">        
        <form name="frm_login" method="POST">
            <div class="login">
                <div class="login_painel">
                    <div class="login-title">Autenticação</div>
                    <div><?php echo $erro ?></div>
                    <div class="form-group">
                        <input type="text" name="login" class="form-control" id="exampleInputEmail1" placeholder="Usuário">
                    </div>
                    <div class="form-group">
                        <input type="password" name="senha" class="form-control" id="exampleInputPassword1" placeholder="Senha">
                    </div>
                    <input type="submit" name="btnacao" value="Entrar" class="btn btn-success" />
                    <br/>
                    <br/>
                    <!--<a href="#">Esqueceu a senha?</a><br/>-->
                </div>
            </div>
        </form>
    </body>
</html>

