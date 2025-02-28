
<div class="container border border-warning rounded shadow px-3 px-md-5 py-4 py-md-5 mb-5 bg-white d-flex flex-column align-items-center w-100 w-md-50  mx-auto"   ">
    <h1>Inscription </h1>
    <img class="w-25 mb-3" src="<?=IMAGES.'undraw_pic-profile_nr49.svg'?>" alt="logo du site" style="width: 10%;">
    <?php if($error) {
        switch ($error_code) {
            case 'empty' :
                $error_message = 'Veuillez remplir le formulaire';
                break;
            case 'password':
                $error_message = 'Un mot de passe valide est requis ';
                break;
            case 'email' :
                $error_message = 'Un email valide est requis';
            break;
            case 'confirmPassword' :
                $error_message = 'Les mots de passe ne correspondent pas';
                break;
            case 'fail'  :
                $error_message = 'Echèc de l\'inscription';
                break;
            default:
                $error_message = 'Une erreur est survenue';
        }
    }
    ?>
    <?php if($error): ?>
    <div class="alert alert-danger w-100" role="alert">
        <?=$error_message?> <i class="fa-solid fa-exclamation"></i>
    </div>
    <?php endif; ?>
    <?php if($success): ?>
        <div class="alert alert-success w-100" role="alert">
            Inscription réussi <i class="fa-solid fa-check"></i></i>
        </div>
    <?php endif; ?>
    <form id="SignUpForm" action="index.php?action=auth&authAction=signUpVerify"   method="post" class="d-flex flex-column needs-validation w-100" novalidate>
        <div class="form-group mb-3">
            <input type="text" class="form-control" name="firstName" placeholder="Nom" aria-label="first-name" <?=$error ?  'value="'.$_POST['firstName'].'"' : 'value=""'?> required>
            <div class="invalid-feedback">Nom valide requis</div>
        </div>
        <div class="form-group mb-3">
            <input type="text" class="form-control" name="lastName" placeholder="Prenom" aria-label="last-name" <?=$error  ?  'value="'.$_POST['lastName'].'"' : 'value=""'?>   required>
            <div class="invalid-feedback">Nom valide requis</div>
        </div>
        <div class="form-group mb-3">
            <input type="text" class="form-control" name="address" placeholder="Adresse" aria-label="address" <?=$error  ?  'value="'.$_POST['address'].'"' : 'value=""'?>  required>
            <div class="invalid-feedback">Adresse valide requis</div>
        </div>
        <div class="form-group mb-3">
            <input type="email" class="form-control" name="email" placeholder="Email" <?=$error  ?  'value="'.$_POST['email'].'"' : 'value=""'?>   required></input>
            <div class="invalid-feedback">Email valide requis</div>
        </div>
        <div class="row mb-3">
            <div class="col-5">
                <input class="form-control" type="text" name="zipCode"  pattern="[0-9]{5}" maxlength="5" placeholder="Code postal" aria-label="code-postal" <?=$error && $error_code != 'none' ?  'value="'.$_POST['zipCode'].'"' : 'value=""'?>  required>
            </div>
            <div class="col-7">
                <input class="form-control" type="text" name="city" placeholder="Ville" aria-label="ville" <?=$error  ?  'value="'.$_POST['city'].'"' : 'value=""'?>  required>
            </div>
        </div>
        <div class="row mb-3">
            <div class="form-group col ">
                <input type="password" class="form-control " name="password" placeholder="Mot de passe" aria-label="mot-de-passe" minlength="8"    required> <!-- pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{6,}$" -->
                <div class="invalid-feedback">Mot de passe valide requis</div>
            </div>
            <button type="button" class="col-auto btn btn-lg btn-danger" data-bs-toggle="popover" data-bs-title="mot de passe valide" data-bs-content=" Longueur minimale 8 - Au moins une majuscule - Au moins une minuscule - Au moins un chiffre - Au moins un caractère spécial">
                <i class="fa-solid fa-circle-info"></i>
            </button>
        </div>

        <div class="form-group mb-3">
            <input type="password" class="form-control" name="confirmPassword" placeholder="Confirmer le mot de passe" aria-label="mot-de-passe" minlength="8"    required>
            <div class="invalid-feedback">Le mot de passe doit être identique</div>
        </div>
        <fieldset class="mb-4" >
            <legend >S'incrire sur nos sites partenaires :</legend>
            <div class="row">
                <div class="form-check col align-content-end">
                    <input class="form-check-input" type="checkbox" id="Site1Check" name="site1Check" value="1" <?=$error && isset($_POST['site1Check'])  ?  'checked' : ''?>  >
                    <label class="form-check-label" for="Site1Check">
                        Site 1
                    </label>
                </div>
                <div class="form-check col">
                    <input class="form-check-input" type="checkbox" id="Site2Check" name="site2Check" value="1"  <?=$error && isset($_POST['site2Check'])  ?  'checked' : ''?>>
                    <label class="form-check-label" for="Site2Check">
                        Site 2
                    </label>
                </div>
            </div>

        </fieldset>
        <button type="submit" class="btn btn-warning mb-2">S'incrire</button>
        <div class="row">
            <p class="col text-end">Déjà inscrit ?</p>
            <a class="col" href="index.php?action=auth&actionAuth=SignIn" class="">Se connecter</a>
        </div>
    </form>
</div>

