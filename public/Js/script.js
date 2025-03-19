document.addEventListener('DOMContentLoaded', function () {
    const chart = Highcharts.chart('income-graph', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'Income'
        },
        xAxis: {
           categories:['juin', 'juillet']
        },
        yAxis: {
            categories:['1', '2', '3']
        },
        series: [{
            name: 'Total',
            data: [1, 3],
        }]
    });
});