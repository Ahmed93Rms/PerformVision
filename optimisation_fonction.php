<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>RSA</title>
  <h1>Cryptosystème RSA</h1>
</head>
<body>

<h3>Optimisation d'une fonction PHP</h3>

<?php

// Fonction pour la version initiale du code
function createUserOriginal($email, $password, $nom, $prenom, $telephone) {
    $password = 'aq1'.sha1($password.'1524').'25';
    $req = $this->db->prepare('INSERT INTO utilisateur (mail, password, nom, prenom, telephone) VALUES (?, ?, ?, ?, ?)');
    $req->execute([$email, $password, $nom, $prenom, $telephone]);
    return $this->db->lastInsertId();
}

// Fonction pour la version optimisée du code
function createUserOptimized($email, $password, $nom, $prenom, $telephone) {
    $passwordHash = password_hash('aq1' . $password . '1524' . '25', PASSWORD_DEFAULT);
    $this->db->beginTransaction();
    try {
        $req = $this->db->prepare('INSERT INTO utilisateur (mail, password, nom, prenom, telephone) VALUES (?, ?, ?, ?, ?)');
        $req->execute([$email, $passwordHash, $nom, $prenom, $telephone]);
        $this->db->commit();
        return $this->db->lastInsertId();
    } catch (Exception $e) {
        $this->db->rollBack();
    }
}

// Mesurer le temps d'exécution et la consommation mémoire pour la version initiale du code
$start_time_original = microtime(true);
$memory_usage_original = memory_get_peak_usage(true); // Utilisation maximale de la mémoire

// Appeler la fonction pour la version initiale ici
// createUserOriginal($email, $password, $nom, $prenom, $telephone);

$end_time_original = microtime(true);
$execution_time_original = ($end_time_original - $start_time_original) * 1000; // en millisecondes

echo "Version initiale du code :\n";
echo "Temps d'exécution : $execution_time_original ms\n";
echo "Consommation mémoire : $memory_usage_original octets\n";
echo "<br><br>";

// Mesurer le temps d'exécution et la consommation mémoire pour la version optimisée du code
$start_time_optimized = microtime(true);
$memory_usage_optimized = memory_get_peak_usage(true); // Utilisation maximale de la mémoire

// Appeler la fonction pour la version optimisée ici
// createUserOptimized($email, $password, $nom, $prenom, $telephone);

$end_time_optimized = microtime(true);
$execution_time_optimized = ($end_time_optimized - $start_time_optimized) * 1000; // en millisecondes

echo "Version optimisée du code :\n";
echo "Temps d'exécution : $execution_time_optimized ms\n";
echo "Consommation mémoire : $memory_usage_optimized octets\n";

?>

</body>
</html>