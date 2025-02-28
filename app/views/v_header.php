<?php $connected = isConnectedAsUser(); ?>
<?php $opacity = isset($_GET['announcementAction']) && $_GET['announcementAction'] == "announcementSearch" ? "opacity-0" : "opacity-1" ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="apple-touch-icon" sizes="180x180" href="<?=IMAGES.DIRECTORY_SEPARATOR.'favicon'.DIRECTORY_SEPARATOR.'apple-touch-icon.png'?>">
    <link rel="icon" type="image/png" sizes="32x32" href="<?=IMAGES.DIRECTORY_SEPARATOR.'favicon'.DIRECTORY_SEPARATOR.'favicon-32x32.png'?>">
    <link rel="icon" type="image/png" sizes="16x16" href="<?=IMAGES.DIRECTORY_SEPARATOR.'favicon'.DIRECTORY_SEPARATOR.'favicon-16x16.png'?>">
    <!-- <link rel="manifest" href="<?=IMAGES.DIRECTORY_SEPARATOR.'favicon'.DIRECTORY_SEPARATOR.'site.webmanifest'?>"> -->
    <title>LeMauvaisCoin</title>
    <!-- BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- STYLE -->
    <link rel="stylesheet" href="<?=CSS.'style.css'?>" >
    <!-- FONT -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@200..800&display=swap" rel="stylesheet">
   </head>
<body class="container min-vh-100 d-flex flex-column">
<nav class="navbar navbar-expand-lg bg-body-tertiary sticky-top mb-3">
    <div class="container-fluid">
        <a class="navbar-brand mb-0 h1 fw-bold fs-3 fs-lg-1" href="index.php">LeMauvaisCoin</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav w-100 me-auto mb-2 mb-lg-0">
                <li class="nav-item mb-2 mb-lg-0">
                    <a class="nav-link active bg-warning px-3 py-2 rounded-3 d-inline-block text-center text-md-start" aria-current="page" href="index.php?action=announcement&announcementAction=announcementAdd">
                        <i class="fa-regular fa-square-plus"></i>
                        Déposer une annonce
                    </a>
                </li>
                <li class="nav-item mb-2 mb-lg-0 flex-grow-1 <?=$opacity?>   ">
                    <form method="get" class="nav-link d-flex flex-column flex-md-row my-0 h-100" role="search">
                        <input type="hidden" name="action" value="announcement">
                        <input type="hidden" name="announcementAction" value="announcementSearch">
                        <div class="d-flex flex-grow-1">
                            <input class="form-control mb-2 mb-md-0 me-md-2 w-100 w-md-auto" type="search" name="q" placeholder="Rechercher sur LeMauvaisCoin" />
                            <button class="btn btn-outline-warning " type="submit">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </button>
                        </div>
                    </form>
                </li>
                <li class="nav-item">
                    <div class="d-flex justify-content-between flex-wrap mt-3 mt-lg-0">
                        <a class="nav-link me-3 mb-2 mb-md-0" href="index.php?action=account&accountAction=favorites">Favoris</a>

                        <?php if($connected) : ?>
                            <a class="nav-link me-3 mb-2 mb-md-0" href="index.php?action=account">Compte</a>
                            <a class="nav-link" href="index.php?action=logOut">Se Deconnecter</a>
                        <?php else: ?>
                            <a class="nav-link" href="index.php?action=auth">Se Connecter</a>
                        <?php endif; ?>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>