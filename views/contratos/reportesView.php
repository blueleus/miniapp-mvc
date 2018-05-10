<div class="container">
	<div class="row">
		<div class="col-8 col-md-8" id="grafico1">

		</div>
	</div>

	<div class="row">
		<div class="col-8 col-md-8" id="grafico2">

		</div>
	</div>

	<div class="row">
        <a href="<?php echo Helper::getUrl("contratos", "listar", array()); ?>">Volver a la lista.</a>
	</div>
</div>

<script type="text/javascript">

	$( document ).ready(function() {
		conteoContratosPorSecretaria();
	});

	function conteoContratosPorSecretaria() {
		$.ajax({
			url:   'http://localhost/nexura/index.php?mod=contratos&fun=conteoContratosPorSecretaria',
			type:  'GET',
			dataType: 'json',
			beforeSend: function () {
				console.log("Procesando, espere por favor...");
			},
			success:  function (response) {
				//console.log(response);

                var data = [];
                $.each(response, function(index, val) {
                    var inf = {name: val.nombre, y: parseInt(val.total)};
                    data.push(inf);
                });

                console.log(data);

				Highcharts.chart('grafico1', {
				    chart: {
				        type: 'column'
				    },
				    title: {
				        text: 'Cantidad'
				    },
				    xAxis: {
				        type: 'category'
				    },
				    yAxis: {
				        title: {
				            text: 'Total'
				        }

				    },
				    "series": [
				        {
				            "name": "Usuarios",
				            "colorByPoint": true,
				            "data": data
				        }
				    ]
				});


				Highcharts.chart('grafico2', {
				    chart: {
				        plotBackgroundColor: null,
				        plotBorderWidth: null,
				        plotShadow: false,
				        type: 'pie'
				    },
				    title: {
				        text: 'Activos e inactivos'
				    },
				    series: [{
				        name: 'Activos e inactivos',
				        colorByPoint: true,
				        data: data
				    }]
				});

			}
		});
	}
</script>