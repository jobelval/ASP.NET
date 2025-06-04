<?php
// Vérifier si l'ID de la consultation est passé dans l'URL
if (isset($_GET['id']) && !empty($_GET['id'])) {
    // Récupérer l'ID de la consultation depuis l'URL
    $id_consultation = $_GET['id'];

    // Inclure le fichier de connexion à la base de données
    include("dBConnect.php");

    // Fonction pour récupérer les détails de la consultation à modifier
    function recuperer_details_consultation($id_consultation)
    {
        $con = connexion();

        // Échapper les caractères spéciaux pour éviter les injections SQL
        $id_consultation_ = $con->real_escape_string($id_consultation);

        // Requête pour récupérer les détails de la consultation à modifier
        $sql = "SELECT * FROM consultation WHERE id = '$id_consultation_'";

        // Exécuter la requête
        $result = $con->query($sql);

        // Récupérer les détails de la consultation
        $details_consultation = $result->fetch_assoc();

        // Fermer la connexion à la base de données
        $con->close();

        return $details_consultation;
    }

    // Récupérer les détails de la consultation à modifier
    $consultation = recuperer_details_consultation($id_consultation);

    // Vérifier si la consultation existe
    if ($consultation) {
        // Afficher le formulaire de modification avec les détails de la consultation
       
        ?>
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
        </header><br><br>    <div class="container">
                <h1>Modification d'une Consultation</h1>
                <form action="traitementconsultation.php" method="post">
                    <input type="hidden" name="id" value="<?php echo $consultation['id']; ?>">
                    <div class="form-group">
                        <label for="idmedecin">ID Médecin :</label>
                        <input type="text" class="form-control" id="idmedecin" name="idmedecin" value="<?php echo $consultation['idmedecin']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="codepatient">Code Patient :</label>
                        <input type="text" class="form-control" id="codepatient" name="codepatient" value="<?php echo $consultation['codepatient']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="poids">Poids :</label>
                        <input type="text" class="form-control" id="poids" name="poids" value="<?php echo $consultation['poids']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="hauteur">Hauteur :</label>
                        <input type="text" class="form-control" id="hauteur" name="hauteur" value="<?php echo $consultation['hauteur']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="diagnostique">Diagnostique :</label>
                        <textarea class="form-control" id="diagnostique" name="diagnostique" rows="4" required><?php echo $consultation['diagnostique']; ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="date_consultation">Date Consultation :</label>
                        <input type="date" class="form-control" id="date_consultation" name="date_consultation" value="<?php echo $consultation['date_consultation']; ?>" required>
                    </div>
                    <button type="submit" class="btn btn-info text-white">Enregistrer</button>
                </form>
            </div>
            <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        </body>

        </html>
    <?php
} else {
    // Redirection vers la page d'erreur si la consultation n'est pas trouvée
    header("Location: affichageconsultation.php");
    exit();
}
} else {
// Redirection vers la page d'erreur si l'ID de la consultation n'est pas spécifié dans l'URL
header("Location: affichageconsultation.php");
exit();
}
?>