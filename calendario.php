<?php
 include "include/conexao.php";

 date_default_timezone_set('America/Sao_Paulo');

	$feriados = array();
    $sql_feriado = "select * from tbl_feriado";
    $res_feriado = pg_query($con, $sql_feriado);
    if(pg_num_rows($res_feriado)>0){
    	for($i= 0; $i<pg_num_rows($res_feriado); $i++){
    		$dia 		= pg_fetch_result($res_feriado, $i, 'dia');
    		$mes 		= pg_fetch_result($res_feriado, $i, 'mes');
    		$ano        = pg_fetch_result($res_feriado, $i, 'ano');
    		$descricao 	= pg_fetch_result($res_feriado, $i, 'descricao');

    		$dia = str_pad($dia, 2, '0', STR_PAD_LEFT);
    		$mes = str_pad($mes, 2, '0', STR_PAD_LEFT);

    		if(strlen(trim($ano))==0){
    			$ano = date('Y');
    		}

    		array_push($feriados, "$dia/$mes/$ano");

    		$descricao_feriado["$dia/$mes/$ano"] = $descricao; 

    	}
    }

 
date_default_timezone_set('America/Los_Angeles');

function MostreSemanas()
{
	$semanas = "DSTQQSS";
 
	for( $i = 0; $i < 7; $i++ )
	 echo "<td align=center><b>".$semanas{$i}."</b></td>";
 
}
 
function GetNumeroDias( $mes )
{
	$numero_dias = array( 
			'01' => 31, '02' => 28, '03' => 31, '04' =>30, '05' => 31, '06' => 30,
			'07' => 31, '08' =>31, '09' => 30, '10' => 31, '11' => 30, '12' => 31
	);
 
	if ((($ano % 4) == 0 and ($ano % 100)!=0) or ($ano % 400)==0)
	{
	    $numero_dias['02'] = 29;	// altera o numero de dias de fevereiro se o ano for bissexto
	}
 
	return $numero_dias[$mes];
}
 
function GetNomeMes( $mes )
{
     $meses = array( '01' => "Janeiro", '02' => "Fevereiro", '03' => "Março",
                     '04' => "Abril",   '05' => "Maio",      '06' => "Junho",
                     '07' => "Julho",   '08' => "Agosto",    '09' => "Setembro",
                     '10' => "Outubro", '11' => "Novembro",  '12' => "Dezembro"
                     );
 
      if( $mes >= 01 && $mes <= 12)
        return $meses[$mes];

        return "Mês deconhecido";
}
 
function MostreCalendario( $mes, $ano )
{

	global $feriados;
	global $descricao_feriado;
 
	$numero_dias = GetNumeroDias( $mes, $ano );	// retorna o número de dias que tem o mês desejado
	$nome_mes = GetNomeMes( $mes );
	$diacorrente = 0;	
 
	$diasemana = jddayofweek( cal_to_jd(CAL_GREGORIAN, $mes,"01",$ano) , 0 );	// função que descobre o dia da semana

	echo "<table border = 0 cellspacing = '0' align = 'left' style=' margin:0px 10px;'>";
	 echo "<tr>";
         echo "<td colspan = 7 align=center><h3>".$nome_mes."-".$ano."</h3></td>";
	 echo "</tr>";
	 echo "<tr>";
	   MostreSemanas();	// função que mostra as semanas aqui
	 echo "</tr>";
	for( $linha = 0; $linha < 6; $linha++ )
	{
 
 
	   echo "<tr>";
 
	   for( $coluna = 0; $coluna < 7; $coluna++ )
	   {
	   	

		echo "<td width = 30 height = 30  ";
 
		  if( ($diacorrente == ( date('d') - 1) && date('m') == $mes) )
		  {	
			   echo " id = 'dia_atual' ";
		  }
		  else
		  {
			     if(($diacorrente + 1) <= $numero_dias )
			     {
			         if( $coluna < $diasemana && $linha == 0)
				 {
					echo " id = 'dia_branco' ";
				 }
				 else
				 {
				  	echo " id = 'dia_comum' ";
				 }
			     }
			     else
			     {
				echo " ";
			     }
		  }

		if(1 == 1 ){
			$class = "teste";
		}else{
			$class = "";
		}

		echo " align = center valign='center' ";
 
 
		   /* TRECHO IMPORTANTE: A PARTIR DESTE TRECHO É MOSTRADO UM DIA DO CALENDÁRIO (MUITA ATENÇÃO NA HORA DA MANUTENÇÃO) */
 
		    if( $diacorrente + 1 <= $numero_dias ){
				if( $coluna < $diasemana && $linha == 0)
				{
					 echo " ";
				}
				else
				{
					// echo "<input type = 'button' id = 'dia_comum' name = 'dia".($diacorrente+1)."'  value = '".++$diacorrente."' onclick = "acao(this.value)">";
				   //echo "<a href = ".$_SERVER["PHP_SELF"]."?mes=$mes&dia=".($diacorrente+1).">".++$diacorrente . "</a>";
						$imprimeDia = ++$diacorrente;
						//trabalhar aqui ..

						$dia = str_pad($imprimeDia, 2, '0', STR_PAD_LEFT);
						$dataProcura = $dia.'/'."$mes".'/'."$ano";

						//echo "dataProcura = $dataProcura";

							if(in_array("$dataProcura", $feriados)){
						   		$complemento = "class='td_feriado'";
						   		$complemento .= " title='".$descricao_feriado["$dataProcura"]."'";
						   	}elseif(($coluna > 0 and $coluna < 5) and !in_array("$dataProcura", $feriados) ){
						   		$complemento = "class='td_dia'";
						   	}elseif($coluna == 0 or $coluna == 6){
						   		$complemento = "class='td_finalsemana'";
						   	}

						echo " $complemento  onclick='buscarDia($imprimeDia, $mes, $ano)'>".  $imprimeDia;
				}
		    }else{
				break;
		    }
 
		   /* FIM DO TRECHO MUITO IMPORTANTE */
 
 
 
		echo "</td>";
	   }
	   echo "</tr>";
	}
 
	echo "</table>";

}

 
function MostreCalendarioCompleto()
{
	    echo "<table align = center>";
	    $cont = 1;
	    for( $j = 0; $j < 4; $j++ )
	    {
		  echo "<tr>";
		for( $i = 0; $i < 3; $i++ )
		{
		 
		  echo "<td>";
			MostreCalendario( ($cont < 10 ) ? "0".$cont : $cont );  
 
		        $cont++;
		  echo "</td>";
 
	 	}
		echo "</tr>";
	   }
	   echo "</table>";
}


if(isset($_POST['btnacao_calendario'])){
	$mes = $_POST['mes'];
	$ano = $_POST['ano'];
	$mes = str_pad($mes, 2, "0", STR_PAD_LEFT);


	if($mes == 01){
		$anterior = 12;
		$posterior = $mes+1;
		$anoAnterior = $ano-1;
		$anoPosterior = $ano;
		$anterior = str_pad($anterior, 2, "0", STR_PAD_LEFT);
		$posterior = str_pad($posterior, 2, "0", STR_PAD_LEFT);
	}elseif($mes <= 11 and $mes >=2){
		$anterior = $mes-1;
		$posterior = $mes+1;
		$anoAnterior = $ano;
		$anoPosterior = $ano;
		$anterior = str_pad($anterior, 2, "0", STR_PAD_LEFT);
		$posterior = str_pad($posterior, 2, "0", STR_PAD_LEFT);
	}else{
		$mes = 11;
		$anterior = $mes-1;
		$posterior = $mes+1;
		$anoAnterior = $ano;
		$anoPosterior = $ano;
		$anterior = str_pad($anterior, 2, "0", STR_PAD_LEFT);
		$posterior = str_pad($posterior, 2, "0", STR_PAD_LEFT);
	}


	echo "<center>";
	MostreCalendario($anterior, $anoAnterior);
	MostreCalendario("$mes", $ano);
	MostreCalendario($posterior, $anoPosterior);
	echo "</center>";


	

		
		//echo "<div id='div_anterior'>". MostreCalendario($anterior, $ano) . "</div>";
		//echo "<div class='col-md-2' id='div_atual'>". MostreCalendario("$mes", $ano). "</div>";
		//echo "<div id='div_posterior'>". MostreCalendario($posterior, $ano). "</div>";
		



}
 

//echo "<br/>";
//MostreCalendarioCompleto();
?>