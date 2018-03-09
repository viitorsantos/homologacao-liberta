<?php

	$con = pg_connect('host=pgsql.fivesystem.com.br port=5432 dbname=fivesystem user=fivesystem password=etec3info');

	$q = strtolower($_GET["q"]);
	if (!$q) return;

	$sql = "select DISTINCT nome from tbl_paciente where nome ~* '$q'";
	$rsd = pg_query($con, $sql);
	while($rs = pg_fetch_array($rsd)) {
		$cname = $rs['nome'];
		echo "$cname\n";
	}
?>