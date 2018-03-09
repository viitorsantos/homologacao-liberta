<?php
	session_start();

	if($_SESSION["usuario"] > 0 and isset($_SESSION["hash"])){

		$sql = "SELECT usuario, login, tbl_grupo_usuario.descricao,  tbl_funcionario.grupo_usuario_id, tbl_funcionario.funcionario, tbl_funcionario.empresa_id from tbl_usuario 
				inner join tbl_funcionario on tbl_funcionario.funcionario = tbl_usuario.funcionario_id
				inner join tbl_grupo_usuario on tbl_grupo_usuario.grupo_usuario = tbl_funcionario.grupo_usuario_id
				where usuario = ". (int)$_SESSION['usuario'];
		$res = pg_query($con, $sql);
		if(pg_num_rows($res) >0){	
			$usuario 			= pg_fetch_result($res, 0, 'usuario');
			$login				= pg_fetch_result($res, 0, 'login');
			$_descricao_usuario	= pg_fetch_result($res, 0, 'descricao');
			$_grupo_usuario_id	= pg_fetch_result($res, 0, 'grupo_usuario_id');
			$_funcionario_id  	= pg_fetch_result($res, 0, 'funcionario');
			$_empresa_id  		= pg_fetch_result($res, 0, 'empresa_id');
			$_administrador 	= true;
			define("EMPRESA", "3");
			define("GRUPO", "$_grupo_usuario_id");

			$hash = md5($login."sistemasclinicaETECINFO");
		}
		
		if($hash != $_SESSION["hash"]){
			header('Location: index.php');
		}
		}else{
		header('Location: index.php');
		}
	

?>