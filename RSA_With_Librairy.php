<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>RSA</title>
  <h1>Cryptosystème RSA</h1>
</head>
<body>

<h3>Chiffrement et déchiffrement RSA en utilisant une bibliothèque fournie</h3>


<?php
$data = 'Texte à chiffrer';

// Génération d'une paire de clés robuste
$privateKey = openssl_pkey_new(array(
    'private_key_bits' => 4096, // Taille de la clé
    'private_key_type' => OPENSSL_KEYTYPE_RSA,
));

// Exportation de la clé privée
openssl_pkey_export($privateKey, $pkeyString);

// Extraction de la clé publique à partir de la clé privée
$publicKey = openssl_pkey_get_details($privateKey);
$publicKeyString = $publicKey['key'];

// Chiffrement des données
$sealed_data = '';
$ekeys = array();
$method = 'AES-128-CBC'; // Méthode de chiffrement
$iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length($method)); // Génération du vecteur d'initialisation
openssl_seal($data, $sealed_data, $ekeys, array($publicKeyString), $method, $iv);
$encrypted = base64_encode($sealed_data);

// Déchiffrement des données
$open_data = '';
openssl_open(base64_decode($encrypted), $open_data, $ekeys[0], $pkeyString, $method, $iv);

echo 'Données chiffrées: ' . $encrypted . "\n";
echo 'Données déchiffrées: ' . $open_data . "\n";

?>

</body>
</html>