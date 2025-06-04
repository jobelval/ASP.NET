<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modification d'une Consultation</title>
    <!-- Inclure Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="afficherpatient.css">
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light" id="nav">
            <div class="container-fluid">
                <a class="navbar-brand" href="index.html">Acceuil</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                    <ul class="navbar-nav">

                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="affichage_medecin.php"><b>Médecin</b></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="affichage_patient.php"><b>Patient</b></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="affichageconsultation.php"><b>Consultation</b></a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <b>Effectuer un engregistrement</b>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="formulairemedecin.php"><b>Enregistrer un médecin</b></a></li>
                                <li><a class="dropdown-item" href="formulairepatient.php"><b>Eregistrer un patient</b></a></li>
                                <li><a class="dropdown-item" href="formulaireenregistrer_consultation.php"><b>Enregistrer une consultation</b></a></li>
                                <li><a class="dropdown-item" href="formulairepourprescription.php"><b>Enregistrer des prescription</b></a></li>
                            </ul>
                        </li>



                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <b>Filtrage</b>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="formulairespecialite.php"><b>Spécialité</b></a></li>
                                <li><a class="dropdown-item" href="formulairelisterconsultation.php"><b>Consultation/Patient</b></a></li>
                                <li><a class="dropdown-item" href="formulairetrouverpatient1.php"><b>Trouver Patient</b></a></li>
                                <li><a class="dropdown-item" href="formulaireverifier.php"><b>Vérification/Consultation</b></a></li>
                            </ul>
                        </li>

                        <li><img src="img.png" width="40px" style="margin-left: 780px"></li>
                    </ul>
                </div>
            </div>
        </nav>
    </header><br><br>

    <?php
    // Vérifier si le formulaire a été soumis
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Récupérer les données du formulaire
        $id = $_POST['id'];
        $idmedecin = $_POST['idmedecin'];
        $codepatient = $_POST['codepatient'];
        $poids = $_POST['poids'];
        $hauteur = $_POST['hauteur'];
        $diagnostique = $_POST['diagnostique'];
        $date_consultation = $_POST['date_consultation'];

        // Inclure le fichier de connexion à la base de données
        include("dBConnect.php");

        // Fonction pour mettre à jour les détails de la consultation
        function modifier_consultation($id, $idmedecin, $codepatient, $poids, $hauteur, $diagnostique, $date_consultation)
        {
            $con = connexion();

            // Échapper les caractères spéciaux pour éviter les injections SQL
            $id_ = $con->real_escape_string($id);
            $idmedecin_ = $con->real_escape_string($idmedecin);
            $codepatient_ = $con->real_escape_string($codepatient);
            $poids_ = $con->real_escape_string($poids);
            $hauteur_ = $con->real_escape_string($hauteur);
            $diagnostique_ = $con->real_escape_string($diagnostique);
            $date_consultation_ = $con->real_escape_string($date_consultation);

            // Requête pour mettre à jour les détails de la consultation dans la base de données
            $sql = "UPDATE consultation SET idmedecin = '$idmedecin_', codepatient = '$codepatient_', poids = '$poids_', hauteur = '$hauteur_', diagnostique = '$diagnostique_', date_consultation = '$date_consultation_' WHERE id = '$id_'";

            // Exécuter la requête
            if ($con->query($sql) === TRUE) {
                echo "<div class='alert alert-success' role='alert'>Consultation modifiée avec succès.</div>";
                // Rediriger vers la page des consultations après 5 secondes
                header("refresh:5;url=affichageconsultation.php");
                exit();
            } else {
                echo "<div class='alert alert-danger' role='alert'>Erreur lors de la modification de la consultation : " . $con->error . "</div>";
            }

            // Fermer la connexion à la base de données
            $con->close();
        }

        // Appeler la fonction pour modifier les détails de la consultation
        modifier_consultation($id, $idmedecin, $codepatient, $poids, $hauteur, $diagnostique, $date_consultation);
    }
    ?>

    <?php
    // Inclure le fichier de connexion à la base de données
    include("dBConnect.php");

    // Fonction pour récupérer toutes les consultations
    function recuperer_toutes_consultations()
    {
        $con = connexion();
// Requête pour récupérer toutes les consultations
$sql = "SELECT * FROM consultation";

// Exécuter la requête
$result = $con->query($sql);

// Vérifier s'il y a des résultats
if ($result->num_rows > 0) {
    // Afficher les consultations sous forme de tableau
    echo "<div class='container'>";
    echo "<h2>Toutes les consultations</h2>";
    echo "<table class='table'>";
    echo "<thead><tr><th>ID</th><th>ID Médecin</th><th>Code Patient</th><th>Poids</th><th>Hauteur</th><th>Diagnostique</th><th>Date Consultation</th></tr></thead>";
    echo "<tbody>";
    // Parcourir les résultats et afficher chaque consultation
    while ($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row["id"] . "</td><td>" . $row["idmedecin"] . "</td><td>" . $row["codepatient"] . "</td><td>" . $row["poids"] . "</td><td>" . $row["hauteur"] . "</td><td>" . $row["diagnostique"] . "</td><td>" . $row["date_consultation"] . "</td></tr>";
    }
    echo "</tbody>";
    echo "</table>";
    echo "</div>";
} else {
    echo "Aucune consultation trouvée.";
}

// Fermer la connexion à la base de données
$con->close();
}

// Appeler la fonction pour récupérer toutes les consultations
recuperer_toutes_consultations();
?>
</body>

</html>