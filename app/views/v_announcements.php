<!--
TODO annonce nulll ou vide => doit  affiche une placeholder avec une indication  indisponible
TODO gerer un affichage en grille si possible, gerer les images,

-->

<!-- Liste des annonces -->
<div id="listAnouncements" class="row g-4">
    <?php if($announcements == null): ?>
        <p class="display-1"> Erreur d'affichage </p>
    <?php elseif( empty($announcements)) :?>
        <p class="display-1"> Aucune annonce trouvée</p>
    <?php else:?>
        <!-- Annonce Card -->
        <?php foreach ($announcements as $row): ?>

            <div class="col-md-4">
                <div class="card h-100">
                    <?php if($row['utilisateur_id'] != $_SESSION['user_id']):?>
                    <button
                            id="favorite-<?= $row['id'] ?>"
                            class="  status-badge bg-light rounded-circle border border-0 " style="width: 40px; height: 40px;">
                        <img  class="fav-image fa-lg m-2 text-danger" src=""></img>
                    </button>
                    <?php endif; ?>
                    <img src="<?=BASE_URL.'images'.DIRECTORY_SEPARATOR.$row['image']?>" class="card-img-top annonce-image" alt="<?=$row['image']?>">
                    <div class="card-body">
                        <a class="text-resert" href="#"><p class=" card-text badge text-bg-warning fw-bold"><?php echo $row['categorie_nom'] ?></p></a>
                        <h5 class="card-title"><?=$row['titre']?></h5>
                        <div class="d-flex justify-content-between">
                            <p class="card-text text-primary fw-bold"><?='Prix : '.$row['prix'].' €'?></p>
                            <p class="card-text text-primary fw-bold"><?='Etat : '.$row['etat_nom']?></p>
                        </div
                        <p class=" card-text text-muted">Publié le <?=dateToString($row['date_creation'])?></p>
                        <p class=" card-text">Publié par <a href="#"><?php echo $row['utilisateur_nom'].' '.$row['utilisateur_prenom'] ?></a></p> <!-- TODO page profile -->

                    </div>
                    <div class="card-footer bg-white border-top-0">
                        <div class="btn-group w-100">
                            <a class="btn btn-outline-primary " href="index.php?action=announcement&announcementAction=announcementItem&announcementId=<?php echo$row['id'] ?>">Voir plus</a>

                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif;?>
</div>