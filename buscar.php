<?php
    $valor_receita = @$_REQUEST['valor_receita'];
    $confirmar_receita = @$_REQUEST['confirmar_receita'];
    $codigo = @$_REQUEST['codigo'];
    $op_receita = @$_REQUEST['op_receita'];

    $valor_buscar_receita = @$_SESSION['buscar_receita'];

    if(!isset($op_receita)){
        $op_receita = 0;
    }

    if ($confirmar_receita == 1)
    {
        $_SESSION['nome_receita_especificada'] = $valor_receita;
        echo "<script language=\"javascript\" type=\"application/javascript\">";
        echo "window.location.replace(\"index.php?paginacentral=receita_especificada.php\")";
        echo "</script>";
    }

    if ($op_receita == 1)
    {
        alerta("Receita não Encontrada!!");
        echo "<script language=\"javascript\" type=\"application/javascript\">";
        echo "window.location.replace(\"index.php?paginacentral=home.php\")";
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
            if ($op_receita == 0)
            {
                if(conecta()){	
                    $flag = false;
                    $texto_sql = "SELECT codigo_receita, nome_receita, foto, tempo FROM cad_receitas WHERE nome_receita LIKE '$valor_buscar_receita%'";
                    $result = pg_query($texto_sql);
                    $linhas = pg_num_rows($result);

                    echo "<table width=\"100%\" class\"tabela\">";
                    $linhas_tabela = $linhas / 3;
                    if(!is_int($linhas_tabela))
                        $linhas_tabela = intval($linhas_tabela) + 1;

                    for ($j = 0; $j < $linhas_tabela; $j++)
                    {
                        echo "<tr>";
                        for ($k = 1; $k < 4; $k++)
                        {
                            echo"<td>";
                            $vetor = @pg_fetch_array($result);
                            
                            //indices numeros + indices string
                            if(count($vetor) == 8)
                            {
                                echo "<div>";
                                echo "<p>&nbsp;</p>";
                                echo "<center><b><a class=\"receita_clicada\" href=\"index.php?paginacentral=buscar.php&codigo={$vetor["codigo_receita"]}\">{$vetor["nome_receita"]}</a><b></center>";
                                echo "<center><b><img width=\"300px\" height=\"300px\" class=\"img-circle\" src=\"{$vetor["foto"]}\"><b></center>";
                                echo "<center><b>Tempo de Preparo: {$vetor["tempo"]}<b></center>";
                                echo "</div>";

                                if ($codigo == $vetor["codigo_receita"])
                                {
                                    echo "<script language=\"javascript\" type=\"application/javascript\">";
                                    echo "window.location.replace(\"index.php?paginacentral=buscar.php&valor_receita={$vetor["nome_receita"]}&confirmar_receita=1\")";
                                    echo "</script>";	
                                }
                                $flag = true;
                            }
                        }
                    }
                    echo "</table>";

                    if ($flag == false)
                    {
                        echo "<script language=\"javascript\" type=\"application/javascript\">";
                        echo "window.location.replace(\"index.php?paginacentral=buscar.php&op_receita=1\")";
                        echo "</script>";		
                    }
                }
            }
        ?>
    </body>
</html>

<?php
    if ($op_receita == 1)
    {
        alerta("Receita não Encontrada!!");
        echo "<script language=\"javascript\" type=\"application/javascript\">";
        echo "window.location.replace(\"index.php?paginacentral=home.php\")";
        echo "</script>";		
    }
?>
