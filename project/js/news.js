function formatDate(date) {
    // returns YYYY-MM-DD (safe for NewsAPI)
    return date.toISOString().split("T")[0];
}

function getAllNews() {
    console.log("Fetching news...");

    let now = new Date();
    let yesterday = new Date(Date.now() - 24 * 60 * 60 * 1000);

    let from = formatDate(yesterday);
    let to = formatDate(now);

    $.ajax({
        type: "GET",
        dataType: "json",
        url: `https://newsapi.org/v2/everything?q=crypto&from=${from}&to=${to}&sortBy=popularity&apiKey=6f28becb7b9147bba3739ead5f55b367`,

        success: function (data) {
            console.log("API response:", data);

            if (data.status !== "ok") {
                console.error("API ERROR:", data);
                $("#articles").html("<p>Failed to load news.</p>");
                return;
            }

            let articles = data.articles;

            if (!articles || articles.length === 0) {
                $("#articles").html("<p>No news found.</p>");
                return;
            }

            let template = $("#news-template").html();

            // limit to 9 articles
            $.each(articles.slice(0, 9), function (index, article) {

                // fallback image
                if (!article.urlToImage) {
                    article.urlToImage = "https://via.placeholder.com/400x200?text=No+Image";
                }

                // shorten description
                if (article.description && article.description.length > 120) {
                    article.description = article.description.substring(0, 120) + "...";
                }

                // format date nicely
                let date = new Date(article.publishedAt);
                article.publishedAt = date.toLocaleString();

                let rendered = Mustache.render(template, article);
                $("#articles").append(rendered);
            });

            // remove loader
            $("#preloader").fadeOut(500, function () {
                $(this).remove();
            });
        },

        error: function (xhr, status, error) {
            console.error("AJAX ERROR:", error);
            console.log(xhr.responseText);

            $("#articles").html("<p>Error loading news.</p>");
        }
    });
}

$(document).ready(function () {
    getAllNews();
});