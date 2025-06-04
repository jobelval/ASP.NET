<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Consultations</title>
    <!-- Inclure Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="afficherpatient.css">
</head>

<body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
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
    <div class="container">
        <h1>Liste des Consultations</h1>
        <?php
        // Inclure le fichier de connexion à la base de données
        include("dBConnect.php");

        // Fonction pour récupérer toutes les consultations
        function recuperer_toutes_les_consultations()
        {
            $con = connexion();

            // Requête pour récupérer toutes les consultations
            $sql = "SELECT * FROM consultation";

            // Exécuter la requête
            $result = $con->query($sql);

            // Créer un tableau pour stocker toutes les consultations
            $toutes_les_consultations = array();

            // Parcourir les résultats et les stocker dans le tableau
            while ($row = $result->fetch_assoc()) {
                $toutes_les_consultations[] = $row;
            }

            // Fermer la connexion à la base de données
            $con->close();

            return $toutes_les_consultations;
        }

        // Récupérer toutes les consultations
        $consultations = recuperer_toutes_les_consultations();

        // Vérifier si des consultations existent
        if ($consultations) {
            // Afficher les consultations dans un tableau Bootstrap
            echo "<table class='table'>";
            echo "<thead class='bg-info text-white'>";
            echo "<tr>";
            echo "<th>ID</th>";
            echo "<th>ID Médecin</th>";
            echo "<th>Code Patient</th>";
            echo "<th>Poids</th>";
            echo "<th>Hauteur</th>";
            echo "<th>Diagnostique</th>";
            echo "<th>Date Consultation</th>";
            echo "<th>Action</th>";
            echo "</tr>";
            echo "</thead>";
            echo "<tbody>";
            foreach ($consultations as $consultation) {
                echo "<tr>";
                echo "<td>" . $consultation['id'] . "</td>";
                echo "<td>" . $consultation['idmedecin'] . "</td>";
                echo "<td>" . $consultation['codepatient'] . "</td>";
                echo "<td>" . $consultation['poids'] . "</td>";
                echo "<td>" . $consultation['hauteur'] . "</td>";
                echo "<td>" . $consultation['diagnostique'] . "</td>";
                echo "<td>" . $consultation['date_consultation'] . "</td>";
                echo "<td><a href=modifierconsultation.php?id=" . $consultation['id'] . "' class='btn btn-info text-white'>Modifier</a></td>";
                echo "</tr>";
            }
            echo "</tbody>";
            echo "</table>";
        } else {
            echo "<p class='text-danger'>Aucune consultation trouvée.</p>";
        }
        ?>
    </div>
    <!-- Inclure Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>