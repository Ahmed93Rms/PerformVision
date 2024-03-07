<?php 

class Model {
    private $db;
    private static $instance = null;

    private function __construct()
    {
        include "Utils/credentials.php";
        $this->db = new PDO($dsn, $login, $mdp);
        $this->db -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    /**
     * Méthode permettant de récupérer un modèle car le constructeur est privé (Implémentation du Design Pattern Singleton)
     */
    public static function getModel() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function createUser($email, $password, $nom, $prenom, $telephone) {
        $password = 'aq1'.sha1($password.'1524').'25';
        $req = $this->db->prepare('INSERT INTO utilisateur (mail, password, nom, prenom, telephone) VALUES (?, ?, ?, ?, ?)');
        $req->execute([$email, $password, $nom, $prenom, $telephone]);
        return $this->db->lastInsertId();
    }

    public function findUserByEmail($email) {
        $req = $this->db->prepare('SELECT * FROM utilisateur WHERE mail = ?');
        $req->execute([$email]);
        return $req->fetch();
    }

    public function emailExists($email) {
        $requete = $this->db->prepare('SELECT COUNT(*) FROM utilisateur WHERE mail = ?');
        $requete->bindValue(1, $email, PDO::PARAM_STR);
        $requete->execute();
        $count = $requete->fetchColumn();
        return $count > 0;
    }

    public function assignRoleToUser($userId, $role) {
        if ($role == 'client') {
            $requete = $this->db->prepare('INSERT INTO client (id_utilisateur) SELECT id_utilisateur FROM utilisateur WHERE id_utilisateur = :userId');
            $requete->bindParam(':userId', $userId);
            $requete->execute();
        } else if ($role == 'formateur') {
            $requete = $this->db->prepare('INSERT INTO formateur (id_utilisateur) SELECT id_utilisateur FROM utilisateur WHERE id_utilisateur = :userId');
            $requete->bindParam(':userId', $userId);
            $requete->execute();
        }
    }

    public function getUserAndRole($email) {
        $req = $this->db->prepare("
            SELECT utilisateur.*, 
                    CASE WHEN c.id_utilisateur IS NOT NULL THEN 'client'
                         WHEN f.id_utilisateur IS NOT NULL THEN 'formateur'
                         WHEN a.id_utilisateur IS NOT NULL THEN 'admin'
                         ELSE 'inconnu' 
                    END as role
            FROM utilisateur
            LEFT JOIN client c ON utilisateur.id_utilisateur = c.id_utilisateur
            LEFT JOIN formateur f ON utilisateur.id_utilisateur = f.id_utilisateur
            LEFT JOIN admin a ON utilisateur.id_utilisateur = a.id_utilisateur
            WHERE utilisateur.mail = ?"
        );
        $req->execute([$email]);
        return $req->fetch(PDO::FETCH_ASSOC);
    }

    public function getFormateursByCategorie($id_theme) {
        $req = $this->db->prepare('SELECT * FROM Utilisateur
                                   JOIN formateur ON Utilisateur.id_utilisateur = formateur.id_utilisateur
                                   JOIN AExperiencePedagogique ON Utilisateur.id_utilisateur = AExperiencePedagogique.id_utilisateur
                                   JOIN AExpertiseProfessionnelle ON Utilisateur.id_utilisateur = AExpertiseProfessionnelle.id_utilisateur
                                   WHERE AExperiencePedagogique.id_theme = :id_theme
                                   OR AExpertiseProfessionnelle.id_theme = :id_theme');
        $req->execute(['id_theme' => $id_theme]);
        return $req->fetchAll();
    }

    public function addCompany($societe, $userId) {
        $req = $this->db->prepare('UPDATE client SET societe = ? WHERE id_utilisateur = ?');
        $req->execute([$societe, $userId]);
        return $req->rowCount() > 0;
    }

    public function updateFormateurInfo($userId, $linkedin, $cvFileName, $taux) {
        $req = $this->db->prepare('UPDATE formateur SET linkedin = ?, cv = ?, taux_horaire = ? WHERE id_utilisateur = ?');
        $req->execute([$linkedin, $cvFileName, $taux, $userId]);
        return $req->rowCount() > 0;
    }
    
    public function insertActivity($name, $imageName,  $text, $userId, $categoryId) {
        $req = $this->db->prepare('INSERT INTO activite (nom_activite, image, texte, id_utilisateur, id_categorie) VALUES (?, ?, ?, ?, ?)');
        $req->execute([$name, $imageName,  $text, $userId, $categoryId]);
        return $req->fetch();
    }

    public function getCategories() {
        $req = $this->db->prepare('SELECT * FROM categorie');
        $req->execute();
        return $req->fetchAll();
    }

    public function getFormateurs() {
        $req = $this->db->prepare('SELECT u.id_utilisateur, u.prenom, u.nom, u.mail, f.linkedin FROM utilisateur u JOIN formateur f ON u.id_utilisateur = f.id_utilisateur');
        $req->execute();
        return $req->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getLinkedin($userId) {
        $req = $this->db->prepare('SELECT linkedin FROM formateur WHERE id_utilisateur = ?');
        $req->execute([$userId]);
        $req->fetch();
    }

    public function promouvoirFormateurEnModerateur($idUtilisateur) {
        $req = $this->db->prepare('INSERT INTO Moderateur (id_utilisateur) VALUES (?)');
        $req->execute([$idUtilisateur]);
        return $req->fetch();
    }

    public function isModerateur($idUtilisateur) {
        $req = $this->db->prepare('SELECT COUNT(*) FROM Moderateur WHERE id_utilisateur = ?');
        $req->execute([$idUtilisateur]);
        return $req->fetchColumn() > 0;
    }

    public function getActivity() {
        $req = $this->db->prepare('SELECT a.nom_activite, a.image, a.texte, a.id_categorie, c.nom_categorie FROM activite a JOIN categorie c ON a.id_categorie = c.id_categorie');
        $req->execute();
        return $req->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getThemes() {
        $req = $this->db->prepare('SELECT * FROM theme');
        $req->execute();
        return $req->fetchAll();
    }

    public function getThemesByCategorie($categorieId) {
        $stmt = $this->db->prepare('SELECT * FROM Theme WHERE id_categorie = ?');
        $stmt->execute([$categorieId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addExperience($idUtilisateur, $idTheme, $heures, $sessions, $commentaire) {
        $req = $this->db->prepare('INSERT INTO aexperiencepedagogique (id_utilisateur, id_theme, volume_heure_moyen_session, nombre_sessions_effectuees, commentaire) VALUES (?, ?, ?, ?, ?)');
        $req->execute([$idUtilisateur, $idTheme, $heures, $sessions, $commentaire]);
        return $req->fetch();
    }

    public function getNiveaux() {
        $req = $this->db->prepare('SELECT * FROM niveau');
        $req->execute();
        return $req->fetchAll();
    }

    public function addExperiencePro($idUtilisateur, $idTheme, $exp, $commentaire, $id_niveau) {
        $req = $this->db->prepare('INSERT INTO aexpertiseprofessionnelle (id_utilisateur, id_theme, duree_moyenne_experience, commentaire, id_niveau) VALUES (?, ?, ?, ?, ?)');
        $req->execute([$idUtilisateur, $idTheme, $exp, $commentaire, $id_niveau]);
        return $req->fetch();
    }

    public function addTheme($categorieId, $nomTheme) { 
        $getLastIdQuery = $this->db->query('SELECT MAX(id_theme) FROM theme');
        $lastId = $getLastIdQuery->fetchColumn();
        $newId = $lastId + 1;
        
        $req = $this->db->prepare('INSERT INTO theme (id_theme, id_categorie, nom_theme, valide_theme) VALUES (?, ?, ?, True)');
        $req->execute([$newId, $categorieId, $nomTheme]); 
        return $newId;
    }

    public function saveMessage($texte, $date, $userId){
        $req = $this->db->prepare('INSERT INTO message(texte, date_heure, valide_message, lu, id_utilisateur) VALUES (?, ?, True, True, ?)');
        $req->execute([$texte, $date, $userId]);
        return $req->fetch();
    }
}