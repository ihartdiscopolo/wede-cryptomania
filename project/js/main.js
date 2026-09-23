let coinChart;

// Function to open the modal and change the info of the coin
function getCoinInfo(selectedButton) {
    var coinId = $(selectedButton).attr("id");

    $.ajax({
        type: "GET",
        dataType: "json",
        url:
            "https://rest.coincap.io/v3/assets/" +
            coinId +
            "/?apiKey=9c3c30d1fa01bd76d3099e33ddc00f7a2463b41a0d8f6fce2f406e339fd5da8f",
        success: function (coin) {
            console.log(coin);
            coinId = coin.data.id;
            cryptoName = coin.data.name;
            cryptoSymbol = coin.data.symbol;
            cryptoPrice = coin.data.priceUsd;
            cryptoMarketCap = coin.data.marketCapUsd;
            volumeUsd24Hr = coin.data.volumeUsd24Hr;
            maxSupply = coin.data.maxSupply;
            selectedInfo = {
                coinId: coinId,
                coinName: cryptoName,
                coinPrice: cryptoPrice,
                coinSymbol: cryptoSymbol,
                coinMarketCap: cryptoMarketCap,
                volumeUsd24Hr: volumeUsd24Hr,
                maxSupply: maxSupply,
            };

            //step 1 get the template
            var getCoinInfoTemplate = $("#cryptofolio-modal-template").html();

            //step 2 Render output with Mustache.js
            var renderGetCoinInfoTemplate = Mustache.render(
                getCoinInfoTemplate,
                selectedInfo,
            );

            //step 3 append the data to the body
            $("#modal-content-cryptofolio").html(renderGetCoinInfoTemplate);
            getChartInfo(coinId);
        },
    });
}

//Function to add a coin to you cryptofolio
function addCoin() {
    //coinId
    var coinId = $("#coin-id").text();

    //coinName
    var coinName = $("#coin-name").text();

    //coinPrice
    var coinPrice = $("#coin-price").text();

    //amountCoins
    var amountCoins = $("#amount-coins").val();

    if (!amountCoins)
        return alert("Please enter an amount of coins you want to add.");
    if (amountCoins < 1) amountCoins = 1;

    $.ajax({
        type: "POST",
        url: "includes/add_coins_db.php",
        data: {
            //coinId
            coin_id: coinId,
            //coinName
            coin_name: coinName,
            //coinPrice
            coin_price: coinPrice,
            //amountCoins
            amount_coins: amountCoins,
        },

        success: function (response) {
            //see the console in your browser
            alert(response);
        },
    });
}

//Save coin function
function saveCoin(getSaveButton) {
    //get the transaction id from the button value
    let transId = $(getSaveButton).attr("value");
    //get the amount of coins from the input field with the transaction id as id
    let coinAmount = $(`#${transId}`).val();
    console.log("coin amount : " + coinAmount);

    $.ajax({
        type: "POST",
        url: "includes/save_coin_db.php",
        data: {
            amount: coinAmount,
            transId: transId,
        },
        success: function (response) {
            console.log("SUCCESS");
            console.log(response);
        },
        error: function (xhr, status, error) {
            console.log("ERROR", error);
            console.log(xhr.responseText);
        },
    });
}

//Delete coin function (create the delete function below this line)
function deleteCoin(getDeleteButton) {
    let transId = $(getDeleteButton).attr("value");

    $.ajax({
        type: "POST",
        url: "includes/delete_coin_db.php",
        data: {
            transId: transId,
        },
        success: function (response) {
            alert(response);
            window.location.reload();
        },
        error: function (xhr, status, error) {
            console.log("ERROR:", error);
            console.log(xhr.responseText);
        },
    });
}

function getUsdToEurRate(callback) {
    $.ajax({
        type: "GET",
        dataType: "json",
        url: "https://rest.coincap.io/v3/rates/euro/?apiKey=9c3c30d1fa01bd76d3099e33ddc00f7a2463b41a0d8f6fce2f406e339fd5da8f",

        success: function (rates) {
            let rate = rates.data.rateUsd;
            console.log(rate);
            callback(rate); // return via callback
        },
    });
}

function getAllCoins() {
    getUsdToEurRate(function (usdToEurRate) {

        $.ajax({
            type: "GET",
            dataType: "json",
            url: "https://rest.coincap.io/v3/assets/?apiKey=9c3c30d1fa01bd76d3099e33ddc00f7a2463b41a0d8f6fce2f406e339fd5da8f",

            success: function (allCoinsData) {
                coins = allCoinsData;

                console.log(coins);

                $.each(coins.data, function (index, coin) {
                    coin.symbolLowerCase = coin.symbol.toLowerCase();

                    coin.changePercent24Hr = parseFloat(coin.changePercent24Hr).toFixed(2);
                    coin.priceUsd = parseFloat(coin.priceUsd).toFixed(2);

                    coin.priceEur = (coin.priceUsd / usdToEurRate).toFixed(2);

                    var template = $("#template").html();
                    var renderTemplate = Mustache.render(template, { data: coin });

                    $("#coins-table tbody").append(renderTemplate);
                });

                $("#preloader").fadeOut(500, function () {
                    $(this).remove();
                });
            },
        });

    });
}

//function to get a single coin
function getCoin(selectedButton) {
    coinId = $(selectedButton).attr("id");

    $.ajax({
        type: "GET",
        dataType: "json",
        url:
            "https://rest.coincap.io/v3/assets/" +
            coinId +
            "?apiKey=<YOUR API KEY HERE>",

        success: function (coin) {
            $("#exampleModal .modal-body")
                .empty()
                .append("<p>Supply: " + coin.data.supply + "</p>");
            $("#exampleModal .modal-title").empty().append(coin.data.name);
        },
    });
}

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
                    borderColor: "#ff0000",
                    data: chartPrice,
                },
            ],
        },

        // Configuration options go here
        options: {
            scales: {
                x: {
                    display: true,
                    title: {
                        display: true,
                        text: "Date",
                    },
                },
                y: {
                    display: true,
                    title: {
                        display: true,
                        text: "Price",
                    },
                },
            },
            elements: { point: { radius: 0 } },
        },
    });
}

$(document).ready(function () {
    //Open modal and get coin info
    $(document).on("click", ".btn-open-modal-cryptofolio", function () {
        getCoinInfo(this);
    });

    //Add a coin to the database
    $(document).on("click", "#js-add-coin-btn", function () {
        addCoin();
    });

    //On click event to update the amount of coins
    $(document).on("click", ".save-coin-btn", function () {
        saveCoin(this);
    });

    //Create the delete event here
    $(document).on("click", ".delete-coin-btn", function () {
        deleteCoin(this);
    });

    //load all coins @ loading
    getAllCoins();

    //On click to get a single coin
    $("#coins-table").on("click", ".coin-info-btn", function () {
        getCoin(this);
    });
});
