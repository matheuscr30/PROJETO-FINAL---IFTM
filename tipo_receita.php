<?php
    $codigo = @$_REQUEST['codigo'];
    $valor_receita = @$_REQUEST['valor_receita'];
    $confirmar_receita = @$_REQUEST['confirmar_receita'];

    $valor_tipo_receita = @$_SESSION['tipo_receita'];

    if ($confirmar_receita == 1)
    {
        $_SESSION['nome_receita_especificada'] = $valor_receita;
        echo "<script language=\"javascript\" type=\"application/javascript\">";
        echo "window.location.replace(\"index.php?paginacentral=receita_especificada.php\")";
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

                $texto_sql = "SELECT codigo_receita, nome_receita, foto, tempo FROM cad_receitas WHERE tipo_receita='$valor_tipo_receita'";
                $result = pg_query($texto_sql);
                $linhas_tabela = pg_num_rows($result);

                echo "<table width=\"100%\" class\"tabela\">";
                $linhas_tabela = $linhas_tabela / 3;
                if(!is_int($linhas_tabela))
                    $linhas_tabela = intval($linhas_tabela) + 1;

                for ($j = 0; $j < $linhas_tabela; $j++)
                {
                    echo "<tr>";
                    for ($k = 1; $k < 4; $k++)
                    {
                        echo"<td>";
                        $vetor = pg_fetch_array($result);
                        
                        if (count($vetor) == 8)
                        {
                            echo "<div>";
                            echo "<center><b><a class=\"receita_clicada\" href=\"index.php?paginacentral=tipo_receita.php&codigo={$vetor["codigo_receita"]}\">{$vetor["nome_receita"]}</a><b></center>";
                            echo "<center><b><img width=\"300px\" height=\"300px\" class=\"img-circle\" src=\"{$vetor["foto"]}\"><b></center>";
                            echo "<center><b>Tempo de Preparo: {$vetor["tempo"]}</b></center>";
                            echo "<p>&nbsp</p>";
                            echo "</div>";

                            if ($codigo == $vetor["codigo_receita"])
                            {
                                echo "<script language=\"javascript\" type=\"application/javascript\">";
                                echo "window.location.replace(\"index.php?paginacentral=tipo_receita.php&valor_receita={$vetor["nome_receita"]}&confirmar_receita=1\")";
                                echo "</script>";		
                            }
                        }
                    } 	
                }
                echo "</table>";
            }
        ?>
    </body>
</html>