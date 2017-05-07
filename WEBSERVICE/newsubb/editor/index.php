<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Noticias UBB</title>
        <link rel="stylesheet" href="css/materialize.min.css">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    </head>
    <body>
        <?php
        	$date = getdate();
        	define('NEWS_DIR', '../data');
			define('SERVER_URL', "http://" . "$_SERVER[HTTP_HOST]" . "/crialvea/newsubb/");
			$tags = filter_input(INPUT_POST, 'tags');
            $titulo = filter_input(INPUT_POST, 'titulo');
            $fecha = $date['year'] . '-' . $date['mon'] . '-' . $date['mday'];
            $contenido = filter_input(INPUT_POST, 'descripcion');
            $url = filter_input(INPUT_POST, 'url');
            $noticia1 = $titulo.".txt";

			$dir = NEWS_DIR . '/' . $date['year'] . '-' . $date['mon'] . '-' . $date['mday'] . '-' . $date['hours'] . '-' . $date['minutes'] . '-' . $date['seconds'];

			function create_dir($dir, $cpy) {
				if ($cpy > 1)
					$dir .= '-' . $cpy;

				if (!file_exists($dir))
					mkdir($dir, 0700);
				else
					create_dir($dir, $cpy++);
			}

            function escribir($dir, $not, $tit, $dat, $cont, $tags, $url, $image){
            	create_dir($dir, 1);

                    $file = fopen($dir . "/" . $not, "w");
                    fwrite($file, "tags: " . $tags . PHP_EOL);
                    fwrite($file, "title: " .$tit . PHP_EOL);
                    fwrite($file, "date: " .$dat . PHP_EOL);
                    fwrite($file, "description: " .$cont . PHP_EOL);
                    fwrite($file, "thumbnail:" .$image . PHP_EOL);
                    fwrite($file, "url:" .$url . PHP_EOL);
                    fclose($file);


            }
            escribir($dir, $noticia1,$titulo,$fecha, $contenido, $tags, $url, "");

        ?>
        <div class="row">
            <div class="navbar-fixed">
            <nav>
                <div class="nav-wrapper indigo darken-4">
                    <a href="" class="brand-logo center"><img src="img/ubb.png" style=" height: 60%; width: 60% "></a>
                </div>
            </nav>
            </div>
        </div>
        <div class="row">
            <form class="col s6" name="form1" method="post" action="index.php">
            	<div class="row">
                    <div class="input-field col s6">
                        <label for="titulo" class="indigo-text text-darken-4">Tags (separados por coma)</label>
                        <input type="text" id='tags' name="tags">
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s6">
                        <label for="titulo" class="indigo-text text-darken-4">Título</label>
                        <input type="text" id='titulo' name="titulo">
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s6">
                        <label for="titulo" class="indigo-text text-darken-4">Url Noticia</label>
                        <input type="text" id="url" name="url">
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s6">
                        <label for="contenido" class="indigo-text text-darken-4">Contenido</label>
                        <textarea type="text" id='descripcion' name="descripcion" class="materialize-textarea validate"></textarea>
                    </div>
                </div>
                </div>
                <div class="row">
                <div class="col s6">
                    <button class="btn waves-effect indigo accent-2" type="submit" name="enviar" id="enviar" value="enviar">Enviar
                        <i class="material-icons right">send</i>
                    </button>
                </div>
            </div>
            </form>
        </div>
        <div>
            <form action="save.php" method="post" enctype="multipart/form-data">
                <span class="indigo-text text-darken-4">Imagen:</span><input name="fichero" type="file" class="btn waves-effect indigo accent-2">
            <input name="submit" type="submit" value="Subir" class="btn waves-effect indigo accent-2">
        </div>
        <!-- Adjuntando los archivos JS -->
        <script src="js/jquery.min.js"></script>
        <script src="js/materialize.min.js"></script>
    </body>
</html>
