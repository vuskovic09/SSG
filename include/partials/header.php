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
    <div class="header-hero">
        <div class="header-filter">
            <nav class="header-hero-nav">
                <ul>
                    <?php foreach($dataNav as $rowNav){ ?>
                        <li><a href="<?php echo $path . $rowNav['href']?>"><?php echo $rowNav['name']?></a></li>
                    <?php   } ?>
                </ul>
            </nav>
        </div>
    </div>
</header>