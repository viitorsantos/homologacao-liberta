<?php
	 include "conexao.php";
	 include "config.php";
	 include "verifica_usuario.php";
	 
		 $sql_per = "SELECT *FROM tbl_permissao";
		 $res_per = pg_query($con, $sql_per);
		 
		 
		
		 
function verifica_permissao($nome){
		 $n = $nome;
		
		  for($i=0; $i<7; $i++){
				
				$id_permissao = pg_fetch_result($res_per, $i, 'permissao');
				$descricao    = pg_fetch_result($res_per, $i, 'descricao');
				
				
				if($n == $descricao){
					
					$id_pagina = $id_permissao;
				}
			}

}
	 
	 verifica_permissao("teste");
	 

?>