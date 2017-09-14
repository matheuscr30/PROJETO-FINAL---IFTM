<?php
    include 'functions.php';

    $valor_receita = @$_REQUEST['valor_receita'];
    $confirmar_receita = @$_REQUEST['confirmar_receita'];
    $codigo = @$_REQUEST['codigo'];

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
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Receitas do Bielzinho</title>
    </head>

    <body>
        <?php
            include 'passa_slide.php';

            if(conecta()){
                $incremento = 2;
                
                $texto_sql = "SELECT * FROM cad_receitas";
                $result = mysql_query($texto_sql);
                $quantidade = mysql_num_rows($result);

                $linhas = $quantidade;

                $texto_sql = "SELECT codigo_receita FROM cad_receitas";
                $result = mysql_query($texto_sql);
                $vet =  mysql_fetch_row($result);

                echo "<table width=\"100%\" class=\"tabela\">";
                $linhas_tabela = $linhas / 3;
                
                if(!is_int($linhas_tabela))
                    $linhas_tabela = intval($linhas_tabela) + 1;

                for ($j = 0; $j < $linhas_tabela; $j++)
                {
                    echo "<tr>";
                    for ($k = 1; $k < 4; $k++)
                    {
                        echo"<td>";

                        //Quando j =0, fica normal, se nao for incrementa i e vet em 2
                        if ($j == 0)
                        {
                            for ($i = ($k +$j); $i < $vet[0] + ($k + $j); $i++){
                                $texto_sql = @"SELECT `nome_receita`, `foto`, `tempo` FROM `cad_receitas` WHERE codigo_receita = '$i'";
                                $result = @mysql_query($texto_sql);
                                $vetor =  @mysql_fetch_row($result);

                                if (count($vetor) == 3){
                                    echo "<div>";
                                    echo "<p>&nbsp;</p>";
                                    echo "<center><b><a class=\"receita_clicada\" href=\"index.php?paginacentral=home.php&estado=$estado&codigo=$i\">$vetor[0]</a><b></center>";
                                    echo "<center><b><img width=\"300px\" height=\"300px\" class=\"img-circle\" src=\"$vetor[1]\"><b></center>";
                                    echo "<center><b>Tempo de Preparo: $vetor[2]<b></center>";
                                    echo "</div>";

                                    if ($codigo == $i){
                                        $texto_sql = "SELECT `nome_receita` FROM `cad_receitas` WHERE codigo_receita = '$i'";
                                        $result = mysql_query($texto_sql);
                                        $vetor =  mysql_fetch_row($result);

                                        echo "<script language=\"javascript\" type=\"application/javascript\">";
                                        echo "window.location.replace(\"index.php?paginacentral=home.php&estado=$estado&valor_receita=$vetor[0]&confirmar_receita=1\")";
                                        echo "</script>";	
                                    }		
                                }
                            }
                        }

                        if ($j != 0)
                        {
                            for ($i = ($k +$j) + ($j * 2); $i < $vet[0] + ($k + $j) + ($j * 2); $i++){
                                $texto_sql = "SELECT `nome_receita`, `foto`, `tempo` FROM `cad_receitas` WHERE codigo_receita = '$i'";
                                $result = mysql_query($texto_sql);
                                $vetor =  mysql_fetch_row($result);

                                if (count($vetor) == 3){
                                    echo "<div>";
                                    echo "<p>&nbsp;</p>";
                                    echo "<center><b><a class=\"receita_clicada\" href=\"index.php?paginacentral=home.php&estado=$estado&codigo=$i\">$vetor[0]</a><b></center>";
                                    echo "<center><b><img width=\"300px\" height=\"300px\" class=\"img-circle\" src=\"$vetor[1]\"><b></center>";
                                    echo "<center><b>Tempo de Preparo: $vetor[2]<b></center>";
                                    echo "</div>";

                                    if ($codigo == $i)
                                    {
                                        $texto_sql = "SELECT `nome_receita` FROM `cad_receitas` WHERE codigo_receita = '$i'";
                                        $result = mysql_query($texto_sql);
                                        $vetor =  mysql_fetch_row($result);

                                        echo "<script language=\"javascript\" type=\"application/javascript\">";
                                        echo "window.location.replace(\"index.php?paginacentral=home.php&estado=$estado&valor_receita=$vetor[0]&confirmar_receita=1\")";
                                        echo "</script>";	
                                    }		
                                }				
                            }
                        }
                    }
                }
                
                echo "</table>";
            }
        ?>
    </body>
</html>
