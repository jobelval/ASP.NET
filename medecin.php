<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Affichage des médecins</title>
    <!-- Inclure Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="csslistemedecin.css">
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
        <?php
        // Inclure le fichier de connexion à la base de données
        include ("dBConnect.php");

        // Vérifier si le formulaire a été soumis
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Récupérer les données du formulaire
            $nom = $_POST['nom'];
            $prenom = $_POST['prenom'];
            $sexe = $_POST['sexe'];
            $tel = $_POST['tel'];
            $adresse = $_POST['adresse'];
            $email = $_POST['email'];
            $specialite = $_POST['specialite'];

            // Appeler la fonction d'insertion des médecins
            Insert_medecin($nom, $prenom, $sexe, $tel, $adresse, $email, $specialite);

            // Afficher tous les médecins
            Afficher_tous_medecins();

            // Afficher le message "Médecin enregistré avec succès" pendant 5 secondes
            echo '<script>
                    setTimeout(function(){
                        document.getElementById("successMessage").style.display = "none";
                    }, 5000);
                  </script>';
        }

        // Définir la fonction Insert_medecin
        function Insert_medecin($nom, $prenom, $sexe, $tel, $adresse, $email, $specialite)
        {
            $con=connexion(); // Utiliser la connexion définie dans le fichier dBconnect.php

            // Échapper les caractères spéciaux pour éviter les injections SQL
            $nom_ = $con->real_escape_string($nom);
            $prenom_ = $con->real_escape_string($prenom);
            $sexe_ = $con->real_escape_string($sexe);
            $tel_ = $con->real_escape_string($tel);
            $adresse_ = $con->real_escape_string($adresse);
            $email_ = $con->real_escape_string($email);
            $specialite_ = $con->real_escape_string($specialite);

            // Requête d'insertion dans la table hopital_medecin
            $sql = "INSERT INTO medecin (nom, prenom, sexe, tel, adresse, email, specialite) 
                    VALUES ('$nom_', '$prenom_', '$sexe_', '$tel_', '$adresse_', '$email_', '$specialite_')";

            // Exécuter la requête et afficher un message approprié
            if ($con->query($sql) === TRUE) {
                echo '<div id="successMessage">Médecin enregistré avec succès.</div>';
            } else {
                echo "Erreur lors de l'enregistrement du médecin : " . $con->error;
            }

            // Fermer la connexion à la base de données
            $con->close();
        }

        // Définir la fonction pour afficher tous les médecins
        function Afficher_tous_medecins()
        {
            $con=connexion(); // Utiliser la connexion définie dans le fichier dBconnect.php

            // Requête pour sélectionner tous les médecins
            $sql = "SELECT * FROM medecin";

            // Exécuter la requête
            $result = $con->query($sql);

            // Afficher la liste des médecins dans un tableau avec Bootstrap
            if ($result->num_rows > 0) {
                echo "<h2>Liste de tous les médecins :</h2>";
                echo '<div class="table-responsive">';
                echo '<table class="table table-striped">';
                echo '<thead class="bg-info text-white">';
                echo '<tr>';
                echo '<th scope="col">Nom</th>';
                echo '<th scope="col">Prénom</th>';
                echo '<th scope="col">Sexe</th>';
                echo '<th scope="col">Téléphone</th>';
                echo '<th scope="col">Adresse</th>';
                echo '<th scope="col">Email</th>';
                echo '<th scope="col">Spécialité</th>';
                echo '</tr>';
                echo '</thead>';
                echo '<tbody>';
                while ($row = $result->fetch_assoc()) {
                    echo '<tr>';
                    echo '<td>' . htmlspecialchars($row["nom"]) . '</td>';
                    echo '<td>' . htmlspecialchars($row["prenom"]) . '</td>';
                    echo '<td>' . htmlspecialchars($row["sexe"]) . '</td>';
                    echo '<td>' . htmlspecialchars($row["tel"]) . '</td>';
                    echo '<td>' . htmlspecialchars($row["adresse"]) . '</td>';
                    echo '<td>' . htmlspecialchars($row["email"]) . '</td>';
                    echo '<td>' . htmlspecialchars($row["specialite"]) . '</td>';
                    echo '</tr>';
                }
                echo '</tbody>';
                echo '</table>';
                echo '</div>';
            } else {
                echo '<div class="alert alert-warning">Aucun médecin trouvé.</div>';
            }

            // Fermer la connexion à la base de données
            $con->close();
        }
        ?>

        <!-- Inclure Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    </div>
</body>

</html>