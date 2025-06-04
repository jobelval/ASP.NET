<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vérification de consultation</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="verifier.css">
    
</head>

<body>
    
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        <header>
        <nav class="navbar navbar-expand-lg navbar-light" id="nav">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php">Acceuil</a>
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

    
    <div class="container">
        <h1>Résultats de la consultation du patient</h1>
        <?php
        // Inclure le fichier de connexion à la base de données
        include 'dBconnect.php';

        // Vérifier si le formulaire a été soumis
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Récupérer le code du patient soumis par le formulaire
            $codepatient = $_POST['codepatient'];

            // Appeler la fonction pour vérifier la consultation du patient
            $resultat = verifier_consultation_patient($codepatient);

            // Afficher le résultat de la vérification
            if ($resultat) {
                // Afficher les informations sur les consultations du patient
                echo "<h2>Informations :</h2>";
                afficher_consultations_patient($codepatient);

                // Afficher les prescriptions associées à ces consultations
                echo "<h2>Prescriptions :</h2>";
                afficher_prescriptions_patient($codepatient);
            } else {
                echo "<p>Aucune consultation trouvée pour le patient avec le code $codepatient.</p>";
            }
        }

        // Fonction pour vérifier la consultation d'un patient
        function verifier_consultation_patient($codepatient)
        {
            $con = connexion();

            // Échapper les caractères spéciaux pour éviter les injections SQL
            $codepatient_ = $con->real_escape_string($codepatient);

            // Requête pour vérifier la consultation d'un patient
            $sql = "SELECT * FROM consultation WHERE codepatient = '$codepatient_'";

            // Exécuter la requête
            $result = $con->query($sql);

            // Vérifier s'il y a des résultats
            if ($result->num_rows > 0) {
                return true;
            } else {
                return false;
            }

            // Fermer la connexion à la base de données
            $con->close();
        }

        // Fonction pour afficher les consultations d'un patient
        function afficher_consultations_patient($codepatient)
        {
            $con = connexion();

            // Échapper les caractères spéciaux pour éviter les injections SQL
            $codepatient_ = $con->real_escape_string($codepatient);

            // Requête pour sélectionner les consultations d'un patient
            $sql = "SELECT * FROM consultation WHERE codepatient = '$codepatient_'";

            // Exécuter la requête
            $result = $con->query($sql);

            // Afficher les consultations sous forme de tableau
            echo "<table class='table'>";
            echo "<thead class='bg-info text-white'>";
            echo "<tr><th>ID Consultation</th><th>ID Médecin</th><th>Poids</th><th>Hauteur</th><th>Diagnostique</th><th>Date Consultation</th></tr>";
            echo "</thead>";
            echo "<tbody>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['idmedecin'] . "</td>";
                echo "<td>" . $row['poids'] . "</td>";
                echo "<td>" . $row['hauteur'] . "</td>";
                echo "<td>" . $row['diagnostique'] . "</td>";
                echo "<td>" . $row['date_consultation'] . "</td>";
                echo "</tr>";
            }
            echo "</tbody>";
            echo "</table>";

            // Fermer la connexion à la base de données
            $con->close();
        }

        // Fonction pour afficher les prescriptions associées à un patient
        function afficher_prescriptions_patient($codepatient)
        {
            $con = connexion();

            // Échapper les caractères spéciaux pour éviter les injections SQL
            $codepatient_ = $con->real_escape_string($codepatient);

            // Requête pour sélectionner les prescriptions associées à un patient
            $sql = "SELECT prescription FROM prescription WHERE idconsultation IN (SELECT id FROM consultation WHERE codepatient = '$codepatient_')";

            // Exécuter la requête
            $result = $con->query($sql);

            // Afficher les prescriptions
            echo "<ul>";
            while ($row = $result->fetch_assoc()) {
                echo "<li>" . $row['prescription'] . "</li>";
            }
            echo "</ul>";
            // Fermer la connexion à la base de données
            $con->close();
        }
        ?>
    </div>
    <!-- Inclure Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>