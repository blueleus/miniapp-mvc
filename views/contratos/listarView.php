<?php include_once "crearModal.php"; ?>

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
                    <a class="btn btn-info btn-lg btn-block" href="<?php echo Helper::getUrl("contrato", "reportes", array()); ?>"><span class="glyphicon glyphicon-picture"></span> Reportes</a>
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
        cargarContratos(1);
    });

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
                console.log(response);
                //var num_total_registros = response.num_total_registros;
                var pagina_actual = parseInt(response.pagina);
                var total_paginas = parseInt(response.total_paginas);
                var data = response.data;

                $("#pagina").text(pagina_actual);
                $("#total_paginas").text(total_paginas);

                if (data) {
                    $("#users_table tbody").html(data);
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