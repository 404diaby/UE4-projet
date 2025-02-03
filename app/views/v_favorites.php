<main class="container my-5 flex-grow-1 d-flex flex-column align-items-center justify-content-center ">
    <!-- Liste des annonces favoris -->
    <p class="fs-1"> Liste des annonces favoris </p>
    <div class="row g-4" id="listFavorites">
    </div>
</main>

<template id="favorite-template">
    <div class="favorite-card col">
        <div class="card h-100">
            <button
                    id=""
                    class="  status-badge bg-light rounded-circle border border-0 " style="width: 40px; height: 40px;">
                <img  class="fav-image fa-lg m-2 text-danger" src=""></img>
            </button>
            <div class="card-body">
                <a class="text-resert" href="#"><p
                            class=" card-text badge text-bg-warning fw-bold"></p></a>
                <h5 class="card-title"></h5>
                <div class="d-flex justify-content-between">
                    <p class="card-text text-primary fw-bold"></p>
                    <p class="card-text text-primary fw-bold"></p>
                </div>
                <p class="date-creation card-text text-muted">Publié le </p>
                <p class="author card-text">Publié par <a href="#"></a></p>
            </div>
            <div class="card-footer bg-white border-top-0">
                <div class="btn-group w-100">
                    <a class="btn btn-outline-primary "
                       href="index.php?action=announcement&announcementAction=announcementItem&announcementId=">Voir
                        plus</a>

                </div>
            </div>
        </div>
    </div>
</template>