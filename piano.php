<?php
    require('include/services/config.php');
    require('include/services/connection.php');
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
        $ppath="upload/".$pname; //set upload folder path    
    
        $docname = $_FILES['document']['name'];
        $doctype = $_FILES['document']['type'];
        $docsize = $_FILES['document']['size'];
        $doctemp = $_FILES['document']['tmp_name'];
        $docpath ="upload/".$docname; //set upload folder path    
    
    
        $directory="upload/"; //set upload folder path for update time previous file remove and new file upload for next use
    
    
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
    
    
            move_uploaded_file($ptemp, "upload/" . $pname);
            move_uploaded_file($doctemp, "upload/" . $docname);
    
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
                        <li><a href="index.php#intro-text">Uvodna riječ</a></li>
                        <li><a href="index.php#rule-info">Pravilnik natjecanja</a></li>
                        <li><a href="singing.php">Pjevačko natjecanje</a></li>
                        <li><a href="#">Klavirsko natjecanje</a></li>
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
<main>
    <div class="main container">
    <div class="language-select">
        <p><a href="#">Croatian</a> | <a href="en/pianoEN.php">English</a></p>
    </div>
        <div class="main-block">
            <div class="row center">
                <div class="col-xs-6 col-md-12">
                    <div class="main-segment-title">
                        <h2>Klavirsko Natjecanje</h2>
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
                            <h2>Propozicije</h2>
                        </div>
                    </div>
                </div>
                <div class= "row center between main-segment-propositions">
                    <div class="divTable">
                        <div class="divTableBody">
                            <div class="divTableRow">
                                <div class="divTableCell">Kotizacija</div>
                                <div class="divTableCell text">
                                    Pretkategorija A i B - 35 €</br>
                                    kategorija A,B,C,D - 40 €</br>
                                    kategorija E,F,G - 45 €</br>
                                    kategorija H,I,J - 50 €</br>
                                    kategorija K,L - 60 €</br>
                                    kategorija N,M - 60 € po klavirskom duu</br>
                                    kategorija O,Q - 70 € po klavirskom duu</br>
                                    kategorija R,S - 70 € po ansamblu</br>
                                    kategorija T,U - 80 € po ansamblu</br></br>
                                    
                                    Uplata kotizacija vrši se na račun Organizatora MUSICA ZAGREB:</br>
                                    Zagrebačka banka d.d.</br>
                                    Trg bana Jelačića 10</br>
                                    10000 Zagreb</br>
                                    IBAN:HR9623600001102900185</br>
                                    SWIFT:ZABA HR 2X
                                </div>
                            </div>
                        <div class="divTableRow">
                                <div class="divTableCell">Klavir solo - napomena</div>
                                <div class="divTableCell text">a) Kandidati u predkategoriji A i B, te kandidati u kategorijama od A do D izvode minimalno dvije skladbe različitog karaktera i tempa</br>
                                    b) Kandidati, studenti i umjetnici od kategorije E do kategorije L izvode minimalno dvije skladbe različitog stilskog razdoblja</br>
                                    c) Kandidati, studenti i umjetnici ne moraju ispuniti maksimalnu minutažu zadanu po kategorijama
                                </div>
                            </div>
                            <div class="divTableRow">
                                <div class="divTableCell">Pretkategorija A</div>
                                <div class="divTableCell text">Kandidati rođeni 2013. godine i mlađi</br></br> Program po slobodnom izboru od 4 - 6 minuta </div>
                            </div>
                            <div class="divTableRow">
                                <div class="divTableCell">Pretkategorija B</div>
                                <div class="divTableCell text">Kandidati rođeni 2011.godine i mlađi</br></br> Program po slobodnom izboru od 5 - 7 minuta </div>
                            </div>
                            <div class="divTableRow">
                                <div class="divTableCell">Kategorija A</div>
                                <div class="divTableCell text">Kandidati rođeni 2010. godine</br></br> Program po slobodnom izboru od 6 do 8 minuta </div>
                            </div>
                            <div class="divTableRow">
                                <div class="divTableCell">Kategorija B</div>
                                <div class="divTableCell text">Kandidati rođeni 2009. godine</br></br>Program po slobodnom izboru od 7 do 9 minuta</div>
                            </div>
                            <div class="divTableRow">
                                <div class="divTableCell">Kategorija C</div>
                                <div class="divTableCell text">Kandidati rođeni 2008. godine</br></br>Program po slobodnom izboru od 8 do 10 minutau</div>
                            </div>
                            <div class="divTableRow">
                                <div class="divTableCell">Kategorija D</div>
                                <div class="divTableCell text">Kandidati rođeni 2007. godine</br></br>Program po slobodnom izboru do 12 minuta</div>
                            </div>
                            <div class="divTableRow">
                                <div class="divTableCell">Kategorija E</div>
                                <div class="divTableCell text">Kandidati rođeni 2005. i 2006. godine</br></br>Program po slobodnom izboru do 15 minuta</div>
                            </div>
                            <div class="divTableRow">
                                <div class="divTableCell">Kategorija F</div>
                                <div class="divTableCell text">Kandidati rođeni 2003. i  2004. godine</br></br>Program po slobodnom izboru do 17 minuta</div>
                            </div>
                            <div class="divTableRow">
                                <div class="divTableCell">Kategorija G</div>
                                <div class="divTableCell text">Kandidati rođeni 2001. i 2002. godine</br></br>Program po slobodnom izboru do 20 minuta</div>
                            </div>
                            <div class="divTableRow">
                                <div class="divTableCell">Kategorija H</div>
                                <div class="divTableCell text">Studenti 1. i 2. godine Muzičke akademije</br></br>Program po slobodnom izboru do 20 minuta </div>
                            </div>
                            <div class="divTableRow">
                                <div class="divTableCell">Kategorija I</div>
                                <div class="divTableCell text">Studenti 3. i 4. godine Muzičke akademije</br></br>Program po slobodnom izboru do 25 minuta </div>
                            </div>
                            <div class="divTableRow">
                                <div class="divTableCell">Kategorija J</div>
                                <div class="divTableCell text">Studenti 5. godine Muzičke akademije</br></br>Program po slobodnom izboru do 30 minuta</div>
                            </div>
                            <div class="divTableRow">
                                <div class="divTableCell">Kategorija K</div>
                                <div class="divTableCell text">Mladi umjetnici rođeni 1990. godine i mlađi</br></br>Program po slobodnom izboru do 40 minuta</div>
                            </div>
                            <div class="divTableRow">
                                <div class="divTableCell">Kategorija L</div>
                                <div class="divTableCell text">Umjetnici rođeni prije 1. siječnja 1990 bez dobne granice</br></br>Program po slobodnom izboru do 50 minuta</div>
                            </div>
                            <div class="divTableRow">
                                <div class="divTableCell">Klavirski duo; klavir četveroručno i na dva klavira - napomena</div>
                                <div class="divTableCell text">a) Kandidati u kategorijama od N do Q izvode minimalno dvije sklade različitog stilskog razdoblja</br> b) Skladbe mogu biti skladane originalno za klavir četveroručno ili za dva klavira, ili transkripcije za klavir četveroručno ili transkipcije za dva klavira</br> c) Klavirski duo može po želji kombinirati u svom programu skladbe skladane originalno za klavir četveroručno ili za dva klavira ili transkripcije za klavir črtveroručno ili transkripcije za dva klavira</br> d) Kandidati, studenti i umjetnici ne moraju ispuniti maksimalnu minutazu zadanu po kategorijama</br></div>
                            </div>
                            <div class="divTableRow">
                                <div class="divTableCell">Kategorija N</div>
                                <div class="divTableCell text">Kandidati rođeni 2010. godine i mlađi</br></br>Program po slobodnom izboru do 10 minuta </div>
                            </div>
                            <div class="divTableRow">
                                <div class="divTableCell">Kategorija M</div>
                                <div class="divTableCell text">Kandidati rođeni 2005. godine i mlađi</br></br>Program po slobodnom izboru do 15 minuta</div>
                            </div>
                            <div class="divTableRow">
                                <div class="divTableCell">Kategorija O</div>
                                <div class="divTableCell text">Kandidati i studenti Muzičke akademije rođeni 2000. i mlađi</br></br>Program po slobodnom izboru do 20 minuta</div>
                            </div>
                            <div class="divTableRow">
                                <div class="divTableCell">Kategorija Q</div>
                                <div class="divTableCell text">Umjetnici rođeni prije 1. siječnja 2000. bez dobne granice</br></br>Program po slobodnom izboru do 30 minuta</div>
                            </div>
                            <div class="divTableRow">
                                <div class="divTableCell">Klavirski ansambl - napomena</div>
                                <div class="divTableCell text">a) Klavirski ansambl mora imati najmanje tri izvođača od kojih najmanje jedan mora biti za klavirom ( npr. klavir šesteroručno, klavirski trio, klavirski kvartet, klavirski kvintet...)</br> b) Klavirski ansambli u kategorijama od R do U izvode minimalno dvije sklade različitog stilskog razdoblja</br> c) Skladbe mogu biti skladane originalno za klavirski ansambl ili transkripcije za klavirski ansambl</br> d) Kandidati, studenti i umjetnici ne moraju ispuniti maksimalnu minutazu zadanu po kategorijama</br></div>
                            </div>
                            <div class="divTableRow">
                                <div class="divTableCell">Kategorija R</div>
                                <div class="divTableCell text">Kandidati rođeni 2010. godine i mlađi</br></br>Program po slobodnom izboru do 10 minuta </div>
                            </div>
                            <div class="divTableRow">
                                <div class="divTableCell">Kategorija S</div>
                                <div class="divTableCell text">Kandidati rođeni 2005. godine i mlađi</br></br>Program po slobodnom izboru do 15 minuta</div>
                            </div>
                            <div class="divTableRow">
                                <div class="divTableCell">Kategorija T</div>
                                <div class="divTableCell text">Kandidati i studenti Muzičke akademije rođeni 2000.godine i mlađi</br></br>Program po slobodnom izboru do 20 minuta</div>
                            </div>
                            <div class="divTableRow">
                                <div class="divTableCell">Kategorija U</div>
                                <div class="divTableCell text">Umjetnici rođeni prije 1. siječnja 2000. bez dobne granice</br></br>Program po slobodnom izboru do 30 minuta</div>
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
                            <h2>Ocjenjivački Sud</h2>
                        </div>
                    </div>
                </div>
                <div class= "row center between main-segment-judges">
                    <div class="col-xs-12 col-md-4 main-segment-judges-single">
                        <div class="main-segment-judges-single-img">
                            <img src="assets/images/manana.jpg" alt="Manana Kandelaki" />
                        </div>
                        <h3 class="main-segment-judges-single-title">Manana Kandelaki</h3>
                        <div class="main-segment-judges-single-text">
                        Rođena je u Gruziji, u obitelji poznatih glazbenika, među kojima je bio i V. Kandelaki, poznati sovjetski pjevač, glumac, filmski redatelj, nacionalni umjetnik SSSR-a.  Njezin otac, Vladimir Kandelaki, je pjevač, solist  Opere, profesor, nacionalni umjetnik Gruzije, a majka je Medea Tsirgiladze, pijanistica i profesor.
                        </div>
                        <a href="include/pages/manana.php"><div class="main-segment-judges-single-button">
                            Još...
                        </div></a>
                    </div>                
                    <div class="col-xs-12 col-md-4 main-segment-judges-single">
                        <div class="main-segment-judges-single-img">
                            <img src="assets/images/nKacar.jpg" alt="Nenad Kacar" />
                        </div>
                        <h3 class="main-segment-judges-single-title">Nenad Kačar</h3>
                        <div class="main-segment-judges-single-text">
                        Hrvatski pijanist i pedagog Nenad Kačar rođen je 1965. godine u Zagrebu. 
                         Glazbom se bavi od najranijeg djetinjstva, već kao petogodišnjak imao je prvi  javni nastup. U vrijeme školovanja kroz brojne koncerte senzibilizira javnost, i biva zapažen što mu tijekom studija omogućava dobivanje prestižne državne stipendije.
                        </div>
                        <a href="include/pages/nKacar.php"><div class="main-segment-judges-single-button">
                            Još...
                        </div></a>
                    </div>
                    <div class="col-xs-12 col-md-4 main-segment-judges-single">
                        <div class="main-segment-judges-single-img">
                            <img src="assets/images/nMitrovic.jpg" alt="Natasa Mitrovic" />
                        </div>
                        <h3 class="main-segment-judges-single-title">Nataša Mitrović</h3>
                        <div class="main-segment-judges-single-text">
                        Pijanistica iz Beograda, osnovni i magistarski studij završila je na FMU u Beogradu u klasi prof. Mirjane Šuica Babić, a doktorski studij na istoj akademiji u klasi prof. Marije Đukić.
                Usavršavala se kod renomiranih klavirskih pedagoga: Lazar Berman (Weimar),  Jan Novotny (Prag), , Avo Kouyoumdjian (Bec), Karl - Heinz Kämmerling (Lindau) i u Americi u okviru Fulbright programa (prof. Arthur Greene i prof. Martin Canin).

                        </div>
                        <a href="include/pages/nMitrovic.php"><div class="main-segment-judges-single-button">
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
                            <h2>Prijava</h2>
                        </div>
                    </div>
                </div>
                <div class="row center between main-segment-application">
                    <div class="main-segment-application-form">
                        <form id="form-piano" action="#form-piano" method="POST" enctype="multipart/form-data" onsubmit="return formValidation(event)">
                            <input type="text" name="fname" placeholder="Ime" value="<?php echo isset($_POST["fname"]) ? $_POST["fname"] : ''; ?>"/>
                            <input type="text" name="lname" placeholder="Prezime" value="<?php echo isset($_POST["lname"]) ? $_POST["lname"] : ''; ?>"/>
                            <input type="text" name="bdate" placeholder="DD/MM/YYYY" value="<?php echo isset($_POST["bdate"]) ? $_POST["bdate"] : ''; ?>" />
                            <input type="text" name="nationality" placeholder="Nacionalnost" value="<?php echo isset($_POST["nationality"]) ? $_POST["nationality"] : ''; ?>"/>
                            <input type="text" name="prof" placeholder="Profesor" value="<?php echo isset($_POST["prof"]) ? $_POST["prof"] : ''; ?>"/>

                            <input type="text" name="city" placeholder="Grad" value="<?php echo isset($_POST["city"]) ? $_POST["city"] : ''; ?>"/>
                            <input type="text" name="country" placeholder="Država" value="<?php echo isset($_POST["country"]) ? $_POST["country"] : ''; ?>"/>
                            <input type="mail" name="mail" placeholder="E-mail" value="<?php echo isset($_POST["mail"]) ? $_POST["mail"] : ''; ?>"/>
                            <input type="text" name="phone" placeholder="Telefon" value="<?php echo isset($_POST["phone"]) ? $_POST["phone"] : ''; ?>"/>

                            </br></br>

                            <div class="row center space-around selects">
                                <div class="custom-select">
                                    <select name="category">
                                        <option selected value="">Kategorija...</option>
                                        <option value="Pretkategorija A">Pretkategorija A</option>
                                        <option value="Pretkategorija B">Pretkategorija B</option>
                                        <option value="A">Kategorija A</option>
                                        <option value="B">Kategorija B</option>
                                        <option value="C">Kategorija C</option>
                                        <option value="D">Kategorija D</option>
                                        <option value="E">Kategorija E</option>
                                        <option value="F">Kategorija F</option>
                                        <option value="G">Kategorija G</option>
                                        <option value="H">Kategorija H</option>
                                        <option value="I">Kategorija I</option>
                                        <option value="J">Kategorija J</option>
                                        <option value="K">Kategorija K</option>
                                        <option value="L">Kategorija L</option>        
                                        <option value="N">Kategorija N</option>
                                        <option value="M">Kategorija M</option>
                                        <option value="O">Kategorija O</option>
                                        <option value="Q">Kategorija Q</option>
                                        <option value="R">Kategorija R</option>
                                        <option value="S">Kategorija S</option>
                                        <option value="T">Kategorija T</option>
                                        <option value="U">Kategorija U</option>                  
                                    </select>
                                </div>

                            </br></br>
                                
                                <div class="custom-select">
                                    <select name="composition">
                                        <option selected value="">Broj natjecatelja...</option>
                                        <option value="Solo">Solo</option>
                                        <option value="Duet">Duet</option>
                                        <option value="Ansambl">Ansambl</option>
                                    </select>
                                </div>
                            </div>

                            <label>Dokaz uplate</label>
                            <input type="file" name="payment" />

                            <label>Identifikacijski dokument</label>
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
                            
                            <input type="submit" name="apply-piano" value="Pošalji!" />
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
    </div>
</main>
<footer>
</footer>
<script src="assets/js/scripts.js"></script>
</body>
</html>