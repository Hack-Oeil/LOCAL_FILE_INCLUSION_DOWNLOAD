<?php
require '../vendor/autoload.php';
new Yoop\Kernel(); // On doit charger le .env

// Vérification de l'existence du paramètre
if (!isset($_GET['file'])) {
    http_response_code(400);
    exit("Paramètre de fichier manquant.");
}

$filename = __DIR__ . '/documents/'.$_GET['file'];
// Configuration des en-têtes pour forcer le téléchargement
header('Content-Description: File Transfer');
header('Content-Type: application/pdf');
header('Content-Disposition: attachment; filename="'.$_GET['file'].'"');
header('Expires: 0');
header('Cache-Control: must-revalidate');
header('Pragma: public');
header('Content-Length: ' . filesize($filename));

// Lecture du fichier et envoi au client
readfile($filename);
exit;

$helper = new App\Service\HelperController();
echo str_replace("DEFAULT_CTF_FLAG=8c07a685949b7c9d1f6d10ea794f249b1cb888be", "Bien joué le flag est : ".$helper->flag(), $output);