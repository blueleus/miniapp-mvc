<div class="container">
    <div class="row">
        <div class="col-12 col-md-12">
            <h4><?php echo isset($mensaje) ? $mensaje : ""; ?></h4>
            <div class="container_options row">
                <div class="col-md-2">
                    <a class="btn btn-primary btn-lg btn-block" href="<?php echo Helper::getUrl("usuarios", "crear", array()); ?>"><span class="glyphicon glyphicon-plus"></span> Crear usuario.</a>
                </div>
                <div class="col-md-1" style="margin-top: 5px; margin-bottom: 5px"></div>
                <div class="col-md-2">
                    <a class="btn btn-info btn-lg btn-block" href="<?php echo Helper::getUrl("usuarios", "reportes", array()); ?>"><span class="glyphicon glyphicon-picture"></span> Reportes</a>
                </div>
                <div class="col-md-1" style="margin-top: 5px; margin-bottom: 5px"></div>
                <div class="col-md-2">
                    <a class="btn btn-info btn-lg btn-block" href="<?php echo Helper::getUrl("contratos", "listar", array()); ?>"><span class="glyphicon glyphicon-chevron-right"></span> Ir a contratos</a>
                </div>
            </div>
            <br>
            <div class="loader"></div>
            <br>
            <div class="container_table table-responsive-lg">
                <table id="users_table" class="table table-bordered table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th></th>
                            <th>Nombre</th>
                            <th class='hidden-xs'>Email</th>
                            <th class='hidden-xs'>C&eacute;dula</th>
                            <th class='hidden-xs hidden-sm'>Estado</th>
                            <th class='hidden-xs hidden-sm'>Imagen</th>
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
        //inicializarListeners();

        var info = getInfoPaginado();
        var num_total_registros = parseInt(info.num_total_registros);
        var total_paginas = parseInt(info.total_paginas);
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
    });

    function getInfoPaginado() {

        var dataResult;

        try {
            $.ajax({
                url:   'http://localhost/nexura/index.php?mod=usuarios&fun=informacion_paginado',
                type:  'GET',
                dataType: 'json',
                async: false,
                beforeSend: function () {
                    console.log("Procesando, espere por favor...");
                },
                success:  function (response) {
                    console.log(response);
                    dataResult = response;
                }
            });

            return dataResult;
        }
        catch(ex) {
            alert("ERROR: Ocurrio un error " + ex);
        }
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
        var loader = $('.loader');

        $.ajax({
            data:  {"pagina" : pagina},
            url:   'http://localhost/nexura/index.php?mod=usuarios&fun=listar_paginado',
            type:  'GET',
            dataType: 'json',
            beforeSend: function () {
                console.log("Procesando, espere por favor...");
                loader.show();
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
                    tablebody += "<td class='hidden-xs'>" + val.email + "</td>";
                    tablebody += "<td class='hidden-xs'>" + val.cedula + "</td>";
                    tablebody += "<td class='hidden-xs hidden-sm'>" + val.estado + "</td>";

                    urlImagen = "/nexura/web/upload/" + val.email +".jpg";

                    if (existeUrl(urlImagen)) {
                        tablebody += "<td class='hidden-xs hidden-sm'><img src='" + urlImagen + "' border='1' width='100' height='100'></td>";
                    }
                    else {
                        tablebody += "<td class='hidden-xs hidden-sm'></td>";
                    }

                    tablebody += "<td><a class='btn btn-warning btn-xs' href='http://localhost/nexura/index.php?mod=usuarios&fun=editar&id=" + val.id + "'><span class='glyphicon glyphicon-edit' aria-hidden='true'></span> <span class='hidden-xs'>Editar.</span></a></td>";
                    tablebody += "<td><a class='btn btn-danger btn-xs' href='http://localhost/nexura/index.php?mod=usuarios&fun=eliminar&id=" + val.id + "'><span class='glyphicon glyphicon-remove' aria-hidden='true'></span> <span class='hidden-xs'>Eliminar.</span></a></td>";
                    tablebody += "<td><a class='btn btn-info btn-xs' href='http://localhost/nexura/index.php?mod=usuarios&fun=buscar&id=" + val.id + "'><span class='glyphicon glyphicon-eye-open' aria-hidden='true'></span> <span class='hidden-xs'>Ver.</span></a></td>";
                    tablebody += "</tr>";
                });

                $("#users_table tbody").html(tablebody);
                loader.hide();
            },
            fail: function (err) {
                loader.hide();
                alert(err);
            }
        });
    }
</script>