<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Résultats de la recherche</title>
    <!-- Inclure Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="trouverpatient.css">
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
        <h1>Résultats de la recherche</h1>
        <!-- Tableau pour afficher les informations du patient -->
        <table class="table table-bordered">
            <tbody class="bg-info"> <!-- Couleur verte pour le fond du tableau -->
                <?php
                // Inclure le fichier de connexion à la base de données
                include 'dBConnect.php';

                // Vérifier si le formulaire a été soumis
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    // Récupérer le mode de recherche et la valeur de recherche du formulaire
                    $mode = $_POST['mode'];
                    $recherche = $_POST['recherche'];

                    // Effectuer la recherche en fonction du mode choisi
                    if ($mode == 'code') {
                        // Recherche par code
                        $patient = trouver_patient_par_code($recherche);
                    } else if ($mode == 'nom_prenom') {
                        // Recherche par nom et prénom
                        $recherche = explode(" ", $recherche);
                        $nom = $recherche[0];
                        $prenom = $recherche[1];
                        $patient = trouver_patient_par_nom_prenom($nom, $prenom);
                    }

                    // Afficher les informations du patient s'il est trouvé
                    if ($patient) {
                        echo "<tr><th scope='row'>Nom</th><td>" . $patient['nom'] . "</td></tr>";
                        echo "<tr><th scope='row'>Prénom</th><td>" . $patient['prenom'] . "</td></tr>";
                        echo "<tr><th scope='row'>Sexe</th><td>" . $patient['sexe'] . "</td></tr>";
                        echo "<tr><th scope='row'>Téléphone</th><td>" . $patient['tel'] . "</td></tr>";
                        echo "<tr><th scope='row'>Adresse</th><td>" . $patient['adresse'] . "</td></tr>";
                        echo "<tr><th scope='row'>Date d'enregistrement</th><td>" . $patient['date_enregistrement'] . "</td></tr>";
                    } else {
                        echo "<tr><td colspan='2'>Patient non trouvé.</td></tr>";
                    }
                }
                
                // Fonction pour trouver un patient par son code dans la base de données
                function trouver_patient_par_code($code)
                {
                    $con = connexion();

                    // Échapper les caractères spéciaux pour éviter les injections SQL
                    $code_ = $con->real_escape_string($code);

                    // Requête pour trouver le patient par son code
                    $sql = "SELECT * FROM dossier_patient WHERE code = '$code_'";

                    // Exécuter la requête
                    $result = $con->query($sql);

                    // Récupérer la première ligne de résultats
                    $patient = $result->fetch_assoc();

                    // Fermer la connexion à la base de données
                    $con->close();

                    return $patient;
                }

                // Fonction pour trouver un patient par son nom et prénom dans la base de données
                function trouver_patient_par_nom_prenom($nom, $prenom)
                {
                    $con = connexion();

                    // Échapper les caractères spéciaux pour éviter les injections SQL
                    $nom_ = $con->real_escape_string($nom);
                    $prenom_ = $con->real_escape_string($prenom);

                    // Requête pour trouver le patient par son nom et prénom
                    $sql = "SELECT * FROM dossier_patient WHERE nom = '$nom_' AND prenom = '$prenom_'";

                    // Exécuter la requête
                    $result = $con->query($sql);

                    // Récupérer la première ligne de résultats
                    $patient = $result->fetch_assoc();

                    // Fermer la connexion à la base de données
                    $con->close();

                    return $patient;
                }
                ?>
            </tbody>
        </table>
    </div>
    <!-- Inclure Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>