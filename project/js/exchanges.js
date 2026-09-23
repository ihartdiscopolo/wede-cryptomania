function getAllExchanges() {
    $.ajax({
        type: "GET",
        dataType: "json",
        url: "https://rest.coincap.io/v3/exchanges",

        success: function (allExchangesData) {
            exchanges = allExchangesData;

            console.log(exchanges);
            $.each(exchanges.data, function (index, exchange) {
                var template = $("#exchanges-template").html();

                var renderTemplate = Mustache.render(template, {
                    data: exchange
                });

                $("#exchanges-table tbody").append(renderTemplate);
            });
            $("#preloader").fadeOut(500, function () {
                $(this).remove();
            });
        },
    });
}

$(document).ready(function () {
    getAllExchanges();
});
