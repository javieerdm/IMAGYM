<!doctype html>
<html lang="es">
	<head>
		<meta charset="UTF-8">
		<title>Detalles de los productos</title>
		<link rel="stylesheet" href="principal.css">
		<link rel="stylesheet" href="detalles.css">
		
	</head>	
	<body>
		<div id="body">		
		
			<?php include('cabecera.php');?>
			
			<section>	
				<div id="articulos">
				
					<!--izquierda-->
					<?php //include('navegador.php');?>
					
					
					<div id="derecha">
					<h6 class="volver"><a href="javascript:history.go(-1)"><img title="Volver atrás" src="imagenes/volver.jpg"></img></a></h6>
							
						<?php
						
							$ProductoID=$_GET["ProductoID"];
								
							$consultadetalles="SELECT * FROM productos WHERE ID='$ProductoID'";
							$resultadodetalles=mysqli_query($conexion, $consultadetalles);
							
							
							while ($registrodetalles=mysqli_fetch_row($resultadodetalles)){?>					
						
						<div id="producto">
							<div id="producto1">							
								<br>
								<!--Muestra la referencia del articulo-->	
								<div class="referencia">ID<?php echo " " . $registrodetalles[0];?></div>
								<br><br>

								<!--Muestra la imagen del articulo-->
								<div id="prenda"><img src="<?php echo $registrodetalles[2];?>"></img></div>
							</div>
							
							<div id="detalles">
							
								<!--Muestra el nombre del articulo-->
								<p id="art"><b><?php echo $registrodetalles[1];?></b></p>
								
								<!--Muestra el precio del articulo-->
								
								<p id="precio"><b>Precio: <?php echo $registrodetalles[3] . " €";?></b></p>
								
								
								<button id="comprar" type="submit">
								<form method='POST' action='<?php echo isset($_SESSION['cliente']) ? "./añadir-cesta.php?ProductoID=" . $registrodetalles[0] : "registro.php"; ?>' target='_self'>
   							 <label>Cantidad</label>
    							<input type='number' name='cantidad' min='<?php echo ($registrodetalles[4] > 0) ? "1" : "0"; ?>' max='<?php echo $registrodetalles[4]; ?>' value='<?php echo ($registrodetalles[4] > 0) ? "1" : "0"; ?>' />
    
									<!-- Sección de tallas -->
									<?php
									$consultaTallas = "SELECT Talla FROM Tallas INNER JOIN ProductoTallas ON Tallas.ID = ProductoTallas.TallaID WHERE ProductoTallas.ProductoID = $ProductoID";
									$resultadoTallas = mysqli_query($conexion, $consultaTallas);

									if (mysqli_num_rows($resultadoTallas) > 0) { // Comprueba si hay tallas disponibles
										echo "<label for='talla'>Talla:</label>";
										echo "<select name='talla' id='talla'>";
										while ($talla = mysqli_fetch_assoc($resultadoTallas)) {
											echo "<option value='{$talla['Talla']}'>{$talla['Talla']}</option>";
										}
										echo "</select>";
									}
									?>

									<input type="submit" id="boton" value="COMPRAR">
								</form>


							</div>
							<br><br>	
						</div>											
						<?php } ?>
					</div>
				</div>	
			</section>
			
			<?php include('pie.php');?>	
		</div>
	</body>
</html>