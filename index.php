<?php  
  $paginacentral = @$_REQUEST['paginacentral'];
  $estado        = @$_REQUEST['estado'];

  if (!isset($paginacentral))
    $paginacentral = 'home.php'; 
	
  if (!isset($estado))
  	$estado = 'naologado';
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
        
        <title>Receitas do Bielzinho</title>
    </head>

    <body>
        <table width="100%" border="1" class="panel-default">
            <?php
                include 'topo.php';
            ?>
            <tr>
                <td colspan="3"><p>&nbsp;</p>
                    <?php
		              include $paginacentral;
                    ?>
        
                </td>
            </tr>
        </table>
    </body>
</html>
