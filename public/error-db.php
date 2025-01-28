<?php require_once '../config/init.php'; ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="apple-touch-icon" sizes="180x180" href="<?=IMAGES.DIRECTORY_SEPARATOR.'favicon'.DIRECTORY_SEPARATOR.'apple-touch-icon.png'?>">
    <link rel="icon" type="image/png" sizes="32x32" href="<?=IMAGES.DIRECTORY_SEPARATOR.'favicon'.DIRECTORY_SEPARATOR.'favicon-32x32.png'?>">
    <link rel="icon" type="image/png" sizes="16x16" href="<?=IMAGES.DIRECTORY_SEPARATOR.'favicon'.DIRECTORY_SEPARATOR.'favicon-16x16.png'?>">
    <title>Erreur technique</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body class="min-vh-100 d-flex justify-content-center align-items-start text-center p-5">
<div class="container bg-danger-subtle rounded shadow-lg p-3 mb-5  " style="max-width: 700px;">
    <h1 class="text-danger-emphasis fw-bold">Oups, une erreur est survenue 😕</h1>
    <p>Nous rencontrons actuellement un problème technique. Nos équipes travaillent à sa résolution.</p>
    <p>Veuillez réessayer dans quelques instants.</p>
    <a class="btn btn-warning" href="index.php">Aller vers le sire</a>
    <p>Si le problème persiste, <a href="index.php">contactez-nous</a>.</p>
</div>
</body>
</html>

