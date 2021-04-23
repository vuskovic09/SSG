<?php
    require('include/services/config.php');
    require('include/services/connection.php');
    $errors = [];

    $navQuery = "SELECT * FROM `nav` ORDER BY `priority`";
    $execNav = $pdo->query($navQuery);
    $dataNav = $execNav -> fetchAll();

    if(isset($_POST['apply-violin'])){
    

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
                        <li><a href="piano.php">Klavirsko natjecanje</a></li>
                        <li><a href="#">Violinističko natjecanje</a></li>
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
        <p><a href="#">Croatian</a> | <a href="en/violinEN.php">English</a></p>
    </div>
        <div class="main-block">
            <div class="row center">
                <div class="col-xs-6 col-md-12">
                    <div class="main-segment-title">
                        <h2>Violinističko natjecanje</h2>
                        <h4>05.06.2021. - 10.06.2021.</h4>
                    </div>
                </div>
            </div>
        </div>

        <!---
        <div class="main-block">
            <div class="row center">
                <div class="col-xs-6 col-md-12">
                    <div class="main-segment-title">
                        <h2>Obavijesti</h2>
                    </div>
                </div>
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
                            <img src="assets/images/ludmilla.png" alt="Ludmilla Weiser">
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-8 main-segment-about-text">
                        <p style="font-size: 20px">...svaka violina ima svoju tajnu i, vidite, tek u ruci sviračevoj pretvara se tajna violine u zagonetku još tajanstveniju, jer ruka guslača je čudestvena snaga, koja prenosi kucaj srca i treperenje živaca u strune...
                        </p>
                    </div>
                </div>  
            </div>
            <div class="main-block">
                <div class="row center">
                    <div class="col-xs-6 col-md-12">
                        <div class="main-segment-title">
                            <h2>Biografija</h2>
                        </div>
                    </div>
                </div>
                <div class="row center main-segment-about-gancev">
                    <div class="col-xs-12 col-md-8 main-segment-about-gancev-text">
                        <p>
                        Ludmilla Aloysia Weiser rođena je 09.kolovoza 1847. u Zagrebu.Otac joj je bio uvaženi zagrebački majstor glazbalar Ivan Nepomuk Weiser, jedan od prvih izučenih glazbalara u Zagrebu. Zbog kvalitetnih tambura Franjo Ks. Kuhač nazvao ga je „Amatijem” tambure, a važno je napomenuti da je bio jedan od najranijih zagrebačkih glazbalara koji je održavao, izrađivao i popravljao glazbala HGZ-a. </br>
                        Ludmilla Weiser upisala je glazbenu školu u HGZ-u 1856.godine kod učitelja Antuna Schwarza.
                        Već je na učeničkim produkcijama  Ludmilla pokazala iznimnu vještinu zbog koje je poslije postala  širokoj javnosti poznata glazbena umjetnica.O zapaženom talentu svjedoče i skladbe koje je Antun Schwarz napisao za Ludmillu.                  
                        </p>
                    </div>
                    <div class="col-xs-12 col-md-4 main-segment-about-photos">
                        <!-- First Img -->
                        <div class="first-img">
                            <img src="assets/images/ludmilla1.png" alt="Photo by Carsten Kohler from Pexels">
                        </div>
                        <!-- Second Img -->
                        <div class="second-img">
                            <img src="assets/images/ludmilla.png" alt="Photo by Jonas Togo from Pexels">
                        </div>
                    </div>
                </div> 
                <a href="include/pages/ludmilla.php"><div class="col-md-12 main-segment-title"><h3>Još...</h3></div></a>
            </div>

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
                <div class= "row center between main-segment-propositions">
                        <div class="divTable">
                            <div class="divTableBody">
                            <div class="divTableRow">
                                    <div class="divTableCell">NAPOMENA:</div>
                                    <div class="divTableCell text">NATJECATELJI NE MORAJU ISPUNITI MAKSIMALNU MINUTAŽU ZADANU PO KATEGORIJAMA
                                    </div>
                                </div>
                                <div class="divTableRow">
                                    <div class="divTableCell">Predkategorija A</div>
                                    <div class="divTableCell text">Natjecatelji rođeni 2014. i mlađi</br>Dvije skladbe po slobodnom izboru do 5 minuta
                                    </div>
                                </div>
                                <div class="divTableRow">
                                    <div class="divTableCell">Predkategorija B</div>
                                    <div class="divTableCell text">Natjecatelji rođeni 2012. i mlađi</br>Dvije skladbe po slobodnom izboru do 5 minuta
                                    </div>
                                </div>
                                <div class="divTableRow">
                                    <div class="divTableCell">1. Kategorija</div>
                                    <div class="divTableCell text">Natjecatelji rođeni 2011. </br>Dvije skladbe po slobodnom izboru do 7 minuta
                                    </div>
                                </div>
                                <div class="divTableRow">
                                    <div class="divTableCell">2. Kategorija</div>
                                    <div class="divTableCell text">Natjecatelji rođeni 2010.</br>Dvije skladbe po slobodnom izboru do 9 minuta
                                    </div>
                                </div>
                                <div class="divTableRow">
                                    <div class="divTableCell">3. Kategorija</div>
                                    <div class="divTableCell text">Natjecatelji rođeni 2009.</br>Dvije skladbe po slobodnom izboru do 11 minuta
                                    </div>
                                </div>
                                <div class="divTableRow">
                                    <div class="divTableCell">4. Kategorija</div>
                                    <div class="divTableCell text">Natjecatelji rođeni 2008.</br>Dvije skladbe po slobodnom izboru do 13 minuta
                                    </div>
                                </div>
                                <div class="divTableRow">
                                    <div class="divTableCell">5. Kategorija</div>
                                    <div class="divTableCell text">Natjecatelji rođeni 2007.</br>Dvije skladbe po slobodnom izboru do 15 minuta
                                    </div> 
                                </div>
                                <div class="divTableRow">
                                    <div class="divTableCell">6. Kategorija</div>
                                    <div class="divTableCell text">Natjecatelji rođeni 2006.</br>Dvije skladbe po slobodnom izboru do 17 minuta
                                    </div>
                                </div>
                                <div class="divTableRow">
                                    <div class="divTableCell">7. Kategorija</div>
                                    <div class="divTableCell text">Natjecatelji rođeni 2004. i mlađi</br>Program po slobodnom izboru do 20 minuta
                                    </div>
                                </div>
                                <div class="divTableRow">
                                    <div class="divTableCell">8. Kategorija</div>
                                    <div class="divTableCell text">Natjecatelji rođeni 2002. i mlađi</br>Program po slobodnom izboru do 25 minuta
                                    </div>
                                </div>
                                <div class="divTableRow">
                                    <div class="divTableCell">Fees</div>
                                    <div class="divTableCell text">Predkategorija A i B - 35 €</br>
                                        1, 2, 3. i 4. kategorija - 35€</br>
                                        5, 6, 7. i 8. kategorija - 40 € </br></br>
                                        TUplata kotizacija vrši se na račun Organizatora MUSICA ZAGREB:</br>
                                        Zagrebačka banka d.d.</br>
                                        Trg bana Jelačića 10</br>
                                        10000 Zagreb</br>
                                        IBAN:HR9623600001102900185</br>
                                        SWIFT:ZABA HR 2X</br>
                                        U slučaju odustajanja kotizacija se ne vraća.
                                    </div>
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
                            <h2>Ocjenjivački Sud</h2>
                        </div>
                    </div>
                </div>
                <div class= "row center between main-segment-judges">
                    <div class="col-xs-12 col-md-4 main-segment-judges-single">
                        <div class="main-segment-judges-single-img">
                            <img src="assets/images/aVeskov.jpg" alt="Ana Veskov" />
                        </div>
                        <h3 class="main-segment-judges-single-title">Ana Veskov</h3>
                        <div class="main-segment-judges-single-text">
                        Ana Veskov rođena je u Beogradu. Nižu glazbenu školu „Mokranjac“ završila je u klasi prof. Vlajka Savkovića, a diplomirala je u srednjoj glazbenoj školi „Stanković“ u Beogradu, u klasi prof. Olge Bešević. Položivši tri prijemna ispita za redovne studije u Beogradu, Sofiji i Rusiji, odlučila se za nastavak školovanja u Lenjingradu, sadašnjem Sankt Petersburgu, gradu koji su proslavili najveći svjetski glazbenici, pisci, slikari....
                        </div>
                        <a href="include/pages/aVeskov.php"><div class="main-segment-judges-single-button">
                            Još...
                        </div></a>
                    </div>                
                    <div class="col-xs-12 col-md-4 main-segment-judges-single">
                        <div class="main-segment-judges-single-img">
                            <img src="assets/images/mKotor.jpg" alt="Myroslava Kotorovych" />
                        </div>
                        <h3 class="main-segment-judges-single-title">Myroslava Kotorovych</h3>
                        <div class="main-segment-judges-single-text">
                        Myroslava Kotorovych rođena je u Kijevu, u obitelji glazbenika; violinista Bohodara Kotorovycha i harfistice Natalije Kmet. Maturirala je u Srednjoj glazbenoj školi za nadarenu djecu M. V. Lysenka u Kijevu, a diplomirala na Državnoj Glazbenoj Akademiji Ukrajine.Smatra da je njena desetogodišnja koncertna aktivnost kao članice “Kremerate Baltice”, komornog orkestra pod ravnateljstvom Gidona Kremera, bio njen “praktični europski konzervatorij”.  
                        </div>
                        <a href="include/pages/mKotor.php"><div class="main-segment-judges-single-button">
                            Još...
                        </div></a>
                    </div>
                    <div class="col-xs-12 col-md-4 main-segment-judges-single">
                        <div class="main-segment-judges-single-img">
                            <img src="assets/images/lBobic.jpg" alt="Lidija Bobić" />
                        </div>
                        <h3 class="main-segment-judges-single-title">Lidija Bobić</h3>
                        <div class="main-segment-judges-single-text">
                        Lidija Bobić rođena je u Varaždinu, gdje završava Srednju glazbenu školu.
                        Školovanje nastavlja na Državnom Konzervatoriju „Petar Iljič Čajkovski” u Kijevu, Ukrajin a u klasi profesora Tarasa Pechenija koji je detaljno upoznaje s ruskom violinističkom školom i s radom profesora Jurija Jankeljejeviča, jednog od najeminentnijih violinističkih pedagoga Moskve. Diplomirala je 1994. godine u klasi profesora Igora Andrievskog. Svo vrijeme studija pohađa nastavu predpraktike.
                        </div>
                        <a href="include/pages/lBobic.php"><div class="main-segment-judges-single-button">
                            Još...
                        </div></a>
                    </div>
                </div>
            </div>

            <!-- Application form 
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
                        <form id="form-singing" action="" method="POST" enctype="multipart/form-data">
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
                                        <option selected value="">Broj natjecatelja...</option>
                                        <option value="Solo">Solo</option>
                                        <option value="Duet">Duet</option>
                                        <option value="Ansambl">Ansambl</option>
                                    </select>
                                </div>
                            </div>
                            </br></br>

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
                            
                            <input type="submit" name="apply" value="Pošalji!" />
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
<script src="assets/js/scripts.js"></script>
</body>
</html>