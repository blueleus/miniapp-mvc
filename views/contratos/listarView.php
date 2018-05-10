<?php include_once "crearModal.php"; ?>
<?php include_once "editarModal.php"; ?>

<div class="container">
    <div class="row">
        <div class="col-12 col-md-12">
            <h4><?php echo isset($mensaje) ? $mensaje : ""; ?></h4>
            <div class="container_options row">
                <div class="col-md-4">
                    <button type="button" class="btn btn-primary btn-lg btn-block" data-toggle="modal" data-target="#myModal">
                        <span class="glyphicon glyphicon-plus"></span> Crear contrato.
                    </button>
                </div>
                <div class="col-md-1" style="margin-top: 5px; margin-bottom: 5px"></div>
                <div class="col-md-4">
                    <a class="btn btn-info btn-lg btn-block" href="<?php echo Helper::getUrl("contratos", "reportes", array()); ?>"><span class="glyphicon glyphicon-picture"></span> Reportes</a>
                </div>
            </div>
            <br>
            <div class="loader"></div>
            <br>
            <a id="bt_eliminar_selected" class="btn btn-danger btn-xs" href="#" style="margin-bottom: 10px"><span class="glyphicon glyphicon-remove"></span> Eliminar todos</a>
            <div class="container_table table-responsive-lg">
                <table id="contratos_table" class="table table-bordered table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th></th>
                            <th></th>
                            <th>Numero de contrato</th>
                            <th>Objeto del contrato</th>
                            <th>Presupuesto</th>
                            <th>Fecha estimada fin</th>
                            <th>Fecha publicacion</th>
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

                <nav aria-label="Page navigation">
                    <ul class="pagination">
                        <li>
                            <a href="#" aria-label="Previous" id="bt-previoues">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                        <li id="li-link-1"><a href="#" id="link-1">1</a></li>
                        <li>
                            <a href="#" aria-label="Next" id="bt-next">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    </ul>
                </nav>

            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $( document ).ready(function() {
        cargarContratos(1);

        var info = getInfoPaginado();
        var num_total_registros = parseInt(info.num_total_registros);
        var total_paginas = parseInt(info.total_paginas);
        var pagina_actual = 1;

        $("#bt-next").on( "click", function() {
            if (pagina_actual + 1 <= total_paginas ) {
                pagina_actual += 1;
                console.log(pagina_actual);
                cargarContratos(pagina_actual);
            } else {
                alert("No hay más paginas.");
                console.log("No hay más paginas.");
            }
        });

        $("#bt-previoues").on( "click", function() {
            if (pagina_actual - 1 > 0 ) {
                pagina_actual -= 1;
                console.log(pagina_actual);
                cargarContratos(pagina_actual);
            } else {
                alert("No hay menos paginas.");
                console.log("No hay menos paginas.");
            }
        });

        for (var i = 1; i < total_paginas; i++) {
            var idx = i + 1;
            $("#li-link-" + i).after("<li id='li-link-" + idx + "'><a href='#' id='link-" + idx + "'>" + idx + "</a></li>");
        }

        for (var i = 1; i <= total_paginas; i++) {
            $("#link-" + i).on( "click", function() {
                var value = parseInt($(this).text());
                cargarContratos(value);
                pagina_actual = value;
            });
        }

        $("#bt_eliminar_selected").on("click", function () {
            var selected = [];
            $('.micheckbox:checked').each( function() {
                    selected.push($(this).val());
            });

            if (selected.length > 0) {
                $.ajax({
                    data:  {"ids" : JSON.stringify(selected)},
                    url:   'http://localhost/nexura/index.php?mod=contratos&fun=eliminarSelected',
                    type:  'GET',
                    dataType: 'json',
                    beforeSend: function () {
                        console.log("Procesando, espere por favor...");
                    },
                    success:  function (response) {
                        if(typeof(response.status) != "undefined"
                            && response.status === true) {
                            location.reload();
                        }
                    }
                });
            }
            else {
                alert("No se ha selecionado nada.");
            }
        });
    });

    function getInfoPaginado() {

        var dataResult;

        try {
            $.ajax({
                url:   'http://localhost/nexura/index.php?mod=contratos&fun=informacion_paginado',
                type:  'GET',
                dataType: 'json',
                async: false,
                beforeSend: function () {
                    console.log("Procesando, espere por favor...");
                },
                success:  function (response) {
                    //console.log(response);
                    dataResult = response;
                }
            });

            return dataResult;
        }
        catch(ex) {
            alert("ERROR: Ocurrio un error " + ex);
        }
    }

    function cargarContratos(pagina) {
        var loader = $('.loader');

        $.ajax({
            data:  {"pagina" : pagina},
            url:   'http://localhost/nexura/index.php?mod=contratos&fun=listar_paginado',
            type:  'GET',
            dataType: 'json',
            beforeSend: function () {
                console.log("Procesando, espere por favor...");
                loader.show();
            },
            success:  function (response) {
                //console.log(response);
                //var num_total_registros = response.num_total_registros;
                var pagina_actual = parseInt(response.pagina);
                var total_paginas = parseInt(response.total_paginas);
                var data = response.data;

                $("#pagina").text(pagina_actual);
                $("#total_paginas").text(total_paginas);

                if (data) {
                    $("#contratos_table tbody").html(data);
                }
                else {
                    alert("No hay datos");
                }
                loader.hide();
            },
            fail: function (err) {
                loader.hide();
                alert(err);
            }
        });
    }
</script>