// Function to open the modal and change the info of the coin
function getCoinInfo(selectedButton) {
    //get the value from the table
    var cryptoName = $(selectedButton)
        .closest("tr")
        .find(".crypto-name")
        .text();
    var cryptoPrice = $(selectedButton)
        .closest("tr")
        .find(".crypto-price")
        .text();

    //place the crypto name and price in an object
    selectedInfo = { coinName: cryptoName, coinPrice: cryptoPrice };

    //step 1 get the template
    var getCoinInfoTemplate = $("#cryptofolio-modal-template").html();

    //step 2 Render output with Mustache.js
    var renderGetCoinInfoTemplate = Mustache.render(getCoinInfoTemplate, selectedInfo)

    //step 3 append the data to the body
    $("#modal-content-cryptofolio").html(renderGetCoinInfoTemplate);
}

//Function to add a coin to you cryptofolio
function addCoin() {
    //coinName
    var coinName = $("#coin-name").text();

    //coinPrice
    var coinPrice = $("#coin-price").text();

    //amountCoins
    var amountCoins = $("#amount-coins").val();

    //totalValue
    var totalValue = $("#total-value").val();

    $.ajax({
        type: "POST",
        url: "includes/add_coins_db.php",
        data: {
            coin_name: coinName,
            //coinPrice
            coin_price: coinPrice,
            //amountCoins
            amount_coins: amountCoins,
            //totalValue
            total_value: totalValue,
        },

        success: function (data) {
            //see the console in your browser
            console.log(data);
        },
    });
}

//Get all coins from the DB for your cryptofolio
function getAllCoinsPortfolio() {
    $.ajax({
        type: "GET",
        url: "includes/get_coins_db.php",
        dataType: "json",

        success: function (data) {
            //An array is returned
            console.log(data);

            //Use mustache to create the table with data (See previous lessons)

            //step 1 get the template
            //step 2 Render output with Mustache.js
            //step 3 append the data to the body
			
            $.each(data, function (index, data) {
                data.totalValue = data.price * data.amount;

                var template = $("#coins-cryptofolio-template").html();

                var renderTemplate = Mustache.render(template, { data: data });

                $("#crypto-folio-table tbody").append(renderTemplate);
            });
        },
    });
}

//Save coin function
function saveCoin(getSaveButton) {
    let coinId = $(getSaveButton).attr("value");

    console.log(coinId);

    let coinAmount = $(`#${coinId}`).val();
    console.log("coin amount : " + coinAmount);

    $.ajax ({
        type: "POST",
        url: "includes/save_coin_db.php",
        data: {
            amount: coinAmount,
            coinId: coinId,
        },
        success: function (response){
            console.log("SUCCESS");
            console.log(response);
        },
        error: function (xhr, status, error) {
            console.log("ERROR", error);
            console.log(xhr.responseText);
        },
    })
}

//Delete coin function (create the delete function below this line)
function deleteCoin(getDeleteButton){
    let coinId = $(getDeleteButton).attr("value");
    console.log(coinId)  

    $.ajax ({
        type: "POST",
        url: "includes/delete_coin_db.php",
        data: {
            coinId: coinId,
        },
        success: function () {
            console.log("successfully deleted!");
        },
        error: function (xhr, status, error){
            console.log("ERROR:", error);
            console.log(xhr.responseText);
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

    //Get all coins from the database (used for the cryptofolio.php page)
    getAllCoinsPortfolio();

    //On click event to update the amount of coins
    $(document).on("click", ".save-coin-btn", function () {
        saveCoin(this);
    });

    //Create the delete event here
    $(document).on("click", ".delete-coin-button", function () {
        deleteCoin(this);
    });
});
