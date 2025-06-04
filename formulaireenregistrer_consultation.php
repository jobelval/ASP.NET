<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Enregistrement d'une consultation</title>
    <link rel="stylesheet" href="enregistrer.css">
</head>

<body>
    
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        <header>
        <nav class="navbar navbar-expand-lg" id="nav">
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
        <form action="consultation.php" method="post" class="row g-3 container">

    <div class="mb-3 row">
    <label for="staticEmail" class="col-sm-2 col-form-label"><b>ID</b></label>
    <div class="col-sm-10">
    <input type="text" name="id" required>
    </div>
  </div>


  <div class="mb-3 row">
    <label for="inputPassword" class="col-sm-2 col-form-label"><b>Code du patient</b></label>
    <div class="col-sm-10">
    <input type="text" name="codepatient" required>
    </div>
  </div>


  
  <div class="mb-3 row">
    <label for="inputPassword" class="col-sm-2 col-form-label"><b>ID du médecin</b></label>
    <div class="col-sm-10">
    <input type="text" name="idmedecin" required>
    </div>
  </div>


  
  <div class="mb-3 row">
    <label for="inputPassword" class="col-sm-2 col-form-label"><b>Poids du patient(kg)</b></label>
    <div class="col-sm-10">
    <input type="text" name="poids" required>
    </div>
  </div>


  
  <div class="mb-3 row">
    <label for="inputPassword" class="col-sm-2 col-form-label"><b>Hauteur(cm)</b></label>
    <div class="col-sm-10">
    <input type="text" name="hauteur" required>
    </div>
  </div>


  
  <div class="mb-3 row">
    <label for="inputPassword" class="col-sm-2 col-form-label"><b>Diagnostique</b></label>
    <div class="col-sm-10">
    <input type="text" name="diagnostique" required>
    </div>
  </div>

  <div class="mb-3 row">
    <label for="inputPassword" class="col-sm-2 col-form-label"><b>Date de consultation</b></label>
    <div class="col-sm-10">
    <input type="date" name="date_consultation" required>
    </div>
  </div>

  <div class="col-auto">
    <button type="submit" class="btn"><b>Enregistrer</b></button>
  </div>
  
</form>
</body>

</html>