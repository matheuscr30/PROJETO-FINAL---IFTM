<?php
	$op = @$_REQUEST['op'];
	
	if(!isset($op)){
		$op = 0;
	}
	if($op == 1){
		$e_email_entrar        = @$_REQUEST['e_email_entrar'];
		$e_senha_entrar        = @$_REQUEST['e_senha_entrar'];
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
            if ($op == 0)
            {
        ?>

        <form id="form1" name="form1" method="post" action="index.php?paginacentral=entrar.php&op=1">
            <div align="center">
                <table width="400" border="0">
                    <tr>
                        <td colspan="2">
                            <div align="center">
                                <p><strong>ENTRE COM SEU LOGIN:</strong></p>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td width="160"><div align="center">E-mail:</div></td>
                        <td width="224"><label for="e_email_entrar"></label>
                            <div align="center">
                                <input type="text" placeholder="Digite seu e-mail" class="formulario" name="e_email_entrar" id="e_email_entrar" />
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td><div align="center">Senha:</div></td>
                        <td><label for="e_senha_entrar"></label>
                            <div align="center">
                                <input type="password" placeholder="Digite sua senha" maxlength="8" class="formulario" name="e_senha_entrar" id="e_senha_entrar" />
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <div align="center">
                                <p><br/>
                                    <input type="reset" name="botao_limpar" class="btn btn-default" id="botao_limpar" value="Limpar" />          
                                    <input type="submit" name="botao_entrar" class="btn btn-default" id="botao_entrar" value="Entrar" />
                                </p>
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
          
            <div align="center"></div>
            <div align="center"></div>
        </form>

        <?php
            }

            if($op == 1)
            {
                if(conecta()){
                    $texto_sql = "SELECT codigo, nome FROM cad_usuarios WHERE email='{$e_email_entrar}' AND senha='{$e_senha_entrar}'" ;
                    $result = pg_query($texto_sql);
                    $quantidade = pg_num_rows($result);
                    $vetor = pg_fetch_array($result);
                    
                    if($quantidade != 0 ){
                        $_SESSION["nome_usuario"] = $vetor['nome'];
                        $_SESSION['login'] = $e_email_entrar;
                        $_SESSION['senha'] = $e_senha_entrar;
                        echo "<script language=\"javascript\" type=\"application/javascript\">";
                        echo "window.location.replace(\"index.php?paginacentral=home.php\")";
                        echo "</script>";			
                    }
                    else
                    {
                        alerta ("Email ou Senha Incorretos");
                        echo "<script language=\"javascript\" type=\"application/javascript\">";
                        echo "window.location.replace(\"index.php?paginacentral=entrar.php\")";
                        echo "</script>";				
                    }
                }
            }
        ?>
    </body>
</html>