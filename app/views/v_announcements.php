<!--
TODO annonce nulll ou vide => doit  affiche une placeholder avec une indication  indisponible
TODO gerer un affichage en grille si possible, gerer les images,

-->

<div class="container min-vh-100 d-flex align-items-center justify-content-center ">
    <div class="row row-cols-1 row-cols-md-3 g-4">
        <?php if($announcements == null): ?>
            <p class="display-1"> Erreur d'affichage </p>
        <?php elseif( empty($announcements)) :?>
            <p class="display-1"> Aucune annonce trouvée</p>
        <?php else:?>
            <?php foreach( $announcements as $row ): ?>
                <div class="col">
                    <div class="card h-100">
                        <img src="<?=IMAGES. $row['image'];?>" class="img-fluid rounded-start card-img-top" style="height: 400px" alt="...">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $row['titre'] ?></h5>
                            <span class="badge text-bg-secondary"><?php echo $row['categorie_nom'] ?></span>
                            <br>
                            <p class="card-text">Publié par <a href="#"><?php echo $row['utilisateur_nom'].' '.$row['utilisateur_prenom'] ?></a></p> <!-- TODO page profile -->
                            <p class="card-text"><small class="text-body-secondary">Publié le <?= dateToString($row['date_creation']) ?></small></p>
                        </div>
                        <div class="card-footer text-end">
                            <a class="card-link " href="index.php?action=announcement&announcementAction=announcementItem&announcementId=<?php echo$row['id'] ?>">Voir plus</a>
                        </div>
                    </div>
                </div>

            <?php endforeach;?>
        <?php endif;?>
    </div>
</div>
