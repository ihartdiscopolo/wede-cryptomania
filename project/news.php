<?php

require_once('includes/session.php');
require_once('includes/headerFunctions.php');

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php htmlHead(); ?>
</head>

<body class="d-flex flex-column min-vh-100">

    <?php displayHeader(); ?>

    <img src="images/loading-cat.gif" id="preloader" class="d-block mx-auto my-5" height="800" width="800"
        alt="Loading...">
        
    <main class="container my-5">
        <h1 class="mb-4">Latest Crypto News</h1>

        <div id="articles" class="row"></div>

        <script id="news-template" type="x-tmpl-mustache">
                <div class="col-md-6 col-lg-4 mb-4">
                    <article class="card h-100 shadow-sm">
                        <img src="{{urlToImage}}" class="card-img-top" alt="news image">

                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{title}}</h5>
                            <p class="card-text">{{description}}</p>

                            <p class="text-muted small mt-auto">
                                {{source.name}} • {{publishedAt}}
                            </p>

                            <a href="{{url}}" target="_blank" class="btn btn-primary mt-2">
                                Read more
                            </a>
                        </div>
                    </article>
                </div>
            </script>
    </main>


    <?php displayFooter(); ?>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"
        integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>

    <!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>

    <!-- Mustache -->
    <script src="https://unpkg.com/mustache@latest/mustache.min.js"></script>

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- Custom js  -->
    <script src="js/news.js"></script>

</body>

</html>