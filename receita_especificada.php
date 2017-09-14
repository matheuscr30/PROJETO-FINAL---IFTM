<?php
    include 'functions.php';

    $estado = @$_REQUEST['estado'];
    setcookie('cookie_estado_comentario', $estado);
    $op_comentario = @$_REQUEST['op_comentario'];
    $valor_cookie_nome_receita_especificada = @$_COOKIE['cookie_nome_receita_especificada'];
    $valor_cookie_nome_usuario = @$_COOKIE['cookie_nome_usuario'];

    if(!isset($op_comentario)){
            $op_comentario = 0;
    }

    if($op_comentario == 1)
    {
        $e_comentario = @$_REQUEST['e_comentario'];
        $valor_cookie_estado_comentario = @$_COOKIE['cookie_estado_comentario'];	

    }
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Receitas do Bielzinho</title>
    </head>

    <body >
        <?php
            if(conecta()){	

                $texto_sql = "SELECT * FROM cad_receitas";
                $result = mysql_query($texto_sql);
                $quantidade = mysql_num_rows($result);

                $linhas = $quantidade;

                $texto_sql = "SELECT codigo_receita FROM cad_receitas";
                $result = mysql_query($texto_sql);
                $vet =  mysql_fetch_row($result);

                $texto_sql = "SELECT `nome_receita`, `foto`, `tempo`, `ingredientes`, `modo_preparo` FROM `cad_receitas` WHERE `nome_receita`='$valor_cookie_nome_receita_especificada'";
                $result = mysql_query($texto_sql);
                $vetor =  mysql_fetch_row($result);

                echo "<div>";
                echo "<center><b><a class=\"receita_clicada\" href=\"index.php?paginacentral=receita_especificada.php&estado=$estado\">$vetor[0]</a></b></center>";
                echo "<center><b><img width=\"300px\" height=\"300px\" class=\"img-circle\" src=\"$vetor[1]\"></b></center><br>";
                echo "<center><b>Tempo de Preparo: $vetor[2]";
                echo "</b></center><br>";
                echo "<center><b>Ingredientes:</b><br>";
                $vetor[3] = nl2br($vetor[3]);
                echo $vetor[3];
                echo "</center><br><br>";
                echo "<center><b>Modo de Preparo:</b><br>";
                $vetor[4] = nl2br($vetor[4]);
                echo $vetor[4];
                echo "</center><br>";
                echo "</div><br>";
                
                //comentarios
                echo "<center><b>Comentários:</b></center>";

                //Pegar quantidade de usuarios da tabela cad_usuarios
                $texto_sql = "SELECT `nome` FROM cad_usuarios";
                $result = mysql_query($texto_sql);
                $quantidade = mysql_num_rows($result);
                $linhas = $quantidade;

                //Pegar o codigo_receita da tabela cad_receitas
                $texto_sql = "SELECT `codigo_receita` FROM cad_receitas WHERE `nome_receita` = '$valor_cookie_nome_receita_especificada'";
                $result = mysql_query($texto_sql);
                $vet =  mysql_fetch_row($result);
                $codigo_receita_comentario = $vet[0];


                for ($j = 1; $j <= $linhas; $j++)
                { 		
                    //Pegar o codigo de cada usuario
                    $texto_sql_1 = "SELECT `nome` FROM `cad_usuarios` WHERE `codigo`=$j";
                    $result_1 = mysql_query($texto_sql_1);
                    $vetor_1 =  mysql_fetch_row($result_1);	

                    $texto_sql_2 = "SELECT `nome_usuario`, `texto` FROM `cad_comentarios` WHERE `codigo_receita`=$codigo_receita_comentario AND `nome_usuario`='$vetor_1[0]'";
                    $result_2 = mysql_query($texto_sql_2);
                    $vetor_2 =  mysql_fetch_row($result_2);

                    if (! ($vetor_2[0] == '' || $vetor_2[1] == '') )
                    {
                        echo "<br>";
                        echo "<center> $vetor_2[0]:   $vetor_2[1] </center>";
                    }
                }
            }

            if ($op_comentario == 0)
            {
        ?>

        <p>&nbsp;</p>
        <form id="form1" name="form1" method="post" action="index.php?paginacentral=receita_especificada.php&op_comentario=1">
            <div align="center">
                <table width="400" border="0">
                    <tr>
                        <td colspan="2"><strong><center>Escreva um comentário:</center></strong></td>
                    </tr>
                    <tr>
                        <div>
                            <td colspan="2"><label for="e_comentario"></label>
                                <div align="center">
                                    <textarea name="e_comentario" id="e_comentario" cols="45" rows="5"></textarea>
                                </div>
                            </td>
                        </div>
                    </tr>
                    
                    <tr>
                        <td>
                            <div align="center">
                                <input type="reset" class="btn btn-default" name="botao_limpar_comentario" id="botao_limpar_comentario" value="Limpar" />
                            </div>
                        </td>
                        
                        <td>
                            <div align="center">
                                <input type="submit" class="btn btn-default" name="botao_enviar_comentario" id="botao_enviar_comentario" value="Enviar" />
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
            
            <div align="center"></div>
        </form>
    </body>
</html>

<?php
    }

    if ($op_comentario == 1)
    {	
        if ($valor_cookie_estado_comentario == 'logado')
        {
            if (conecta())
            {
                $texto_sql = "INSERT INTO `cad_comentarios`(`codigo_receita`, `texto`, `nome_usuario`) VALUES ('$codigo_receita_comentario', '$e_comentario' ,'$valor_cookie_nome_usuario')";
                $result = mysql_query($texto_sql);

                if($result > 0)
                {
                    alerta("Comentário Cadastrado!!");
                    echo "<script language=\"javascript\" type=\"application/javascript\">";
                    echo "window.location.replace(\"index.php?paginacentral=receita_especificada.php&estado=logado\")";
                    echo "</script>";
                }
                else
                {
                    alerta("Comentário Não Cadastrado!!");
                    echo "<script language=\"javascript\" type=\"application/javascript\">";
                    echo "window.location.replace(\"index.php?paginacentral=receita_especificada.php&estado=logado\")";
                    echo "</script>";
                }	
            }
        }

        if ($valor_cookie_estado_comentario == 'naologado')
        {
            alerta("Usuario tem que estar logado para comentar as receitas");	
            echo "<script language=\"javascript\" type=\"application/javascript\">";
            echo "window.location.replace(\"index.php?paginacentral=entrar.php&estado=naologado\")";
            echo "</script>";
        }
    }
?>