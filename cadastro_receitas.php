<?php
	$op = @$_REQUEST['op'];
	
	if(!isset($op)){
		$op = 0;
	}
	if($op == 1){

		$e_nome_receita        = @$_REQUEST['e_nome_receita'];
		$e_tempo_receita       = @$_REQUEST['e_tempo_receita'];
		$e_ingredientes_receita= @$_REQUEST['e_ingredientes_receita'];
		$e_modo_receita        = @$_REQUEST['e_modo_receita'];
				echo $e_modo_receita;
		$e_imagem_receita      = @$_REQUEST['e_imagem_receita'];
		$e_tipo_receita        = @$_REQUEST['e_tipo_receita'];
		$e_ingredientes_receita = nl2br($e_ingredientes_receita);
	}

    if($op == 1){
        $texto_erro = '';
        $erro = false;

        if($e_nome_receita == ''){
            $texto_erro = $texto_erro.'Nome invalido. Campo em Branco\n';
            $erro = true;
        }
        if (strlen($e_nome_receita) > 100){
            $texto_erro = $texto_erro.'Nome invalido. Mais de 100 caracteres\n';
            $erro = true;
        }
        if($e_tempo_receita == ''){
            $texto_erro = $texto_erro.'Tempo de Receita invalido. Campo em Branco\n';
            $erro = true;
        }	
        if($e_ingredientes_receita == ''){
            $texto_erro = $texto_erro.'Ingredientes invalido. Campo em Branco\n';
            $erro = true;
        }	
        if($e_modo_receita == ''){
            $texto_erro = $texto_erro.'Modo de Preparo invalido. Campo em Branco\n';
            $erro = true;
        }
        if($e_tipo_receita == ''){
            $texto_erro = $texto_erro.'Tipo de Receita invalido. Campo em Branco\n';
            $erro = true;
        }
        if($erro == true){
            alerta($texto_erro);
            $op = 0;
        }
    }
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Cadastro de Receitas</title>
    </head>

    <body>
        <?php
            if ($op == 0)
            {
        ?>
        
        <form action="index.php?paginacentral=cadastro_receitas.php&op=1" method="post" enctype="multipart/form-data" name="form1" id="form1">
            <div align="center">
                <table width="400" border="0">
                    <tr>
                        <td colspan="2"><div align="center"><strong>CADASTRO DE RECEITAS</strong></div></td>
                    </tr>
                    <tr>
                        <td width="183">Nome da Receita:</td>
                        <td width="201"><label for="e_nome_receita"></label>
                            <input type="text" name="e_nome_receita" id="e_nome_receita" />
                        </td>
                    </tr>
                    <tr>
                        <td>Tempo de Preparo:</td>
                        <td><label for="e_tempo_receita"></label>
                            <input type="text" name="e_tempo_receita" id="e_tempo_receita" />
                        </td>
                    </tr>
                    <tr>
                        <td>Ingredientes:</td>
                        <td>
                            <label for="e_ingredientes_receitas"></label>
                            <label for="e_ingredientes_receita"></label>
                            <textarea name="e_ingredientes_receita" id="e_ingredientes_receita" cols="45" rows="5"></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>Modo de Preparo:</td>
                        <td>
                            <label for="e_modo_receitas"></label>
                            <label for="e_modo_receita"></label>
                            <textarea name="e_modo_receita"  id="e_modo_receita" cols="45" rows="5"></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>Tipo de Receita:</td>
                        <td>
                            <label for="e_tipo_receita"></label>
                            <label for="e_tipo_receita"></label>
                            <textarea name="e_tipo_receita" id="e_tipo_receita" cols="45" rows="5"></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>Imagem:</td>
                        <td>
                            <label for="e_imagem_receita"></label>
                            <textarea name="e_imagem_receita" id="e_imagem_receita" cols="45" rows="5"></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">    
                            <div align="center">
                                <input type="reset" name="botao_limpar_receita" id="botao_limpar_receita" class="btn btn-default" value="Limpar" />   
                                <input type="submit" name="botao_enviar_receita" id="botao_enviar_receita" class="btn btn-default" value="Cadastrar"/>
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
            <div align="center"></div>
        </form>
        
        <?php
            }

            if($op == 1 && conecta()){
                $texto_sql = "INSERT INTO cad_receitas(codigo_receita, nome_receita, tempo, ingredientes, modo_preparo, foto, tipo_receita ) VALUES (null, '$e_nome_receita', '$e_tempo_receita' ,'$e_ingredientes_receita', '$e_modo_receita', '$e_imagem_receita', '$e_tipo_receita')";
                $result = pg_query($texto_sql);

                if($result > 0)
                {
                    alerta("Dados inseridos");
                    echo "<script language=\"javascript\" type=\"application/javascript\">";
                    echo "window.location.replace(\"index.php?paginacentral=cadastro_receitas.php\")";
                    echo "</script>";
                }
                else
                {
                    alerta("Dados não inseridos");
                    echo "<script language=\"javascript\" type=\"application/javascript\">";
                    echo "window.location.replace(\"index.php?paginacentral=cadastro_receitas.php\")";
                    echo "</script>";
                }
            }	
        ?>
    </body>
</html>