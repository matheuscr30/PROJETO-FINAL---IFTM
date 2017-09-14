<?php

function alerta($mensagem){
	echo "<script language=\"javascript\">";
	echo "alert(\"$mensagem\");";
	echo "</script>";
}

function conecta(){
	
	$host         = "localhost";
	$usuario      = "root";
	$senha        = "";
	$bancodedados = "info_mcr";
	
	$servidor = mysql_connect($host, $usuario, $senha);

		
		if($servidor){
			//alerta("conexao com o servidor ok");
			$db = mysql_select_db($bancodedados, $servidor);
			if($db){
				alerta ("conexao OK");
			}else{
				alerta ("conexao OFF");
			}
			return true;
		}else{
			alerta("conexao com o servidor falha");		
		}
}

if (conecta())
{
$texto_sql_bolo = "SELECT `foto`, `nome_receita` FROM `cad_receitas` WHERE `tipo_receita` = 'bolos e tortas' ORDER BY `codigo_receita` DESC ";
$result_bolo = mysql_query($texto_sql_bolo);
$vetor_bolo =  mysql_fetch_row($result_bolo);
$imagem_bolo = $vetor_bolo[0];
$nome_bolo = $vetor_bolo[1];

$texto_sql_carne = "SELECT `foto`, `nome_receita` FROM `cad_receitas` WHERE `tipo_receita` = 'carnes e peixes' ORDER BY `codigo_receita` DESC ";
$result_carne = mysql_query($texto_sql_carne);
$vetor_carne =  mysql_fetch_row($result_carne);
$imagem_carne = $vetor_carne[0];
$nome_carne = $vetor_carne[1];

$texto_sql_bebida = "SELECT `foto, `nome_receita`` FROM `cad_receitas` WHERE `tipo_receita` = 'bebidas' ORDER BY `codigo_receita` DESC ";
$result_bebida = mysql_query($texto_sql_bebida);
$vetor_bebida =  mysql_fetch_row($result_bebida);
$imagem_bebida = $vetor_bebida[0];
$nome_bebida = $vetor_bebida[1];

$texto_sql_doce = "SELECT `foto`, `nome_receita` FROM `cad_receitas` WHERE `tipo_receita` = 'doces e sobremesas' ORDER BY `codigo_receita` DESC ";
$result_doce = mysql_query($texto_doce);
$vetor_doce =  mysql_fetch_row($result_doce);
$imagem_doce = $vetor_doce[0];
$nome_doce = $vetor_doce[1];

$texto_sql_sopa = "SELECT `foto`, `nome_receita` FROM `cad_receitas` WHERE `tipo_receita` = 'sopas' ORDER BY `codigo_receita` DESC ";
$result_sopa = mysql_query($texto_sql_sopa);
$vetor_sopa =  mysql_fetch_row($result_sopa);
$imagem_sopa = $vetor_sopa[0];
$nome_sopa = $vetor_sopa[1];

}


?>
<html>
<head>
<link href="slide/js-image-slider.css" rel="stylesheet" type="text/css" />
<script src="slide/js-image-slider.js" type="text/javascript"></script>
<link href="slide/generic.css" rel="stylesheet" type="text/css" />
</head>

<body>
    <div id="sliderFrame">
        <div id="slider">
            <a href="" target="_blank">
            	<?php
                echo "<img src=\"$imagem_bolo\" alt=\"$nome_bolo\" />";
            	?>
			</a>
            	
			<?php
              echo "<img src=\"$imagem_carne\" alt=\"$nome_carne\" />";
              echo "<img src=\"$imagem_bebida\" alt=\"$nome_bebida\" />";
              echo "<img src=\"$imagem_doce\" alt=\"$nome_doce\" />";
			  echo "<img src=\"$imagem_sopa\" alt=\"$nome_sopa\" />";
		   	?>
		</div>
    </div>

</body>