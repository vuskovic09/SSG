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
        <meta name="description" content="Zamisao i želja organizatora MUSICA ZAGREB jest ostvarenje natjecanja za talentirane perspektivne mlade umjetnike širom svijeta koji će dobiti priliku da putem ONLINE tehnologije prezentiraju svoje umijeće, vještine i ljubav prema glazbi" /> 
        <meta name="author" content="mailto: info@zagrebmusiccompetition.com" /> 
        <meta name="language" content="Croatian" />
        <meta name="keywords" content="musica zagreb, zagreb, natjecanje, takmičenje, pjevačko, klavirsko, natjecatelji, muzičko takmičenje, grad zagreb, natjecanje mladih glazbenika, ocjenjivački sud, natjecanja, natjecatelji, Stojan Stojanov Gančev, skladbe, solo pjesme, arija, glazbene škole" />
        <meta name="robots" content="index, follow" />
        <meta name="copyright" content="Musica Zagreb">
        <link rel="icon" type="image/png" href="images/favicon.ico" />

		<title>Musica Zagreb | Muzičko Natjecanje</title>

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
                        <li><a class="a-click" href="intro-text">Uvodna riječ</a></li>
                        <li><a class="a-click" href="rule-info">Pravilnik natjecanja</a></li>
                        <li><a href="singing.php">Pjevačko natjecanje</a></li>
                        <li><a href="piano.php">Klavirsko natjecanje</a></li>
                        <li><a href="violin.php">Violinističko natjecanje</a></li>
                    </ul>
                </nav>
            </div>
            <div class="col-xs-12 col-md-9 header-title">
                <h1>Online</br>Međunarodno natjecanje</br>Mladih glazbenika</br>Zagreb 2021.</h1>
            </div>
        </div>
        <div class="col-md-12 header-contact">info&#64;zagrebmusiccompetition&#46;com</div>
    </div>
</header>