<?php
    include 'functions.php';

    $op = @$_REQUEST['op'];
    $receita_escolhida = @$_REQUEST['receita_escolhida'];
    $estado = @$_REQUEST['estado'];

    if(!isset($estado)){
        $estado = 'naologado';
    }

    if (conecta())
    {
        echo "<h3>lulululu2</h3>";
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

        $texto_sql_bebida = "SELECT `foto`, `nome_receita` FROM `cad_receitas` WHERE `tipo_receita` = 'bebidas' ORDER BY `codigo_receita` DESC ";
        $result_bebida = mysql_query($texto_sql_bebida);
        $vetor_bebida =  mysql_fetch_row($result_bebida);
        $imagem_bebida = $vetor_bebida[0];
        $nome_bebida = $vetor_bebida[1];

        $texto_sql_doce = "SELECT `foto`, `nome_receita` FROM `cad_receitas` WHERE `tipo_receita` = 'doces e sobremesas' ORDER BY `codigo_receita` DESC ";
        $result_doce = mysql_query($texto_sql_doce);
        $vetor_doce =  mysql_fetch_row($result_doce);
        $imagem_doce = $vetor_doce[0];
        $nome_doce = $vetor_doce[1];

        $texto_sql_sopa = "SELECT `foto`, `nome_receita` FROM `cad_receitas` WHERE `tipo_receita` = 'sopas' ORDER BY `codigo_receita` DESC ";
        $result_sopa = mysql_query($texto_sql_sopa);
        $vetor_sopa =  mysql_fetch_row($result_sopa);
        $imagem_sopa = $vetor_sopa[0];
        $nome_sopa = $vetor_sopa[1];
    }

    if ($op == 1)
    {
        setcookie('cookie_nome_receita_especificada', $receita_escolhida);
        $op++;	
        echo "<meta HTTP-EQUIV='refresh' CONTENT='0'>";
    }

    if ($op == 2)
    {
        echo "<script language=\"javascript\" type=\"application/javascript\">";
        echo "window.location.replace(\"index.php?paginacentral=receita_especificada.php&estado=$estado\")";
        echo "</script>";
    }

?>

<html>
    <head>
        <link href="slide/js-image-slider.css" rel="stylesheet" type="text/css" />
        <script src="slide/js-image-slider.js" type="text/javascript"></script>
    </head>

    <body>
        <h3 style="font-family:'Comic Sans MS', cursive"> <center> <b> Últimas Receitas Adicionadas </b> </center> </h3>
        <div id="sliderFrame">
            <div id="slider">
                <?php
                    echo "<a href=\"index.php?paginacentral=passa_slide.php&estado=$estado&op=1&receita_escolhida=$nome_bolo\"><img src=\"$imagem_bolo\" alt=\"$nome_bolo\" /></a>";
                    echo "<a href=\"index.php?paginacentral=passa_slide.php&estado=$estado&op=1&receita_escolhida=$nome_carne\"><img src=\"$imagem_carne\" alt=\"$nome_carne\" /></a>";
                    echo "<a href=\"index.php?paginacentral=passa_slide.php&estado=$estado&op=1&receita_escolhida=$nome_bebida\"><img src=\"$imagem_bebida\" alt=\"$nome_bebida\" /></a>";
                    echo "<a href=\"index.php?paginacentral=passa_slide.php&estado=$estado&op=1&receita_escolhida=$nome_sopa\"><img src=\"$imagem_sopa\" alt=\"$nome_sopa\" /></a>";
                    echo "<a href=\"index.php?paginacentral=passa_slide.php&estado=$estado&op=1&receita_escolhida=$nome_doce\"><img src=\"$imagem_doce\" alt=\"$nome_doce\" /></a>";
                ?>
            </div>
        </div>
        <br><br><br>
    </body>
</html>