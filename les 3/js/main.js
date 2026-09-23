function getChartInfo() {
    let end = Date.now();
    let start = end - 7 * 24 * 60 * 60 * 1000;

    $.ajax({
        type: "GET",
        dataType: "json",
        url: `https://rest.coincap.io/v3/assets/bitcoin/history?interval=d1&start=${start}&end=${end}`,

        success: function (historicalData) {
            dateArray = [];
            priceArray = [];

            $.each(historicalData.data, function (index, value) {
                let date = new Date(value.date);

                dateArray.push(date.toLocaleDateString());
                priceArray.push(parseFloat(value.priceUsd));
            });

            generateChart(dateArray, priceArray);
        },
    });
}

//generates the chart with the historical information from the past year
function generateChart(chartDate, chartPrice) {
    var ctx = document.getElementById("coin-history-chart").getContext("2d");

    var chart = new Chart(ctx, {
        // The type of chart we want to create
        type: "line",

        // The data for our dataset
        data: {
            labels: chartDate,
            datasets: [
                {
                    type: "line",
                    label: "Price",
                    borderColor: "#3e95cd",
                    data: chartPrice,
                },
            ],
        },

        // Configuration options go here
        options: {
            scales: {
                xAxes: [
                    {
                        display: true,
                        scaleLabel: {
                            display: true,
                            labelString: "Date",
                        },
                    },
                ],
                yAxes: [
                    {
                        display: true,
                        scaleLabel: {
                            display: true,
                            labelString: "Price",
                        },
                    },
                ],
            },
            elements: { point: { radius: 0 } },
        },
    });
}

$(document).ready(function () {
    //The chart is loaded when the page is parsed
    getChartInfo();
});

