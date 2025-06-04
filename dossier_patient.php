<?php
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
    $date_enregistrement = date("Y-m-d"); // Date d'enregistrement automatique

    // Appeler la fonction d'insertion des patients
    Insert_dossier_patient($code, $nom, $prenom, $sexe, $tel, $adresse, $date_enregistrement);
}

function Insert_dossier_patient($code, $nom, $prenom, $sexe, $tel, $adresse, $date_enregistrement)
{
    $con = connexion(); // Utiliser la connexion définie dans le fichier dBconnect.php

    // Échapper les caractères spéciaux pour éviter les injections SQL
    $code_ = $con->real_escape_string($code);
    $nom_ = $con->real_escape_string($nom);
    $prenom_ = $con->real_escape_string($prenom);
    $sexe_ = $con->real_escape_string($sexe);
    $tel_ = $con->real_escape_string($tel);
    $adresse_ = $con->real_escape_string($adresse);
    $date_enregistrement_ = $con->real_escape_string($date_enregistrement);

    // Requête d'insertion dans la table dossier_patient
    $sql = "INSERT INTO dossier_patient (code, nom, prenom, sexe, tel, adresse, date_enregistrement) 
            VALUES ('$code_', '$nom_', '$prenom_', '$sexe_', '$tel_', '$adresse_', '$date_enregistrement_')";

    // Exécuter la requête
    if ($con->query($sql) === TRUE) {
        // Afficher le message de succès
        echo "<div class='alert alert-info' role='alert'>Patient enregistré avec succès.</div>";

        // Rediriger vers la même page après 5 secondes
        header("refresh:5;url=affichage_patient.php");
    } else {
        echo "Erreur lors de l'enregistrement du patient : " . $con->error;
    }

    // Fermer la connexion à la base de données
    $con->close();
}

// Récupérer tous les patients du système
function get_all_patients()
{
    $con = connexion();

    // Requête pour récupérer tous les patients
    $sql = "SELECT * FROM dossier_patient";

    // Exécuter la requête
    $result = $con->query($sql);

    // Créer un tableau pour stocker les patients
    $patients = array();

    // Parcourir les résultats et les stocker dans le tableau
    while ($row = $result->fetch_assoc()) {
        $patients[] = $row;
    }

    // Fermer la connexion à la base de données
    $con->close();

    return $patients;
}

// Afficher tous les patients dans un tableau Bootstrap
$patients = get_all_patients();
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des patients</title>
    <!-- Inclure Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <h1>Liste des patients</h1>
        <?php if (!empty($patients)) : ?>
            <table class="table table-bordered table-striped">
                <thead class="bg-info text-white">
                    <tr>
                        <th>Code</th>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Sexe</th>
                        <th>Téléphone</th>
                        <th>Adresse</th>
                        <th>Date d'enregistrement</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($patients as $patient) : ?>
                        <tr>
                            <td><?php echo $patient['code']; ?></td>
                            <td><?php echo $patient['nom']; ?></td>
                            <td><?php echo $patient['prenom']; ?></td>
                            <td><?php echo $patient['sexe']; ?></td>
                            <td><?php echo $patient['tel']; ?></td>
                            <td><?php echo $patient['adresse']; ?></td>
                            <td><?php echo $patient['date_enregistrement']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else : ?>
            <p>Aucun patient enregistré pour le moment.</p>
        <?php endif; ?>
    </div>
    <!-- Inclure Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>