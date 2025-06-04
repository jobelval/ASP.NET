<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enregistrement d'une consultation</title>
    <!-- Inclure Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="cssconsultation.css">
    <style>
        .bg-success {
            background-color: #28a745;
            color: #fff;
        }
    </style>
</head>

<body>
    
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        <header>
        <nav class="navbar navbar-expand-lg" id="nav">
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
    // Inclure le fichier de connexion à la base de données
    include("dBConnect.php");

    // Vérifier si le formulaire a été soumis
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Récupérer les données du formulaire
        $id = $_POST['id'];
        $idmedecin = $_POST['idmedecin'];
        $codepatient = $_POST['codepatient'];
        $poids = $_POST['poids'];
        $hauteur = $_POST['hauteur'];
        $diagnostique = $_POST['diagnostique'];
        $date_consultation = $_POST['date_consultation']; // Peut être remplacé par une date automatique

        // Appeler la fonction d'insertion des consultations
        Insert_consultation($id, $idmedecin, $codepatient, $poids, $hauteur, $diagnostique, $date_consultation);
    }

    function Insert_consultation($id, $idmedecin, $codepatient, $poids, $hauteur, $diagnostique, $date_consultation)
    {
        $con = connexion(); // Utiliser la connexion définie dans le fichier dBconnect.php

        // Échapper les caractères spéciaux pour éviter les injections SQL
        $id_ = $con->real_escape_string($id);
        $idmedecin_ = $con->real_escape_string($idmedecin);
        $codepatient_ = $con->real_escape_string($codepatient);
        $poids_ = $con->real_escape_string($poids);
        $hauteur_ = $con->real_escape_string($hauteur);
        $diagnostique_ = $con->real_escape_string($diagnostique);
        $date_consultation_ = $con->real_escape_string($date_consultation);

        // Requête d'insertion dans la table consultation
        $sql = "INSERT INTO consultation (id, idmedecin, codepatient, poids, hauteur, diagnostique, date_consultation) 
                VALUES ('$id_', '$idmedecin_', '$codepatient_', '$poids_', '$hauteur_', '$diagnostique_', '$date_consultation_')";

        // Exécuter la requête et afficher un message approprié
        if ($con->query($sql) === TRUE) {
            echo '<div class="alert alert-success" role="alert">
                    Consultation enregistrée avec succès.
                  </div>';
            echo '<script>
                    setTimeout(function(){
                        document.querySelector(".alert").style.display = "none";
                    }, 5000);
                  </script>';
        } else {
            echo "Erreur lors de l'enregistrement de la consultation : " . $con->error;
        }

        // Afficher toutes les consultations du système
        echo '<div class="alert alert-info mt-4" role="alert">';
        echo "<h2>Toutes les consultations du système :</h2>";
        echo '</div>';
        $sql = "SELECT * FROM consultation";
        $result = $con->query($sql);

        if ($result->num_rows > 0) {
            echo '<table class="table table-bordered">';
            echo '<thead class="bg-info text-white">';
            echo '<tr>';
            echo '<th>ID</th>';
            echo '<th>ID Médecin</th>';
            echo '<th>Code Patient</th>';
            echo '<th>Poids</th>';
            echo '<th>Hauteur</th>';
            echo '<th>Diagnostique</th>';
            echo '<th>Date Consultation</th>';
            echo '</tr>';
            echo '</thead>';
            echo '<tbody>';
            while ($row = $result->fetch_assoc()) {
                echo '<tr>';
                echo '<td>' . $row['id'] . '</td>';
                echo '<td>' . $row['idmedecin'] . '</td>';
                echo '<td>' . $row['codepatient'] . '</td>';
                echo '<td>' . $row['poids'] . '</td>';
                echo '<td>' . $row['hauteur'] . '</td>';
                echo '<td>' . $row['diagnostique'] . '</td>';
                echo '<td>' . $row['date_consultation'] . '</td>';
                echo '</tr>';
            }
            echo '</tbody>';
            echo '</table>';
        } else {
            echo '<p>Aucune consultation trouvée.</p>';
        }
        // Fermer la connexion à la base de données
        $con->close();
    }
    ?>
    <!-- Inclure Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>