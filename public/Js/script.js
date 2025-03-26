let monthList = [];
let incomeList = [];
for (month in recetteParMois) {
    monthList.push(month);
    incomeList.push(Number(recetteParMois[month]));
}

Highcharts.setOptions({
    chart: {
        styleMode: true,
    },
});

document.addEventListener("DOMContentLoaded", function () {
    const chart = Highcharts.chart("income-graph", {
        chart: {
            type: "column",
        },
        title: {
            text: "Income",
        },
        xAxis: {
            categories: monthList,
        },
        yAxis: {
            title: {
                text: "Income values",
            },
        },
        series: [
            {
                name: "Income",
                data: incomeList,
            },
        ],
    });
});
