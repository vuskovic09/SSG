<?php
    $navQuery = "SELECT * FROM `nav` ORDER BY `priority`";
    $execNav = $pdo->query($navQuery);
    $dataNav = $execNav -> fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content=" shop" /> 
        <meta name="author" content="mailto: " /> 
        <meta name="language" content="" />
        <meta name="keywords" content="" />
        <meta name="robots" content="index, follow" />
        <meta name="copyright" content="">
        <link rel="icon" type="image/png" href="images/favicon.ico" />

		<title>SSG</title>

		<!-- Font Awesome Icon -->
		<link rel="stylesheet" href="assets/css/font-awesome.min.css">

		<!-- Custom stlylesheet -->
		<link type="text/css" rel="stylesheet" href="assets/css/style.css"/>
    </head>
<body>
<!-- HEADER -->
<header>
    <div class="container-fluid header">
        <div class="header-filter">
        </div>
        <div class="row between">
            <div class="col-xs-12 col-md-3">
                <nav class="header-nav navigation">
                    <ul>
                        <li><a href="intro-text">Uvodna riječ</a></li>
                        <li><a href="rule-info">Pravilnik natjecanja</a></li>
                        <li><a href="comp-info">Pjevačko natjecanje</a></li>
                        <li><a href="">Klavirsko natjecanje</a></li>
                    </ul>
                </nav>
            </div>
            <div class="col-xs-12 col-md-9 header-title">
                <h1>Online</br>Međunarodno natjecanje</br>Mladih glazbenika</br>Zagreb 2021.</h1>
            </div>
        </div>
    </div>
</header>