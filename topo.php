<?php
    function verifica_estado_topo($estado)
    {	
        $valor_cookie_nome_usuario = @$_COOKIE['cookie_nome_usuario'];		
        if($valor_cookie_nome_usuario != ''){
            echo "<script language=\"javascript\" type=\"application/javascript\">";
            echo "window.location.replace(\"index.php?paginacentral=tipo_receita.php&estado=logado\")";
            echo "</script>";				
        } 
        else {
            echo "<script language=\"javascript\" type=\"application/javascript\">";
            echo "window.location.replace(\"index.php?paginacentral=tipo_receita.php&estado=naologado\")";
            echo "</script>";				
        }
    }
	
	$op_estado       = @$_REQUEST['op_estado'];
	$op_buscar       = @$_REQUEST['op_buscar'];
	$op_tipo_receita = @$_REQUEST['op_tipo_receita'];
	
	//Tipos de Receita
	//1 - Bolos e Tortas
	//2 - Carnes e Peixes
	//3 - Bebidas
	//4 - Sopas
	//5 - Doces e Sobremesas
	
	if(!isset($op_buscar)){
		$op_buscar = 0;
	}
	if($op_buscar == 1){
		$e_nome_receita    = @$_REQUEST['e_nome_receita'];
	}
	
	if(!isset($op_tipo_receita)){
		$op_tipo_receita = 0;
	}
	if($op_buscar == 1){
		$e_tipo_receita    = @$_REQUEST['e_tipo_receita'];
	}
?>

<?php
    if ($op_buscar == 0 || $op_estado == 0)
    {
?>

<div class="fundo_topo">
    <div class="nav fundo">
        <div class="container">
            <ul class="pull-left">
                <li class="esquerda">
                    <?php
                        echo "<a href=\"index.php?paginacentral=home.php&estado=$estado\"><img src=\"imagens/as-minhas-receitas.png\"></img></a>";
                    ?>            
                </li>
          
                <li class="meio">
                    <form action="" method="post">
                        <div align="center">
                            <input name="e_nome_receita" type="text" placeholder="Digite o nome da receita:" />
                                <?php
                                    echo "<input name=\"botao_buscar\" class=\"btn btn-default btn-sm\" formaction=\"index.php?paginacentral=home.php&estado=$estado&op_buscar=1\" type=\"submit\" value=\"Buscar\" />";
                                ?>
                        </div>
                        <br/>
                    </form>        
               </li>
            </ul>
            <?php
                if ($estado == 'naologado'){		
            ?>
            
            <ul class="pull-right">
                <li>
                    <form action="" method="post">
                        <input name="botao_cadastrar" class="btn btn-default"  formaction="index.php?paginacentral=cadastro.php"	type="submit" value="Cadastre-se" />

                        <input name="botao_entrar" type="submit" class="btn btn-default" formaction="index.php?paginacentral=entrar.php" value="Entrar" />
                    </form>
                </li>
            </ul>
            
            <?php
                }
            ?>
        
            <?php
                @$valor_cookie_nome_usuario = $_COOKIE['cookie_nome_usuario'];
                if ($estado == 'logado' && $valor_cookie_nome_usuario != 'Matheus'){
                    echo "<ul class=\"pull-right\" >";
                    echo "<li>Bem Vindo, $valor_cookie_nome_usuario</li>";
                    echo "<li><form action=\"\" method=\"post\">";
                    echo "<input name=\"botao_sair\" class=\"btn btn-default btn-sm\" formaction=\"index.php?paginacentral=home.php&estado=naologado&op_estado=1\" type=\"submit\" value=\"Sair\">";
                    echo "</form></li>";
                    echo "</ul>";
                }

                if ($estado == 'logado' && $valor_cookie_nome_usuario == 'Matheus'){    		
                    echo "<ul class=\"pull-right\" >";
                    echo "<li>Bem Vindo, $valor_cookie_nome_usuario</li>";
                    echo "<li><form action=\"\" method=\"post\">";
                    echo "<input name=\"botao_sair\" class=\"btn btn-default btn-sm\" formaction=\"index.php?paginacentral=home.php&estado=naologado&op_estado=1\" type=\"submit\" value=\"Sair\">";
                    echo "<li><input name=\"botao_cadastrar_receita\" class=\"btn btn-default btn-sm\" formaction=\"index.php?paginacentral=cadastro_receitas.php&estado=logado&opestado=1\" type=\"submit\" value=\"Cadastrar Receitas\"></li>";
                    echo "</form></li>";
                    echo "</ul>";
                }		
            ?>
        </div>
    </div>

    <tr>
        <td colspan="3" class="bots">
            <p></p>
            <form action=""  method="post">
                <div align="center" >
                    
                    <input name="botao_bolos_tortas"  class="btn btn-primary" formaction="index.php?estado=<?php echo $estado; ?>&op_tipo_receita=1&e_tipo_receita=1" type="submit" value="Bolos e Tortas" />
                    &nbsp;
                    <input name="botao_carnes_peixes" class="btn btn-success" formaction="index.php?estado=<?php echo $estado; ?>&op_tipo_receita=1&e_tipo_receita=2" type="submit" value="Carnes e Peixes" />
                    &nbsp;
                    <input name="botao_bebidas" class="btn btn-info" formaction="index.php?estado=<?php echo $estado; ?>&op_tipo_receita=1&e_tipo_receita=3" type="submit" value="Bebidas" />
                    &nbsp;
                    <input name="botao_sopas" class="btn btn-warning" formaction="index.php?estado=<?php echo $estado; ?>&op_tipo_receita=1&e_tipo_receita=4" type="submit" value="Sopas" />
                    &nbsp;
                    <input name="botao_doces_sobremesas" class="btn btn-danger" formaction="index.php?estado=<?php echo $estado; ?>&op_tipo_receita=1&e_tipo_receita=5" type="submit" value="Doces e Sobremesas" />
                    &nbsp;
                    
                </div>
            </form>
            <p></p>
        </td>
    </tr>
</div>

<?php
    } //Fechando o op_buscar_receita == o lá de cima

    if($op_buscar == 1){
        setcookie('cookie_buscar_receita', $e_nome_receita);

        $valor_cookie_nome_usuario = $_COOKIE['cookie_nome_usuario'];

        echo "<script language=\"javascript\" type=\"application/javascript\">";
        echo "window.location.replace(\"index.php?paginacentral=buscar.php&estado=$estado\")";
        echo "</script>";			
    }

    if($op_tipo_receita == 1){	
        $e_tipo_receita    = @$_REQUEST['e_tipo_receita'];
        $valor_cookie_nome_usuario = @$_COOKIE['cookie_nome_usuario'];

        if($e_tipo_receita == 1){
                setcookie('cookie_tipo_receita', 'bolos e tortas');
                $valor_cookie_tipo_receita = $_COOKIE['cookie_tipo_receita'];
                verifica_estado_topo($estado);
        }
        elseif($e_tipo_receita == 2){
                setcookie('cookie_tipo_receita', 'carnes e peixes');
                verifica_estado_topo($estado);
        }
        elseif($e_tipo_receita == 3){
                setcookie('cookie_tipo_receita', 'bebidas');
                verifica_estado_topo($estado);
        }
        elseif($e_tipo_receita == 4){
                setcookie('cookie_tipo_receita', 'sopas');
                verifica_estado_topo($estado);
        }
        elseif($e_tipo_receita == 5){
                setcookie('cookie_tipo_receita', 'doces e sobremesas');
                verifica_estado_topo($estado);
        }
    }

    if ($op_estado == 1){
        setcookie('cookie_nome_usuario','');	
        echo "<script language=\"javascript\" type=\"application/javascript\">";
        echo "window.location.replace(\"index.php?paginacentral=home.php&estado=naologado\")";	
        echo "</script>";
    }
?>