<?php 

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

       
    </div>
</main>