<?php
    require('../include/services/config.php');
    require('../include/services/connection.php');
    $errors = [];

    $navQuery = "SELECT * FROM `nav` ORDER BY `priority`";
    $execNav = $pdo->query($navQuery);
    $dataNav = $execNav -> fetchAll();

    if(isset($_POST['apply-piano'])){


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
        
            $query = "INSERT INTO `piano` (`id`, `fname`, `lname`, `bdate`, `nationality`, `prof`, `city`, `country`, `email`, `phone`, `link1`, `link2`, `link3`, `link4`, `link5`, `link6`, `link7`, `link8`, `category`, `composition`, `pname`, `ptype`, `docname`, `doctype`) 
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
                        <li><a href="#">Piano Competition</a></li>
                        <li><a href="violinEN.php">Violin Competition</a></li>
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
                <p><a href="../piano.php">Croatian</a> | <a href="#">English</a></p>
            </div>
        <div class="main-block">
            <div class="row center">
                <div class="col-xs-6 col-md-12">
                    <div class="main-segment-title">
                        <h2>Piano Competition</h2>
                        <h4>20.05.2021. - 25.05.2021.</h4>
                    </div>
                </div>
            </div>
        </div>
        

        <div class="comp-wrap piano">
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
                                <div class="divTableCell">Kotizacija</div>
                                <div class="divTableCell text">
                                    Pre-category A and B - 35 €</br>
                                    category A, B, C, D - 40 €</br>
                                    category E, F, G - 45 €</br>
                                    category H, I, J - 50 €</br>
                                    category K, L - 60 €</br>
                                    category N, M - 60 € per piano duo</br>
                                    category O, Q - 70 € per piano duo</br>
                                    category R, S - 70 € per ensemble</br>
                                    category T, U - 80 € per ensemble</br>
                                    Payment of registration fees is made to the account of the Organizer MUSICA ZAGREB:</br></br>
                                    Zagrebačka banka d.d.</br>
                                    Ban Jelacic Square 10</br>
                                    10000 Zagreb</br>
                                    IBAN: HR9623600001102900185</br>
                                    SWIFT: ZABA HR 2X
                                </div>
                            </div>
                        <div class="divTableRow">
                                <div class="divTableCell">Piano solo - note</div>
                                <div class="divTableCell text">a) Candidates in pre-category A and B and candidates in categories A to D perform at least two compositions of different character and tempo</br>
                                b) Candidates, students, and artists from category E to category L perform at least two compositions of the different stylistic period</br>
                                c) Candidates, students, and artists do not have to meet the maximum minutes given by category
                                </div>
                            </div>
                            <div class="divTableRow">
                                <div class="divTableCell">Pre Category A</div>
                                <div class="divTableCell text">Candidates born in 2013 and younger</br></br> Free choice program of 4 - 6 minutes</div>
                            </div>
                            <div class="divTableRow">
                                <div class="divTableCell">Pre Category B</div>
                                <div class="divTableCell text">Candidates born in 2011 and younger</br></br> Free choice program of 4 - 6 minutes</div>
                            </div>
                            <div class="divTableRow">
                                <div class="divTableCell">Category A</div>
                                <div class="divTableCell text">Candidates born in 2010</br></br> Program of your choice from 6 to 8 minutes</div>
                            </div>
                            <div class="divTableRow">
                                <div class="divTableCell">Category B</div>
                                <div class="divTableCell text">Candidates born in 2009</br></br>Program of your choice from 7 to 9 minutes</div>
                            </div>
                            <div class="divTableRow">
                                <div class="divTableCell">Category C</div>
                                <div class="divTableCell text">Kandidati rođeni 2008. godine</br></br>Program po slobodnom izboru od 8 do 10 minutau</div>
                            </div>
                            <div class="divTableRow">
                                <div class="divTableCell">Category D</div>
                                <div class="divTableCell text">Candidates born in 2007</br></br>Program of your choice up to 12 minutes</div>
                            </div>
                            <div class="divTableRow">
                                <div class="divTableCell">Category E</div>
                                <div class="divTableCell text">Candidates born in 2005 and 2006</br></br>Program of your choice up to 15 minutes</div>
                            </div>
                            <div class="divTableRow">
                                <div class="divTableCell">Category F</div>
                                <div class="divTableCell text">Candidates born in 2003 and 2004</br></br>Free choice program up to 17 minutes</div>
                            </div>
                            <div class="divTableRow">
                                <div class="divTableCell">Category G</div>
                                <div class="divTableCell text">Candidates born in 2001 and 2002</br></br>Program of your choice up to 20 minutes</div>
                            </div>
                            <div class="divTableRow">
                                <div class="divTableCell">Category H</div>
                                <div class="divTableCell text">1st and 2nd-year students of the Music Academy</br></br>Program of your choice up to 20 minutes</div>
                            </div>
                            <div class="divTableRow">
                                <div class="divTableCell">Category I</div>
                                <div class="divTableCell text">3rd and 4th-year students of the Music Academy</br></br>Program of your choice up to 25 minutes</div>
                            </div>
                            <div class="divTableRow">
                                <div class="divTableCell">Category J</div>
                                <div class="divTableCell text">Students of the 5th year of the Music Academy</br></br>Program of your choice up to 30 minutes</div>
                            </div>
                            <div class="divTableRow">
                                <div class="divTableCell">Category K</div>
                                <div class="divTableCell text">Young artists born in 1990 and younger</br></br>Free choice program up to 40 minutes</div>
                            </div>
                            <div class="divTableRow">
                                <div class="divTableCell">Category L</div>
                                <div class="divTableCell text">Artists born before January 1, 1990, without age limit</br></br>Program of your choice up to 50 minutes</div>
                            </div>
                            <div class="divTableRow">
                                <div class="divTableCell">Piano duo; piano four hands and two pianos - note</div>
                                <div class="divTableCell text">a) Candidates in categories N to Q perform a minimum of two compositions of different stylistic periods</br> b) Compositions may be composed originally for piano four hands or two pianos, or transcriptions for piano four hands or transcriptions for two pianos.</br> c) The piano duo may, if they wish, combine in their program compositions composed originally for piano four hands or two pianos or transcriptions for piano four hands or transcriptions for two pianos</br> d) Candidates, students, and artists do not have to meet the maximum minutes given by category</br></div>
                            </div>
                            <div class="divTableRow">
                                <div class="divTableCell">Category N</div>
                                <div class="divTableCell text">Candidates born in 2010 and younger</br></br>Program of your choice up to 10 minutes</div>
                            </div>
                            <div class="divTableRow">
                                <div class="divTableCell">Category M</div>
                                <div class="divTableCell text">Candidates born in 2005 and younger</br></br>Program of your choice up to 15 minutes</div>
                            </div>
                            <div class="divTableRow">
                                <div class="divTableCell">Category O</div>
                                <div class="divTableCell text">CCandidates and students of the Academy of Music born in 2000 and younger</br></br>Program of your choice up to 20 minutes</div>
                            </div>
                            <div class="divTableRow">
                                <div class="divTableCell">Category Q</div>
                                <div class="divTableCell text">Artists born before January 1, 2000, without age limit</br></br>Program of your choice up to 30 minutes</div>
                            </div>
                            <div class="divTableRow">
                                <div class="divTableCell">Piano enThe piano ensemble must have at least three performers, at least one of which must be at the piano (eg, six-handed piano, piano trio, piano quartet, piano quintet ...)</br> b) Piano ensembles in categories from R to U perform at least two compositions of the different stylistic period</br> c) Compositions can be composed originally for piano ensemble or transcriptions for piano ensemble</br> d) Candidates, students, and artists do not have to meet the maximum minutes given by category</br></div>
                            </div>
                            <div class="divTableRow">
                                <div class="divTableCell">Category R</div>
                                <div class="divTableCell text">Candidates born in 2010 and younger</br></br>Program of your choice up to 10 minutes </div>
                            </div>
                            <div class="divTableRow">
                                <div class="divTableCell">Category S</div>
                                <div class="divTableCell text">Candidates born in 2005 and younger</br></br>PProgram of your choice up to 15 minutes</div>
                            </div>
                            <div class="divTableRow">
                                <div class="divTableCell">Category T</div>
                                <div class="divTableCell text">Candidates and students of the Academy of Music born in 2000 and younger</br></br>Program of your choice up to 20 minutes</div>
                            </div>
                            <div class="divTableRow">
                                <div class="divTableCell">Category U</div>
                                <div class="divTableCell text">Artists born before January 1, 2000, without age limit</br></br>Program of your choice up to 30 minutes</div>
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
                            <img src="../assets/images/manana.jpg" alt="Vladimir Kandelaki" />
                        </div>
                        <h3 class="main-segment-judges-single-title">Manana Kandelaki</h3>
                        <div class="main-segment-judges-single-text">
                        She was born in Georgia, in a family of famous musicians, among whom was V. Kandelaki, a
                        famous Soviet singer, actor, film director, national artist of the USSR. Her father, Vladimir
                        Kandelaki, is a singer, opera soloist, professor, national artist of Georgia, and her mother is Medea
                        Tsirgiladze, a pianist and professor.
                        In 1975, she graduated from the Z. Paliashvili Special Music School for Particularly Gifted
                        Children at the Saradjishvili Conservatory in Tbilisi, where she studied in the class of Honorary
                        Artist, Professor M. Chavchanidze. She enrolled in the Moscow State Conservatory P. I. Tchaikovsky in the class of Professor L. Naumov.
                        </div>
                        <a href="manana.php"><div class="main-segment-judges-single-button">
                            Još...
                        </div></a>
                    </div>                
                    <div class="col-xs-12 col-md-4 main-segment-judges-single">
                        <div class="main-segment-judges-single-img">
                            <img src="../assets/images/nKacar.jpg" alt="Nenad Kacar" />
                        </div>
                        <h3 class="main-segment-judges-single-title">Nenad Kačar</h3>
                        <div class="main-segment-judges-single-text">
                        Croatian pianist and pedagogue Nenad Kačar was born in 1965 in Zagreb.
                        He has been involved with music since his early childhood, and as a five-year-old, he
                        had his first public performance. During his schooling through he sensitized the public
                        through numerous concerts, and gets noticed which, in return, made it possible to to
                        obtain prestigious national scholarships.
                        He studied and graduated at the Zagreb Academy of Music in the class of a prominent
                        Croatian pianist and professor, academician Jurica Muraja. He continued his training
                        with numerous pianists, E. Timakin, M. Lorković A. Preger, R. Kerer, M. Farre and I.
                        Žukov.
                        </div>
                        <a href="nKacar.php"><div class="main-segment-judges-single-button">
                            Još...
                        </div></a>
                    </div>
                    <div class="col-xs-12 col-md-4 main-segment-judges-single">
                        <div class="main-segment-judges-single-img">
                            <img src="../assets/images/nMitrovic.jpg" alt="Arijana Gigliani" />
                        </div>
                        <h3 class="main-segment-judges-single-title">Nataša Mitrović</h3>
                        <div class="main-segment-judges-single-text">
                        Natasha Mitrovic, pianist, is a native of Belgrade.
                        She received her undergraduate and graduate degrees with
                        excellent results at the Music Academy in Belgrade where she now
                        teaches piano.
                        Further studies included studies in Vienna with prof. Avo
                        Kouyoumdjian and piano studies with prof. Jan Novotny in
                        Prague.
                        Natasha Mitrovic was the only artist from Serbia to be awarded
                        Fulbright scholarship in year 2004. During her Fulbright grant, Ms.
                        Mitrovic studied at the University of Michigan (Ann Arbor), at
                        Julliard University (New York) and at de Paul University
                        (Chicago) where she performed extensively with great acclaim.
                        </div>
                        <a href="nMitrovic.php"><div class="main-segment-judges-single-button">
                            Još...
                        </div></a>
                    </div>
                </div>
            </div>

            <!-- Application form -->
            <div class="main-block-last">
                <div class="row center">
                    <div class="col-xs-6 col-md-12">
                        <div class="main-segment-title">
                            <h2>Application</h2>
                        </div>
                    </div>
                </div>
                <div class="row center between main-segment-application">
                    <div class="main-segment-application-form">
                        <form id="form-piano" action="#form-piano" method="POST" enctype="multipart/form-data" onsubmit="return formValidation(event)">
                            <input type="text" name="fname" placeholder="First Name" value="<?php echo isset($_POST["fname"]) ? $_POST["fname"] : ''; ?>"/>
                            <input type="text" name="lname" placeholder="Last Name" value="<?php echo isset($_POST["lname"]) ? $_POST["lname"] : ''; ?>"/>
                            <input type="text" name="bdate" placeholder="DD/MM/YYYY" value="<?php echo isset($_POST["bdate"]) ? $_POST["bdate"] : ''; ?>" />
                            <input type="text" name="nationality" placeholder="Nationality" value="<?php echo isset($_POST["nationality"]) ? $_POST["nationality"] : ''; ?>"/>
                            <input type="text" name="prof" placeholder="Professor" value="<?php echo isset($_POST["prof"]) ? $_POST["prof"] : ''; ?>"/>

                            <input type="text" name="city" placeholder="City" value="<?php echo isset($_POST["city"]) ? $_POST["city"] : ''; ?>"/>
                            <input type="text" name="country" placeholder="Country" value="<?php echo isset($_POST["country"]) ? $_POST["country"] : ''; ?>"/>
                            <input type="mail" name="mail" placeholder="E-mail" value="<?php echo isset($_POST["mail"]) ? $_POST["mail"] : ''; ?>"/>
                            <input type="text" name="phone" placeholder="Phone" value="<?php echo isset($_POST["phone"]) ? $_POST["phone"] : ''; ?>"/>

                            </br></br>

                            <div class="row center space-around selects">
                                <div class="custom-select">
                                    <select name="category">
                                        <option selected value="">Category...</option>
                                        <option value="Pretkategorija A">Pre Category A</option>
                                        <option value="Pretkategorija B">Pre Category B</option>
                                        <option value="A">Category A</option>
                                        <option value="B">Category B</option>
                                        <option value="C">Category C</option>
                                        <option value="D">Category D</option>
                                        <option value="E">Category E</option>
                                        <option value="F">Category F</option>
                                        <option value="G">Category G</option>
                                        <option value="H">Category H</option>
                                        <option value="I">Category I</option>
                                        <option value="J">Category J</option>
                                        <option value="K">Category K</option>
                                        <option value="L">Category L</option>        
                                        <option value="N">Category N</option>
                                        <option value="M">Category M</option>
                                        <option value="O">Category O</option>
                                        <option value="Q">Category Q</option>
                                        <option value="R">Category R</option>
                                        <option value="S">Category S</option>
                                        <option value="T">Category T</option>
                                        <option value="U">Category U</option>                  
                                    </select>
                                </div>

                            </br></br>
                                
                                <div class="custom-select">
                                    <select name="composition">
                                        <option selected value="">Number of competitors...</option>
                                        <option value="Solo">Solo</option>
                                        <option value="Duet">Duet</option>
                                        <option value="Ansambl">Ensemble</option>
                                    </select>
                                </div>
                            </div>

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
                            
                            <input type="submit" name="apply-piano" value="Send!" />
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