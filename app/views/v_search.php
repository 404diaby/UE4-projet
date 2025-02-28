
<form method="get" id="searchForm" >
    <input type="hidden" name="action" value="announcement">
    <input type="hidden" name="announcementAction" value="announcementSearch">
<!-- Barre de recherche principale -->
        <div class="row mb-4">
            <div class="col">
                <div class="input-group input-group-lg">
                    <input type="text" class="form-control" placeholder="Que recherchez-vous ?" name="q" <?=!empty($query) ? "value='$query'" : "value=''"  ?>  >
                    <button class="btn btn-warning" >
                        <i class="fas fa-search"></i> <span class="d-none d-md-block"><Rechercher/span>
                    </button>
                </div>
            </div>
        </div>
<!-- Filtres -->
        <div class=" mb-4">
            <div class="row mb-4">
                <h5 class="mb-3 col-12 col-md">Filtres</h5>
                    <!-- Boutons d'action -->
                    <div class="col-12 col-sm-6 col-md-2 d-flex justify-content-center justify-content-sm-end mb-2 mb-md-0">
                        <button class="btn btn-outline-warning w-100" type="submit">Appliquer les filtres</button>
                    </div>
                    <div class="col-12 col-sm-6 col-md-2 d-flex justify-content-center justify-content-sm-end mb-2 mb-md-0">
                        <button class="btn btn-outline-secondary w-100" type="reset">Réinitialiser</button>
                    </div>
            </div>


            <div class="filter-section row">
                <!-- Catégories -->
                <div class="mb-4 col-12 col-md-4">
                    <h6>Catégories</h6>
                    <select class="form-select" name="category" >
                        <option value="all">Toutes les catégories</option>
                        <?php foreach ($categories as $category): ?>
                            <option value="<?=$category['id']?>"><?=$category['nom']?></option>
                        <?php endforeach;?>
                    </select>

                </div>

                <!-- Prix -->
                <div class="mb-4 col-12 col-md-4">
                    <h6>Prix</h6>
                    <div class="price-range-inputs row">
                        <div class="col-5">
                            <input type="number" class=" form-control" placeholder="Min" name="price_min">
                        </div>
                        <span class="col-1 text-center">à</span>
                        <div class="col-6">
                            <input type="number" class="form-control" placeholder="Max" name="price_max">
                        </div>
                    </div>
                </div>

                <!-- État -->
                <div class="mb-4 col-12 col-md-4">
                    <h6>État</h6>
                    <div class="accordion " id="accordionExample">
                        <div class="accordion-item">
                            <h6 class="accordion-header ">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    Sélectionner l'état
                                </button>
                            </h6>
                            <div id="collapseOne" class="accordion-collapse collapse " data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="all" name="state[]" value="-1" checked >
                                        <label class="form-check-label" for="all"  >Tous les états</label>
                                    </div>
                                    <?php foreach ($states as $state): ?>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="state-<?=$state['id']?>" value="<?=$state['id']?>" name="state[]">
                                        <label class="form-check-label" for="state-<?=$state['id']?>"><?=$state['nom']?></label>
                                    </div>
                                    <?php endforeach;?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
<!-- Nombre résultat -->
        <div class="col d-none">
            <!-- Options de tri -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <span id="totalResult" class="text-muted"><?=($announcements_count)?> résultats trouvés</span>
                </div>

            </div>
        </div>
</form>



<!-- Liste des annonces -->
<div id="listAnouncements" class="row g-4">
    <?php if($announcements == null || empty($announcements)): ?>
        <p class="display-1"> Aucune annonce trouvée  </p>
    <?php else:?>
        <!-- Annonce Card -->
        <?php foreach ($announcements as $row): ?>

            <div class="col-md-4">
                <div class="card h-100">
                    <button
                        id="favorite-<?= $row['id'] ?>"
                        class="  status-badge bg-light rounded-circle border border-0 " style="width: 40px; height: 40px;">
                        <img  class="fav-image fa-lg m-2 text-danger" src=""/>
                    </button>
                    <img src="<?=BASE_URL.'images'.DIRECTORY_SEPARATOR.'announcement'.DIRECTORY_SEPARATOR.$row['utilisateur_id'].DIRECTORY_SEPARATOR.$row['id'].DIRECTORY_SEPARATOR.$row['image']?>" class="card-img-top annonce-image" alt="<?=$row['image']?>">
                    <div class="card-body">
                        <a class="text-resert" href="#"><p class=" card-text badge text-bg-warning fw-bold"><?php echo $row['categorie_nom'] ?></p></a>
                        <h5 class="card-title"><?=$row['titre']?></h5>
                        <div class="d-flex justify-content-between">
                            <p class="card-text text-primary fw-bold"><?='Prix : '.$row['prix'].' €'?></p>
                            <p class="card-text text-primary fw-bold"><?='Etat : '.$row['etat_nom']?></p>
                        </div>
                        <p class=" card-text text-muted">Publié le <?=dateToString($row['date_creation'])?></p>
                        <p class=" card-text">Publié par <a href="#"><?php echo $row['utilisateur_nom'].' '.$row['utilisateur_prenom'] ?></a></p>

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

<script>
    document.addEventListener("DOMContentLoaded", function () {

        // Déchocher le filtre "tout les états" quand on choisi un état particulier
        const allCheckbox = document.getElementById("all");
        const stateCheckboxes = document.querySelectorAll("[id^='state-']");
            console.log(allCheckbox)
        stateCheckboxes.forEach(checkbox => {
            checkbox.addEventListener("change", function () {
                // Si un état spécifique est coché, décocher "Tous les états"
                if (this.checked) {
                    allCheckbox.checked = false;
                }

                // Vérifier si tous les autres états sont décochés
                const anyChecked = Array.from(stateCheckboxes).some(cb => cb.checked);
                if (!anyChecked) {
                    allCheckbox.checked = true;
                }
            });
        });

        // Si "Tous les états" est coché, décocher tous les autres
        allCheckbox.addEventListener("change", function () {
            if (this.checked) {
                stateCheckboxes.forEach(checkbox => {
                    checkbox.checked = false;
                });
            }
        });



        const form = document.getElementById("searchForm");
        const resultsContainer = document.getElementById("listAnouncements");

        form.addEventListener("submit", function (e) {
            e.preventDefault(); // Empêche le rechargement de la page

            console.log("Formulaire soumis !");
            const formData = new FormData(form); // Récupère les données du formulaire



            const params = new URLSearchParams(formData); // Convertit en format GET


//console.log("search.php?" + params.toString())
            fetch("search.php?" + params.toString(), { method: "GET" })
                .then(response => response.text()) // Récupère la réponse en texte
                .then(data => {
                    resultsContainer.innerHTML = data; // Affiche les annonces
                })
                .catch(error => {
                    console.error("Erreur AJAX :", error);
                });
        });
    });

</script>