<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Consultations par Patient</title>
    <!-- Inclure Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="listerpatient.css">
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
        <?php
        // Inclure le fichier de connexion à la base de données
        include 'dBConnect.php';

        // Vérifier si le formulaire a été soumis
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Récupérer le code du patient soumis par le formulaire
            $codepatient = $_POST['codepatient'];

            // Appeler la fonction pour lister les consultations par patient
            $liste_consultations = lister_consultations_par_patient($codepatient);

            // Afficher la liste des consultations
            if ($liste_consultations) {
        ?>
                <div class="alert alert-info" role="alert">
                    Liste des consultations pour le patient avec le code <?php echo $codepatient; ?> :
                </div>
                <table class="table table-bordered table-info">
                    <thead>
                        <tr>
                            <th scope="col">Date</th>
                            <th scope="col">Diagnostique</th>
                            <th scope="col">Poids (kg)</th>
                            <th scope="col">Hauteur (cm)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($liste_consultations as $consultation) {
                        ?>
                            <tr>
                                <td><?php echo $consultation['date_consultation']; ?></td>
                                <td><?php echo $consultation['diagnostique']; ?></td>
                                <td><?php echo $consultation['poids']; ?></td>
                                <td><?php echo $consultation['hauteur']; ?></td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            <?php
            } else {
            ?>
                <div class="alert alert-danger" role="alert">
                    Aucune consultation trouvée pour le patient avec le code <?php echo $codepatient; ?>.
                </div>
        <?php
            }
        }

        // Fonction pour lister les consultations par patient
        function lister_consultations_par_patient($codepatient)
        {
            $con = connexion();

            // Échapper les caractères spéciaux pour éviter les injections SQL
            $codepatient_ = $con->real_escape_string($codepatient);

            // Requête pour lister les consultations par patient
            $sql = "SELECT * FROM consultation WHERE codepatient = '$codepatient_'";

            // Exécuter la requête
            $result = $con->query($sql);

            // Créer un tableau pour stocker les consultations
            $liste_consultations = array();

            // Parcourir les résultats et les stocker dans le tableau
            while ($row = $result->fetch_assoc()) {
                $liste_consultations[] = $row;
            }

            // Fermer la connexion à la base de données
            $con->close();

            return $liste_consultations;
        }
        ?>
    </div>
    <!-- Inclure Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>