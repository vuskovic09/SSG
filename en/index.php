<?php

ob_start();
session_start();

require('../include/services/config.php');
require('../include/services/connection.php');

?>

<?php require_once('header.php'); ?>

<?php require_once('main.php'); ?>

<?php require_once('footer.php'); ?>


<script src="../assets/js/scripts.js"></script>
</body>
</html>
