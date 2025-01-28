
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion Admin</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css" rel="stylesheet">
    <script defer  src="<?=JS.'app.js'?>"></script>

    <style>
        body {
            background: #f8f9fa;
        }
        .login-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .login-form {
            background: white;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
            padding: 2rem;
            width: 100%;
            max-width: 400px;
        }
        .brand-header {
            text-align: center;
            margin-bottom: 2rem;
        }
        .brand-circle {
            width: 80px;
            height: 80px;
            background: #f8f9fa;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem;
        }

    </style>
</head>
<body>
<div class="login-container">
    <div class="login-form">
        <!-- Brand Header -->
        <div class="brand-header">
            <div class="brand-circle">
                <i class="fas fa-user-shield fa-2x text-primary"></i>
            </div>
            <h4>Administration</h4>
            <p class="text-muted">Connectez-vous à votre compte</p>
        </div>

        <!-- Login Form -->
        <form class="needs-validation" action="admin.php?action=signIn&authAction=signInAdminVerify" method="post" novalidate>
            <!-- Email Input -->
            <!-- Alert Message -->
            <?php if($error): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-circle me-2"></i>
                   <?=$error_message?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            <?php endif;?>
            <?php if($success): ?>
                <div class="alert alert-success fade show" role="alert">
                    <i class=fa-solid fa-check me-2"></i>
                    Connexion reussi
                </div>
            <?php endif;?>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <div class="input-group">
                        <span class="input-group-text">
                            <i class="fas fa-envelope"></i>
                        </span>
                    <input type="email" class="form-control" id="email" name="email"
                           placeholder="nom@exemple.com" required>
                </div>

            </div>

            <!-- Password Input -->
            <div class="mb-3">
                <label for="password" class="form-label">Mot de passe</label>
                <div class="input-group">
                        <span class="input-group-text">
                           <i class="fa-solid fa-lock"></i>
                        </span>
                    <input type="password" class="form-control" id="password" name="password"
                           placeholder="Votre mot de passe" required>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-sign-in-alt me-2"></i>Se connecter
                </button>
            </div>
        </form>
    </div>
</div>
<script>

    const notificationAlert = document.querySelector('.alert');
    if (notificationAlert != null) {
        setTimeout(
            () => {
                if (notificationAlert.classList.contains('alert-success')) {
                    setTimeout(
                        () => {
                            location.href = 'admin.php?action=account';
                        }
                        , 1000)
                }
                notificationAlert.style.display = 'none';
            }
            , 1000)
    }
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>
<script src="https://kit.fontawesome.com/a57cf1d88d.js" crossorigin="anonymous"></script>
</body>
</html>
