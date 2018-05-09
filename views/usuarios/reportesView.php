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
        <a href="<?php echo Helper::getUrl("usuarios", "listar", array()); ?>">Volver a la lista.</a>
	</div>
</div>

<script type="text/javascript">

	$( document ).ready(function() {
		conteoActivosInactivos();
	});

	function conteoActivosInactivos() {
		$.ajax({
			url:   'http://localhost/nexura/index.php?mod=usuarios&fun=conteo_activo_inactivos',
			type:  'GET',
			dataType: 'json',
			beforeSend: function () {
				console.log("Procesando, espere por favor...");
			},
			success:  function (response) {
				console.log(response);
                var activos = (typeof(response[0]) != "undefined" && response[0] != null)? response[0].total : 0;
                var inactivos = (typeof(response[1]) != "undefined" && response[1] != null)? response[1].total : 0;

				Highcharts.chart('grafico1', {
				    chart: {
				        type: 'column'
				    },
				    title: {
				        text: 'Activos e Inactivos'
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
				            "data": [
				                {
				                    "name": "Inactivos",
				                    "y": parseInt(inactivos)
				                },
				                {
				                    "name": "Activos",
				                    "y": parseInt(activos)
				                }
				            ]
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
				        data: [{
				            name: 'Inactivos',
				            y: parseInt(inactivos)
				        }, {
				            name: 'Activos',
				            y: parseInt(activos)
				        }]
				    }]
				});

			}
		});
	}
</script>