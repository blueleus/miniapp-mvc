<?php include_once dirname(__FILE__)."/../lib/php/Helper.php" ?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title></title>
    <link rel="stylesheet" href="">

    <script
      src="https://code.jquery.com/jquery-3.3.1.min.js"
      integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
      crossorigin="anonymous"></script>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

    <script src="https://code.highcharts.com/highcharts.js"></script>

    <style>
    table {
        font-family: arial, sans-serif;
        border-collapse: collapse;
        width: 100%;
    }

    /*td, th {
        border: 1px solid #dddddd;
        text-align: left;
        padding: 8px;
    }

    tr:nth-child(even) {
        background-color: #dddddd;
    }*/
    </style>

</head>
<body>
<?php
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {

    /*echo "<div class='d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom box-shadow'>";
    echo "<h5 class='my-0 mr-md-auto font-weight-normal'></h5>";
    echo "<nav class='my-2 my-md-0 mr-md-3'></nav>";
    echo "<a class='btn btn-outline-primary' href='".Helper::getUrl("login", "singout", array())."''>Cerrar sesi&oacute;n</a>";
    echo "</div>";*/

    echo "<nav class='navbar navbar-default'>";
    echo "<div class='container-fluid'>";
    echo "<div class='navbar-right' style='margin-right:10px'>";
    echo "<a class='btn btn-primary navbar-btn' href='".Helper::getUrl("login", "singout", array())."'>";
    echo "<span>Cerrar sesi&oacute;n</span>";
    echo "</a>";
    echo "</div>";
    echo "</div>";
    echo "</nav>";

}
?>