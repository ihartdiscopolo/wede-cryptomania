//Get all coins from the DB for your cryptofolio
function getAllCoinsPortfolio() {
    $.ajax({
        type: "GET",
        url: "includes/get_coins_db.php",
        dataType: "json",

        success: function (data) {
            //An array is returned
            console.log(data);

            $.each(data, function (index, data) {
                data.totalValue = data.price * data.amount;

                var template = $("#coins-cryptofolio-template").html();

                var renderTemplate = Mustache.render(template, { data: data });

                $("#crypto-folio-table tbody").append(renderTemplate);
            });
        },
    });
}

$(document).ready(function () {
    //Get all coins from the database (used for the cryptofolio.php page)
    getAllCoinsPortfolio();
});
