<?php
    function alerta($mensagem){
        echo "<script language=\"javascript\">";
        echo "alert(\"$mensagem\");";
        echo "</script>";
    }

    function conecta(){
        $host         = "localhost";
        $usuario      = "postgres";
        $senha        = "********";
        $bancodedados = "info_mcr";

        $servidor = pg_connect($host, $usuario, $senha);
        alerta("lelele");

            if($servidor){
                alerta("conexao com o servidor ok");
                $db = mysql_select_db($bancodedados, $servidor);
                if($db){
                    alerta ("conexao OK");
                }else{
                    alerta ("conexao OFF");
                }
                return true;
            }else{
                alerta("conexao com o servidor falha");		
            }
    }

    function validar_email($email) { 
        $pattern = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/i";

        if (preg_match($pattern, $email)){
            return true; 
        }else {
            return false;
        }
    } 


    function validar_cpf($cpf)
    {
        if (strlen($cpf) != 11 || 	
            $cpf == '00000000000' || 
            $cpf == '11111111111' || 
            $cpf == '22222222222' || 
            $cpf == '33333333333' || 
            $cpf == '44444444444' || 
            $cpf == '55555555555' || 
            $cpf == '66666666666' || 
            $cpf == '77777777777' || 
            $cpf == '88888888888' || 
            $cpf == '99999999999')
        {
            return false;
        }
        else
        {   // Calcula os números para verificar se o CPF é verdadeiro
            for ($t = 9; $t < 11; $t++) {
                for ($d = 0, $c = 0; $c < $t; $c++) {
                    $d += $cpf{$c} * (($t + 1) - $c);
                }

                $d = ((10 * $d) % 11) % 10;

                if ($cpf{$c} != $d) {
                    return false;
                }
            }

            return true;
        }
    }
?>