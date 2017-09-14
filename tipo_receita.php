<?php
    include 'functions.php';

    $codigo = @$_REQUEST['codigo'];
    $estado = @$_REQUEST['estado'];
    $valor_receita = @$_REQUEST['valor_receita'];
    $confirmar_receita = @$_REQUEST['confirmar_receita'];
    $valor_cookie_nome_receita_especificada = @$_COOKIE['cookie_nome_receita_especificada'];
    $valor_cookie_tipo_receita = @$_COOKIE['cookie_tipo_receita'];

    if ($confirmar_receita == 1)
    {
        setcookie('cookie_nome_receita_especificada', $valor_receita);
        $confirmar_receita++;
        echo "<meta HTTP-EQUIV='refresh' CONTENT='0'>";
    }

    if ($confirmar_receita == 2)
    {
        echo "<script language=\"javascript\" type=\"application/javascript\">";
        echo "window.location.replace(\"index.php?paginacentral=receita_especificada.php&estado=$estado\")";
        echo "</script>";
    }

    if (!isset($codigo))
    {
        $codigo = 0;	
    }
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Receitas do Bielzinho</title>
    </head>

    <body>
        <?php
            if(conecta()){	

                $texto_sql = "SELECT * FROM cad_receitas";
                $result = mysql_query($texto_sql);
                $quantidade = mysql_num_rows($result);

                $linhas = $quantidade;

                $contador = 1;
                for ($t = 1; $t < $linhas+1; $t++)
                {
                    $texto_sql = "SELECT `codigo_receita` FROM `cad_receitas` WHERE `tipo_receita`='$valor_cookie_tipo_receita' AND `codigo_receita`=$t ";
                    $result = mysql_query($texto_sql);
                    $vet =  mysql_fetch_row($result);
                    $linhas_tabela = mysql_num_rows($result);
                    if ($linhas_tabela != 0)
                    {
                        $vetor_codigos[$contador] = $vet[0];
                        $contador++;
                    }
                }

                echo "<table width=\"100%\" class\"tabela\">";
                $linhas_tabela = count($vetor_codigos) / 3;
                if(!is_int($linhas_tabela))
                    $linhas_tabela = intval($linhas_tabela) + 1;

                for ($j = 0; $j < $linhas_tabela; $j++)
                {
                    echo "<tr>";
                    for ($k = 1; $k < 4; $k++)
                    {
                        echo"<td>";

                        for ($i = ($k + $j)+($j * 2); $i < 1 + ($k + $j)+($j * 2); $i++){
                            $texto_sql = @"SELECT `nome_receita`, `foto`, `tempo` FROM `cad_receitas` WHERE `tipo_receita`='$valor_cookie_tipo_receita' AND `codigo_receita`=$vetor_codigos[$i]";
                            $result = @mysql_query($texto_sql);
                            $vetor =  @mysql_fetch_row($result);

                            //count é função para contar quantos elementos tem na matriz
                            //Se tem 3 é porque achou nome_receita, foto e tempo
                            if (count($vetor) == 3)
                            {
                                echo "<div>";
                                echo "<center><b><a class=\"receita_clicada\" href=\"index.php?paginacentral=tipo_receita.php&estado=$estado&codigo=$vetor_codigos[$i]\">$vetor[0]</a><b></center>";
                                echo "<center><b><img width=\"300px\" height=\"300px\" class=\"img-circle\" src=\"$vetor[1]\"><b></center>";
                                echo "<center><b>Tempo de Preparo: $vetor[2]</b></center>";
                                echo "<p>&nbsp</p>";
                                echo "</div>";

                                if ($codigo == $vetor_codigos[$i])
                                {
                                    $texto_sql = "SELECT `nome_receita` FROM `cad_receitas` WHERE codigo_receita = '$vetor_codigos[$i]'";
                                    $result = mysql_query($texto_sql);
                                    $vetor =  mysql_fetch_row($result);

                                    echo "<script language=\"javascript\" type=\"application/javascript\">";
                                    echo "window.location.replace(\"index.php?paginacentral=tipo_receita.php&estado=$estado&valor_receita=$vetor[0]&confirmar_receita=1\")";
                                    echo "</script>";		
                                }				
                            } //Fecha count
                        } //Fecha for
                    } //Fecha o count	
                }  //Fecha o for de linhas
                echo "</table>";
            } //Fecha a funcao conecta
        ?>
    </body>
</html>