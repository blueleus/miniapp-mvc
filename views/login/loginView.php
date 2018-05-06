<div class="container">
    <div class="row">
        <div class="col-4 col-md-4">
            <br>
            <h5>Login de usuarios</h5>
            <hr />
            <h6><?php echo isset($mensaje) ? $mensaje : ""; ?></h6>
            <form action="<?php echo Helper::getUrl("login", "login", array()); ?>" method="post" >

                <div class="form-group">
                    <label for="email">Email:</label><br>
                    <input class="form-control" name="email" type="text" id="email" required>
                </div>

                <div class="form-group">
                    <label>Password:</label><br>
                    <input class="form-control" name="password" type="password" id="password" required>
                </div>

                <input class="btn btn-primary" type="submit" name="Submit" value="Login">

            </form>
            <br>
            <div>
                No estas registrado?, <a href="<?php echo Helper::getUrl('usuarios', 'crear', array()); ?>">hazlo ya!</a>
            </div>
        </div>
    </div>
</div>