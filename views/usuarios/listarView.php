<div class="container">
    <div class="row">
        <div class="col-12 col-md-12">
            <h4><?php echo isset($mensaje) ? $mensaje : ""; ?></h4>
            <div class="container_options">
                <a class="btn btn-primary" href="<?php echo Helper::getUrl("usuarios", "crear", array()); ?>">Crear usuario.</a>
            </div>
            <br>
            <div class="container_table">
                <table id="users_table">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Email</th>
                            <th>C&eacute;dula</th>
                            <th>Estado</th>
                            <th>Imagen</th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">

    $( document ).ready(function() {
        cargarUsuarios(1);
    });

    function cargarUsuarios(pagina) {
        $.ajax({
            data:  {"pagina" : pagina},
            url:   'http://localhost/nexura/index.php?mod=usuarios&fun=listar_paginado',
            type:  'GET',
            dataType: 'json',
            beforeSend: function () {
                console.log("Procesando, espere por favor...");
            },
            success:  function (response) {
                console.log(response);
                //var num_total_registros = response.num_total_registros;
                //var pagina = response.pagina;
                //var total_paginas = response.total_paginas;
                var data = response.data;

                var tablebody = ""; 
                $.each(data, function(index, val) {
                    tablebody += "<tr>";
                    tablebody += "<td>" + val.nombre + "</td>";
                    tablebody += "<td>" + val.email + "</td>";
                    tablebody += "<td>" + val.cedula + "</td>";
                    tablebody += "<td>" + val.estado + "</td>";
                    tablebody += "<td><img src='http://localhost/nexura/web/upload/" + val.email +".jpg' border='1' width='100' height='100'></td>";
                    tablebody += "<td><a class='btn btn-secondary' href='http://localhost/nexura/index.php?mod=usuarios&fun=editar&id=" + val.id + "'>Editar.</a></td>";
                    tablebody += "<td><a class='btn btn-danger' href='http://localhost/nexura/index.php?mod=usuarios&fun=eliminar&id=" + val.id + "'>Eliminar.</a></td>";
                    tablebody += "<td><a class='btn btn-info' href='http://localhost/nexura/index.php?mod=usuarios&fun=buscar&id=" + val.id + "'>Ver.</a></td>";
                    tablebody += "</tr>";
                });

                $("#users_table tbody").html(tablebody);
            }
        });
    }
</script>