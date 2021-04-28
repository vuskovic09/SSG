<?php
    require('include/services/config.php');
    require('include/services/connection.php');
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
                        <li><a href="#">Pjevačko natjecanje</a></li>
                        <li><a href="singingResults.php">Pjevačko natjecanje - rezultati</a></li>
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
<main>
    <div class="main container">
    <div class="language-select">
        <p><a href="#">Croatian</a> | <a href="en/singingEN.php">English</a></p>
    </div>
        <div class="main-block">
            <div class="row center">
                <div class="col-xs-6 col-md-12">
                    <div class="main-segment-title">
                        <h2>Pjevačko Natjecanje</h2>
                        <h4>19.04.2021. - 22.04.2021.</h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="main-block">
                <div class="row center">
                    <div class="col-xs-6 col-md-12">
                        <div class="main-segment-title">
                            <h2>Obavijesti</h2>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-md-12 main-segment-about-text-announcement">
                    <p>GRAND PRIX nagradu “Stojan Stojanov” u iznosu od 500 eura 
                        omogućava obitelj Stojanov</br></br>

                        Posebne nagrade</br>
                        Nagrada Kvarteta Rucner - nastup u sezoni 2021/2022 u koncertnoj dvorani V.Lisinskog</br>
                        Nagrada Hrvatskog komornog orkestra - nastup s orkestrom</br>
                    </p>
                </div>  
                <div class="col-xs-12 col-md-12 main-segment-about-text-announcement">
                <p>Dragi pjevači,</br></br>
                    Zbog Vaših upita i interesa  produžavamo rok prijave do 18.04.2021.</br></br>
                    Musica Zagreb
                </p>
            </div>
        </div>
    
        <div class="comp-wrap singing">
            <div class="main-block">
                <div class="row center">
                    <div class="col-xs-6 col-md-12">
                        <div class="main-segment-title">
                            <h2>Stojan Stojanov Gančev</h2>
                        </div>
                    </div>
                </div>
                <div class="row center main-segment-about">
                    <div class="col-xs-12 col-md-4 main-segment-about-photos">
                        <!-- First Img -->
                        <div class="gancev-img">
                            <img src="assets/images/gancev.jpg" alt="Stevan Stojanov Gancev">
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-8 main-segment-about-text">
                        <p>Dragi natjecatelji,</br></br>
                            Dobro došli na prvo međunarodno natjecanje solo pjevača Stojan Stojanov Gančev.
                            Ovo natjecanje dobilo je ime po pjevaču i pedagogu koji je svojim djelovanjem ostavio
                            neizbrisiv trag na generacije pjevača i publike koja je slušala kreacije njegovih uloga koje
                            je tumačio na pozornicama Hrvatske i inozemstva. Svojim stručnim i temeljitim pristupom
                            odgojio je niz opernih pjevača i pedagoga koji djeluju diljem svijeta. U svojoj bogatoj
                            karijeri često je bio i član žirija na međunarodnim natjecanjima mladih solo pjevača.
                            Pravedan, strog ali ponajprije dobronamjeran svakom bi pjevaču poslije nastupa rado
                            prišao, s njim razgovarao te podijelio mišljenje i savjet. Organizatori ovog natjecanja
                            željeli bi kvalitete koje je imao profesor Stojanov njegovati i prenijeti ih na mlade
                            naraštaje. U želji da čujemo čim veći broj talentiranih mladih glazbenika, kroz propozicije
                            smo omogućili nastup širokoj paleti generacija pjevača. Radujemo se susretu na
                            umjetničkoj razini i međusobnim novim poznanstvima.
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
                            Stojan Stojanov Gančev tenor (Ajtos) Bugarska 1929. Studij solo pjevanja završio je u klasi
                            poznatog bugarskog vokalnog pedagoga Hriste Brmbarova u Sofiji. Nakon završetka studija solo
                            pjevanja 1960., počeo je studirati I opernu režiju kod Dragana Karadžieva. Još u vrijeme studija,
                            1957. debitirao je u sofijskom Državnom muzikalnom teatru kao Caramello u opereti Jedna noć u
                            Veneciji Johanna Straussa te je odmah bio angažiran u mnogim drugim projektima, uglavnom u
                            operetama. Iste godine je dobio zlatnu medalju na Omladinskom festivalu u Moskvi.
                            Već dvije godine nakon, 1959. osvojio je prvu nagradu na natjecanju “Ferenc Erkel” u Budimpešti.
                            1960. do 1963. je bio član sofijske Opere. 1961. se predstavio i u Varni kao Rodolpho u operi La
                            Boheme te je iste godine osvojio prvu nagradu za herojski repertoar u Sofiji. Napredujući u sofijskoj
                            operi, redatelji su mu povjeravali sve teži i zahtjevniji program. 1964. Stojanov je odlučio otići u
                            Makedoniju te je tamo ostao sve do 1969. Kao solist Opere u Skoplju. 1969. dolazi u Zagreb gdje
                            je kao solist u Hrvatskom narodnom kazalištu djelovao punih 25 godina te je u Hrvatskoj ostao sve
                            do svoje smrti.                    
                        </p>
                    </div>
                    <div class="col-xs-12 col-md-4 main-segment-about-photos">
                        <!-- First Img -->
                        <div class="first-img">
                            <img src="assets/images/gancev1.jpg" alt="Photo by Carsten Kohler from Pexels">
                        </div>
                        <!-- Second Img -->
                        <div class="second-img">
                            <img src="assets/images/gancev2.jpg" alt="Photo by Jonas Togo from Pexels">
                        </div>
                        <!-- Third Img-->
                        <div class="third-img">
                            <img src="assets/images/gancev3.jpg" alt="Photo by Pixabay from Pexels">
                        </div>
                    </div>
                </div> 
                <a href="include/pages/gancev.php"><div class="col-md-12 main-segment-title"><h3>Još...</h3></div></a>
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
                    <div class="divTable">
                        <div class="divTableBody">
                            <div class="divTableRow">
                                <div class="divTableCell">Pretkategorija A</div>
                                <div class="divTableCell text">Natjecatelji prve godine učenja (Države koje imaju u sustavu pripremno obrazovanje - I razred pripremnog)</br></br> Dvije skladbe različitog karaktera po slobodnom izboru</div>
                            </div>
                            <div class="divTableRow">
                                <div class="divTableCell">Pretkategorija B</div>
                                <div class="divTableCell text">Natjecatelji druge godine učenja (Države koje imaju u sustavu pripremno obrazovanje - II razred pripremnog)</br></br> Dvije skladbe različitog karaktera po slobodnom izboru</div>
                            </div>
                            <div class="divTableRow">
                                <div class="divTableCell">I/A</div>
                                <div class="divTableCell text">Natjecatelji I razreda srednje glazbene &scaron;kole ili treće godine učenja.</br></br> Jedna arija i dvije solo pjesme po slobodnom izboru</br>(Arije mogu biti iz opere, operete, kantate, oratorija i arije starih talijanskih majstora)</div>
                            </div>
                            <div class="divTableRow">
                                <div class="divTableCell">I/B</div>
                                <div class="divTableCell text">Natjecatelji II razreda srednje glazbene &scaron;kole ili četvrte godine učenja.</br></br> Jedna arija i tri solo pjesme po slobodnom izboru</br>(Arije mogu biti iz opere, operete, kantate, oratorija i arije starih talijanskih majstora)</div>
                            </div>
                            <div class="divTableRow">
                                <div class="divTableCell">II/A</div>
                                <div class="divTableCell text">Natjecatelji III razreda srednje glazbene &scaron;kole ili pete godine učenja.</br></br> Jedna arija i tri solo pjesme po slobodnom izboru<</br>(Arije mogu biti iz opere, operete, kantate, oratorija i arije starih talijanskih majstora)/div>
                            </div>
                            <div class="divTableRow">
                                <div class="divTableCell">II/B</div>
                                <div class="divTableCell text">Natjecatelji IV razreda srednje glazbene &scaron;kole ili &scaron;este godine učenja.</br></br>Jedna arija starog talijanskog majstora 16.,17. ili 18. stoljeća po slobodnom izboru.</br> Dvije solo pjesme po slobodnom izboru.</br> Jedna arija iz opere ili operete po slobodnom izboru</br>(Arije mogu biti iz opere, operete, kantate, oratorija i arije starih talijanskih majstora)</div>
                            </div>
                            <div class="divTableRow">
                                <div class="divTableCell">III/A</div>
                                <div class="divTableCell text">Natjecatelji I i II godine studija Muzičke akademije.</br></br> Dvije arije i tri solo pjesme po slobodnom izboru</br>(Arije mogu biti iz opere, operete, kantate, oratorija i arije starih talijanskih majstora)</div>
                            </div>
                            <div class="divTableRow">
                                <div class="divTableCell">III/B</div>
                                <div class="divTableCell text">Natjecatelji III i IV godine studija Muzičke akademije.</br></br> Dvije arije i tri solo pjesme po slobodnom izboru</br>(Arije mogu biti iz opere, operete, kantate, oratorija i arije starih talijanskih majstora)</div>
                            </div>
                            <div class="divTableRow">
                                <div class="divTableCell">IV</div>
                                <div class="divTableCell text">Natjecatelji V godine studija Muzičke akademije.</br></br> Dvije arije i tri solo pjesme po slobodnom izboru</br>(Arije mogu biti iz opere, operete, kantate, oratorija i arije starih talijanskih majstora)</div>
                            </div>
                            <div class="divTableRow">
                                <div class="divTableCell">V/A</div>
                                <div class="divTableCell text">Srednjo&scaron;kolski komorni ansambli uz klavirsku pratnju učenika.</br></br> Dvije skladbe različitog karaktera po slobodnom izboru</div>
                            </div>
                            <div class="divTableRow">
                                <div class="divTableCell">V/B</div>
                                <div class="divTableCell text">Studentski komorni ansambli uz klavirsku pratnju studenta.</br></br> Tri skladbe različitog karaktera po slobodnom izboru</div>
                            </div>
                            <div class="divTableRow">
                                <div class="divTableCell">VI</div>
                                <div class="divTableCell text">Mje&scaron;oviti operni dueti ili ansambli uz klavirsku pratnju profesionalnog korepetitora &ndash; dame i/ili gospoda do navr&scaron;ene 35 godine života u godini natjecanja.</br></br> Dva operna dueta ili ansambla po slobodnom izboru</div>
                            </div>
                            <div class="divTableRow">
                                <div class="divTableCell">VII</div>
                                <div class="divTableCell text">Natjecatelji mlađi profesionalci;
                                    Dame do navršene 28 godine života u godini natjecanja;
                                    Gospoda do navršene 30 godine života u godini natjecanja.</br></br>
                                    Tri arije po slobodnom izboru</br>(Arije mogu biti iz opere, operete, kantate, oratorija i arije starih talijanskih majstora)</div>
                            </div>
                            <div class="divTableRow">
                                <div class="divTableCell">VIII</div>
                                <div class="divTableCell text">Dame do navršene 33 godine života u godini natjecanja;
                                Gospoda do navršene 35 godine života u godini natjecanja.</br></br>
                                Četiri arije po slobodnom izboru </br>(Arije mogu biti iz opere, operete, kantate, oratorija i arije starih talijanskih majstora)</div>
                            </div>
                            <div class="divTableRow">
                                <div class="divTableCell">Kotizacije</div>
                                <div class="divTableCell text">Pretkategorija A i B - 35 €</br>
                                I/A, I/B, II/A i II/B kategorija - 40 €</br>
                                III/A, III/B i IV kategorija - 50 €</br>
                                V/A, V/B, VI, VII i VIII kategorija - 60 €</br></br>
                                Uplata kotizacija vrši se na račun Organizatora MUSICA ZAGREB:</br>
                                Zagrebačka banka d.d.</br>
                                Trg bana Jelačića 10</br>
                                10000 Zagreb</br>
                                IBAN:HR9623600001102900185</br>
                                SWIFT:ZABA HR 2X</br>
                                U slučaju odustajanja kotizacija se ne vraća.</div>
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
                            <img src="assets/images/kandelaki.jpg" alt="Vladimir Kandelaki" />
                        </div>
                        <h3 class="main-segment-judges-single-title">Vladimir Kandelaki</h3>
                        <div class="main-segment-judges-single-text">
                            Nacionalni umjetnik Gruzije, profesor, akademik, Vladimir Rafaelovič Kandelaki, odlikovan
                            ordenom Reda časti Gruzije, roden je 11. siječnja 1928 godine.
                            Završio je specijalnu glazbenu školu za posebno darovitu djecu pri Državnom konzervatoriju V.
                            Sarajišvili u Tbilisiju, te isti diplomirao kao lirsko-dramski tenor 
                        </div>
                        <a href="include/pages/kandelaki.php"><div class="main-segment-judges-single-button">
                            Još...
                        </div></a>
                    </div>                
                    <div class="col-xs-12 col-md-4 main-segment-judges-single">
                        <div class="main-segment-judges-single-img">
                            <img src="assets/images/ljZiv.jpg" alt="Ljubica Zivkovic" />
                        </div>
                        <h3 class="main-segment-judges-single-title">Ljubica Živković</h3>
                        <div class="main-segment-judges-single-text">
                            Lljubica Živković rođena je u Beogradu,1952. godine. Poslije završene srednje
                            glazbene škole "Josip Slavenski", odjel za glazbenu teoriju i solo pjevanje, studije je
                            nastavila na FMU u Beogradu, na oba odjela: teoriju u klasi prof. Petra Ozgijana, a
                            solo pjevanje u klasi prof. Zvonimira Krnetića. Diplomirala je u klasi Radmile
                            Smiljanić. 
                        </div>
                        <a href="include/pages/ljZiv.php"><div class="main-segment-judges-single-button">
                            Još...
                        </div></a>
                    </div>
                    <div class="col-xs-12 col-md-4 main-segment-judges-single">
                        <div class="main-segment-judges-single-img">
                            <img src="assets/images/aGig.jpg" alt="Arijana Gigliani" />
                        </div>
                        <h3 class="main-segment-judges-single-title">Arijana Gigliani</h3>
                        <div class="main-segment-judges-single-text">
                            Arijana Gigliani Philipp rođena je u Sarajevu gdje je završila nižu i srednju
                            glazbenu školu odjel violine i solo-pjevanja.
                            Nakon diplome na zagrebačkoj Muzičkoj akademiji nastavlja usavršavanje kod
                            renomiranog pedagoga i opernog prvaka Stojana Stojanova Gančeva. 
                        </div>
                        <a href="include/pages/aGig.php"><div class="main-segment-judges-single-button">
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
<script src="assets/js/scripts.js"></script>
</body>
</html>