//example API (Docs): https://pro.coincap.io/api-docs
//get all coins
function getAllCoins() {
    $.ajax({
        type: "GET",
        dataType: "json",
        type: "GET",
        url: "https://rest.coincap.io/v3/assets?apiKey=<YOUR API KEY HERE>",

        success: function (allCoinsData) {
            coins = allCoinsData;

            console.log(coins);
            $.each(coins.data, function (index, coin) {
                $("#coins-table").append(
                    "<tr>" +
                        "<td>" +
                        coin.name +
                        "</td>" +
                        "<td>" +
                        coin.symbol +
                        "</td>" +
                        "<td>" +
                        coin.priceUsd +
                        "</td>" +
                        "<td><button type='button' class='coin-info-btn btn btn-primary' id='" + coin.id + "' data-bs-toggle='modal' data-bs-target='#exampleModal'>" +
                        "More Info" +
                        "</button></td>" +
                        "</tr>",
                );
            });
        },
    });
}

//function to get a single coin
function getCoin(selectedButton) {

    coinId = $(selectedButton).attr("id");

    $.ajax({
        type: "GET",
        dataType: "json",
        url: "https://rest.coincap.io/v3/assets/" + coinId + "?apiKey=<YOUR API KEY HERE>",
    
        success: function (coin) {
            $("#exampleModal .modal-body").empty().append(
                "<p>Supply: " + coin.data.supply + "</p>",
            );
            $("#exampleModal .modal-title").empty().append(coin.data.name);
        },

    });
}

$(document).ready(function () {
    //load all coins @ loading
    getAllCoins();

    //On click to get a single coin
    $("#coins-table").on("click", ".coin-info-btn", function () {
        getCoin(this);
    });
});
