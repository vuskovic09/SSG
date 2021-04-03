<?php
    require('include/services/config.php');
    require('include/services/connection.php');

    $query = "SELECT * FROM `singing`";
    $execQuery = $pdo->query($query);
    $dataQuery = $execQuery -> fetchAll();
    $i = 1;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <style type="text/css">
    .tg  {border-collapse:collapse;border-spacing:0;}
    .tg td{border-color:black;border-style:solid;border-width:1px;font-family:Arial, sans-serif;font-size:14px;
    overflow:hidden;padding:10px 5px;word-break:normal;}
    .tg th{border-color:black;border-style:solid;border-width:1px;font-family:Arial, sans-serif;font-size:14px;
    font-weight:normal;overflow:hidden;padding:10px 5px;word-break:normal;}
    .tg .tg-0lax{text-align:left;vertical-align:top}
    </style>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prijave</title>
</head>
<body>
   <main>
        <div class="prijave">
        <table class="tg">
            <thead>
            <tr>
                <th class="tg-0lax">Br</th>
                <th class="tg-0lax">Ime</th>
                <th class="tg-0lax">Prezime</th>
                <th class="tg-0lax">Datum Rodjenja</th>
                <th class="tg-0lax">Nacionalnost</th>
                <th class="tg-0lax">Profesor</th>
                <th class="tg-0lax">Grad</th>
                <th class="tg-0lax">Drzava</th>
                <th class="tg-0lax">Mail</th>
                <th class="tg-0lax">Telefon</th>
                <th class="tg-0lax">Kategorija</th>
                <th class="tg-0lax">Sastav</th>
                <th class="tg-0lax">Identifikacija</th>
                <th class="tg-0lax">Dokaz uplate</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach($dataQuery as $row) { ?>
                <tr>
                    <td class="tg-0lax"><?php echo $i; ?></td>
                    <td class="tg-0lax"><?php echo $row['fname']; ?></td>
                    <td class="tg-0lax"><?php echo $row['lname']; ?></td>
                    <td class="tg-0lax"><?php echo $row['bdate']; ?></td>
                    <td class="tg-0lax"><?php echo $row['nationality']; ?></td>
                    <td class="tg-0lax"><?php echo $row['prof']; ?></td>
                    <td class="tg-0lax"><?php echo $row['city']; ?></td>
                    <td class="tg-0lax"><?php echo $row['country']; ?></td>
                    <td class="tg-0lax"><?php echo $row['email']; ?></td>
                    <td class="tg-0lax"><?php echo $row['phone']; ?></td>
                    <td class="tg-0lax"><?php echo $row['category']; ?></td>
                    <td class="tg-0lax"><?php echo $row['composition']; ?></td>
                    <td class="tg-0lax"><a href="upload/<?php echo $row['pname']; ?>"><?php echo $row['pname']; ?></a></td>
                    <td class="tg-0lax"><a href="upload/<?php echo $row['docname']; ?>"><?php echo $row['docname']; ?></a></td>
                </tr>
                <?php $i = $i + 1; }  ?>
            </tbody>
        </table>
        </div>
   </main>  
</body>
</html>