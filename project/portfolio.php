<?php
require_once('includes/session.php');
require_once('includes/headerFunctions.php');

if (!isset($_SESSION['user'])) {
    echo "<script>
    alert('You must be logged in to access this page.');
    window.location.href = 'login.php';
    </script>";
    exit();
}

$userId = $_SESSION['user']['id'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php htmlHead(); ?>
</head>

<body class="d-flex flex-column min-vh-100">

    <?php displayHeader(); ?>

    <main class="flex-grow-1 container py-4">
        <table class="table" id="crypto-folio-table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Amount</th>
                    <th>Total</th>
                    <th>Save</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                <template id="coins-cryptofolio-template">
                    {{#data}}
                    <tr>
                        <td>{{name}}</td>
                        <td>${{price}}</td>
                        <td><input type="number" id="{{transId}}" value="{{amount}}" class="amount-input" /></td>
                        <td class="price-total">${{totalValue}}</td>
                        <td><button type="button" class="btn btn-warning save-coin-btn"
                                value="{{transId}}">Save</button></td>
                        <td><button type="button" class="btn btn-danger delete-coin-btn"
                                value="{{transId}}">Delete</button></td>
                    </tr>
                    {{/data}}
                </template>
            </tbody>
            <tfoot>
                <tr></tr>
            </tfoot>
        </table>
    </main>

    <?php
    displayFooter();
    ?>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"
        integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>

    <!-- Bootstrap -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"
        integrity="sha384-LtrjvnR4Twt/qOuYxE721u19sVFLVSA4hf/rRt6PrZTmiPltdZcI7q7PXQBYTKyf"
        crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>

    <!-- Mustache JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/mustache.js/2.3.0/mustache.js"></script>

    <!-- Chart JS -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>

    <!-- Custom js  -->
    <script src="js/portfolio.js"></script>
    <script src="js/main.js"></script>

</body>

</html>