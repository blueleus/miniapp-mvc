<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Ver usuario</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>

</head>
<body>
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
</body>
</html>