<!DOCTYPE html>
<html>
	<head>
		<title>Cartelera Clasica</title>
		<meta charset="UTF-8">
		<link rel="stylesheet" href="estilos.css">
		<script src="funciones.js"></script>
	</head>
	<body>
		<?php 
		$pelis = simplexml_load_file('data/peliculas.xml');
		?>
		<div id="cabecera">
			<a href="index.php"><img class="logo" src="imagenes/logo.jpg"></a>

			<div class="buscador">
				<input onkeydown="buscar(this);"  list="pelis" placeholder="Buscador" type="text">
				<datalist id="pelis">
				<?php
					foreach($pelis -> pelicula as $peli){
						echo '<option value="'.$peli->nombre.'">';
					}
				?>
				</datalist>
                <br><br>
                <input type="button" value="Añadir película" onclick="window.location.replace('nueva.php');"/>
			</div>
		</div>
        <br>
		<?php
		

		foreach($pelis -> pelicula as $peli){?>
			<div style="float:left;margin-bottom: 1%;">
				<img class="imagen" src="<?=$peli->imagen;?>">
				<div>
					<h1><a href="pelicula.php?id=<?=$peli['id']?>"><?=$peli->nombre;?></a></h1>
					<p>
						<?=$peli->descripcion;?>
					</p>
					<?php
					$reviews = simplexml_load_file('data/criticas.xml');
					$cont=0;
					$score=0;
					foreach($reviews-> review as $review){
						if(intval($review['idpeli'])==intval($peli['id'])){
							$cont=$cont+1;
							$score=$review->puntuacion+$score;
						}
					}
					?>
					Puntuación: 
					<?php if ($cont==0){echo 'no hay reviews';} else {echo $score/$cont;}?>
				</div>
			</div>
		<?php
		}
		?>

	</body>
</html>
