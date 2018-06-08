$(function() {
    $.ajax({

        url: 'http://localhost:8080/Web App/Incident Reporting App/chartsyear/CatCountYear.php',
		
        type: 'GET',
        success: function(data) {
            chartData = data;
            var chartProperties = {
                "caption": "Total incidents",
                "xAxisName": "Category",
                "yAxisName": "Count",
                "rotatevalues": "1",
                "theme": "zune"
            };

            apiChart = new FusionCharts({
                type: 'pie3d',
                renderAt: 'chart-container1',
                width: '750',
                height: '550',
                dataFormat: 'json',
                dataSource: {
                    "chart": chartProperties,
                    "data": chartData
                }
            });
	
            apiChart.render();
        }
    });
});