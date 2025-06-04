<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des médecins par spécialité</title>
    <!-- Inclure Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="listermedecin.css">
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
    <div class="container mt-5">
        <div class="card">
            <div class="card-header bg-info text-white">
                <h5 class="card-title">Liste des médecins spécialisés dans cette domaine</h5>
            </div>
            <div class="card-body">
                <?php
                // Inclure le fichier de connexion à la base de données
                include 'dBConnect.php';

                // Vérifier si le formulaire a été soumis
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    // Récupérer la spécialité soumise par le formulaire
                    $specialite = $_POST['specialite'];

                    // Appeler la fonction pour lister les médecins par spécialité
                    $liste_medecins = lister_medecins_par_specialite($specialite);

                    // Afficher la liste des médecins
                    if ($liste_medecins) {
                        echo "<ul class='list-group'>";
                        foreach ($liste_medecins as $medecin) {
                            echo "<li class='list-group-item'>" . $medecin['nom'] . " " . $medecin['prenom'] . "</li>";
                        }
                        echo "</ul>";
                    } else {
                        echo "<div class='alert alert-warning' role='alert'>Aucun médecin trouvé pour la spécialité $specialite.</div>";
                    }
                }

                // Fonction pour lister les médecins par spécialité
                function lister_medecins_par_specialite($specialite)
                {
                    $con = connexion();

                    // Échapper les caractères spéciaux pour éviter les injections SQL
                    $specialite_ = $con->real_escape_string($specialite);

                    // Requête pour lister les médecins par spécialité
                    $sql = "SELECT * FROM medecin WHERE specialite = '$specialite_'";

                    // Exécuter la requête
                    $result = $con->query($sql);

                    // Créer un tableau pour stocker les médecins
                    $liste_medecins = array();

                    // Parcourir les résultats et les stocker dans le tableau
                    while ($row = $result->fetch_assoc()) {
                        $liste_medecins[] = $row;
                    }

                    // Fermer la connexion à la base de données
                    $con->close();

                    return $liste_medecins;
                }
                ?>
            </div>
        </div>
    </div>
    <!-- Inclure Bootstrap JS (facultatif) -->
    <script src="https://code.jquery.com/jquery-3.5.   1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>