<?php
// Inclure le fichier de connexion à la base de données
include("dBConnect.php");

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $code = $_POST['code'];
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $sexe = $_POST['sexe'];
    $tel = $_POST['tel'];
    $adresse = $_POST['adresse'];

    // Appeler la fonction de mise à jour du patient
    Modifier_patient($code, $nom, $prenom, $sexe, $tel, $adresse);
}

// Définir la fonction de mise à jour du patient
function Modifier_patient($code, $nom, $prenom, $sexe, $tel, $adresse)
{
    $con = connexion(); // Utiliser la connexion définie dans le fichier dBConnect.php

    // Échapper les caractères spéciaux pour éviter les injections SQL
    $nom_ = $con->real_escape_string($nom);
    $prenom_ = $con->real_escape_string($prenom);
    $sexe_ = $con->real_escape_string($sexe);
    $tel_ = $con->real_escape_string($tel);
    $adresse_ = $con->real_escape_string($adresse);

    // Requête de mise à jour du patient dans la table patient
    $sql = "UPDATE dossier_patient SET nom='$nom_', prenom='$prenom_', sexe='$sexe_', tel='$tel_', adresse='$adresse_' WHERE code='$code'";

    // Exécuter la requête et afficher un message approprié
    if ($con->query($sql) === TRUE) {
        // Rediriger vers la page affichant tous les médecins
        header("Location: affichage_patient.php");
        exit();
    } else {
        echo '<div class="alert alert-danger" role="alert">Erreur lors de la modification du patient : ' . $con->error . '</div>';
    }

    // Fermer la connexion à la base de données
    $con->close();
}
?>