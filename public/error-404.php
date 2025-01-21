<?php require_once '../config/init.php'; ?>
<!-- TODO a faire + gerer le 404 -->
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="apple-touch-icon" sizes="180x180" href="<?=IMAGES.DIRECTORY_SEPARATOR.'favicon'.DIRECTORY_SEPARATOR.'apple-touch-icon.png'?>">
    <link rel="icon" type="image/png" sizes="32x32" href="<?=IMAGES.DIRECTORY_SEPARATOR.'favicon'.DIRECTORY_SEPARATOR.'favicon-32x32.png'?>">
    <link rel="icon" type="image/png" sizes="16x16" href="<?=IMAGES.DIRECTORY_SEPARATOR.'favicon'.DIRECTORY_SEPARATOR.'favicon-16x16.png'?>">
    <link rel="manifest" href="<?=IMAGES.DIRECTORY_SEPARATOR.'favicon'.DIRECTORY_SEPARATOR.'site.webmanifest'?>">
    <title>404 - Page non trouvée</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?=CSS.'style.css'?>" ></link>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome pour les icônes -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <!--<style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }


    </style>-->
</head>
<body class="min-vh-100  d-flex flex-column ">
    <!-- Header -->
    <header class="bg-light py-3">
        <div class="container">
            <div class="row">
                <div class="col">
                    <a href="index.php" class="text-decoration-none">
                        <h1 class="h4 text-dark mb-0">LeMauvaisCoin</h1>
                    </a>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <?php include VIEWS. 'v_error.php'; ?>
    <!-- Footer -->
    <footer class="bg-light py-4 mt-5 ">
        <div class="container text-center">
            <p class="text-muted mb-0">© 2025 LeMauvaisCoin - Tous droits réservés</p>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>