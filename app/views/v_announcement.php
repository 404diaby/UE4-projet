<!--
TODO sur card detail de l'annonce  -  lien sur categorie pour recherche
-->

<?php switch ($_GET['announcementAction']): ?>
<?php case 'announcementItem': ?>
        <div class="container  d-flex align-items-start justify-content-start ">
            <div class="card mb-3 border border-warning rounded-5 shadow  mb-5 " style="width: 60%;">
                <div class=" d-flex align-items-center justify-content-center w-100 border-2 border-bottom">
                    <img src="<?= IMAGES . $announcement['image'] ?>" class="img-fluid rounded-start"
                         alt="...">
                </div>
                <div class="row d-none">
                    <div class="col bg-warning" style="width: 100px; height: 100px;"></div>
                    <div class="col bg-primary" style="width: 100px; height: 100px;"></div>
                    <div class="col bg-warning" style="width: 100px; height: 100px;"></div>
                    <div class="col bg-primary " style="width: 100px; height: 100px;"></div>
                </div>
                <div class="row px-5 py-5">
                    <div class="card-body">
                        <div class="d-flex align-items-start justify-content-between ">
                            <h4 class="card-title "><?= $announcement['titre'] ?></h4>
                            <span class="badge text-bg-secondary"><?= $announcement['prix'] . ' €'; ?></span>
                        </div>
                        <br>
                        <div class="d-flex gap-5">
                            <p class="card-text "><i class="fa-regular fa-calendar pe-1"></i> Publié
                                le <?= dateToString($announcement['date_creation']) ?></p>
                            <!-- mettre en format e 7 novembre 2024 à 12:32 -->
                            <p class="card-text ">
                                <a class="text-reset link-warning link-underline-warning link-underline-opacity-0 link-underline-opacity-75-hover"
                                   href="#"><i class="fa-solid fa-tag pe-1"></i> <?= $announcement['categorie_nom'] ?>
                                </a></p>
                            <p class="card-text ">
                                <i class="fa-regular fa-clock pe-1"></i> <?= $announcement['vendu'] ? 'Vendu' : 'Disponible' ?>
                            </p>
                        </div>
                        <div class="row mt-3 p-3 bg-secondary bg-gradient rounded">
                            <p class="card-text "><?= $announcement['description'] ?></p>
                        </div>
                        <hr>
                        <div id="criterions" class="row">
                            <div class="row mb-2">
                                <h5>Critères</h5>
                            </div>
                            <div class="criterionItem row">
                                <?php for ($i = 0; $i < 8; $i++): ?>
                                    <div class="criterionItem col-3 mb-4 ">
                                        <div class="row">
                                            <div class="col-auto align-self-center">
                                                <i class="fa-solid fa-thumbs-up fa-xl"></i>
                                            </div>
                                            <div class="col ">
                                                <span class="row">Etat</span>
                                                <span class="row fw-bold "><?= $announcement['etat_nom'] ?></span>
                                            </div>
                                        </div>
                                    </div>
                                <?php endfor; ?>
                                <!--<div class="criterionItem col-3 mb-4 ">
                                        <div class="row">
                                            <div class="col-auto align-self-center">
                                                <i class="fa-solid fa-thumbs-up fa-xl"></i>
                                            </div>
                                            <div class="col ">
                                                <span class="row">Etat</span>
                                                <span class="row fw-bold "><?= $announcement['etat'] ?></span>
                                            </div>
                                        </div>
                                    </div>-->
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="ms-5 mb-3 d-flex flex-column" style="width: 40%">
                <div class="card  px-4 py-4 border border-warning rounded-5 shadow  mb-4 align-self-start col">
                    <div class="row mb-4">
                        <div class="col-3">
                            <img class="img-fluid" src="<?= IMAGES . 'undraw_pic-profile_nr49.svg' ?>"
                                 alt="owern picture">
                        </div>
                        <div class="col-9 ">
                            <div class="row "><span class="fw-bold fs-4  "><a
                                            class="text-reset link-warning link-underline link-underline-opacity-0 link-underline-opacity-75-hover "
                                            href="#"><?= $announcement['utilisateur_nom'] . ' ' . $announcement['utilisateur_prenom'] ?></a></span>
                            </div>
                            <div class="row">
                    <span>
                        <a class="text-reset link-warning link-underline link-underline-opacity-0 link-underline-opacity-75-hover "
                           href="#"><i class="fa-solid fa-star text-warning"></i> 5 (7)</a>
                        <a class="text-reset link-warning link-underline link-underline-opacity-0 link-underline-opacity-75-hover "
                           href="#">26 annonces</a> </span>
                            </div> <!-- TODO etoile, nbr annonce, page profile -->
                        </div>
                    </div>
                    <div class="row mb-4">
                        <button class="contactOwner btn btn-warning fw-bold fs-5"
                                data-content-owner-email="<?= $announcement['utilisateur_email'] ?>">Contacter le
                            vendeur
                        </button> <!-- TODO Mettre en place le contact de vendeur -->
                    </div>
                    <div class="row">
                        <button class="reportAnnouncement btn btn-outline-warning fw-bold fs-5"
                                data-content-id="<?= $announcement['id'] ?>">Signaler l'annonce
                        </button> <!-- TODO Mettre en place le signalement -->
                    </div>

                </div>
                <?php if (isConnected() && isset($_SESSION['user_id']) && $announcement['utilisateur_id'] == $_SESSION['user_id']): ?>
                    <div class="card p-4 border border-warning rounded-5 shadow  ">
                        <h5 class="fw-bold fs-4 text-center">Gestion de mon annonce</h5>
                        <hr>
                        <p>
                            <a class="text-reset link-warning link-underline-warning link-underline-opacity-0 link-underline-opacity-75-hover"
                               href="#"><i class="fa-solid fa-pen me-2"></i>Modifier l'annonce</a></p>
                        <!-- TODO METTRE LIEN -->
                        <p>
                            <a class="text-reset link-warning link-underline-warning link-underline-opacity-0 link-underline-opacity-75-hover"
                               href="#"><i class="fa-regular fa-trash-can me-2"></i>Supprimer l'annonce</a></p>
                        <!-- TODO METTRE LIEN -->
                        <p>
                            <a class="text-reset link-warning link-underline-warning link-underline-opacity-0 link-underline-opacity-75-hover"
                               href="#"><i class="fa-regular fa-circle-pause me-2"></i>Mettre en pause l'annonce</a></p>
                        <!-- TODO METTRE LIEN -->

                    </div>
                <?php endif; ?>
            </div>
        </div>
        <?php break; ?>
    <?php case 'announcementAdd': ?>
    <?php case 'announcementAddVerify': ?>
        <?php if ($error) {
            switch ($error_code) {
                case 'empty' :
                    $error_message = 'Veuillez remplir le formulaire';
                    break;
                case 'image'  :
                    $error_message = 'Un image est obligatoire';
                    break;
                case 'extension' :
                    $error_message = 'Format non autorisé ! Seuls JPG, JPEG, PNG et GIF sont acceptés.';
                    break;
                case 'upload' :
                    $error_message = 'Erreur lors du téléchargement.';
                    break;
                case 'title':
                    $error_message = 'Un titre est obligatoire ';
                    break;
                case 'description' :
                    $error_message = 'Une description est obligatoire';
                    break;
                case 'category' :
                    $error_message = 'Une categorie est obligatoire';
                    break;
                case 'state'  :
                    $error_message = 'Un état est obligatoire';
                    break;
                case 'price'  :
                    $error_message = 'Un prix valide est obligatoire';
                    break;
                case 'status'  :
                    $error_message = 'Un statut est obligatoire';
                    break;
                case 'fail'  :
                    $error_message = 'Echèc de la création de l\'annonce';
                    break;
                default:
                    $error_message = 'Une erreur est survenue';
            }
        }
        ?>
        <div class="container flex-grow-1">

            <div class="row">
                <div class="col"><h3>Creer une annonce</h3></div>
                <div class="col text-end"><p><span class="text-danger fw-bold">*</span> Champs obligatoires</p></div>
            </div>
            <?php if ($error): ?>
                <div class="alert alert-danger" role="alert">
                    <?= $error_message ?> <i class="fa-solid fa-exclamation"></i>
                </div>
            <?php endif; ?>
            <?php if ($success): ?>
                <div class="alert alert-success" role="alert">
                    Création réussi <i class="fa-solid fa-check"></i>
                </div>
            <?php endif; ?>
            <div class="row card mb-3 border border-warning rounded-5 shadow  mb-5">
                <!--TODO rajouter au class needs-validation -->
                <form class=" p-3" action="index.php?action=announcement&announcementAction=announcementAddVerify"
                      method="post" novalidate enctype="multipart/form-data" > <!-- TODO mettre action -->
                    <div class="form-control mb-4 py-4 ">
                        <div class="row">
                            <div class="col">
                                <label for="fileInput" class="mb-2">Photo<? // TODO ajouter un S quand on va gerer plus d'une photo?> de
                                    votre
                                    jouet<span class="text-danger fw-bold">*</span></label>
                                <small class="text-danger fw-bold d-none">Ajoutez jusqu'à 3 photos. La premier sera la photo
                                    principal de votre annonce </small>
                                <!-- <div class="dashed bg-subtitle border border-warning mb-2   "</div>-->
                                <div class="drop-zone" id="dropZone">
                                    <div class="mb-3">
                                        <i class="fas fa-cloud-upload-alt fa-2x text-muted"></i>
                                    </div>
                                    <p class="mb-2">Déposez vos photos ici ou</p>
                                    <input name="announcementImage" type="file" id="fileInput"    accept="image/*" required>

                                    <div class="invalid-feedback">Une image requis</div>
                                </div>
                            </div>
                            <div class="col">
                                <div class=""> Photo ajoutées </div>
                                <div class="d-flex justify-content-start gap-3 mt-3" >
                                    <div id="previewContainer1" class="col-3 bg-primary" style="height: 200px; width: 200px;"></div>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="floatingInput" placeholder="Titre de l'annonce"
                               name="announcementTitle" <?= $error ? 'value="' . $_POST['announcementTitle'] . '"' : 'value=""' ?>
                               required>
                        <label for="floatingInput">Titre de l'annonce<span class="text-danger fw-bold">*</span></label>
                        <div class="invalid-feedback">Titre d'annonce requis</div>
                    </div>
                    <div class="form-floating mb-3">
                        <textarea class="form-control" placeholder="Description détaillée" id="floatingTextarea2"
                                  style="height: 150px" name="announcementDescription"
                                  required><?= $error ? $_POST['announcementDescription'] : '' ?></textarea>
                        <label for="floatingTextarea2">Description détaillée<span
                                    class="text-danger fw-bold">*</span></label>
                        <div class="invalid-feedback">Description d'annonce requis</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <div class="form-floating">
                                <select class="form-select" id="floatingSelect"
                                        aria-label="Floating label select example" name='announcementCategory' required>
                                    <option <?= /* ($error && empty($_POST['announcementCategory'])) ? 'selected' : '';*/
                                    '' ?> selected disabled value="">Séléctionnez une catégorie
                                    </option>
                                    <?php foreach ($categories as $category): ?>
                                        <option value='<?= $category['id'] ?>' <?= $error && !empty($_POST['announcementCategory']) && $_POST['announcementCategory'] == $category['id'] ? 'selected' : '' ?> >
                                            <?= $category['nom'] ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                                <label for="floatingSelect">Catérogies<span class="text-danger fw-bold">*</span></label>
                                <div class="invalid-feedback">Catégorie d'annonce requis</div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-floating">
                                <select class="form-select" id="floatingSelect"
                                        aria-label="Floating label select example" name='announcementState' required>
                                    <option <?= /* ($error && !empty($_POST['announcementState'])) ? 'selected' : ''; */
                                            '' ?>selected disabled value="">Séléctionnez un état
                                    </option>
                                    <?php foreach ($states as $state): ?>
                                        <option value='<?= $state['id'] ?>' <?= $error && !empty($_POST['announcementState']) && $_POST['announcementState'] == $state['id'] ? 'selected' : '' ?> >
                                            <?= $state['nom'] ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                                <label for="floatingSelect">Etat<span class="text-danger fw-bold">*</span></label>
                                <div class="invalid-feedback">Etat d'annonce requis</div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <div class="form-floating ">
                                <input type="number" class="form-control" id="floatingInput" placeholder="€" min="0.00"
                                       max="10000.00" step="0.01"
                                       name="announcementPrice" <?= $error ? 'value="' . $_POST['announcementPrice'] . '"' : 'value=""' ?>
                                       required>
                                <label for="floatingInput">Prix<span class="text-danger fw-bold">*</span></label>
                                <div class="invalid-feedback">Prix d'annonce requis</div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-floating ">
                                <input type="datetime-local" class="form-control" id="floatingInput"
                                       value="<?= date('Y-m-d\TH:i') ?>" disabled>
                                <label for="floatingInput">Date creation<span
                                            class="text-danger fw-bold">*</span></label>
                            </div>
                        </div>
                    </div>
                    <div class="form-control mb-4 ">
                        <div class="col">
                            <div class="mb-2">Statut de publication</div>
                            <?php foreach ($statuses as $status): ?>
                                <div class="form-floating mb-3 ms-4">
                                    <div class="form-check">
                                        <input class="form-check-input me-3" type="radio" name="announcementStatus"
                                               value="<?= $status['id'] ?>"
                                               id="<?= 'flexRadioDefault' . $status['id'] ?>" <?= $error && !empty($_POST['announcementStatus']) && $_POST['announcementStatus'] == $status['id'] ? 'checked' : '' ?>
                                               required>
                                        <label class="form-check-label "
                                               for="<?= 'flexRadioDefault' . $status['id'] ?>"><?= $status['libelle'] ?> </label>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                            <div class="invalid-feedback">Statut de publication requis</div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <button class="btn btn-outline-dark w-100 mb-3 py-3" id="cancelAnnouncementButton">Annuler
                            </button>
                        </div>
                        <div class="col">
                            <button class="btn btn-outline-warning w-100 mb-3 py-3" type="submit">Publier l'annonce
                            </button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
        <?php break; ?>
    <?php case 'announcementEdit': ?>
        <p>edit</p>
        <?php break; ?>
    <?php case 'announcementDelete': ?>
        <p>delete</p>
        <?php break; ?>
    <?php default: ?>
        <?php include VIEWS . 'v_error.php'; ?>
    <?php endswitch; ?>

<script>


</script>


