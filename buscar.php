<?php
    include 'functions.php';

    $valor_receita = @$_REQUEST['valor_receita'];
    $confirmar_receita = @$_REQUEST['confirmar_receita'];
    $estado = @$_REQUEST['estado'];
    $codigo = @$_REQUEST['codigo'];
    $op_receita = @$_REQUEST['op_receita'];
    $valor_cookie_buscar_receita = @$_COOKIE['cookie_buscar_receita'];


    if(!isset($op_receita)){
        $op_receita = 0;
    }

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

    if ($op_receita == 1)
    {
        alerta("Receita não Encontrada!!");
        echo "<script language=\"javascript\" type=\"application/javascript\">";
        echo "window.location.replace(\"index.php?paginacentral=home.php&estado=$estado\")";
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
                    $contador = 0;

                    $texto_sql = "SELECT * FROM cad_receitas";
                    $result = mysql_query($texto_sql);
                    $quantidade = mysql_num_rows($result);

                    $linhas = $quantidade;

                    $texto_sql = "SELECT codigo_receita FROM cad_receitas";
                    $result = mysql_query($texto_sql);
                    $vet =  mysql_fetch_row($result);

                    $contador2 = 1;
                    for ($t = 1; $t < $linhas+1; $t++)
                    {
                        $texto_sql = "SELECT `codigo_receita` FROM `cad_receitas` WHERE `nome_receita` LIKE '$valor_cookie_buscar_receita%' AND `codigo_receita`=$t ";
                        $result = mysql_query($texto_sql);
                        $vet =  mysql_fetch_row($result);
                        $linhas_tabela = mysql_num_rows($result);
                        if ($linhas_tabela != 0)
                        {
                            $vetor_codigos[$contador2] = $vet[0];
                            $contador2++;
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
                                @$texto_sql = "SELECT `nome_receita`, `foto`, `tempo` FROM `cad_receitas` WHERE `nome_receita` LIKE '$valor_cookie_buscar_receita%' AND `codigo_receita`=$vetor_codigos[$i]";
                                $result = mysql_query($texto_sql);
                                @$quantidade_receitas = mysql_num_rows($result);
                                //alerta($quantidade_receitas);
                                @$vetor =  mysql_fetch_row($result);

                                if($quantidade_receitas != 0)
                                {
                                    echo "<div>";
                                    echo "<p>&nbsp;</p>";
                                    echo "<center><b><a class=\"receita_clicada\" href=\"index.php?paginacentral=buscar.php&estado=$estado&codigo=$vetor_codigos[$i]\">$vetor[0]</a><b></center>";
                                    echo "<center><b><img width=\"300px\" height=\"300px\" class=\"img-circle\" src=\"$vetor[1]\"><b></center>";
                                    echo "<center><b>Tempo de Preparo: $vetor[2]<b></center>";
                                    echo "</div>";

                                    if ($codigo == $vetor_codigos[$i])
                                    {
                                        $texto_sql = "SELECT `nome_receita` FROM `cad_receitas` WHERE codigo_receita = '$vetor_codigos[$i]'";
                                        $result = mysql_query($texto_sql);
                                        $vetor =  mysql_fetch_row($result);

                                        echo "<script language=\"javascript\" type=\"application/javascript\">";
                                        echo "window.location.replace(\"index.php?paginacentral=buscar.php&estado=$estado&valor_receita=$vetor[0]&confirmar_receita=1\")";
                                        echo "</script>";	
                                    }		
                                }

                                if ($quantidade_receitas > 0)
                                    $contador = $contador + 1;
                            } //Fecha o for das receitas
                        }
                    }
                    echo "</table>";

                    if ($contador == 0)
                    {
                        echo "<script language=\"javascript\" type=\"application/javascript\">";
                        echo "window.location.replace(\"index.php?paginacentral=buscar.php&estado=$estado&op_receita=1\")";
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
        echo "window.location.replace(\"index.php?paginacentral=home.php&estado=$estado\")";
        echo "</script>";		
    }
?>
