<div class="container-fluid">
	<div class="card" style="width: 18rem;">
		<div class="card-body">
			<h5 class="card-title">Acceso restringido</h5>
			<p class="card-text">Esta pagina es solo para usuarios registrados.</p>
			<a class="btn btn-primary" href="<?php echo Helper::getUrl("login", "login", array()); ?>">Login</a>
			<a class="btn btn-primary" href="<?php echo Helper::getUrl("usuarios", "crear", array()); ?>">Registrarme</a>
		</div>
	</div>
</div><div class="container-fluid">

    Esta pagina es solo para usuarios registrados.<br>
    <br><a href="<?php echo Helper::getUrl("login", "login", array()); ?>">Login</a>
    <br><br><a href="<?php echo Helper::getUrl("usuarios", "crear", array()); ?>">Registrarme</a>

</div>