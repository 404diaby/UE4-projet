

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administration - Utilisateurs & Import/Export</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
    <style>
        .main-content {
            margin-left: 240px;
            padding: 2rem;
            margin-top: 56px;
        }
        .sidebar {
            position: fixed;
            top: 56px;
            left: 0;
            width: 240px;
            height: calc(100vh - 56px);
            background: #2c3e50;
            padding-top: 1rem;
        }
        .nav-link {
            color: rgba(255,255,255,.8);
        }
        .nav-link:hover, .nav-link.active {
            color: white;
            background: rgba(255,255,255,.1);
        }
        @media (max-width: 768px) {
            .main-content {
                margin-left: 0;
            }
            .sidebar {
                width: 100%;
                position: relative;
            }
        }
    </style>
</head>
<body>
<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container-fluid">
        <a class="navbar-brand" href="admin.php">Dashboard</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                        <i class="fas fa-user-circle"></i> Admin
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="#"><i class="fas fa-cog"></i> Paramètres</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="admin.php?action=logOut"><i class="fas fa-sign-out-alt"></i> Déconnexion</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Sidebar -->
<div class="sidebar">
    <ul class="nav flex-column">
        <li class="nav-item">
            <a class="nav-link active" href="#" data-bs-toggle="tab" data-bs-target="#announcements">
                <i class="fas fa-tachometer-alt me-2"></i>Annonces
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#" data-bs-toggle="tab" data-bs-target="#users">
                <i class="fas fa-users me-2"></i>Utilisateurs
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#" data-bs-toggle="tab" data-bs-target="#import-export">
                <i class="fas fa-exchange-alt me-2"></i>Import/Export
            </a>
        </li>
    </ul>
</div>

<!-- Main Content -->
<div class="main-content">
    <div class="tab-content">
        <!-- Announcement Tab -->
        <div class="tab-pane fade active show" id="announcements">
            <!-- Stats Cards -->
            <div class="row mb-4">
                <div class="col-md-4">
                    <div class="card text-white bg-primary">
                        <div class="card-body">
                            <h5 class="card-title">Total Annonces</h5>
                            <p class="card-text display-4"><?= $errorAnnouncements ?  'N/A' : count($announcements)?></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card text-white bg-success">
                        <div class="card-body">
                            <h5 class="card-title">Annonces Actives</h5>
                            <p class="card-text display-4"><?= $errorAnnouncements ?  'N/A' : $activeAnnouncements?></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card text-white bg-warning">
                        <div class="card-body">
                            <h5 class="card-title">En attente</h5>
                            <p class="card-text display-4"><?= $errorAnnouncements ?  'N/A' : $moderateAnnouncements ?></p>
                        </div>
                    </div>
                </div>
            </div>
            <?php if ($errorAnnouncements == true): ?>
                <div class="alert alert-danger" role="alert">
                    <?= $error_messageAnnouncements ?> <i class="fa-solid fa-exclamation"></i>
                </div>
            <?php endif; ?>
            <?php if ($successAnnouncements == true): ?>
                <div class="alert alert-success" role="alert">
                    Opération réussi <i class="fa-solid fa-check"></i></i>
                </div>
            <?php endif; ?>

            <!-- Annonces Section -->
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-start align-items-center">
                    <h5 class="mb-0">Gestion des annonces</h5>
                </div>
                <div class="card-body">
                    <!-- Search and Filters -->
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Rechercher une annonce...">
                                <button class="btn btn-outline-secondary" >
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <select class="form-select">
                                <option selected >Toutes les catégories</option><!-- TODO filter -->
                                <?php foreach ($categories as $category): ?>
                                    <option value='<?= $category['nom'] ?>' >
                                        <?= $category['nom'] ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <select class="form-select">  <!-- TODO filter -->
                                <option selected >Tous les statuts</option>
                                <?php foreach ($statuses as $status): ?>
                                    <option value='<?= $status['nom'] ?>'  >
                                        <?= $status['nom'] ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <!-- Table -->
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Titre</th>
                                <th>Utilisateur</th>
                                <th>Date</th>
                                <th>Statut</th>
                                <th>Categorie</th>
                                <th>Etat</th>
                                <th>Description</th>
                                <th>Image</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if ($errorAnnouncements == false): ?>

                                <?php foreach ($announcements as $row): ?>
                                    <tr>
                                        <td>#<?=$row['id']?></td>
                                        <td><?=$row['titre']?></td>
                                        <td><?=$row['nom'].' '.$row['prenom']?></td>
                                        <td><?=$row['date_creation']?></td>
                                        <td>
                                            <?php switch($row['statut_id']) {
                                                case 1 :
                                                    echo "<span class='badge bg-success'>Active</span>";
                                                    break;
                                                case 2 :
                                                    echo "<span class='badge bg-info text-dark'>En Pause</span>";
                                                    break;
                                                case 3 :
                                                    echo "<span class='badge bg-warning text-dark'>En attente</span>";
                                                    break;
                                                default:
                                                    echo '';
                                            };?>


                                        </td>

                                        <td><?=$row['categorie_nom']?></td>
                                        <td><?=$row['etat_nom']?></td>
                                        <td>
                                           <button class="btn btn-sm btn-info me-1" onclick='alert("<?=htmlspecialchars($row['description'],ENT_QUOTES)?>");'><i class="fa-solid fa-text-height"></i></button>
                                        </td>
                                        <td>
                                            <button class="btn btn-sm btn-info me-1" onclick="alert(' extras')"><i class="fa-regular fa-image" style="color: #ffffff;"></i></button>
                                            <!-- DO image -->
                                        </td>
                                        <td>
                                            <button class="btn btn-sm btn-info me-1" onclick="alert('fonction extras')"><i class="fas fa-edit"></i></button>   <!-- TODO fonction extra -->
                                            <a class="btn btn-sm btn-danger" href="admin.php?action=deleteAnnouncement&announcementId=<?=$row['id']?>" ><i class="fas fa-trash"></i></a>  <!-- TODO fonction extra -->
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif;?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- Users Tab -->
        <div class="tab-pane fade" id="users">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Gestion des utilisateurs </h5>
                    <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#userModal">
                        <i class="fas fa-user-plus"></i> Nouvel utilisateur
                    </button>
                </div>
                <div class="card-body">
                    <!-- Search and Filters -->
                    <div class=" row mb-3">
                        <div class="col-md-5">
                            <div class="input-group">
                                <input id="searchUser" type="text" class="form-control" placeholder="Rechercher un utilisateur..."> <!-- TODO fonction extra -->
                                <button class="btn btn-outline-secondary" onclick="filterUsers()">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                        <div class="col-md-7 "> <!-- TODO  -->
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
                        </div>
                    </div>

                    <!-- Users Table -->
                    <div  class="table-responsive">
                        <table id="usersTable" class="table table-striped">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nom Prenom</th>
                                <th>Adresse</th>
                                <th>Ville</th>
                                <th>Code postal</th>
                                <th>Email</th>
                                <th>Rôle</th>
                                <th>Statut</th>
                                <th>Date inscription</th>
                                <th>Date connexion</th>
                                <th>Site 1</th>
                                <th>Site 2</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($users as $user):?>
                                <tr>
                                    <td>#<?=$user['id'] ?></td>
                                    <td><?=$user['nom'].' '.$user['prenom'] ?></td>
                                    <td><?=$user['adresse'] ?></td>
                                    <td><?=$user['ville'] ?></td>
                                    <td><?=$user['code_postal'] ?></td>
                                    <td><?=$user['email'] ?></td>
                                    <td><span class="badge bg-info"><?=$user['role'] ?></span></td>
                                    <td><span class="badge bg-success"><?=$user['statut'] ? 'active' : 'inactive' ?></span></td>
                                    <td><?=dateToString($user['date_inscription']) ?></td>
                                    <td><?=$user['date_connexion'] ?></td>
                                    <td><?=$user['site_1'] ? 'oui' : 'non' ?></td>
                                    <td><?=$user['site_2'] ? 'oui' : 'non' ?></td>

                                    <td>
                                        <a class="btn btn-sm btn-info" onclick="alert('fonction extras')"><i class="fas fa-edit"></i></a> <!-- TODO fonction extra -->
                                        <a class="btn btn-sm btn-danger" href="admin.php?action=deleteUser&userId=<?=$user['id']?>" ><i class="fas fa-trash"></i></a>
                                    </td>
                                </tr>
                            <?php endforeach;?>
                            <!-- More users... -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- Import/Export Tab -->
        <div class="tab-pane fade" id="import-export">
            <div class="row ">
                <!-- Import Section -->
                <div class="col-md-6 mb-4">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">Import de données</h5>
                        </div>
                        <div class="card-body">
                            <form class="d-none">
                                <div class="mb-3">
                                    <label class="form-label">Type de données</label>
                                    <select class="form-select mb-3">
                                        <option>Utilisateurs</option>
                                        <option>Annonces</option>
                                        <option>Catégories</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Fichier CSV</label>
                                    <input type="file" class="form-control" accept=".csv">
                                    <div class="form-text">Format accepté : CSV</div>
                                </div>
                                <div class="mb-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="updateExisting">
                                        <label class="form-check-label" for="updateExisting">
                                            Mettre à jour les entrées existantes
                                        </label>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-upload me-2"></i>Importer
                                </button>
                            </form>
                            <a type="submit" class="btn btn-primary" href="admin.php?action=import">
                                <i class="fas fa-upload me-2"></i>Importer
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Export Section -->
                <div class="col-md-6 mb-4">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">Export de données</h5>
                        </div>
                        <div class="card-body">
                            <form class="d-none">
                                <div class="mb-3">
                                    <label class="form-label">Type de données</label>
                                    <select class="form-select mb-3">
                                        <option>Utilisateurs</option>
                                        <option>Annonces</option>
                                        <option>Catégories</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Format d'export</label>
                                    <select class="form-select mb-3">
                                        <option>CSV</option>
                                        <option>Excel</option>
                                        <option>JSON</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="exportAll">
                                        <label class="form-check-label" for="exportAll">
                                            Exporter toutes les données
                                        </label>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-success">
                                    <i class="fas fa-download me-2"></i>Exporter
                                </button>
                            </form>
                            <a type="submit" class="btn btn-success" href="admin.php?action=export">
                                <i class="fas fa-download me-2"></i>Exporter
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Import History -->
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">Historique des imports/exports</h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Type</th>
                                        <th>Action</th>
                                        <th>Statut</th>
                                        <th>Fichier</th>
                                        <th>Détails</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>23/01/2025 14:30</td>
                                        <td>Utilisateurs</td>
                                        <td>Import</td>
                                        <td><span class="badge bg-success">Succès</span></td>
                                        <td>users_export_site1_2025-02-02.json</td>
                                        <td>
                                            <button class="btn btn-sm btn-info">
                                                <i class="fas fa-info-circle"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <!-- More history entries... -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal pour création/modification d'utilisateur -->
<div class="modal fade" id="userModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" id="userForm" class="needs-n" action="admin.php?action=addUser" novalidate>
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle">Nouvel utilisateur</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <!-- Champs du formulaire -->
                    <div class="form-group mb-3">
                        <input type="text" class="form-control" name="firstName" placeholder="Nom" aria-label="first-name" <?=$error ?  'value="'.$_POST['firstName'].'"' : 'value=""'?> required>
                        <div class="invalid-feedback">Nom valide requis</div>
                    </div>
                    <div class="form-group mb-3">
                        <input type="text" class="form-control" name="lastName" placeholder="Prenom" aria-label="last-name" <?=$error  ?  'value="'.$_POST['lastName'].'"' : 'value=""'?>   required>
                        <div class="invalid-feedback">Prénom valide requis</div>
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
                    <div class="row mb-3">
                        <select class="form-select" id="floatingSelect"
                                aria-label="Floating label select example" name='role' required>
                            <option selected disabled value="">Séléctionnez un role </option>
                            <option value="admin">admin</option>
                            <option value="utilisateur">utilisateur</option>
                        </select>
                        <div class="invalid-feedback">Requis</div>
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

                        <!-- Ajoutez les autres champs nécessaires -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-primary">Enregistrer</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

<script>
    const popoverTriggerList = document.querySelectorAll('[data-bs-toggle="popover"]')
    const popoverList = [...popoverTriggerList].map(popoverTriggerEl => new bootstrap.Popover(popoverTriggerEl))


    const forms = document.querySelectorAll('.needs-validation')
    Array.from(forms).forEach(form => {
        form.addEventListener('submit', event => {
            if (!form.checkValidity()) {
                event.preventDefault()
                event.stopPropagation()
            }

            form.classList.add('was-validated')
        }, false)
    })

</script>
<script>
    function filterUsers() {
        console.log('filter users')
        // Récupérer la valeur de la barre de recherche
        const searchValue = document.getElementById('searchUser').value.toLowerCase();

        // Récupérer toutes les lignes du tableau
        const rows = document.querySelectorAll('#usersTable tbody tr');
console.log(rows)
        // Parcourir chaque ligne du tableau
        rows.forEach(row => {
            // Récupérer le texte de la ligne
            const rowText = row.textContent.toLowerCase();

            // Afficher ou masquer la ligne en fonction de la correspondance
            if (rowText.includes(searchValue)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    }

    // Ajouter un écouteur d'événement pour déclencher la recherche à chaque frappe
    document.getElementById('searchUser').addEventListener('input', filterUsers);


    // Fonction pour la recherche textuelle
    function searchAnnouncement() {
        const searchValue = document.querySelector('input[type="text"][placeholder="Rechercher une annonce..."]').value.toLowerCase();
        const rows = document.querySelectorAll('.table tbody tr');

        rows.forEach(row => {
            const rowText = row.textContent.toLowerCase();
            if (rowText.includes(searchValue)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    }

    // Fonction pour le filtrage par catégorie
    function filterByCategory() {
        const categorySelect = document.querySelector('select');
        const selectedCategory = categorySelect.value;
        const rows = document.querySelectorAll('.table tbody tr');

        rows.forEach(row => {
            // Si "Toutes les catégories" est sélectionné, afficher toutes les lignes
            if (selectedCategory === 'Toutes les catégories') {
                row.style.display = '';
                return;
            }

            const categoryCell = row.querySelector('td:nth-child(6)').textContent; // Colonne catégorie
            console.log(categoryCell)
            console.log(selectedCategory)
            if (categoryCell === selectedCategory) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    }

    // Fonction pour le filtrage par statut
    function filterByStatus() {
        const statusSelect = document.querySelectorAll('select')[1];
        const selectedStatus = statusSelect.value;
        const rows = document.querySelectorAll('.table tbody tr');

        rows.forEach(row => {
            // Si "Tous les statuts" est sélectionné, afficher toutes les lignes
            if (selectedStatus === 'Tous les statuts') {
                row.style.display = '';
                return;
            }

            const statusCell = row.querySelector('td:nth-child(5)').textContent.trim(); // Colonne statut
            if (statusCell === selectedStatus) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    }

    // Ajouter les écouteurs d'événements une fois que le DOM est chargé
    document.addEventListener('DOMContentLoaded', () => {
        // Écouteur pour la barre de recherche
        const searchInput = document.querySelector('input[type="text"][placeholder="Rechercher une annonce..."]');
        searchInput.addEventListener('input', searchAnnouncement);

        // Écouteur pour le filtre de catégorie
        const categorySelect = document.querySelector('select');
        categorySelect.addEventListener('change', filterByCategory);

        // Écouteur pour le filtre de statut
        const statusSelect = document.querySelectorAll('select')[1];
        statusSelect.addEventListener('change', filterByStatus);

        // Configurer le bouton de recherche
        const searchButton = document.querySelector('.input-group .btn-outline-secondary');
        searchButton.onclick = searchAnnouncement;
    });
</script>
</body>
</html>


