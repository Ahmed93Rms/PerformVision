<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>RSA</title>
  <h1>Cryptosystème RSA</h1>
</head>
<body>

<h3>Chiffrement et déchiffrement RSA sans utiliser de bibliothèque spécifique</h3>

<?php
// On déclare deux nombres premiers '$p' et '$q'
$p = 29;
$q = 23;

// On effectue le produit de ces deux nombres
$n = $p * $q;

// On calcule la fonction d'Euler '$phi'
$phi = ($p - 1) * ($q - 1);

$e = 11; // Désigne la clé publique
$d = 3; // Désigne la clé privée

/**
 * On utilise deux fonctions qui correspondent respectivement au chiffrement et au déchiffrement
 * La fonction 'bcpowmod' est utilisée pour effectuer des calculs de puissance modulaire
 */

// La fonction de chiffrement
function rsa_encrypt($message, $public_key) {
    list($e, $n) = $public_key;
    return bcpowmod($message, $e, $n);
}

// La fonction de déchiffrement
function rsa_decrypt($message, $private_key) {
    list($d, $n) = $private_key;
    return bcpowmod($message, $d, $n);
}

$message = 9;
$encrypted = rsa_encrypt($message, array($e, $n));
$decrypted = rsa_decrypt($encrypted, array($d, $n));

echo 'Message: ' . $message . "\n";
echo 'Message chiffré: ' . $encrypted . "\n";
echo 'Message déchiffré: ' . $decrypted . "\n";
?>

</body>
</html>