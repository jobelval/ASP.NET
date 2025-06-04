<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enregistrement des Prescriptions</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
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
    <h2 class="mt-4 mb-4 text-info">Enregistrement des Prescriptions</h2>
    <form action="prescription.php" method="post">
        <div class="form-group">
            <label for="idconsultation">ID Consultation:</label>
            <input type="text" class="form-control" id="idconsultation" name="idconsultation" placeholder="Entrez l'ID de la consultation" required>
        </div>
        <div class="form-group">
            <label for="prescription">Prescription:</label>
            <textarea class="form-control" id="prescription" name="prescription" rows="3" placeholder="Entrez les détails de la prescription" required></textarea>
        </div>
        <button type="submit" class="btn btn-info">Enregistrer</button>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>