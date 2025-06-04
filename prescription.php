<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des prescriptions</title>
    <!-- Inclure Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="prescription.css">
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
        <h1>Liste des prescriptions</h1>
        <!-- Afficher le message "Prescription enregistrée avec succès" -->
        <div id="successMessage" class="alert alert-success" role="alert" style="display:none;">
            Prescription enregistrée avec succès.
        </div>
        <!-- Tableau pour afficher les prescriptions -->
        <table class="table table-bordered">
            <thead class="bg-info text-white"> <!-- Entête du tableau en vert -->
                <tr>
                    <th scope="col">ID Consultation</th>
                    <th scope="col">Prescription</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Inclure le fichier de connexion à la base de données
                include("dbConnect.php");

                // Vérifier si le formulaire a été soumis
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    // Récupérer les données du formulaire
                    $idconsultation = $_POST['idconsultation'];
                    $prescription = $_POST['prescription'];

                    // Appeler la fonction d'insertion des prescriptions
                    Insert_prescription($idconsultation, $prescription);
                }

                // Fonction pour insérer une prescription dans la base de données
                function Insert_prescription($idconsultation, $prescription) {
                    $con = connexion();
                    $idconsultation_ = $con->real_escape_string($idconsultation);
                    $prescription_ = $con->real_escape_string($prescription);

                    $sql = "INSERT INTO prescription (idconsultation, prescription) 
                            VALUES ('$idconsultation_', '$prescription_')";
                    
                    // Exécuter la requête et afficher un message approprié
                    if ($con->query($sql) === TRUE) {
                        echo "<tr>";
                        echo "<td>" . $idconsultation_ . "</td>";
                        echo "<td>" . $prescription_ . "</td>";
                        echo "</tr>";
                        echo '<script>document.getElementById("successMessage").style.display = "block";</script>';
                    } else {
                        echo "Erreur lors de l'enregistrement de la prescription : " . $con->error;
                    }

                    // Fermer la connexion à la base de données
                    $con->close();
                }

                // Récupérer toutes les prescriptions de la base de données
                $con = connexion();
                $sql = "SELECT * FROM prescription";
                $result = $con->query($sql);

                // Afficher les prescriptions dans le tableau
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['idconsultation'] . "</td>";
                        echo "<td>" . $row['prescription'] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='2'>Aucune prescription trouvée.</td></tr>";
                }
                // Fermer la connexion à la base de données
                $con->close();
                ?>
            </tbody>
        </table>
    </div>
    <!-- Inclure Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- Script pour masquer le message après 5 secondes -->
    <script>
        setTimeout(function(){
            document.getElementById('successMessage').style.display = 'none';
        }, 5000);
    </script>
</body>
</html>