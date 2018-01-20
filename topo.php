<?php
    $nome_usuario = $_SESSION["nome_usuario"];
    if ( !isset($_SESSION['login']) and !isset($_SESSION['senha']) )
        $estado = 'naologado';
    else
        $estado = 'logado';
    
    function verifica_estado_topo($estado)
    {
        if($nome_usuario != ''){
            echo "<script language=\"javascript\" type=\"application/javascript\">";
            echo "window.location.replace(\"index.php?paginacentral=tipo_receita.php\")";
            echo "</script>";				
        } 
        else {
            echo "<script language=\"javascript\" type=\"application/javascript\">";
            echo "window.location.replace(\"index.php?paginacentral=tipo_receita.php\")";
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
                        echo "<a href=\"index.php?paginacentral=home.php\"><img src=\"imagens/as-minhas-receitas.png\"></img></a>";
                    ?>            
                </li>
          
                <li class="meio">
                    <form action="" method="post">
                        <div align="center">
                            <input name="e_nome_receita" type="text" placeholder="Digite o nome da receita:" />
                                <?php
                                    echo "<input name=\"botao_buscar\" class=\"btn btn-default btn-sm\" formaction=\"index.php?paginacentral=home.php&op_buscar=1\" type=\"submit\" value=\"Buscar\" />";
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
                if($estado == 'logado'){
                    
                 //   session_start();
                    $nome_usuario = $_SESSION["nome_usuario"];
                //    session_write_close();
                    
                    echo "<ul class=\"pull-right\" >";
                    echo "<li>Bem Vindo, $nome_usuario</li>";
                    echo "<li><form action=\"\" method=\"post\">";
                    echo "<input name=\"botao_sair\" class=\"btn btn-danger btn-sm\" formaction=\"index.php?paginacentral=home.php&op_estado=1\" type=\"submit\" value=\"Sair\">";
                    
                    if($nome_usuario == 'Matheus'){
                        echo "<li><input name=\"botao_cadastrar_receita\" class=\"btn btn-default btn-sm\" formaction=\"index.php?paginacentral=cadastro_receitas.php&opestado=1\" type=\"submit\" value=\"Cadastrar Receitas\"></li>";
                    }
                    
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
                    
                    <input name="botao_bolos_tortas"  class="btn btn-primary" formaction="index.php?op_tipo_receita=1&e_tipo_receita=1" type="submit" value="Bolos e Tortas" />
                    &nbsp;
                    <input name="botao_carnes_peixes" class="btn btn-success" formaction="index.php?op_tipo_receita=1&e_tipo_receita=2" type="submit" value="Carnes e Peixes" />
                    &nbsp;
                    <input name="botao_bebidas" class="btn btn-info" formaction="index.php?op_tipo_receita=1&e_tipo_receita=3" type="submit" value="Bebidas" />
                    &nbsp;
                    <input name="botao_sopas" class="btn btn-warning" formaction="index.php?op_tipo_receita=1&e_tipo_receita=4" type="submit" value="Sopas" />
                    &nbsp;
                    <input name="botao_doces_sobremesas" class="btn btn-danger" formaction="index.php?op_tipo_receita=1&e_tipo_receita=5" type="submit" value="Doces e Sobremesas" />
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
        $_SESSION["buscar_receita"] = $e_nome_receita;
        
        echo "<script language=\"javascript\" type=\"application/javascript\">";
        echo "window.location.replace(\"index.php?paginacentral=buscar.php\")";
        echo "</script>";			
    }

    if($op_tipo_receita == 1){	
        $e_tipo_receita    = @$_REQUEST['e_tipo_receita'];

        if($e_tipo_receita == 1){
                $_SESSION["tipo_receita"] = 'bolos e tortas';
                verifica_estado_topo($estado);
        }
        elseif($e_tipo_receita == 2){
                $_SESSION["tipo_receita"] = 'carnes e peixes';
                verifica_estado_topo($estado);
        }
        elseif($e_tipo_receita == 3){
                $_SESSION["tipo_receita"] = 'bebidas';
                verifica_estado_topo($estado);
        }
        elseif($e_tipo_receita == 4){
                $_SESSION["tipo_receita"] = 'sopas';
                verifica_estado_topo($estado);
        }
        elseif($e_tipo_receita == 5){
                $_SESSION["tipo_receita"] = 'doces e sobremesas';
                verifica_estado_topo($estado);
        }
    }

    if ($op_estado == 1){
        $_SESSION["nome_usuario"] = '';
        unset($_SESSION['login']);
	    unset($_SESSION['senha']);
        echo "<script language=\"javascript\" type=\"application/javascript\">";
        echo "window.location.replace(\"index.php?paginacentral=home.php\")";	
        echo "</script>";
    }
?>