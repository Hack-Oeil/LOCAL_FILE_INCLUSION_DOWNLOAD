<?php
require '../vendor/autoload.php';
new Yoop\Kernel(); // On doit charger le .env

// Vérification de l'existence du paramètre
if (!isset($_GET['file'])) {
    http_response_code(400);
    exit("Paramètre de fichier manquant.");
}

$filename = __DIR__ . '/documents/'.$_GET['file'];
if(file_exists($filename)) {
    // Configuration des en-têtes pour forcer le téléchargement
    header('Content-Description: File Transfer');
    header('Content-Type: application/pdf');
    header('Content-Disposition: attachment; filename="'.$_GET['file'].'"');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($filename));
    
    $helper = new App\Service\HelperController();
    
    // Lire le contenu du fichier dans une variable
    $content = file_get_contents($filename);
    
    // Remplacer la chaîne par ton message personnalisé
    $output = str_replace(
        "DEFAULT_CTF_FLAG=2cd6cdd779afff98a5f6536bb370ff97296690a7",
        "Bien joué le flag est : " . $helper->flag(),
        $content
    );
    // Envoyer le résultat au client
    echo $output;
    exit;
}
else {
    http_response_code(400);
    exit("Fichier introuvable.");
}
