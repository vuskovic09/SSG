<?php 

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
<main>

    <div class="main container">
    <div class="language-select">
        <p><a href="#">Hrvatski</a> | <a href="en/index.php">Engleski</a></p>
    </div>
        <!-- Intro -->
        <div id="intro-text" class="main-block">
            <div class="row center">
                <div class="col-xs-6 col-md-12">
                    <div class="main-segment-title">
                        <h2>Uvodna riječ</h2>
                    </div>
                </div>
            </div>
            <div class="row center main-segment-about">
                <div class="col-xs-12 col-md-4 main-segment-about-photos">
                    <!-- First Img -->
                    <div class="first-img">
                        <img src="assets/images/about1.jpg" alt="Photo by Carsten Kohler from Pexels">
                    </div>
                    <!-- Second Img -->
                    <div class="second-img">
                        <img src="assets/images/about2.jpg" alt="Photo by Jonas Togo from Pexels">
                    </div>
                    <!-- Third Img-->
                    <div class="third-img">
                        <img src="assets/images/about3.jpg" alt="Photo by Pixabay from Pexels">
                    </div>
                </div>
                <div class="col-xs-12 col-md-8 main-segment-about-text">
                    <p>Dragi natjecatelji,</br></br>
                        Organizator MUSICA ZAGREB sa velikim zadovoljstvom najavljuje i želi
                        dobrodošlicu svim natjecateljicama i natjecateljima na 1. međunarodno natjecanje mladih glazbenika Zagreb 2021.</br></br>
                        Grad Zagreb, domaćin ovog međunarodnog događanja glavni je grad Republike
                        Hrvatske ali i znanstveno i gospodarsko središte ovog dijela Europe. To je grad
                        kulture koji se ponosi svojim brojnim kulturnim i umjetničkim aktivnostima.
                        Treba spomenuti da se godišnje prosječno realizira 230 koncerata, 550
                        izložbaba, 270 festivala i sa ostalim vidovima kulturne baštine prelazi
                        impozantnu brojku od 5000 događanja.</br></br>
                        Zamisao i želja organizatora MUSICA ZAGREB jest ostvarenje natjecanja za
                        talentirane perspektivne mlade umjetnike širom svijeta koji će dobiti priliku da
                        putem ONLINE tehnologije prezentiraju svoje umijeće, vještine i ljubav prema
                        glazbi.</br></br>
                        Naše prvo, pjevačko, natjecanje posvećeno je In memoriam velikom bugarskom pjevaču i
                        pjevačkom pedagogu Stojanu Stojanovu Gančevu koji je ostavio dubok trag u
                        našoj sredini, a nakon njega će slijediti violinističko i klavirsko natjecanje.</br></br>
                        Veliki i čuveni austrijski skladatelj Franz Joseph Haydn inspirirao nas je svojim
                        riječima:
                        „Mladi ljudi mogu naučiti iz mog primjera da nešto ne može doći ni iz čega. Ono
                        što sam postigao rezultat je mog velikog napora, truda i ljubavi“.
                        Svim učesnicima želimo mnogo uspjeha i sreće od srca, te Vas s nestrpljenjem
                        očekujemo na predstojećem natjecanju.
                        Srdačno,
                        Organizator MUSICA ZAGREB 
 
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
                        <h2>Pravilnik natjecanja</h2>
                    </div>
                </div>
            </div>
            <div class="row center main-segment-comp">
                <div class="col-md-12 main-segment-comp-rules-text">    
                    <p>                        
                        1. NATJECANJE MLADIH GLAZBENIKA ZAGREB 2021.</br></br>
                        PRAVILNIK NATJECANJA.</br></br>
                        1.Ovim Pravilnikom ureduju se pravila muzičkog natjecanja...(Natjecanje)</br>
                        2. Natjecanje je namijenjeno mladim glazbenicima u Republici Hrvatskoj i mladim glazbenicima u inozemstvu bez obzira na vrstu obrazovanja i nacionalnost.</br>
                        3. Organizator ovog medunarodnog muzičkog natjecanja je Musica, Zagreb.</br>
                        4. Sva natjecanja će se odvijati – ON LINE.</br>
                        5. Natjecatelji su dužni do trenutka popunjavanja prijave objaviti  program koji izvode na ovom natjecanju na javnom youtube kanalu. U prijavi  natjecatelji su dužni navesti link, na predviđenom mjestu, za svaku pojedinu skladbu.</br>
                        6. Skladbe mogu biti snimljene pojedinačno. Takoder, program može biti snimljen i u cijelosti, bez prekidanja.</br>
                        7. Snimljene skladbe ne smiju biti objavljene na javnom  youtube kanalu prije 1. siječnja 2019. godine. Obvezatno je navesti ime skladbe i kompozitora u opisu videa.</br>
                        8. Redoslijed nastupa određuje organizator i zadržava pravo promjene rasporeda.</br>
                        9.Točan termin rasporeda natjecanja u svakoj pojedinoj kategoriji bit će objavljen na internetskoj stranici Natjecanja a natjecatelji će također biti obaviješteni putem e-maila.</br>
                        10. Natjecatelj ili komorni ansambl se može prijaviti i u višoj kategoriji nego je predviđena za njihovu dob.</br>
                        11. Cijeli program natjecatelj izvodi napamet u solističkim kategorijama , a komorni ansambli mogu izvoditi program iz nota, a repeticije nisu nužne.</br>
                        12. Promjena programa navedenog u prijavi neće biti dopuštena.</br>
                        13. Ocjenjivački sud sastavljen je od eminentnih domaćih i stranih glazbenika i pedagoga.</br>
                        14. U slučaju odustajanja pojedinog člana ocjenjivačkog suda, Organizator ima pravo zamjene istog novim članom.</br>
                        15. Član Ocjenjivačkog suda ne ocjenjuje svog učenika ili studenta koji se natječe, ni natjecatelja s kojim je u srodstvu.</br>
                        16. Ocjenjivački sud sluša program u cijelosti.</br>
                        17. U slučaju da više natjecatelja dijeli jednak broj bodova, mlađi kandidat ostvaruje pravo prednosti.</br>
                        18. Ocjenjivački sud donosi konačnu i neopozivu odluku na koju natjecatelj nema pravo žalbe.</br>
                        19. Ocjenjivački sud ima mogućnost prema vlastitoj procjeni dodijeliti  i posebne nagrade kao i nagradu  najuspješnijem pedagogu.</br>
                        20. Rezultati i pojedinačne ocjene svakog člana Ocjenjivačkog suda bit će objavljeni na ovoj web stranici po završetku svake kategorije.</br></br></br></br></br>
                        21. Na Natjecanju ocjenjivački sud dodjeljuje nagrade:</br>
                        90,00 – 100,00 bodova 	    - 1. nagrada.</br>
                        80,00 – 89,99 bodova	    - 2. nagrada.</br>
                        70,00 – 79,99 bodova	    - 3. nagrada.</br>
                        69,99 bodova i sve manje od toga   -  Priznanje.</br></br>
                        22. Natjecatelji dobivaju diplome za osvojenu 1., 2. ili 3. nagradu ili priznanje za sudjelovanje.</br>
                        23. Svaka kategorija ima svog pobjednika. To je natjecatelj/ica sa najvećim ostvarenim bodovima od strane Ocjenjivačkog suda. Ako je natjecatelj/ica ocijenjen sa više od 98,00 bodova, dobiva naziv laureat.</br>
                        24. Diplome i priznanja kao i posebne nagrade, Organizator natjecanja će svakom natjecatelju poslati na mail adresu navedenu u prijavi.</br>
                        25. Ocjenjivački sud odlučuje o svemu što nije određeno ovim Pravilnikom
                        26. Za sudjelovanje na natjecanju obvezna je prijava.</br>
                        27. Natjecatelj/ica je dužan dostaviti u prijavi fotografiju identifikacijskog dokumenta.</br>
                        28.Prijava se podnosi isključivo popunjavanjem online prijavnice koja je dostupna na ovoj web stranici.</br>
                        29. Prijave će biti omogućene do 7 dana prije početka natjecanja.</br>
                        30.Krivo navođenje podataka u prijavi može biti razlog za diskvalifikaciju natjecatelja.</br>
                        31.Nepotpune prijave neće se razmatrati.</br></br>
                        <span class="boldy">32. Za sudjelovanje na Natjecanju potrebno je platiti kotizaciju. Uplata kotizacije vrši se na račun Organizatora natjecanja MUSICA, Zagreb:</br>
                        Zagrebačka banka d.d</br>
                        Trg bana Jelačića 10</br>
                        10000 Zagreb</br>
                        IBAN: HR9623600001102900185</br>
                        SWIFT: ZABA HR 2X</br></br></span>
                        33. U slučaju odustajanja kotizacija se ne vraća.</br>
                        34. U opisu plaćanja obavezno napisati ime i prezime natjecatelja, odnosno imena i prezimena svih natjecatelja u komornom ansamblu  za koje se uplaćuje kotizacija.</br>
                        35. Natjecatelji iz Republike Hrvatske uplaćuju kunsku protuvrijednost prema središnjem tečaju HNB na dan uplate.</br>
                        36. Organizator natjecanja zadržava pravo obradivati audio/video/foto zapise svih natjecanja i  događanja vezanih za natjecanje. Natjecatelji su upoznati i pristaju da će Organizator obradivati njihove osobne podatke( fotografije, video i audio zapise, nagrade itd.) u svrhe organiziranja i  promoviranja Natjecanja, te da ima pravo objaviti navedene osobne podatke na svojoj web stranici i na drugim kanalima socijalnih medija.</br>
                        37. MUSICA, Zagreb, organizator Natjecanja, zadržava pravo izmjene ovog Pravilnika.</br>
                        38. U slučaju nejasnoća hrvatski tekst uzima se kao pravovaljan.</br>
                        39. Za slučaj spora nadležan je sud u Zagrebu.</br>
                    </p>
                </div>
            </div>
        </div>        

        <div id="comp-info" class="main-block">
            <div class="row center">
                <div class="col-xs-12 col-md-12">
                    <div class="main-segment-title singing-js">
                        <h2>Pjevačko natjecanje</h2>
                        <h4>12.04.2021. - 16.04.2021.</h4>
                    </div>
                </div>
                <div class="col-xs-12 col-md-12">
                    <div class="main-segment-title piano-js">
                        <h2>Klavirsko natjecanje</h2>
                        <h4>20.05.2021. - 25.05.2021.</h4>
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
                                <div class="divTableCell text">Natjecatelji I razreda srednje glazbene &scaron;kole ili treće godine učenja.</br></br> Jedna arija i dvije solo pjesme po slobodnom izboru</div>
                            </div>
                            <div class="divTableRow">
                                <div class="divTableCell">I/B</div>
                                <div class="divTableCell text">Natjecatelji II razreda srednje glazbene &scaron;kole ili četvrte godine učenja.</br></br> Jedna arija i tri solo pjesme po slobodnom izboru</div>
                            </div>
                            <div class="divTableRow">
                                <div class="divTableCell">II/A</div>
                                <div class="divTableCell text">Natjecatelji III razreda srednje glazbene &scaron;kole ili pete godine učenja.</br></br> Jedna arija i tri solo pjesme po slobodnom izboru</div>
                            </div>
                            <div class="divTableRow">
                                <div class="divTableCell">II/B</div>
                                <div class="divTableCell text">Natjecatelji IV razreda srednje glazbene &scaron;kole ili &scaron;este godine učenja.</br></br>Jedna arija starog talijanskog majstora 16.,17. ili 18. stoljeća po slobodnom izboru.</br> Dvije solo pjesme po slobodnom izboru.</br> Jedna arija iz opere ili operete po slobodnom izboru</div>
                            </div>
                            <div class="divTableRow">
                                <div class="divTableCell">III/A</div>
                                <div class="divTableCell text">Natjecatelji I i II godine studija Muzičke akademije.</br></br> Dvije arije i tri solo pjesme po slobodnom izboru</div>
                            </div>
                            <div class="divTableRow">
                                <div class="divTableCell">III/B</div>
                                <div class="divTableCell text">Natjecatelji III i IV godine studija Muzičke akademije.</br></br> Dvije arije i tri solo pjesme po slobodnom izboru</div>
                            </div>
                            <div class="divTableRow">
                                <div class="divTableCell">IV</div>
                                <div class="divTableCell text">Natjecatelji V godine studija Muzičke akademije.</br></br> Dvije arije i tri solo pjesme po slobodnom izboru</div>
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
                                    Tri arije po slobodnom izboru</div>
                            </div>
                            <div class="divTableRow">
                                <div class="divTableCell">VIII</div>
                                <div class="divTableCell text">Dame do navršene 33 godine života u godini natjecanja;
                                Gospoda do navršene 35 godine života u godini natjecanja.</br></br>
                                Četiri arije po slobodnom izboru </div>
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
                            <img src="assets/images/manana.jpg" alt="Vladimir Kandelaki" />
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
                            <img src="assets/images/nMitrovic.jpg" alt="Arijana Gigliani" />
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