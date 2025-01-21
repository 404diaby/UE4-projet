
    <div class="container border border-warning rounded shadow px-5 py-5 mb-5 bg-white d-flex flex-column align-items-center w-25   ">
        <h1>Connexion </h1>
        <img class="w-25 mb-3" src="<?=IMAGES.'undraw_pic-profile_nr49.svg'?>" alt="logo du site">
        <?php if($error): ?>
            <div class="alert alert-danger" role="alert">
                Identifiant incorrect <i class="fa-solid fa-exclamation"></i>
            </div>
        <?php endif; ?>
        <?php if($success): ?>
            <div class="alert alert-success" role="alert">
                Connexion réussi <i class="fa-solid fa-check"></i></i>
            </div>
        <?php endif; ?>
        <form id="SignInForm" action="index.php?action=auth&authAction=signInVerify" method="post" class="d-flex flex-column needs-validation" novalidate>
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-envelope"></i></span>
                <input type="email" class="form-control" name="email" placeholder="Email" aria-label="Email" aria-describedby="basic-addon1" required>
                <div class="invalid-feedback">Email valide requis</div>
            </div>
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-lock"></i></span>
                <input type="password" class="form-control " name="password" placeholder="Mot de passe" aria-label="Password" aria-describedby="basic-addon1" required >
                <div class="invalid-feedback">Mot de passe requis</div>
            </div>
            <a class="mb-2 align-self-end "   onclick="console.log('mot de passe oublié');"><span class="">Mot de passe oublié</span></a> <!-- TODO Mettre le lien href=""-->
            <button type="submit" class="btn btn-warning mb-2">Se connecter</button>
            <p>Pas encore de compte ? <a class="text-decoration-none" href="index.php?action=auth&authAction=signUp" > Inscrivez-vous</p></a>
        </form>
    </div>
