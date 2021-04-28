<?php
    require('../include/services/config.php');
    require('../include/services/connection.php');
    $errors = [];

    $navQuery = "SELECT * FROM `nav` ORDER BY `priority`";
    $execNav = $pdo->query($navQuery);
    $dataNav = $execNav -> fetchAll();

    if(isset($_POST['apply'])){
    

        $fname = $_POST['fname']; //verify
        $lname = $_POST['lname']; //verify
        $bdate = $_POST['bdate']; //verify
        $nationality = $_POST['nationality']; //verify
        $prof = $_POST['prof'];
        $city = $_POST['city'];
        $country = $_POST['country']; //verify
        $email = $_POST['mail']; //verify
        $phone = $_POST['phone'];
    
        $regExBdate = "/^([0-2][0-9]|(3)[0-1])(\/)(((0)[0-9])|((1)[0-2]))(\/)\d{4}$/";
        $regExYoutube = "/^((?:https?:)?\/\/)?((?:www|m)\.)?((?:youtube\.com|youtu.be))(\/(?:[\w\-]+\?v=|embed\/|v\/)?)([\w\-]+)(\S+)?$/";
    
        $link1 = $_POST['link1'];
        $link2 = $_POST['link2'];
        $link3 = $_POST['link3'];
        $link4 = $_POST['link4'];
        $link5 = $_POST['link5'];
        $link6 = $_POST['link6'];
        $link7 = $_POST['link7'];
        $link8 = $_POST['link8'];
    
        $pname = $_FILES['payment']['name'];
        $ptype = $_FILES['payment']['type'];
        $psize = $_FILES['payment']['size'];
        $ptemp = $_FILES['payment']['tmp_name'];			
        $ppath="../upload/".$pname; //set upload folder path    
    
        $docname = $_FILES['document']['name'];
        $doctype = $_FILES['document']['type'];
        $docsize = $_FILES['document']['size'];
        $doctemp = $_FILES['document']['tmp_name'];
        $docpath ="../upload/".$docname; //set upload folder path    
    
    
        $directory="../upload/"; //set upload folder path for update time previous file remove and new file upload for next use
    
    
        $category = $_POST['category'];
        $composition = $_POST['composition'];
    
    
        if ($fname == null){
            $errors[] = "Ime mora biti upisano";
        }
    
        if ($lname == null){
            $errors[] = "Prezime mora biti upisano";
        }
    
        if ($bdate == null){
            $errors[] = "Datum rođenja mora biti upisan";
        }
        
        if($nationality == null) {
            $errors[] = "Nacionalnost mora biti upisana";
        }
    
        if($country == null) {
            $errors[] = "Država mora biti upisana";
        }
    
        if(!preg_match($regExBdate, $bdate)){
            $errors[] = "Datum rođenja mora pratiti 'dan/mjesec/godina' format";
        }
    
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $errors[] = "E-mail adresa nije u korektnom formatu";
        } else if ($email == null) {
            $errors[] = "E-mail adresa mora biti upisana";
        }
    
        if($link1 == null && $link2 == null  && $link3 == null  && $link4 == null  && $link5 == null  && $link6 == null  && $link7 == null  && $link8 == null ){
            $errors[] = "Mora postojati bar jedan link";
        }
    
        if($link1 != null && !preg_match($regExYoutube, $link1)){
            $errors[] = "Prvi link nije dobro unet";
        }
        if($link2 != null && !preg_match($regExYoutube, $link2)){
            $errors[] = "Drugi link nije dobro unet";
        }
        if($link3 != null && !preg_match($regExYoutube, $link3)){
            $errors[] = "Treći link nije dobro unet";
        }
        if($link4 != null && !preg_match($regExYoutube, $link4)){
            $errors[] = "Četvrti link nije dobro unet";
        }
        if($link5 != null && !preg_match($regExYoutube, $link5)){
            $errors[] = "Peti link nije dobro unet";
        }
        if($link6 != null && !preg_match($regExYoutube, $link6)){
            $errors[] = "Šesti link nije dobro unet";
        }
        if($link7 != null && !preg_match($regExYoutube, $link7)){
            $errors[] = "Sedmi link nije dobro unet";
        }
        if($link8 != null && !preg_match($regExYoutube, $link8)){
            $errors[] = "Osmi link nije dobro unet";
        }
    
        if($pname == null) {
            $errors[] = "Dokaz uplate je obavezna stavka";
        }
    
        if($pname) {
             if($psize > 5000000){
                $errors[] = "Dokaz uplate ne sme biti fajl veći od 5MB";
            }
        }
    
        if($docname == null) {
            $errors[] = "Identifikacijski dokument je obavezna stavka";
        }
    
        if($pname) {
             if($psize > 5000000){
                $errors[] = "Identifikacijski dokument ne sme biti fajl veći od 5MB";
            }
        }
    
        if($category == ''){
            $errors[] = "Kategorija mora biti izabrana";
        }
        if($composition  == ''){
            $errors[] = "Sastav mora biti izabran";
        }
    
        if(count($errors) == 0) {
        
            $query = "INSERT INTO `singing` (`id`, `fname`, `lname`, `bdate`, `nationality`, `prof`, `city`, `country`, `email`, `phone`, `link1`, `link2`, `link3`, `link4`, `link5`, `link6`, `link7`, `link8`, `category`, `composition`, `pname`, `ptype`, `docname`, `doctype`) 
                        VALUES (NULL, :fname, :lname, :bdate, :nationality, :prof, :city, :country, :email, :phone, :link1, :link2, :link3, :link4, :link5, :link6, :link7, :link8, :category, :composition, :pname, :ptype, :docname, :doctype)";
            
            $prepare = $pdo->prepare($query);
            $prepare->bindParam(":fname", $fname);
            $prepare->bindParam(":lname", $lname);
            $prepare->bindParam(":bdate", $bdate);
            $prepare->bindParam(":nationality", $nationality);
            $prepare->bindParam(":prof", $prof);
            $prepare->bindParam(":city", $city);
            $prepare->bindParam(":country", $country);
            $prepare->bindParam(":email", $email);
            $prepare->bindParam(":phone", $phone);
    
            
            $prepare->bindParam(":link1", $link1);
            $prepare->bindParam(":link2", $link2);
            $prepare->bindParam(":link3", $link3);
            $prepare->bindParam(":link4", $link4);
            $prepare->bindParam(":link5", $link5);
            $prepare->bindParam(":link6", $link6);
            $prepare->bindParam(":link7", $link7);
            $prepare->bindParam(":link8", $link8);
    
            $prepare->bindParam(":category", $category);
            $prepare->bindParam(":composition", $composition);
    
            $prepare->bindParam(":pname", $pname);
            $prepare->bindParam(":ptype", $ptype);
    
            $prepare->bindParam(":docname", $docname);
            $prepare->bindParam(":doctype", $doctype);
    
    
            move_uploaded_file($ptemp, "../upload/" . $pname);
            move_uploaded_file($doctemp, "../upload/" . $docname);
    
            try {
                $execute = $prepare->execute();
                header('Location: '.$path);
                exit;
    
            } catch(PDOException $ex) {   
                var_dump($ex);         
            }
        } 
    }

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

		<title>Zagreb Music Competition</title>

		<!-- Font Awesome Icon -->
		<link rel="stylesheet" href="../assets/css/font-awesome.min.css">

		<!-- Custom stlylesheet -->
		<link type="text/css" rel="stylesheet" href="../assets/css/style.css"/>
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
                        <li><a href="index.php#intro-text">Intro</a></li>
                        <li><a href="index.php#rule-info">Rules</a></li>
                        <li><a href="singingEN.php">Singing Competition</a></li>
                        <li><a href="singingResultsEN.php">Singing Competition - Results</a></li>
                        <li><a href="pianoEN.php">Piano Competition</a></li>
                        <li><a href="#">Violin competition</a></li>
                    </ul>
                    <!-- <ul> -->
                        <?php //foreach($dataNav as $rowNav){ ?>
                            <!-- <li><a href="<?php //echo $rowNav['href']?>"><?php //echo $rowNav['name']?></a></li> -->
                        <?php   //} ?>

                    <!-- </ul> -->
                </nav>
            </div>
            <div class="col-xs-12 col-md-9 header-title">
                <h1>Online</br>International Competition</br>of Young Musicians</br>Zagreb 2021.</h1>
            </div>
        </div>
        <div class="col-md-12 header-contact">info&#64;zagrebmusiccompetition&#46;com</div>
    </div>
</header>
<main>
    <div class="main container">
    <div class="language-select">
        <p><a href="../violin.php">Croatian</a> | <a href="#">English</a></p>
    </div>
        <div class="main-block">
            <div class="row center">
                <div class="col-xs-6 col-md-12">
                    <div class="main-segment-title">
                        <h2>Violin Competition</h2>
                        <h4>05.06.2021. - 10.06.2021.</h4>
                    </div>
                </div>
            </div>
        </div>
        <!--
        <div class="main-block">
            <div class="row center">
                <div class="col-xs-6 col-md-12">
                    <div class="main-segment-title">
                        <h2>Announcements</h2>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-md-12 main-segment-about-text-announcement">
                <p>GRAND PRIX award "Stojan Stojanov" in the amount of 500 euros
                    enables the Stojanov family</br></br>

                    Special awards</br>
                    Rucner Quartet Award - performance in the 2021/2022 season in the concert hall of V. Lisinski</br>
                    Award of the Croatian Chamber Orchestra - performance with the orchestra</br>
                </p>
            </div>
            <div class="col-xs-12 col-md-12 main-segment-about-text-announcement">
                <p>Dear Singers,</br></br>
                    Because of your inquiries and interest, we are extending the application deadline to the 18th of April, 2021.</br></br>
                    Musica Zagreb
                </p>
            </div>
        </div>
        -->
        <div class="comp-wrap singing">
            <div class="main-block">
                <div class="row center">
                    <div class="col-xs-6 col-md-12">
                        <div class="main-segment-title">
                            <h2>Ludmilla Weiser</h2>
                        </div>
                    </div>
                </div>
                <div class="row center main-segment-about">
                    <div class="col-xs-12 col-md-4 main-segment-about-photos">
                        <!-- First Img -->
                        <div class="gancev-img">
                            <img src="../assets/images/ludmilla.png" alt="Ludmilla Weiser">
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-8 main-segment-about-text">
                        <p style="font-size: 20px">...each violin has it's secret and, as you may see, only in the artist's hands does the secret of the violin transforms into a riddle even more mysterious, because the player's hand is a powerful force, conveying heartbeat, and flickering of the nerves into strings...
                        </p>
                        <p>Miroslav Krleža: "Zastave"</p>
                    </div>
                </div>  
            
            
            
                <div class="main-block">
                    <div class="row center">
                        <div class="col-xs-6 col-md-12">
                            <div class="main-segment-title">
                                <h2>Biography</h2>
                            </div>
                        </div>
                    </di+v>
                    <div class="row center main-segment-about-gancev">
                        <div class="col-xs-12 col-md-8 main-segment-about-gancev-text">
                            <p>
                            Ludmilla Aloysia Weiser was born 9th of August 1847. in Zagreb. Her father was renowned master luthier Ivan Nepomuk Weiser, one of the first professional luthiers in Zagreb. Because of his quality tamburas Franjo Ks. Kuhač called him „Amatti of tambura”, and is important to notice that he was one of the earliest in Zagreb who created, maintained and repaired the instruments of HGZ. In 1856. Ludmilla started attending classes of Antun Schwarz at the Musical school of HGZ. She displayed exceptional skill and talent already at the pupil productions, which made her known to the wider audience as musical artist. Compositions of Antun Schwarz which were dedicated to Ludmilla bear testament to her immense talent.                  
                            </p>
                        </div>
                        <div class="col-xs-12 col-md-4 main-segment-about-photos">
                            <!-- First Img -->
                            <div class="first-img">
                                <img src="../assets/images/ludmilla1.png" alt="Photo by Carsten Kohler from Pexels">
                            </div>
                            <!-- Second Img -->
                            <div class="second-img">
                                <img src="../assets/images/ludmilla.png" alt="Photo by Jonas Togo from Pexels">
                            </div>
                        </div>
                    </div> 
                    <a href="ludmillaEN.php"><div class="col-md-12 main-segment-title"><h3>More...</h3></div></a>
                </div>

                <!-- Propositions -->
                <div class="main-block">
                    <div class="row center">
                        <div class="col-xs-6 col-md-12">
                            <div class="main-segment-title">
                                <h2>Propositions</h2>
                            </div>
                        </div>
                    </div>
                    <div class= "row center between main-segment-propositions">
                        <div class="divTable">
                            <div class="divTableBody">
                            <div class="divTableRow">
                                    <div class="divTableCell">NOTE:</div>
                                    <div class="divTableCell text">COMPETITORS DO NOT HAVE TO COMPLETE THE MAXIMUM MINUTE SET BY CATEGORIES
                                    </div>
                                </div>
                                <div class="divTableRow">
                                    <div class="divTableCell">Precategory A</div>
                                    <div class="divTableCell text">Competitors born in 2014 and younger</br>Two compositions of your choice up to 5 minutes
                                    </div>
                                </div>
                                <div class="divTableRow">
                                    <div class="divTableCell">Precategory B</div>
                                    <div class="divTableCell text">Competitors born in 2012 and younger</br>Two compositions of your choice up to 5 minutes
                                    </div>
                                </div>
                                <div class="divTableRow">
                                    <div class="divTableCell">Category 1</div>
                                    <div class="divTableCell text">Competitors born in 2011</br>Two compositions of your choice up to 7 minutes
                                    </div>
                                </div>
                                <div class="divTableRow">
                                    <div class="divTableCell">Category 2</div>
                                    <div class="divTableCell text">Competitors born in 2010</br>Two compositions of your choice up to 9 minutes
                                    </div>
                                </div>
                                <div class="divTableRow">
                                    <div class="divTableCell">Category 3</div>
                                    <div class="divTableCell text">Competitors born in 2009</br>Two compositions of your choice up to 11 minutes
                                    </div>
                                </div>
                                <div class="divTableRow">
                                    <div class="divTableCell">Category 4</div>
                                    <div class="divTableCell text">Competitors born in 2008</br>Two compositions of your choice up to 13 minutes
                                    </div>
                                </div>
                                <div class="divTableRow">
                                    <div class="divTableCell">Category 5</div>
                                    <div class="divTableCell text">Competitors born in 2007</br>Two compositions of your choice up to 15 minutes
                                    </div> 
                                </div>
                                <div class="divTableRow">
                                    <div class="divTableCell">Category 6</div>
                                    <div class="divTableCell text">Competitors born in 2006</br>Two compositions of your choice up to 17 minutes
                                    </div>
                                </div>
                                <div class="divTableRow">
                                    <div class="divTableCell">Category 7</div>
                                    <div class="divTableCell text">Competitors born in 2004 and younger</br>Program of your choice up to 20 minutes
                                    </div>
                                </div>
                                <div class="divTableRow">
                                    <div class="divTableCell">Category 8</div>
                                    <div class="divTableCell text">Competitors born in 2002 and younger</br>Program of your choice up to 25 minutes
                                    </div>
                                </div>
                                <div class="divTableRow">
                                    <div class="divTableCell">Fees</div>
                                    <div class="divTableCell text">Precategory A i B - 35 €</br>
                                        1st, 2nd, 3rd and 4th category - 35€</br>
                                        5th, 6th, 7th, and 8th category - 40 € </br></br>
                                        The registration fee is to be paid to the account:</br>
                                        Zagrebačka banka d.d.</br>
                                        Trg bana Jelačića 10</br>
                                        10000 Zagreb</br>
                                        IBAN:HR9623600001102900185</br>
                                        SWIFT:ZABA HR 2X</br>
                                        In case of cancellation of the candidate, the registration fee is not refundable. 
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Judges -->
                <div class="main-block">
                    <div class="row center">
                        <div class="col-xs-6 col-md-12">
                            <div class="main-segment-title">
                                <h2>Jury</h2>
                            </div>
                        </div>
                    </div>
                    <div class= "row center between main-segment-judges">
                        <div class="col-xs-12 col-md-4 main-segment-judges-single">
                            <div class="main-segment-judges-single-img">
                                <img src="../assets/images/aVeskov.jpg" alt="Ana Veskov" />
                            </div>
                            <h3 class="main-segment-judges-single-title">Ana Veskov</h3>
                            <div class="main-segment-judges-single-text">
                            Ana Veskov was born and raised in Belgrade. She finished Primary music school “Mokranjac” in the class of prof. Vlajko Savković, and she graduated from Musical High School “Stanković” in Belgrade, in the class of prof. Olga Bešević. Having successfully passed three entrance examinations for full-time studies in Belgrade, Sofia and Russia, she decided to continue further education in Leningrad, modern St. Petersburg, city which was celebrated by some of the most famous global musicians, writers and painters… 
                            </div>
                            <a href="aVeskovEN.php"><div class="main-segment-judges-single-button">
                                More...
                            </div></a>
                        </div>
                        <div class="col-xs-12 col-md-4 main-segment-judges-single">
                            <div class="main-segment-judges-single-img">
                                <img src="../assets/images/mKotor.jpg" alt="Myroslava Kotorovych" />
                            </div>
                            <h3 class="main-segment-judges-single-title">Myroslava Kotorovych</h3>
                            <div class="main-segment-judges-single-text">
                            Myroslava Kotorovych was born in Kyiv in a family of musicians: the outstanding violinist Bohodar Kotorovych and harpist Natalia Kmet. She graduated from Kyiv Specialized Secondary Music boarding school named after M. V. Lysenko, the National Music Academy of Ukraine . Myroslava considers her ten-year concert activity as a member of Gidon Kremer's chamber orchestra "Kremerata Baltica" to be her "practical European conservatory".  
                            </div>
                            <a href="mKotorEN.php"><div class="main-segment-judges-single-button">
                                More...
                            </div></a>
                        </div>
                        <div class="col-xs-12 col-md-4 main-segment-judges-single">
                            <div class="main-segment-judges-single-img">
                                <img src="../assets/images/lBobic.jpg" alt="Lidija Bobić" />
                            </div>
                            <h3 class="main-segment-judges-single-title">Lidija Bobić</h3>
                            <div class="main-segment-judges-single-text">
                            Lidija Bobić was born in Varaždin, where she graduated from Musical Secondary School. She continues her education on the National Conservatory „P.I. Tchaikovsky” in Kyev, Ukraine, in the class of prof. Taras Pecheny, who introduces her with the Russian violin school and work of prof. Yuri Jankeleyevich, one of the most eminent violin pedagogues of Moscow. She graduated in 1994. in the class of prof. Igor Andrievsky. During her studies she attended the classes of pedagogy practice.
                            </div>
                            <a href="lBobicEN.php"><div class="main-segment-judges-single-button">
                                More...
                            </div></a>
                        </div>
                    </div>
                </div>

                <<!-- Application form 
                <div class="main-block">
                    <div class="row center">
                        <div class="col-xs-6 col-md-12">
                            <div class="main-segment-title">
                                <h2>Application</h2>
                            </div>
                        </div>
                    </div>
                    <div class="row center between main-segment-application">
                        <div class="main-segment-application-form">
                            <form id="form" action="#form" method="POST" enctype="multipart/form-data">
                                <input type="text" name="fname" placeholder="First Name" value="<?php echo isset($_POST["fname"]) ? $_POST["fname"] : ''; ?>"/>
                                <input type="text" name="lname" placeholder="Last Name" value="<?php echo isset($_POST["lname"]) ? $_POST["lname"] : ''; ?>"/>
                                <input type="text" name="bdate" placeholder="DD/MM/YYYY" value="<?php echo isset($_POST["bdate"]) ? $_POST["bdate"] : ''; ?>" />
                                <input type="text" name="nationality" placeholder="Nationality" value="<?php echo isset($_POST["nationality"]) ? $_POST["nationality"] : ''; ?>"/>
                                <input type="text" name="prof" placeholder="Professor" value="<?php echo isset($_POST["prof"]) ? $_POST["prof"] : ''; ?>"/>

                                <input type="text" name="city" placeholder="City" value="<?php echo isset($_POST["city"]) ? $_POST["city"] : ''; ?>"/>
                                <input type="text" name="country" placeholder="Country" value="<?php echo isset($_POST["country"]) ? $_POST["country"] : ''; ?>"/>
                                </br>
                                <input type="mail" name="mail" placeholder="E-mail" value="<?php echo isset($_POST["mail"]) ? $_POST["mail"] : ''; ?>"/>
                                <input type="text" name="phone" placeholder="Phone" value="<?php echo isset($_POST["phone"]) ? $_POST["phone"] : ''; ?>"/>
        
                                </br></br>

                                <div class="row center space-around selects">
                                    <div class="custom-select">
                                        <select name="category">
                                            <option selected value="">Category...</option>
                                            <option value="Pretkategorija A">Precategory A</option>
                                            <option value="Pretkategorija B">Precategory B</option>
                                            <option value="I/A">I/A</option>
                                            <option value="I/B">I/B</option>
                                            <option value="II/A">II/A</option>
                                            <option value="II/B">II/B</option>
                                            <option value="III/A">III/A</option>
                                            <option value="III/B">III/B</option>
                                            <option value="IV">IV</option>
                                            <option value="V/A">V/A</option>
                                            <option value="V/B">V/B</option>
                                            <option value="VI">VI</option>
                                            <option value="VII">VII</option>
                                            <option value="VIII">VIII</option>                            
                                        </select>
                                    </div>
                                    
                                    <div class="custom-select">
                                        <select name="composition">
                                            <option selected value="">Number of competitors...</option>
                                            <option value="Solo">Solo</option>
                                            <option value="Duet">Duet</option>
                                            <option value="Ansambl">Ensemble</option>
                                        </select>
                                    </div>
                                </div>

                                </br></br>

                                <label>Proof of payment</label>
                                <input type="file" name="payment" />

                                <label>Identification document</label>
                                <input type="file" name="document" />

                                </br></br>

                                <input type="text" name="link1" placeholder="YouTube link" value="<?php echo isset($_POST["link1"]) ? $_POST["link1"] : ''; ?>"/>
                                <input type="text" name="link2" placeholder="YouTube link" value="<?php echo isset($_POST["link2"]) ? $_POST["link2"] : ''; ?>"/>
                                <input type="text" name="link3" placeholder="YouTube link" value="<?php echo isset($_POST["link3"]) ? $_POST["link3"] : ''; ?>"/>
                                <input type="text" name="link4" placeholder="YouTube link" value="<?php echo isset($_POST["link4"]) ? $_POST["link4"] : ''; ?>"/>
                                <input type="text" name="link5" placeholder="YouTube link" value="<?php echo isset($_POST["link5"]) ? $_POST["link5"] : ''; ?>"/>
                                <input type="text" name="link6" placeholder="YouTube link" value="<?php echo isset($_POST["link6"]) ? $_POST["link6"] : ''; ?>"/>
                                <input type="text" name="link7" placeholder="YouTube link" value="<?php echo isset($_POST["link7"]) ? $_POST["link7"] : ''; ?>"/>
                                <input type="text" name="link8" placeholder="YouTube link" value="<?php echo isset($_POST["link8"]) ? $_POST["link8"] : ''; ?>"/>

                                </br></br>
                                
                                <input type="submit" name="apply" value="Send!" />
                            </form>	
                            <?php 
                            
                            if(count($errors) > 0) { 
                            foreach($errors as $error) {?>
                                <div class="errors">
                                    <?php echo($error); ?>
                                </div>
                            <?php } } else {
                                        $_SESSION['errors'] = $errors;
                                    }?>
                        </div>
                    </div>
                </div>-->
            </div>
        </div>
</main>

<footer>
    <div class="row center space-between footer">
        <div class="col-xs-12 col-md-6">
            <p>Contact information | E-Mail: info&#64;musiccompetitionzagreb&#46;com</p>
        </div>
        <div class="col-xs-12 col-md-6">
            <p>Website by Filip Vušković | v1.0 </p>
        </div>
    </div>
</footer>
<script src="../assets/js/scripts.js"></script>
</body>
</html>