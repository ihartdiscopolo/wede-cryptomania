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
                coin.symbolLowerCase = coin.symbol.toLowerCase();

                var template = $("#template").html();

                var renderTemplate = Mustache.render(template, { data: coin });

                $("#coins-table tbody").append(renderTemplate);

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

const student =  {
    name : "John Doe",
    age : 67,
    course : "Women"
}

student.dick = 6;

student.location = "Your moms bed ;)";

console.log(student);

const product = {
    name : "Laptop",
    price : 800,
    get PriceWithVAT(){
        return this.price * 1.21;
    }
};

console.log(product);