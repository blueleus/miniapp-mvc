<?php include_once dirname(__FILE__)."/../../lib/php/Helper.php" ?>

<!DOCTYPE html>
<html>
<head>
	<title>Crear Usuarios</title>
</head>
<body>
<h1><?php echo isset($mensaje) ? $mensaje : ""; ?></h1> 
<form action="<?php echo Helper::getUrl("usuarios", "crear", array()); ?>" method="post" enctype="multipart/form-data">
  Nombre:<br>
  <input type="text" name="nombre" value="">
  <br>
  Email:<br>
  <input type="text" name="email" value="">
  <br>
  Cedula:<br>
  <input type="text" name="cedula" value="">
  <br>
  Estado:<br>
  <input type="text" name="estado" value="">
  <br>
  Password:<br>
  <input type="text" name="password" value="">
  <br>
  Imagen de perfil:<br>
  <input type="file" name="imagen" value="">
  <br><br>
  <input type="submit" value="Crear">
</form> 
</body>
</html>