<!-- TODO fonctionnalite -->
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 py-4">
    <div class="container">
        <h2 class="mb-4">Profil</h2>
        <!-- Avatar -->
        <div class="mb-4">
            <div class="d-flex align-items-center">
                <div class="position-relative">
                    <img src="<?=IMAGES.'undraw_pic-profile_nr49.svg'?>" alt="Photo de profil"
                         class="rounded-circle" style="width: 100px; height: 100px;">
                    <button class="btn btn-primary btn-sm position-absolute bottom-0 end-0">
                        <i class="fas fa-camera"></i>
                    </button>
                </div>
            </div>
        </div>
        <!-- Profile form -->
        <form id="settingForm" method="post" class="needs-validation" novalidate onsubmit="alert('submitted successfully')">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="lastName" class="form-label">Nom</label>
                    <input type="text" class="form-control" id="lastName" required <?= $user['nom'] ? 'value='.$user['nom'] : '' ?> >
                </div>
                <div class="col-md-6 mb-3">
                    <label for="firstName" class="form-label">Prénom</label>
                    <input type="text" class="form-control" id="firstName" required <?= $user['prenom'] ? 'value='.$user['prenom'] : '' ?> >
                </div>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" required <?= $user['email'] ? 'value='.$user['email'] : '' ?> >
            </div>
            <div class="mb-3">
                <label for="address" class="form-label">Adresse</label>
                <input type="text" class="form-control" id="address" required <?= $user['adresse'] ? 'value='.$user['adresse'] : '' ?> >
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="city" class="form-label">Ville</label>
                    <input type="text" class="form-control" id="city" required <?= $user['ville'] ? 'value='.$user['ville'] : '' ?> >
                </div>
                <div class="col-md-6 mb-3">
                    <label for="zipCode" class="form-label">Code postal</label>
                    <input type="text" class="form-control" id="zipCode" required <?= $user['code_postal'] ? 'value='.$user['code_postal'] : '' ?> >
                </div>
            </div>

            <div class="mb-3">
                <label for="language" class="form-label">Langue</label>
                <select class="form-select" id="language" required>
                    <option value="fr">Français</option>
                    <option value="en">English</option>
                    <option value="es">Español</option>
                    <option value="de">Deutsch</option>
                </select>
            </div>
            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <button type="button" class="cancelButton btn btn-outline-secondary me-2" >Annuler</button>
                <button type="submit" class="btn btn-primary">Enregistrer</button>
            </div>
        </form>
    </div>
</main>