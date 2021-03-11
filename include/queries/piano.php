<?php

require('../services/config.php');
require('../services/connection.php');

$errors = [];

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


        move_uploaded_file($ptemp, "../../upload/" . $pname);
        move_uploaded_file($doctemp, "../../upload/" . $docname);

        try {
            $execute = $prepare->execute();
            header('Location: '.$path);
            exit;

        } catch(PDOException $ex) {   
            var_dump($ex);         
        }
    } 
?>