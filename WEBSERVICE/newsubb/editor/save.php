<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
            $ruta="./imagenes/";//ruta carpeta donde queremos copiar las imágenes 
            $uploadfile_temporal=$_FILES['fichero']['tmp_name']; 
            $uploadfile_nombre=$ruta.$_FILES['fichero']['name']; 
            $directorio=opendir("imagenes/"); 
            function guardar_imagen($temporal,$nombre,$dir) {
                if (is_uploaded_file($temporal)) 
                { 
                    move_uploaded_file($temporal,$nombre); 
                } 
                else 
                { 
                    echo "error"; 
                } 
                
                while($ficheros=readdir($dir)) 
                { 
                    $url="imagenes/".$ficheros; 
                    /*echo "<img src=".$url.">";*/ 
                } 
            }
            guardar_imagen($uploadfile_temporal, $uploadfile_nombre, $directorio);
        ?>
    </body>
</html>
