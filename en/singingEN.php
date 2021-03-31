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
                        <li><a href="#">Singing Competition</a></li>
                        <li><a href="pianoEN.php">Piano Competition</a></li>
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
        <p><a href="../singing.php">Croatian</a> | <a href="#">English</a></p>
    </div>
        <div class="main-block">
            <div class="row center">
                <div class="col-xs-6 col-md-12">
                    <div class="main-segment-title">
                        <h2>Singing Competition</h2>
                        <h4>12.04.2021. - 16.04.2021.</h4>
                    </div>
                </div>
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
                            <img src="../assets/images/gancev.jpg" alt="Stevan Stojanov Gancev">
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-8 main-segment-about-text">
                        <p>Dear competitors,</br></br>
                            Welcome to the first international competition of solo singers Stojan Stojanov Gančev.
                            This competition was named after the singer and pedagogue who left an indelible mark on
                            generations of singers and audiences who listened to the creations of his roles that he interpreted
                            on the stages of Croatia and abroad. With his professional and thorough approach, he has
                            educated a number of opera singers and pedagogues who work all over the world. In his rich
                            career, he was often a member of the jury at international competitions for young solo singers. Fair,
                            strict but above all well-meaning, he would gladly approach every singer after the performance, talk
                            to him and share his opinion and advice. The organizers of this competition would like to nurture
                            the qualities that Professor Stojanov had and pass them on to the younger generations. In order to
                            hear as many talented young musicians as possible, through the propositions we have enabled the
                            performance of a wide range of generations of singers. We look forward to meeting each other on
                            an artistic level and making new acquaintances.
                        </p>
                    </div>
                </div>  
            
            
            
                <div class="main-block">
                    <div class="row center">
                        <div class="col-xs-6 col-md-12">
                            <div class="main-segment-title">
                                <h2>Biography</h2>
                            </div>
                        </div>
                    </div>
                    <div class="row center main-segment-about-gancev">
                        <div class="col-xs-12 col-md-8 main-segment-about-gancev-text">
                            <p>
                                Stojan Stojanov Gančev was a tenor born in Ajtos, Bulgaria in 1929. In 1960 he completed his
                                studies in solo singing in the class of the famous Bulgarian vocal pedagogue Hristo Brmbarov in
                                Sofia. Afterward, he studied opera direction in the class of Dragan Karadžiev. While still a student,
                                he made his debut in 1957 as Caramello in Johan Strauss’ operetta A Night in Venice performed in
                                Sofia State Musical Theater. Soon after he was signed for many other projects, mainly operettas.
                                The same year he was awarded a gold medal at the Youth Festival in Moscow.
                                In 1959 he won the first prize in Ferenc Erkel Competition in Budapest. From 1960 to 1963 he was
                                a member of the Sofia Opera. In 1961 he performed in Varna as Rodolpho in La Boheme and that
                                same year he won the first prize for the heroic repertoire in Sofia.
                                His success in the Sofia Opera was recognized by the directors allowing him to perform in a more
                                demanding program. In 1964 Stojan decided to transfer to Macedonia where he remained until
                                1969. As a Skopje Opera soloist in 1969, he came to the Croatian National Theater in Zagreb
                                where he performed for the next 25 years, until his death.                  
                            </p>
                        </div>
                        <div class="col-xs-12 col-md-4 main-segment-about-photos">
                            <!-- First Img -->
                            <div class="first-img">
                                <img src="../assets/images/gancev1.jpg" alt="Photo by Carsten Kohler from Pexels">
                            </div>
                            <!-- Second Img -->
                            <div class="second-img">
                                <img src="../assets/images/gancev2.jpg" alt="Photo by Jonas Togo from Pexels">
                            </div>
                            <!-- Third Img-->
                            <div class="third-img">
                                <img src="../assets/images/gancev3.jpg" alt="Photo by Pixabay from Pexels">
                            </div>
                        </div>
                    </div> 
                    <a href="gancev.php"><div class="col-md-12 main-segment-title"><h3>More...</h3></div></a>
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
                                    <div class="divTableCell">Precategory A</div>
                                    <div class="divTableCell text">First-year students
                                        (States that have a preparatory degree, first-degree students)</br></br>
                                        Two compositions of different character of your choice 
                                    </div>
                                </div>
                                <div class="divTableRow">
                                    <div class="divTableCell">Precategory B</div>
                                    <div class="divTableCell text">Second-year students
                                        (States that have a preparatory degree, second-degree students)</br></br>
                                        Two compositions of different character of your choice
                                    </div>
                                </div>
                                <div class="divTableRow">
                                    <div class="divTableCell">I/A</div>
                                    <div class="divTableCell text">First-year high school students (third-year students)</br></br>
                                        One aria and two solo songs of your choice
                                    </div>
                                </div>
                                <div class="divTableRow">
                                    <div class="divTableCell">I/B</div>
                                    <div class="divTableCell text">Second-year high school students (fourth-year students)</br></br>
                                        One aria and three solo songs of your choice
                                    </div>
                                </div>
                                <div class="divTableRow">
                                    <div class="divTableCell">II/A</div>
                                    <div class="divTableCell text">Third-year high school students (fifth-year students)</br></br>
                                        One aria and three solo songs of your choice
                                    </div>
                                </div>
                                <div class="divTableRow">
                                    <div class="divTableCell">II/B</div>
                                    <div class="divTableCell text">Fourth-year high school students (sixth-year students)</br></br>
                                        One aria by an old Italian master of the 16th, 17th or 18th century of your choice</br>
                                        Two solo songs of your choice</br>
                                        One aria from opera or operetta of your choice
                                    </div>
                                </div>
                                <div class="divTableRow">
                                    <div class="divTableCell">III/A</div>
                                    <div class="divTableCell text">First and second-year students of the Music Academy</br></br>
                                        Two arias and three solo songs of your choice
                                    </div> 
                                </div>
                                <div class="divTableRow">
                                    <div class="divTableCell">III/B</div>
                                    <div class="divTableCell text">Second and third-year students of the Music Academy</br></br>
                                        Two arias and three solo songs of your choice
                                    </div>
                                </div>
                                <div class="divTableRow">
                                    <div class="divTableCell">IV</div>
                                    <div class="divTableCell text">Fifth-year students of the Music Academy</br></br>
                                        Two arias and three solo songs of your choice</div>
                                </div>
                                <div class="divTableRow">
                                    <div class="divTableCell">V/A</div>
                                    <div class="divTableCell text">High school chamber ensembles with piano accompaniment by
                                        high school student.</br></br> Two compositions with different character of your choice
                                    </div>
                                </div>
                                <div class="divTableRow">
                                    <div class="divTableCell">V/B</div>
                                    <div class="divTableCell text">Academic chamber ensembles with piano accompaniment by a
                                        student of the Music Academy.</br></br>
                                        Three compositions with different character of your choice
                                    </div>
                                </div>
                                <div class="divTableRow">
                                    <div class="divTableCell">VI</div>
                                    <div class="divTableCell text">The mixed opera duets or ensembles with piano accompaniment
                                        by a professional accompanist - ladies and / or gentlemen up to the age of 35 in
                                        the year of the competition.</br></br>
                                        Two opera duets or ensembles of your choice
                                    </div>
                                </div>
                                <div class="divTableRow">
                                    <div class="divTableCell">VII</div>
                                    <div class="divTableCell text">Competitors younger professionals; ladies up to the age of 28 in the year of the competition; gentlemen up to the age of 30 in the year of the competition</br></br>
                                        Three arias of your choice 
                                    </div>
                                </div>
                                <div class="divTableRow">
                                    <div class="divTableCell">VIII</div>
                                    <div class="divTableCell text">Ladies up to the age of 33 in the year of the competition; gentlemen up to the age of
                                        35 in the year of the competition</br></br>
                                        Four arias of your choice 
                                    </div>
                                </div>
                                <div class="divTableRow">
                                    <div class="divTableCell">Fees</div>
                                    <div class="divTableCell text">Precategory A i B - 35 €</br>
                                        I/A, I/B, II/A i II/B category - 40 €</br>
                                        III/A, III/B i IV category - 50 €</br>
                                        V/A, V/B, VI, VII i VIII category - 60 €</br></br>
                                        The registration fee is to be paid to the account:</br>
                                        Zagrebačka banka d.d.</br>
                                        Trg bana Jelačića 10</br>
                                        10000 Zagreb</br>
                                        IBAN:HR9623600001102900185</br>
                                        SWIFT:ZABA HR</br>
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
                                <img src="../assets/images/kandelaki.jpg" alt="Vladimir Kandelaki" />
                            </div>
                            <h3 class="main-segment-judges-single-title">Vladimir Kandelaki</h3>
                            <div class="main-segment-judges-single-text">
                                The National Artist of Georgia, Professor, Academician Vladimir Rafaelovich Kandelaki, awarded the Order of Honor of Georgia, was born on January 11, 1928.
                                He graduated from a particular music school for specially gifted children at the V. Sarajišvili State Conservatory in Tbilisi and graduated as a lyric-drama tenor.
                            </div>
                            <a href="kandelaki.php"><div class="main-segment-judges-single-button">
                                More...
                            </div></a>
                        </div>
                        <div class="col-xs-12 col-md-4 main-segment-judges-single">
                            <div class="main-segment-judges-single-img">
                                <img src="../assets/images/ljZiv.jpg" alt="Ljubica Zivkovic" />
                            </div>
                            <h3 class="main-segment-judges-single-title">Ljubica Živković</h3>
                            <div class="main-segment-judges-single-text">
                                LJUBICA ZIVKOVIC was born in Belgrade in 1952. After having finished Secondary Music School
                                "Josip Slavenski", departments of music theory and solo singing, she continued her studies at the
                                Faculty of Music in Belgrade, at both departments: music theory with Prof. Petar Ozgijan and solo
                                singing with Prof. Zvonimir Krnetić. She graduated from the class of Prof. Radmila Smiljanić. 
                            </div>
                            <a href="ljZiv.php"><div class="main-segment-judges-single-button">
                                More...
                            </div></a>
                        </div>
                        <div class="col-xs-12 col-md-4 main-segment-judges-single">
                            <div class="main-segment-judges-single-img">
                                <img src="../assets/images/aGig.jpg" alt="Arijana Gigliani" />
                            </div>
                            <h3 class="main-segment-judges-single-title">Arijana Gigliani</h3>
                            <div class="main-segment-judges-single-text">
                                ARIJANA GIGLIANI PHILIPP was born in Sarajevo (1979), where she graduated
                                secondary school of violin and solo singing. Following graduation at Academy of
                                Music in Zagreb, she continued to study voice with renowned pedagogue and tenor
                                principal Stojan Stojanov Gančev from Bulgaria.
                            </div>
                            <a href="aGig.php"><div class="main-segment-judges-single-button">
                                More...
                            </div></a>
                        </div>
                    </div>
                </div>

                <<!-- Application form -->
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
                </div>
            </div>
        </div>
</main>
<footer>
</footer>
<script src="../assets/js/scripts.js"></script>
</body>
</html>