<?php
notConnected();
?>
<div class="container py-4">

    <!-- Main Menu Grid -->
    <div class="row g-4">
        <!-- Annonce active -->
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        <i class="fa-solid fa-globe fa-2xl me-3"></i>
                        <h3 >Annonces actives</h3>
                    </div>
                    <span class="display-5"><?= $error ?  'N/A' : $user['annonces_actives']?></span>
                </div>
            </div>
        </div>
        <!-- Vente  -->
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        <i class="fa-solid fa-coins fa-2xl me-3"></i>
                        <h5 class="mb-0">Annonces vendus</h5>
                    </div>
                    <span class="display-5"><?=$error ?  'N/A' : (isset($user['annonces_vendus']) ? $user['annonces_vendus']: '0') ?></span>
                </div>
            </div>
        </div>
        <!-- Paramètres -->
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        <i class="fa-solid fa-gear fa-2xl me-3"></i>
                        <a href="index.php?action=account&accountAction=settings" class="stretched-link  text-reset text-decoration-none"><h5 class="mb-0">Paramètres</h5></a>
                    </div>
                    <p class="text-muted">Compléter et modifier mes informations privées et préférences</p>
                </div>
            </div>
        </div>

</div>


    <style>
        .card {
            transition: transform 0.2s;
        }
        .card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }


    </style>
</head>
<div class="container py-4">
    <!-- Liste des annonces -->
    <?php if ($error == true): ?>
        <div class="alert alert-danger" role="alert">
            <?= $error_message ?> <i class="fa-solid fa-exclamation"></i>
        </div>
    <?php endif; ?>
    <div class="row g-4">
        <!-- Annonce Card -->
        <?php if ($error == false): ?>
            <?php foreach ($announcements as $row): ?>
            <div class="col-md-4">
                <div class="card h-100">
                    <?php if($row['statut_id'] == 1 ): ?>
                        <span class="badge bg-success status-badge" data-content-id="<?=$row['id']?>">Active</span>
                    <?php elseif ($row['statut_id'] == 2 ): ?>
                        <span class="badge bg-info status-badge" data-content-id="<?=$row['id']?>">Inactive</span>
                    <?php elseif ($row['statut_id'] == 3 ): ?>
                        <span class="badge bg-warning status-badge">Validation</span>
                    <?php endif; ?>
                    <?php if($row['vendu'] == 1 ): ?>
                        <span class="badge bg-primary sold-badge">Vendu</span>
                    <?php else: ?>
                        <span class="badge bg-secondary sold-badge">Invendu</span>
                    <?php endif; ?>
                    <img src="<?=BASE_URL.'images'.DIRECTORY_SEPARATOR.'announcement'.DIRECTORY_SEPARATOR.$row['utilisateur_id'].DIRECTORY_SEPARATOR.$row['id'].DIRECTORY_SEPARATOR.$row['image']?>" class="card-img-top annonce-image" alt="<?=$row['image']?>">
                    <div class="card-body">
                        <a class="text-resert" href="#"><p class=" card-text badge text-bg-warning fw-bold"><?php echo $row['categorie_nom'] ?></p></a>
                        <h5 class="card-title"><?=$row['titre']?></h5>
                        <div class="d-flex justify-content-between">
                            <p class="card-text text-primary fw-bold"><?='Prix : '.$row['prix'].' €'?></p>
                            <p class="card-text text-primary fw-bold"><?='Etat : '.$row['etat_nom']?></p>
                        </div
                        <p class="card-text text-muted">Publié le <?=dateToString($row['date_creation'])?></p>
                    </div>
                    <div class="card-footer bg-white border-top-0">
                        <div class="btn-group w-100">
                            <?php if($row['statut_id'] != 3 ): ?>
                            <button class="soldButton btn btn-outline-success" type="button"  data-content-id="<?=$row['id']?>" >Vendu?</button>
                            <?php endif; ?>
                            <a class="btn btn-outline-primary" href="index.php?action=announcement&announcementAction=announcementUpdate&announcementId=<?=$row['id']?>">Modifier</a>
                            <a class="btn btn-outline-danger" href="index.php?action=announcement&announcementAction=announcementDelete&announcementId=<?=$row['id']?>">Supprimer</a>

                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>
