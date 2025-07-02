<?php
if (!isset($_SESSION['id_niveau']) || $_SESSION['id_niveau'] != 1) {
    header('Location: index.php?action=liste');
    exit;
}
?>
<h2>Coucou admin</h2>