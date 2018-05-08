<div class="container">
    <div class="row">
        <div class="col-12 col-md-12">
            <h4><?php echo isset($mensaje) ? $mensaje : ""; ?></h4>
            <div class="container_options row">
                <div class="col-md-4">
                    <a class="btn btn-primary btn-lg btn-block" href="<?php echo Helper::getUrl("usuarios", "crear", array()); ?>"><span class="glyphicon glyphicon-plus"></span>Crear usuario.</a>
                </div>

                <div class="col-md-4">
                    <a class="btn btn-secondary btn-lg btn-block" href="<?php echo Helper::getUrl("usuarios", "reportes", array()); ?>"><span class="glyphicon glyphicon-picture"></span>Reportes</a>
                </div>
            </div>
            <br>
            <div class="container_table table-responsive-lg">
                <table id="users_table" class="table table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th></th>
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
            <br>
            <div>
                <span id="pagina"></span>/<span id="total_paginas" ></span>
                <nav aria-label="...">
                    <ul class="pagination">
                        <li class="page-item">
                            <a class="page-link" id="bt-previoues" href="#" tabindex="-1">Previous</a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" id="bt-next" href="#">Next</a>
                        </li>
                    </ul>
                </nav>                
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $( document ).ready(function() {

        cargarUsuarios(1);
        inicializarListeners();

    });

    function inicializarListeners() {
        $.ajax({
            url:   'http://localhost/nexura/index.php?mod=usuarios&fun=informacion_paginado',
            type:  'GET',
            dataType: 'json',
            beforeSend: function () {
                console.log("Procesando, espere por favor...");
            },
            success:  function (response) {
                console.log(response);
                //var num_total_registros = response.num_total_registros;
                var num_total_registros = parseInt(response.num_total_registros);
                var total_paginas = parseInt(response.total_paginas);
                var pagina_actual = 1;

                $("#bt-next").on( "click", function() {
                    if (pagina_actual + 1 <= total_paginas ) {
                        pagina_actual += 1;
                        console.log(pagina_actual);
                        cargarUsuarios(pagina_actual);
                    } else {
                        alert("No hay más paginas.");
                        console.log("No hay más paginas.");
                    }
                });

                $("#bt-previoues").on( "click", function() {
                    if (pagina_actual - 1 > 0 ) {
                        pagina_actual -= 1;
                        console.log(pagina_actual);
                        cargarUsuarios(pagina_actual);
                    } else {
                        alert("No hay menos paginas.");
                        console.log("No hay menos paginas.");
                    }
                });
            }
        });
    }

    /*
    Averigua si existe o no un archivo en la url especifica.
    */
    function existeUrl(url) {
        var http = new XMLHttpRequest();
        http.open('HEAD', url, false);
        http.send();
        return http.status!=404;
    }    

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
                var pagina_actual = parseInt(response.pagina);
                var total_paginas = parseInt(response.total_paginas);
                var data = response.data;

                $("#pagina").text(pagina_actual);
                $("#total_paginas").text(total_paginas);

                var tablebody = ""; 
                $.each(data, function(index, val) {

                    var idx = (index  + 1) + (pagina_actual-1)*10;

                    tablebody += "<tr>";
                    tablebody += "<td>" + idx + "</td>";
                    tablebody += "<td>" + val.nombre + "</td>";
                    tablebody += "<td>" + val.email + "</td>";
                    tablebody += "<td>" + val.cedula + "</td>";
                    tablebody += "<td>" + val.estado + "</td>";

                    urlImagen = "/nexura/web/upload/" + val.email +".jpg";

                    if (existeUrl(urlImagen)) {
                        tablebody += "<td><img src='" + urlImagen + "' border='1' width='100' height='100'></td>";
                    }
                    else {
                        tablebody += "<td></td>";
                    }
                    
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