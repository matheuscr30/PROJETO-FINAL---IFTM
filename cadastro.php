<?php
    include 'functions.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Cadastro de Usuarios</title>
    </head>

    <?php
        
        $op = @$_REQUEST['op'];

        if(!isset($op)){
            $op = 0;
        }
        if($op == 1){
            $e_nome        = @$_REQUEST['e_nome'];
            $e_cpf         = @$_REQUEST['e_cpf'];
            $e_email       = @$_REQUEST['e_email'];
            $e_senha       = @$_REQUEST['e_senha'];
            $e_contrasenha = @$_REQUEST['e_contrasenha'];
        }

        //Vê se tem algum erro
        if($op == 1){
            
            $texto_erro = '';
            $erro = false;

            if($e_nome == ''){
                $texto_erro = $texto_erro.'Nome invalido. Campo em Branco\n';
                $erro = true;
            }
            
            if(validar_email($e_email) == 0){
                $texto_erro = $texto_erro.'E-mail invalido.\n';
                $erro = true;
            }
            
            alerta("lululu");
            if(conecta()){
                alerta("lalalala");    
                $email = $e_email;
                $texto_sql = "SELECT * FROM cad_usuarios WHERE email='$e_email'";
                $result = mysql_query($texto_sql);
                $quantidade = @mysql_num_rows($result);
                if($quantidade != 0 ){
                    $texto_erro = $texto_erro.("E-mail já cadastrado\n");
                    $erro = true;
                }
            }

            if(conecta()){

                $cpf = $e_cpf;
                $texto_sql = "SELECT * FROM cad_usuarios WHERE cpf='$e_cpf'";
                $result = mysql_query($texto_sql);
                $quantidade = @mysql_num_rows($result);
                if($quantidade != 0 ){
                    $texto_erro = $texto_erro.("CPF já cadastrado\n");
                    $erro = true;
                }
            }
            if(validar_cpf($e_cpf) == 0){
                $texto_erro = $texto_erro.'CPF invalido.\n';
                $erro = true;
            }
            if($e_senha == '')
            {
                $texto_erro = $texto_erro.'Senha em Branco.\n';
                $erro = true;	
            }
            if(strlen($e_senha) > 8)
            {
                $texto_erro = $texto_erro.'Senha Invalida. Digite uma senha com menos de 9 digitos\n';
                $erro = true;	
            }
            if($e_senha != $e_contrasenha)
            {
                $texto_erro = $texto_erro.'Senha diferente da Contra-Senha.\n';
                $erro = true;	
            }

            if($erro == true){
                alerta($texto_erro);
                $op = 0;
            }

        }
    ?>

    <body>
        <?php
            if($op == 0){
        ?>
        
        <form id="form_cadastro" name="form_cadastro" method="post" action="index.php?paginacentral=cadastro.php&op=1">
            <div  align="center">
                <table width="500" border="0">
                    <tr>
                        <td colspan="2"><div align="center"><p><strong>CADASTRO DE USUARIOS</strong></p></div></td>
                    </tr>
                    <tr>
                        <td><div align="center">Nome:</div></td>
                        <td><label for="e_nome"></label>
                            <input type="text" name="e_nome" class="formulario" id="e_nome" />
                        </td>
                    </tr>
                    <tr>
                        <td><div align="center">CPF:</div></td>
                        <td><label for="e_cpf"></label>
                            <input type="text" name="e_cpf" class="formulario"  id="e_cpf" />
                        </td>
                    </tr>
                    <tr>
                        <td><div align="center">Email:</div></td>
                        <td><label for="e_email"></label>
                            <input type="text" name="e_email" class="formulario" id="e_email" />
                        </td>
                    </tr>
                    <tr>
                        <td><div align="center">Senha:</div></td>
                        <td><label for="e_senha"></label>
                            <input type="password" name="e_senha" class="formulario" maxlength="8" id="e_senha" />
                        </td>
                    </tr>
                    <tr>
                        <td><div align="center">Contra-Senha:</div></td>
                        <td>
                            <label for="e_contrasenha"></label>
                            <input type="password" name="e_contrasenha" maxlength="8" class="formulario" id="e_contrasenha" />
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <div align="center"><br/>
                                <input type="submit" name="botao_validar" class="btn btn-default"  id="botao_validar" value="Cadastrar" />
                                <input type="reset" name="botao_limpar" class="btn btn-default"  id="botao_limpar" value="Limpar" />
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

            if($op == 1){
            //Se op = 1, ou seja se for enviado os valores do formulario, ele pega e insere no banco de dado

                $texto_sql = "INSERT INTO `cad_usuarios`(`codigo`, `nome`, `email`, `cpf`, `senha`) VALUES (null, '$e_nome', '$e_email' ,'$e_cpf', '$e_senha')";
                $result = mysql_query($texto_sql);

                if($result > 0){
                    alerta("Usuario Cadastrado");
                    echo "<script language=\"javascript\" type=\"application/javascript\">";
                    echo "window.location.replace(\"index.php?paginacentral=home.php&estado=naologado\")";
                    echo "</script>";		
                }

                else{
                    alerta("Usuario Não Cadastrado");
                    echo "<script language=\"javascript\" type=\"application/javascript\">";
                    echo "window.location.replace(\"index.php?paginacentral=cadastro.php\")";
                    echo "</script>";			
                }
            }
        ?>
    </body>
</html>