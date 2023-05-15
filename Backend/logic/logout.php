<?php
session_start();

// Session löschen
session_unset();
session_destroy();

// Zurück zur Login-Seite weiterleiten
header("Location: ../../Frontend/sites/index.php");
exit;
?>
