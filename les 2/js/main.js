//example API (Docs): https://pro.coincap.io/api-docs
//get all coins
function getData() {
    $.ajax({
        type: "GET",
        dataType: "json",
        type: "GET",
        url: "https://jsonplaceholder.typicode.com/posts/",

        success: function (data) {

            console.log(data);

            var template = $("#template").html();

            var renderTemplate = Mustache.render(template, { data: data });

            $("#lorem-table tbody").append(renderTemplate)
        },
    });
}

$(document).ready(function () {
    //load all coins @ loading
    getData();
});