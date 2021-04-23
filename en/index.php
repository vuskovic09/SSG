<?php 
    require('../include/services/config.php');
    require('../include/services/connection.php');
    $errors = [];

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
            $errors[] = "First name is required";
        }
    
        if ($lname == null){
            $errors[] = "Last name is required";
        }
    
        if ($bdate == null){
            $errors[] = "Date of birth is required";
        }
        
        if($nationality == null) {
            $errors[] = "Nationality is required";
        }
    
        if($country == null) {
            $errors[] = "Country is required";
        }
    
        if(!preg_match($regExBdate, $bdate)){
            $errors[] = "Date of birth needs to be in the day/month/year format";
        }
    
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $errors[] = "E-mail address isn't in the proper format";
        } else if ($email == null) {
            $errors[] = "E-mail address is required";
        }
    
        if($link1 == null && $link2 == null  && $link3 == null  && $link4 == null  && $link5 == null  && $link6 == null  && $link7 == null  && $link8 == null ){
            $errors[] = "There needs to be at least one link";
        }
    
        if($link1 != null && !preg_match($regExYoutube, $link1)){
            $errors[] = "The first link isn't valid";
        }
        if($link2 != null && !preg_match($regExYoutube, $link2)){
            $errors[] = "The second link isn't valid";
        }
        if($link3 != null && !preg_match($regExYoutube, $link3)){
            $errors[] = "The third link isn't valid";
        }
        if($link4 != null && !preg_match($regExYoutube, $link4)){
            $errors[] = "The fourth link isn't valid";
        }
        if($link5 != null && !preg_match($regExYoutube, $link5)){
            $errors[] = "The fifth link isn't valid";
        }
        if($link6 != null && !preg_match($regExYoutube, $link6)){
            $errors[] = "The sixth link isn't valid";
        }
        if($link7 != null && !preg_match($regExYoutube, $link7)){
            $errors[] = "The seventh link isn't valid";
        }
        if($link8 != null && !preg_match($regExYoutube, $link8)){
            $errors[] = "The eigth link isn't valid";
        }
    
        if($pname == null) {
            $errors[] = "Proof of payment is required";
        }
    
        if($pname) {
             if($psize > 5000000){
                $errors[] = "Proof of payment cannot be larger than 5MB";
            }
        }
    
        if($docname == null) {
            $errors[] = "Identification document is required";
        }
    
        if($pname) {
             if($psize > 5000000){
                $errors[] = "Identification document cannot be larger than 5MB";
            }
        }
    
        if($category == ''){
            $errors[] = "Category is required";
        }
        if($composition  == ''){
            $errors[] = "Ensemble is required";
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
                        <li><a class="a-click" href="intro-text">Intro</a></li>
                        <li><a class="a-click" href="rule-info">Rules</a></li>
                        <li><a href="singingEN.php">Singing Competition</a></li>
                        <li><a href="pianoEN.php">Piano Competition</a></li>
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
        <p><a href="../index.php">Croatian</a> | <a href="#">English</a></p>
    </div>

        <!-- Intro -->
        <div id="intro-text" class="main-block">
            <div class="row center">
                <div class="col-xs-6 col-md-12">
                    <div class="main-segment-title">
                        <h2>Introduction</h2>
                    </div>
                </div>
            </div>
            <div class="row center main-segment-about">
                <div class="col-xs-12 col-md-4 main-segment-about-photos">
                    <!-- First Img -->
                    <div class="first-img">
                        <img src="../assets/images/about1.jpg" alt="Photo by Carsten Kohler from Pexels">
                    </div>
                    <!-- Second Img -->
                    <div class="second-img">
                        <img src="../assets/images/about2.jpg" alt="Photo by Jonas Togo from Pexels">
                    </div>
                    <!-- Third Img-->
                    <div class="third-img">
                        <img src="../assets/images/about3.jpg" alt="Photo by Pixabay from Pexels">
                    </div>
                </div>
                <div class="col-xs-12 col-md-8 main-segment-about-text">
                    <p>Dear contestants, </br></br>
                        The organizer, Musica Zagreb, takes great pleasure in announcing and wishing welcome to all
                        of the contestants on the first international competition of young musicians in Zagreb, 2021.</br></br>
                        The city of Zagreb, host of this international event, is the capital of Croatia but also the
                        scientific and economic center of this part of Europe. It is a city of culture, proud with it’s
                        numerous cultural and artistic activities. It should also be mentioned that on a yearly basis,
                        there’s an average of 230 concerts, 550 exhibitions, 270 festivals and, with other forms of
                        cultural activities, surpasses the impressive number of 5000 events. </br></br>
                        The idea of Musica Zagreb is realization of a competition for talented and promising young
                        artists all around the world who will get a chance at presenting their skills and love of music
                        online. 
                        </br></br>
                        Our first, singing, competition is dedicated in memoriam to the great Bulgarian singer and
                        singing teacher Stojan Stojanov Gančev, who left a significant trace in our environment, and
                        after it will follow violin and piano competitions. </br></br>
                        The great and famous Austrian composer, Franz Joseph Haydn inspired us with his words:
                        “Young people can learn from my example that something can come from nothing. What I
                        have become is the result of my hard efforts."
                        We wish the best of luck and the greatest of success to all of the contestants and we eagerly
                        expect you on our upcoming competition. </br>
                        
                        MUSICA ZAGREB
 
                    </p>
                </div>
            </div>  
        </div>

        <!-- Gallery -->
        <div class="main-block">
            <div class="row center main-segment">
                <div class="col-md-12 main-segment-gallery">
                    <div class="hex"></div>
                    <div class="hex"></div>
                    <div class="hex"></div>
                    <div class="hex"></div>
                    <div class="hex"></div>
                    <div class="hex"></div>
                    <div class="hex"></div>
                    <div class="hex"></div>
                    <div class="hex"></div>
                    <div class="hex"></div>
                </div>
            </div>
        </div>

        <!-- Rules -->
        <div id="rule-info" class="main-block">
            <div class="row center">
                <div class="col-xs-6 col-md-12">
                    <div class="main-segment-title">
                        <h2>Rules</h2>
                    </div>
                </div>
            </div>
            <div class="row center main-segment-comp">
                <div class="col-md-12 main-segment-comp-rules-text">    
                    <p>                        
                        1st COMPETITON OF YOUNG MUSICIANS ZAGREB 2021 </br></br>
                        RULES</br></br>
                        1. These Rules define the music competition…. (the Competition).</br>
                        2. The Competition is international, designed for young musicians nevertheless of type of education and nationality.</br>
                        3. The Organizer of this international music Competition is Musica, Zagreb.</br>
                        4. The Competition shall be held ON-LINE</br>
                        5. The participants shall be obliged, before uploading ON-LINE application, to upload their competition program on a public You Tube channel. In application the participant should insert the link for each particular composition. </br>
                        6. The compositions can be individually recorded. Also, the program may be recorded in its entirety without interruption. </br>
                        7. The recorded compositions may not be posted on the public YouTube channel before January 1, 2019. It is obligatory to state the name of the composition and the composer in the video description.  </br>
                        8. The order of performance shall be determined by the Organizer. The Organizer reserves the right to change the schedule. </br>
                        9. The exact schedule in each category shall be published on this web page. The participants shall also be informed about the schedule by email. </br>
                        10. The participant or ensembles may apply in the higher age category than provided for their age.  </br>
                        11. The whole program shall be performed by heart by the participant in the solo performance category and the ensembles can perform by reading the notes. Repetitions are not necessary. </br>
                        12. The program specified in the application cannot be changed. </br>
                        13. The jury will be formed by eminent national and foreign musicians and music pedagogues. </br>
                        14. In case of withdrawal of a jury member, the Organizer has the right to appoint a new jury member. </br>
                        15. A member of the jury shall not evaluate a participant who is their student or relative. </br>
                        16. The jury shall listen to the whole program. </br>
                        17. In case more participants share the same number of points, the younger candidate gains the priority right. </br>
                        18. The jury delivers a final and irrevocable decision with no right to appeal. </br>
                        19. The jury may award a special prize and may award a prize for the most successful pedagogue. </br>
                        20. The results and marks given by each jury member shall be published on this web page after completion of each category. </br></br></br></br></br>
                        21. The jury delivers the following awards: </br>

                        90,00 – 100,00 points 	1. Prize</br>
                        80,00 – 89,99 points	 2. Prize</br>
                        70,00 – 79,99 points	3. Prize</br>
                                69,99 points and below – acknowledgement</br></br>
                        22. The participants will receive diplomas for winning the 1, 2 and 3 Prize or Acknowledgement of Participation. </br>
                        23. Each category has its own winner, that is the participant with the highest points gained. If a participant gets more than 98,00 points, he/she shall be awarded by the name “Laureate”. </br>
                        24.The organizer shall send diplomas as well as acknowledges and special prizes to the participant’s e-mail address listed in the application form. </br>
                        25. The jury has the right to decide about everything that is not defined by this Rules. </br>
                        26. For participating in this competition an application is necessary. </br>
                        27. The participant is obliged to submit a scan of his/her identification document in the application form. </br>
                        28. The application for the participation in the competition should be exclusively done online, by filling out the online form available on this web-page. </br>
                        29. Applications for the competition will be allowed up to 7 days before the start of the competition. </br>
                        30. Falsely stating data in the application may be a reason for disqualification of the applicant. </br>
                        31. Incomplete applications shall not be considered. </br></br>
                        32. To participate in the competition you need to pay a registration fee. For the applicants who are not Croatian residents, registration fee shall be payable in Euros. Registration fee should be paid to the following account: </br></br>
                        For: MUSICA, Zagreb</br>
                        Zagrebačka banka d.d. </br>
                        Trg bana Jelačića 10</br>
                        10000 Zagreb</br>
                        IBAN: HR9623600001102900185</br>
                        SWIFT/ BIC: ZABA HR 2X</br></br>
                        33. In case of withdrawal from the Competition, the registration fee will not be reimbursed. </br>
                        34. Name and surname of an applicant who is paying the registration fee should be listed in the payment description line. The same applies to the ensemble members who are paying registration fees for themselves. </br>
                        35. Registration fee for Croatian residents is payable in Croatian Kuna, based on the medium exchange rate of the Croatian National Bank on the payment day. </br>
                        36. The Organizer of the Competition reserves the right to process audio and video recordings of all competitions and events related to the competition. The participants are informed and they agree that the Organizer will process their personal data (photos, video and audio recordings, awards etc.) for the purpose of organizing and promoting the Competition, and publishing these data on its web page and other social media channels. </br>
                        37. MUSIC,Zagreb, the organizer of the Competition has the sole right to change this Rules. </br>
                        38. In case of ambiguities, the Croatian version of this Rules shall prevail. </br>
                        39. In case of dispute the parties shall submit the case before the competent court in Zagreb. </br>
                    </p>
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