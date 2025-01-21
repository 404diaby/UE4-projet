
<main class="container my-5 flex-grow-1 d-flex flex-column align-items-center justify-content-center ">
    <div class="row justify-content-center text-center ">
        <!-- Error Icon -->
        <div class="col-12 mb-4">
            <i class="fas fa-teddy-bear error-bear"></i>
        </div>

        <!-- Error Message -->
        <div class="col-md-8">
            <h1 class="display-4 mb-3">Erreur 404</h1>
            <p class="lead mb-4">Oups ! Cette page a disparu comme un jouet égaré...</p>
        </div>

        <!-- Action Buttons -->
        <div class="col-md-6">
            <div class="d-grid gap-3 d-sm-flex justify-content-sm-center">
                <a href="index.php" class="btn btn-warning btn-lg px-4">
                    <i class="fas fa-home me-2"></i>Accueil
                </a>
                <a href="/search" class="btn btn-outline-secondary btn-lg px-4"> <!--TODO Mettre lien-->
                    <i class="fas fa-search me-2"></i>Rechercher
                </a>
            </div>
        </div>
    </div>

    <!-- Suggestions Section -->
    <div class="row mt-5">
        <div class="col-12 text-center mb-4">
            <h2 class="h4">Découvrez nos jouets populaires :</h2>
        </div>

        <!-- Suggestion Cards -->
        <div class="col-md-3 mb-3">
            <div class="card suggestion-card h-100">
                <div class="card-body text-center">
                    <i class="fas fa-car mb-3 fs-1 text-warning"></i>
                    <h3 class="h6">Voitures anciennes</h3>
                    <p class="small text-muted">Collection années 60</p>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-3">
            <div class="card suggestion-card h-100">
                <div class="card-body text-center">
                    <i class="fas fa-train mb-3 fs-1 text-warning"></i>
                    <h3 class="h6">Trains miniatures</h3>
                    <p class="small text-muted">Modèles rares</p>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-3">
            <div class="card suggestion-card h-100">
                <div class="card-body text-center">
                    <i class="fas fa-gamepad mb-3 fs-1 text-warning"></i>
                    <h3 class="h6">Jeux vintage</h3>
                    <p class="small text-muted">Années 80-90</p>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-3">
            <div class="card suggestion-card h-100">
                <div class="card-body text-center">
                    <i class="fas fa-baby mb-3 fs-1 text-warning"></i>
                    <h3 class="h6">Poupées de collection</h3>
                    <p class="small text-muted">Éditions limitées</p>
                </div>
            </div>
        </div>
    </div>
</main>