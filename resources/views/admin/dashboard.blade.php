<style>
#chartdiv, #chartdiv2 {
  width: 100%;
  height: 350px;
}
</style>
<div class="content-wrapper">
	<!-- Page header -->
	<div class="page-header page-header-light">
		<div class="page-header-content header-elements-md-inline">
			<div class="page-title d-flex">
				<h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">Dashboard</span></h4>
				<a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
			</div>

			<div class="header-elements d-none">
				<div class="d-flex justify-content-center">
					<!-- <a href="#" class="btn btn-link btn-float text-default"><i class="icon-bars-alt text-primary"></i><span>Statistics</span></a>
					<a href="#" class="btn btn-link btn-float text-default"><i class="icon-calculator text-primary"></i> <span>Invoices</span></a>
					<a href="#" class="btn btn-link btn-float text-default"><i class="icon-calendar5 text-primary"></i> <span>Schedule</span></a>-->
				</div>
			</div>
		</div>

		<div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
			<div class="d-flex">
				<div class="breadcrumb">
					<a href="index.html" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Dashboard</a>
				</div>

				<a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
			</div>

			<div class="header-elements d-none">
				<div class="breadcrumb justify-content-center">
					<a href="#" class="breadcrumb-elements-item">
						<i class="icon-comment-discussion mr-2"></i>
						Support
					</a>

					<div class="breadcrumb-elements-item dropdown p-0">
						<a href="#" class="breadcrumb-elements-item dropdown-toggle" data-toggle="dropdown">
							<i class="icon-gear mr-2"></i>
							Settings
						</a>

						<div class="dropdown-menu dropdown-menu-right">
							<a href="#" class="dropdown-item"><i class="icon-user-lock"></i> Account security</a>
							<a href="#" class="dropdown-item"><i class="icon-statistics"></i> Analytics</a>
							<a href="#" class="dropdown-item"><i class="icon-accessibility"></i> Accessibility</a>
							<div class="dropdown-divider"></div>
							<a href="#" class="dropdown-item"><i class="icon-gear"></i> All settings</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- /page header -->
	<div class="content">
		<!-- Main charts -->
		<div class="row">
			<div class="col-xl-12">
				<div class="card">
					<div class="card-header header-elements-inline">
						<h6 class="card-title">Grafik Coba</h6>
						<div class="header-elements">
							
						</div>
					</div>

					<div class="card-body py-0">
						<div class="row">
							<div class="col-sm-12">
								<div id="chartdiv"></div>
							</div>
						</div>
					</div>

				</div>
			</div>
			<div class="col-xl-6">
				<div class="card">
					<div class="card-header header-elements-inline">
						<h6 class="card-title">Grafik Coba</h6>
						<div class="header-elements">
							
						</div>
					</div>

					<div class="card-body py-0">
						<div class="row">
							<div class="col-sm-12">
								<div id="chartdiv2"></div>
							</div>
						</div>
					</div>

				</div>
				
			</div>
		</div>
	</div>

	<!-- Resources -->
	<script src="https://cdn.amcharts.com/lib/4/core.js"></script>
	<script src="https://cdn.amcharts.com/lib/4/charts.js"></script>
	<script src="https://cdn.amcharts.com/lib/4/themes/animated.js"></script>
	<script>
		am4core.ready(function() {

		// Themes begin
		am4core.useTheme(am4themes_animated);
		// Themes end



		var chart = am4core.create('chartdiv', am4charts.XYChart)
		chart.colors.step = 2;

		chart.legend = new am4charts.Legend()
		chart.legend.position = 'top'
		chart.legend.paddingBottom = 20
		chart.legend.labels.template.maxWidth = 95

		var xAxis = chart.xAxes.push(new am4charts.CategoryAxis())
		xAxis.dataFields.category = 'category'
		xAxis.renderer.cellStartLocation = 0.1
		xAxis.renderer.cellEndLocation = 0.9
		xAxis.renderer.grid.template.location = 0;

		var yAxis = chart.yAxes.push(new am4charts.ValueAxis());
		yAxis.min = 0;

		function createSeries(value, name) {
			var series = chart.series.push(new am4charts.ColumnSeries())
			series.dataFields.valueY = value
			series.dataFields.categoryX = 'category'
			series.name = name

			series.events.on("hidden", arrangeColumns);
			series.events.on("shown", arrangeColumns);

			var bullet = series.bullets.push(new am4charts.LabelBullet())
			bullet.interactionsEnabled = false
			bullet.dy = 30;
			bullet.label.text = '{valueY}'
			bullet.label.fill = am4core.color('#ffffff')

			return series;
		}

		chart.data = [
			{
				category: 'Place #1',
				first: 40,
				second: 55,
				third: 60
			},
			{
				category: 'Place #2',
				first: 30,
				second: 78,
				third: 69
			},
			{
				category: 'Place #3',
				first: 27,
				second: 40,
				third: 45
			},
			{
				category: 'Place #4',
				first: 50,
				second: 33,
				third: 22
			}
		]


		createSeries('first', 'The First');
		createSeries('second', 'The Second');
		createSeries('third', 'The Third');

		function arrangeColumns() {

			var series = chart.series.getIndex(0);

			var w = 1 - xAxis.renderer.cellStartLocation - (1 - xAxis.renderer.cellEndLocation);
			if (series.dataItems.length > 1) {
				var x0 = xAxis.getX(series.dataItems.getIndex(0), "categoryX");
				var x1 = xAxis.getX(series.dataItems.getIndex(1), "categoryX");
				var delta = ((x1 - x0) / chart.series.length) * w;
				if (am4core.isNumber(delta)) {
					var middle = chart.series.length / 2;

					var newIndex = 0;
					chart.series.each(function(series) {
						if (!series.isHidden && !series.isHiding) {
							series.dummyData = newIndex;
							newIndex++;
						}
						else {
							series.dummyData = chart.series.indexOf(series);
						}
					})
					var visibleCount = newIndex;
					var newMiddle = visibleCount / 2;

					chart.series.each(function(series) {
						var trueIndex = chart.series.indexOf(series);
						var newIndex = series.dummyData;

						var dx = (newIndex - trueIndex + middle - newMiddle) * delta

						series.animate({ property: "dx", to: dx }, series.interpolationDuration, series.interpolationEasing);
						series.bulletsContainer.animate({ property: "dx", to: dx }, series.interpolationDuration, series.interpolationEasing);
					})
				}
			}
		}

		var chart2 = am4core.create("chartdiv2", am4charts.PieChart);

		// Add data
		chart2.data = [ {
		"country": "Lithuania",
		"litres": 501.9
		}, {
		"country": "Czechia",
		"litres": 301.9
		}, {
		"country": "Ireland",
		"litres": 201.1
		}, {
		"country": "Germany",
		"litres": 165.8
		}, {
		"country": "Australia",
		"litres": 139.9
		}, {
		"country": "Austria",
		"litres": 128.3
		}, {
		"country": "UK",
		"litres": 99
		}, {
		"country": "Belgium",
		"litres": 60
		}, {
		"country": "The Netherlands",
		"litres": 50
		} ];

		// Set inner radius
		chart2.paddingTop = 0;
		chart2.innerRadius = am4core.percent(15);
		chart2.radius = am4core.percent(45);
		// Add and configure Series
		var pieSeries = chart2.series.push(new am4charts.PieSeries());
		pieSeries.dataFields.value = "litres";
		pieSeries.dataFields.category = "country";
		pieSeries.slices.template.stroke = am4core.color("#fff");
		pieSeries.slices.template.strokeWidth = 2;
		pieSeries.slices.template.strokeOpacity = 1;

		// This creates initial animation
		pieSeries.hiddenState.properties.opacity = 1;
		pieSeries.hiddenState.properties.endAngle = -90;
		pieSeries.hiddenState.properties.startAngle = -90;

		}); // end am4core.ready()
	</script>