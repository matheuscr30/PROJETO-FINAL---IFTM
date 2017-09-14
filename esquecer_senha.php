<?php
    include 'functions.php';

	$op = @$_REQUEST['op'];
	
	if(!isset($op)){
		$op = 0;
	}

	if($op == 1){
		$e_esquecer_email = @$_REQUEST['e_esquecer_email'];
	}
?>

<form name="form1" method="post" action="index.php?paginacentral=esquecer_senha.php&estado=naologado&op=1">
    <div align="center">
        <table width="400" border="0">
            <tr>
                <td colspan="2"><div align="center"><strong>Digite seu E-mail:</strong></div></td>
            </tr>
            <tr>
                <td width="156"><div align="right">Email:</div></td>
                <td width="234"><label for="e_esquecer_email"></label>
                <input type="text" name="e_esquecer_email" id="e_esquecer_email"></td>
            </tr>
            <tr>
                <td colspan="2">
                    <div align="center">
                        <input name="e_esquecer_validar" type="submit" value="Enviar">
                    </div>
                </td>
            </tr>
        </table>
    </div>
</form>

<?php
    if ($op == 1)
    {
        if (conecta())
        {
            $texto_sql = "SELECT `senha` FROM `cad_usuarios` WHERE email = '$e_esquecer_email'";
            $result = mysql_query($texto_sql);
            $vetor =  mysql_fetch_row($result);

            $emailenviar = $e_esquecer_email;
            $destino = $emailenviar;
            $assunto = ("Sua senha eh:".$vetor[0]);

            // É necessário indicar que o formato do e-mail é html
            $headers  = 'MIME-Version: 1.0' . "\r\n";
                $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
            //$headers .= "Bcc: $EmailPadrao\r\n";

            $enviaremail = mail($destino, $assunto, $headers);
            if($enviaremail){
                alerta("oi");
                $mgm = "E-MAIL ENVIADO COM SUCESSO! <br> O link será enviado para o e-mail fornecido no formulário";
                echo " <meta http-equiv='refresh' content='10;URL=contato.php'>";
            } else {
                $mgm = "ERRO AO ENVIAR E-MAIL!";
                echo "";
            }
        }
    }
?>