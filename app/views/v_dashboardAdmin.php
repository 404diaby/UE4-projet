

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administration - Utilisateurs & Import/Export</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css" rel="stylesheet">
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
                            <p class="card-text display-4"><?= $error ?  'N/A' : count($announcements)?></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card text-white bg-success">
                        <div class="card-body">
                            <h5 class="card-title">Annonces Actives</h5>
                            <p class="card-text display-4"><?= $error ?  'N/A' : $activeAnnouncements?></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card text-white bg-warning">
                        <div class="card-body">
                            <h5 class="card-title">En attente</h5>
                            <p class="card-text display-4"><?= $error ?  'N/A' : $moderateAnnouncements ?></p>
                        </div>
                    </div>
                </div>
            </div>
            <?php if ($error == true): ?>
                <div class="alert alert-danger" role="alert">
                    <?= $error_message ?> <i class="fa-solid fa-exclamation"></i>
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
                                <!-- TODO filter -->
                                <button class="btn btn-outline-secondary" onclick="alert('fonction extras')">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <select class="form-select">
                                <option selected >Toutes les catégories</option><!-- TODO filter -->
                                <?php foreach ($categories as $category): ?>
                                    <option value='<?= $category['id'] ?>' >
                                        <?= $category['nom'] ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <select class="form-select">  <!-- TODO filter -->
                                <option selected >Tous les statuts</option>
                                <?php foreach ($statuses as $status): ?>
                                    <option value='<?= $status['id'] ?>'  >
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
                            <?php if ($error == false): ?>

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
                                            <button class="btn btn-sm btn-danger" onclick="alert('fonction extras')"><i class="fas fa-trash"></i></button>  <!-- TODO fonction extra -->
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
                    <button class="btn btn-primary btn-sm" onclick="alert('fonction extras')"> <!-- TODO fonction extra -->
                        <i class="fas fa-user-plus"></i> Nouvel utilisateur
                    </button>
                </div>
                <div class="card-body">
                    <!-- Search and Filters -->
                    <div class=" row mb-3">
                        <div class="col-md-5">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Rechercher un utilisateur..."> <!-- TODO fonction extra -->
                                <button class="btn btn-outline-secondary" onclick="alert('fonction extras')">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                        <div class="col-md-7 opacity-0">

                        </div>
                    </div>

                    <!-- Users Table -->
                    <div class="table-responsive">
                        <table class="table table-striped">
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
                                        <button class="btn btn-sm btn-info" onclick="alert('fonction extras')"><i class="fas fa-edit"></i></button> <!-- TODO fonction extra -->
                                        <button class="btn btn-sm btn-danger" onclick="alert('fonction extras')"><i class="fas fa-trash"></i></button> <!-- TODO fonction extra -->
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
            <div class="row">
                <!-- Import Section -->
                <div class="col-md-6 mb-4">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">Import de données</h5>
                        </div>
                        <div class="card-body">
                            <form>
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
                            <form>
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
                                        <td>users_import.csv</td>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>


