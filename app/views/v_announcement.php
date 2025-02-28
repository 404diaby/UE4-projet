

<?php switch ($_GET['announcementAction']): ?>
<?php case 'announcementItem': ?>
        <div class="container  d-flex align-items-start justify-content-start ">
            <div class="card mb-3 border border-warning rounded-5 shadow  mb-5 " style="width: 60%;">
                <div class=" d-flex align-items-center justify-content-center w-100 border-2 border-bottom">
                    <img src="<?= IMAGES .'announcement'.DIRECTORY_SEPARATOR.$announcement['utilisateur_id'].DIRECTORY_SEPARATOR.$announcement['id'].DIRECTORY_SEPARATOR.$announcement['image']; ?>" class="img-fluid rounded-start"
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
                            <p class="card-text ">
                                <a class="text-reset link-warning link-underline-warning link-underline-opacity-0 link-underline-opacity-75-hover"
                                   href="#"><i class="fa-solid fa-tag pe-1"></i> <?= $announcement['categorie_nom'] ?>
                                </a></p>
                            <p class="card-text ">
                                <i class="fa-regular fa-clock pe-1"></i> <?= $announcement['vendu'] ? 'Vendu' : 'Disponible' ?>
                            </p>
                            <button
                                    id="favorite-<?= $announcement['id'] ?>"
                                    class="  status-badge bg-light rounded-circle border border-0 " style="width: 40px; height: 40px;">
                                <img  class="fav-image fa-lg m-2 text-danger" src=""></img>
                            </button>
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
                            <div class="row ">
                                <span class="fw-bold fs-4  ">
                                    <a class="text-reset link-warning link-underline link-underline-opacity-0 link-underline-opacity-75-hover " href="#"><?= $announcement['utilisateur_nom'] . ' ' . $announcement['utilisateur_prenom'] ?></a>
                                </span>
                            </div>
                            <div class="row">
                                <span>
                                    <a class="text-reset link-warning link-underline link-underline-opacity-0 link-underline-opacity-75-hover opacity-0 " href="#"><i class="fa-solid fa-star text-warning"></i> 5 (7)</a>
                                    <a class="text-reset link-warning link-underline link-underline-opacity-0 link-underline-opacity-75-hover opacity-0 " href="#">26 annonces</a>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <button class="contactOwner btn btn-warning fw-bold fs-5"
                                data-content-owner-email="<?= $announcement['utilisateur_email'] ?>">Contacter le
                            vendeur
                        </button>
                    </div>
                    <div class="row">
                        <button class="reportAnnouncement btn btn-outline-warning fw-bold fs-5"
                                data-content-id="<?= $announcement['id'] ?>">Signaler l'annonce
                        </button>
                    </div>

                </div>
                <?php if (isConnectedAsUser() && isset($_SESSION['user_id']) && $announcement['utilisateur_id'] == $_SESSION['user_id']): ?>
                    <div class="card p-4 border border-warning rounded-5 shadow  ">
                        <h5 class="fw-bold fs-4 text-center">Gestion de mon annonce</h5>
                        <hr>
                        <p>
                            <a class="text-reset link-warning link-underline-warning link-underline-opacity-0 link-underline-opacity-75-hover"
                               href="index.php?action=announcement&announcementAction=announcementUpdate&announcementId=<?=$announcement['id']?>""><i class="fa-solid fa-pen me-2"></i>Modifier l'annonce</a></p>
                        <p>
                            <a class="text-reset link-warning link-underline-warning link-underline-opacity-0 link-underline-opacity-75-hover"
                               href="index.php?action=announcement&announcementAction=announcementDelete&announcementId=<?=$announcement['id']?>"><i class="fa-regular fa-trash-can me-2"></i>Supprimer l'annonce</a></p>
                        <p>
                            <?php if($announcement['statut_id'] != 2): ?>
                            <a class="text-reset link-warning link-underline-warning link-underline-opacity-0 link-underline-opacity-75-hover"
                               href="index.php?action=announcement&announcementAction=announcementStatus&announcementId=<?=$announcement['id']?>"><i class="fa-regular fa-circle-pause me-2"></i>Mettre en pause l'annonce</a></p>
                            <?php endif; ?>
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
                <form class="needs-validation p-3" action="index.php?action=announcement&announcementAction=announcementAddVerify"
                      method="post" novalidate enctype="multipart/form-data" >
                    <div class="form-control mb-4 py-4 ">
                        <div class="row">
                            <div class="col">
                                <label for="fileInput" class="mb-2">Photo de
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
                                       max="99999999.99" step="0.01"
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
                    <div class="row">
                        <div class="col">
                            <button class="cancelButton btn btn-outline-dark w-100 mb-3 py-3" >Annuler
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
    <?php case 'announcementUpdate': ?>
    <?php case 'announcementUpdateVerify': ?>
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
                <div class="col"><h3>Modifier une annonce</h3></div>
            </div>
            <?php if ($error): ?>
                <div class="alert alert-danger" role="alert">
                    <?= $error_message ?> <i class="fa-solid fa-exclamation"></i>
                </div>
            <?php endif; ?>
            <?php if ($success): ?>
                <div class="alert alert-success" role="alert">
                    Modification réussi <i class="fa-solid fa-check"></i>
                </div>
            <?php endif; ?>
            <div class="row card mb-3 border border-warning rounded-5 shadow  mb-5">
                <form class=" p-3" action="index.php?action=announcement&announcementAction=announcementUpdateVerify&announcementId=<?=$announcement['id']?>" method="post" >
                    <div class="form-control mb-4 py-4 ">
                        <div class="row">
                            <div class="col">
                                <label for="fileInput" class="mb-2">Photo de
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
                                    <input name="announcementImage" type="file" id="fileInput" value=""   accept="image/*" >

                                    <div class="invalid-feedback">Une image requis</div>
                                </div>
                            </div>
                            <div class="col">
                                <div class=""> Photo ajoutées </div>
                                <div class="d-flex justify-content-start gap-3 mt-3" >
                                    <div id="previewContainer1" class="col-3 bg-primary" style="height: 300px; width: 300px;">
                                        <?php if($error): ?>
                                        <img src="<?=IMAGES.'announcement'.DIRECTORY_SEPARATOR.$_SESSION['user_id'].DIRECTORY_SEPARATOR.$_GET['announcementId'].DIRECTORY_SEPARATOR.$_POST['announcementImage'];?>" class="img-thumbnail rounded-start w-100 h-100" style="" alt="...">
                                        <?php else: ?>
                                        <img src="<?=IMAGES.'announcement'.DIRECTORY_SEPARATOR.$announcement['utilisateur_id'].DIRECTORY_SEPARATOR.$announcement['id'].DIRECTORY_SEPARATOR.$announcement['image'];?>" class="img-thumbnail rounded-start w-100 h-100" style="" alt="...">
                                        <?php endif;?>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="floatingInput" placeholder="Titre de l'annonce"
                               name="announcementTitle"
                               value="<?=$error ?  $_POST['announcementTitle']  : $announcement['titre'] ?>">

                        <label for="floatingInput">Titre de l'annonce<span class="text-danger fw-bold">*</span></label>
                    </div>
                    <div class="form-floating mb-3">
                        <textarea class="form-control" placeholder="Description détaillée" id="floatingTextarea2"
                                  style="height: 150px" name="announcementDescription"
                                  ><?= $error ? $_POST['announcementDescription'] : $announcement['description'] ?>
                        </textarea>
                        <label for="floatingTextarea2">Description détaillée<span
                                    class="text-danger fw-bold">*</span></label>
                        <div class="invalid-feedback">Description d'annonce requis</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <div class="form-floating">
                                <select class="form-select" id="floatingSelect"
                                        aria-label="Floating label select example" name='announcementCategory' >
                                    <option value="">Séléctionnez une catégorie
                                    </option>
                                    <?php foreach ($categories as $category): ?>
                                        <?php if($error): ?>
                                            <option value='<?= $category['id'] ?>' <?= $_POST['announcementCategory'] == $category['id'] ? 'selected disabled' : '' ?> >
                                        <?php else: ?>
                                        <option value='<?= $category['id'] ?>' <?= $announcement['categorie_id'] == $category['id'] ? 'selected ' : '' ?> >
                                        <?php endif; ?>
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
                                        aria-label="Floating label select example" name='announcementState' >
                                    <option value="">Séléctionnez un état
                                    </option>
                                    <?php foreach ($states as $state): ?>
                                     <?php if($error): ?>
                                            <option value='<?= $state['id'] ?>' <?= $_POST['announcementState'] == $state['id'] ? 'selected disabled' : '' ?> >
                                        <?php else: ?>
                                        <option value="<?= $state['id'] ?>" <?= $announcement['etat_id'] == $state['id'] ? 'selected ' : '' ?> >
                                        <?php endif; ?>
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
                                       name="announcementPrice" <?= $error ? 'value="' . $_POST['announcementPrice'] . '"' : 'value="'.$announcement['prix'].'"' ?>
                                       >
                                <label for="floatingInput">Prix<span class="text-danger fw-bold">*</span></label>
                                <div class="invalid-feedback">Prix d'annonce requis</div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-floating ">
                                <input type="datetime-local" class="form-control" id="floatingInput" disabled
                                       value="<?= date("Y-m-d H:i:s")?>" >
                                <label for="floatingInput">Date creation<span
                                            class="text-danger fw-bold">*</span></label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <button class="cancelButton btn btn-outline-dark w-100 mb-3 py-3" >Annuler
                            </button>
                        </div>
                        <div class="col">
                            <button class="btn btn-outline-warning w-100 mb-3 py-3" type="submit">Modifier l'annonce
                            </button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
        <?php break; ?>
    <?php case 'announcementDelete': ?>
    <?php case 'announcementDeleteVerify': ?>
        <div class="container flex-grow-1">
            <div class="row">
                <div class="col"><h3>Supprimer une annonce</h3></div>
            </div>
            <?php if ($error): ?>
                <div class="alert alert-danger" role="alert">
                    <?= $error_message ?> <i class="fa-solid fa-exclamation"></i>
                </div>
            <?php endif; ?>
            <?php if ($success): ?>
                <div class="alert alert-success" role="alert">
                    Suppression réussi <i class="fa-solid fa-check"></i>
                </div>
            <?php endif; ?>
            <div class="row card mb-3 border border-warning rounded-5 shadow  mb-5">
                <form class=" p-3" action="index.php?action=announcement&announcementAction=announcementDeleteVerify&announcementId=<?=$announcement['id']?>" method="post" >
                    <div class="form-control mb-4 py-4 ">
                        <div class="row ">
                                <div class=""> Photo annonce </div>
                                <div class="d-flex justify-content-center gap-3 mt-3 m-auto" >
                                    <div id="previewContainer1" class=" bg-primary " style="height: 500px; width:500px;">
                                        <img src="<?=IMAGES.'announcement'.DIRECTORY_SEPARATOR.$announcement['utilisateur_id'].DIRECTORY_SEPARATOR.$announcement['id'].DIRECTORY_SEPARATOR.$announcement['image'];?>" class="img-thumbnail rounded-start w-100 h-100" style="" alt="...">
                                    </div>
                                </div>
                        </div>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="floatingInput" placeholder="Titre de l'annonce"
                               name="announcementTitle" value="<?=$announcement['titre']?>"
                               disabled>
                        <label for="floatingInput">Titre de l'annonce<span class="text-danger fw-bold">*</span></label>
                    </div>
                    <div class="form-floating mb-3">
                        <textarea class="form-control" placeholder="Description détaillée" id="floatingTextarea2"
                                  style="height: 150px" name="announcementDescription"
                                  disabled><?= $announcement['description'] ?></textarea>
                        <label for="floatingTextarea2">Description détaillée<span
                                    class="text-danger fw-bold">*</span></label>
                        <div class="invalid-feedback">Description d'annonce requis</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <div class="form-floating">
                                <select class="form-select" id="floatingSelect"
                                        aria-label="Floating label select example" name='announcementCategory' disabled>
                                    <option value="">Séléctionnez une catégorie
                                    </option>
                                    <?php foreach ($categories as $category): ?>
                                        <option value='<?= $category['id'] ?>' <?= $announcement['categorie_id'] == $category['id'] ? 'selected disabled' : '' ?> >
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
                                        aria-label="Floating label select example" name='announcementState' disabled>
                                    <option value="">Séléctionnez un état
                                    </option>
                                    <?php foreach ($states as $state): ?>
                                        <option value="<?= $state['id'] ?>" <?= $announcement['etat_id'] == $state['id'] ? 'selected ' : '' ?> >
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
                                       name="announcementPrice" value="<?=$announcement['prix']?>"
                                        disabled>
                                <label for="floatingInput">Prix<span class="text-danger fw-bold">*</span></label>
                                <div class="invalid-feedback">Prix d'annonce requis</div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-floating ">
                                <input type="datetime-local" class="form-control" id="floatingInput"
                                       value="<?= $announcement['date_creation']?>" disabled>
                                <label for="floatingInput">Date creation<span
                                            class="text-danger fw-bold">*</span></label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <button class="cancelButton btn btn-outline-dark w-100 mb-3 py-3" >Annuler
                            </button>
                        </div>
                        <div class="col">
                            <button class="btn btn-outline-warning w-100 mb-3 py-3" type="submit">Supprimer l'annonce
                            </button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
        <?php break; ?>
    <?php default: ?>
        <?php include VIEWS . 'v_error.php'; ?>
    <?php endswitch; ?>

<script>


</script>


