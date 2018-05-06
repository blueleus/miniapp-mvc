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
      <input type="text" name="nombre" value="<?php echo isset($datos['nombre'])? $datos['nombre'] : ""; ?>">
      <br>
      Email:<br>
      <input type="text" name="email" value="<?php echo isset($datos['email'])? $datos['email'] : ""; ?>">
      <br>
      C&eacute;dula:<br>
      <input type="text" name="cedula" value="<?php echo isset($datos['cedula'])? $datos['cedula'] : ""; ?>">
      <br>
      Estado:<br>
      <input type="text" name="estado" value="<?php echo isset($datos['estado'])? $datos['estado'] : ""; ?>">
      <br>
      Password:<br>
      <input type="text" name="password" value="<?php echo isset($datos['password'])? $datos['password'] : ""; ?>">
      <br><br>
      <?php 
      echo "<select name='roles[]' multiple>";
      foreach ($roles as $value) {
        echo "<option value='".$value->getId()."'>".$value->getNombre()."</option>";
      }
      echo "</select>";
      ?>
      <br><br>
      Imagen de perfil:<br>
      <input type="file" name="imagen" value="<?php echo isset($datos['imagen'])? $datos['imagen'] : ""; ?>">
      <br><br>
      <input type="submit" value="Crear">
    </form>
    <div>
        <br><br>
        <a href="<?php echo Helper::getUrl("usuarios", "listar", array()); ?>">Volver a la lista.</a>
    </div>
</body>
</html>