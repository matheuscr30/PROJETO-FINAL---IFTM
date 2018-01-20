<?php
    $op_comentario = @$_REQUEST['op_comentario'];

    if ( !isset($_SESSION['login']) and !isset($_SESSION['senha']) )
        $estado = 'naologado';
    else
        $estado = 'logado';

    $valor_nome_receita_especificada = @$_SESSION['nome_receita_especificada'];
    $valor_nome_usuario = @$_SESSION['nome_usuario'];
    $_SESSION['estado_comentario'] = $estado;

    if(!isset($op_comentario)){
            $op_comentario = 0;
    }

    if($op_comentario == 1)
    {
        $e_comentario = @$_REQUEST['e_comentario'];
        $valor_estado_comentario = $_SESSION['estado_comentario'];
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
                $texto_sql = "SELECT nome_receita, foto, tempo, ingredientes, modo_preparo FROM cad_receitas WHERE nome_receita='$valor_nome_receita_especificada'";
                $result = pg_query($texto_sql);
                $vetor =  pg_fetch_array($result);

                echo "<div>";
                echo "<center><b><a class=\"receita_clicada\" href=\"index.php?paginacentral=receita_especificada.php\">{$vetor["nome_receita"]}</a></b></center>";
                echo "<center><b><img width=\"300px\" height=\"300px\" class=\"img-circle\" src=\"{$vetor["foto"]}\"></b></center><br>";
                echo "<center><b>Tempo de Preparo: {$vetor["tempo"]}";
                echo "</b></center><br>";
                echo "<center><b>Ingredientes:</b><br>";
                $vetor["ingredientes"] = str_replace("\\n", "<br/>", $vetor["ingredientes"]);
                echo $vetor["ingredientes"];
                echo "</center><br><br>";
                echo "<center><b>Modo de Preparo:</b><br>";
                $vetor["modo_preparo"] = str_replace("\\n", "<br/>", $vetor["modo_preparo"]);
                echo $vetor["modo_preparo"];
                echo "</center><br>";
                echo "</div><br>";
                
                //comentarios
                echo "<center><b>Comentários:</b></center>";

                $texto_sql = "SELECT nome_usuario, texto FROM cad_receitas CR INNER JOIN (cad_comentarios CC INNER JOIN cad_usuarios CU ON CC.nome_usuario = CU.nome)
ON CR.codigo_receita = CC.codigo_receita WHERE CR.nome_receita = '$valor_nome_receita_especificada'";
                $result = pg_query($texto_sql);
                $linhas = pg_num_rows($result);

                for ($j = 1; $j <= $linhas; $j++)
                { 		
                    $vet = pg_fetch_array($result);
                    echo "<br>";
                    echo "<center> {$vet["nome_usuario"]}:   {$vet["texto"]} </center>";
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
        if ($valor_estado_comentario == 'logado')
        {
            if (conecta())
            {
                $texto_sql = "SELECT codigo_receita FROM cad_receitas WHERE nome_receita = '$valor_nome_receita_especificada'";
                $result = pg_query($texto_sql);
                $vetor = pg_fetch_array($result);
                $e_codigo_receita = $vetor["codigo_receita"];
                
                $texto_sql = "INSERT INTO cad_comentarios(codigo_receita, texto, nome_usuario) VALUES ('$e_codigo_receita', '$e_comentario' ,'$valor_nome_usuario')";
                $result = pg_query($texto_sql);

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
        else {
            alerta("Usuario tem que estar logado para comentar as receitas");	
            echo "<script language=\"javascript\" type=\"application/javascript\">";
            echo "window.location.replace(\"index.php?paginacentral=entrar.php&estado=naologado\")";
            echo "</script>";
        }
    }
?>