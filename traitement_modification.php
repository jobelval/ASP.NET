<?php
// Inclure le fichier de connexion à la base de données
include("dBConnect.php");

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $id = $_POST['id'];
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $sexe = $_POST['sexe'];
    $tel = $_POST['tel'];
    $adresse = $_POST['adresse'];
    $email = $_POST['email'];

    // Mettre à jour le médecin dans la base de données
    $con = connexion();
    $sql = "UPDATE medecin SET nom='$nom', prenom='$prenom', sexe='$sexe', tel='$tel', adresse='$adresse', email='$email' WHERE id=$id";

    if ($con->query($sql) === TRUE) {
        // Rediriger vers la page affichant tous les médecins
        header("Location: affichage_medecin.php");
        exit();
    } else {
        echo "Erreur lors de la mise à jour du médecin : " . $con->error;
    }

    $con->close();
}
?>