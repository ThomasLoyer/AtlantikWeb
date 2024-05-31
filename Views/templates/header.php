<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<?php $session = session(); ?>
<body>
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark fixed-top">
        <div class="container-fluid">
            
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active" href="/accueil">Accueil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/creercompte">Créer un compte</a>
                </li>
                <?php if($session->has('Identifiant')): ?>
                <li class="nav-item">
                    <a class="nav-link" href="/modifiercompte">Modifier les informations du compte</a>
                </li>
                <?php endif ?>
                <li class="nav-item">
                    <a class="nav-link" href="/afficherliaison">Afficher les liaisons</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/afficherhorraire">Horraires de traversées</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/historiquereservation">Historique des réservations</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/authentification">S'authentifier</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/deconnexion">Déconnexion</a>
                </li>
            </ul>
        </div>
    </nav>