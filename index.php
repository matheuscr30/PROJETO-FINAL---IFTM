<?php  
  include "functions.php";
  $paginacentral = @$_REQUEST['paginacentral'];

  session_start();

  if (!isset($paginacentral))
    $paginacentral = 'home.php'; 
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
      
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        
        <!-- Latest compiled JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        
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
