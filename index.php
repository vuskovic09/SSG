<?php

ob_start();
session_start();

require('include/services/config.php');
require('include/services/connection.php');

?>

<?php require_once('include/partials/header.php'); ?>

<?php require_once('include/partials/main.php'); ?>

<?php require_once('include/partials/footer.php'); ?>


<script src="assets/js/scripts.js"></script>
</body>
</html>
