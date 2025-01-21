<?php
notConnected();
?>
<!-- TODO a faire -->


<div class="container min-vh-100 d-flex justify-content-center align-items-center" >
    <div class="card" style="width: 18em">
        <h5 class="card-header text-danger"> Dashbord </h5>
        <!-- <img src="..." class="card-img-top" alt="...">-->
        <div class="card-body">
            <h5 class="card-title text-danger">Lorem</h5>
            <p class=" card-text mt-2 lh-lg"><?php echo "Bienvenue, " . htmlspecialchars($_SESSION['user_email']);?></p>
            <a href="index.php"> <button type="button" class="btn btn-warning">Aller à l'accueil</button></a>
        </div>
    </div>
</div>