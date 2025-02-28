



export function isStrongPassword( password) {
    const minLength = 8; // Longueur minimale
    const hasUppercasePattern = /[A-Z]/; // Au moins une majuscule
    const hasLowercasePattern = /[a-z]/; // Au moins une minuscule
    const hasNumberPattern = /[0-9]/; // Au moins un chiffre
    const hasSpecialCharPattern = /[\W_]/; // Au moins un caractère spécial (y compris _)

    const hasUppercase = hasUppercasePattern.test(password);
    const hasLowercase = hasLowercasePattern.test(password);
    const hasNumber = hasNumberPattern.test(password);
    const hasSpecialChar = hasSpecialCharPattern.test(password);


    return (
        password.length >= minLength &&
        hasUppercase &&
        hasLowercase &&
        hasNumber &&
        hasSpecialChar
    );
}


// Script de gestion des favoris en JavaScript
export function toggleFavorite(annonceId) {
    // Récupération des favoris depuis le localStorage
    let favorites = JSON.parse(localStorage.getItem('le-mauvais-coins-favorites')) || [];

    // Vérifier si l'annonce est déjà dans les favoris
    const index = favorites.indexOf(annonceId);
    const btnFavorite = document.getElementById(`favorite-${annonceId}`)
    const heart = btnFavorite.querySelector('.fav-image')


    if (index === -1) {
        // Ajouter aux favoris
        favorites.push(annonceId);
        heart.src = 'images/heart-solid.svg'
        console.log('Ajouter aux favoris')
    } else {
        // Retirer des favoris
        favorites.splice(index, 1);
        heart.src = 'images/heart-regular.svg'
        console.log('Retirer des favoris')

        // Supprimer l'élément de la liste des favoris dans le DOM
        const favoriteCard = btnFavorite.closest('.favorite-card');
        if (favoriteCard) {
            favoriteCard.remove();
        }
    }

    // Sauvegarder dans le localStorage
    localStorage.setItem('le-mauvais-coins-favorites', JSON.stringify(favorites));
    checkEmptyFavorites();

}

// Fonction pour vérifier si la liste des favoris est vide et afficher un message
function checkEmptyFavorites() {
    const favorites = JSON.parse(localStorage.getItem('le-mauvais-coins-favorites')) || [];
    const listFavorites = document.querySelector('#listFavorites');

    // Supprimer l'ancien message s'il existe
    const oldPlaceholder = document.querySelector('#listFavorites .display-1');
    if (oldPlaceholder) {
        oldPlaceholder.remove();
    }

    if (favorites.length === 0) {
        const favorisPlaceholder = document.createElement('p');
        favorisPlaceholder.classList.add('display-1');
        favorisPlaceholder.classList.add('text-center')
        favorisPlaceholder.textContent = 'Aucun favoris';
        listFavorites.append(favorisPlaceholder);
    }
}

/*
export function updateFavoriteButton(annonceId) {
    const favorites = JSON.parse(localStorage.getItem('le-mauvais-coins-favorites')) || []
    const btnFavorite = document.getElementById(`favorite-${annonceId}`)
    const heart = btnFavorite.querySelector('.fav-image')

    if (favorites.includes(annonceId)) {
        heart.src = 'images/heart-solid.svg'
    } else {
        heart.src = 'images/heart-solid.svg'
    }
}*/

export async function loadFavorites() {
    const favorites = JSON.parse(localStorage.getItem('le-mauvais-coins-favorites')) || []
    const listFavorites = document.querySelector('#listFavorites')
    listFavorites.innerHTML = ""

    if (favorites.length === 0) {
        const favorisPlaceholder = document.createElement('p')
        favorisPlaceholder.classList.add('display-1')
        favorisPlaceholder.textContent =  'Aucune favoris'
        listFavorites.append(favorisPlaceholder)
        return
    }

        /*favorites.forEach(
            favoriteId => {
                const url = `http://localhost:8888/api-lemauvaiscoins/public/index.php/announcement/${favoriteId}`

                fetch(url)
                    .then(response => response.json())
                    .then(announcement => {
                        // Créer un élément pour chaque annonce favorite
                        const card = createAnnouncementCard(announcement);
                        listFavorites.appendChild(card)
                    });


            }
        )*/

    favorites.forEach(
        favoriteId => {
            const url = `favorites.php?announcementId=${favoriteId}`
            fetch(url , { method: "GET" })
                .then(response => response.json()) // Récupère la réponse en texte
                .then(announcement => {
                    if( announcement){
                        console.log(announcement)
                        const card = createAnnouncementCard(announcement);
                        listFavorites.appendChild(card)
                    }
                })
                .catch(error => {
                    console.error("Erreur AJAX :", error);
                });
        }
    )
}





// Fonction pour créer un élément d'annonce (à adapter selon votre structure HTML)
function createAnnouncementCard(announcement) {
    const favorisTemplate = document.querySelector('#favorite-template')
    const card = favorisTemplate.content.cloneNode(true)
    const favBtn = card.querySelector('button')
    favBtn.setAttribute('id',`favorite-${announcement.id}`)
    const heart = card.querySelector('.fav-image')
    heart.src = 'images/heart-solid.svg'
    favBtn.addEventListener('click', () => {
        toggleFavorite(`${announcement.id}`)
    });
    const img = card.querySelector('.card-img-top')
    img.src = `./images/announcement/${announcement.utilisateur_id}/${announcement.id}/${announcement.image}`
    const title = card.querySelector('.card-title')
    title.textContent = announcement.titre
    const dateCreation = card.querySelector('.date-creation')
    dateCreation.textContent = `Publié le ${dateToString(announcement.date_creation)}`
    const author = card.querySelector('.author')
        author. innerHTML = `Publié par <a href="#"> ${announcement.utilisateur_nom} ${announcement.utilisateur_prenom}</a>`
    const button = card.querySelector('.btn-outline-primary')
    button.href = `index.php?action=announcement&announcementAction=announcementItem&announcementId=${announcement.id}`
    return card

}

export function setFavorites(){
    let favorites = document.querySelectorAll("[id^='favorite-']");
    const favoritesLocalStorage = JSON.parse(localStorage.getItem('le-mauvais-coins-favorites')) || []
    favorites.forEach(favorite => {
        const annonceId = favorite.getAttribute('id').substring(9);
        const heart = favorite.querySelector('.fav-image')
        if (favoritesLocalStorage.includes(annonceId)) {
            heart.src = 'images/heart-solid.svg'
        } else {
            heart.src = 'images/heart-regular.svg'
        }
        favorite.addEventListener('click', () => {
            toggleFavorite(annonceId)
        });
    });
}


function dateToString(dateString) {
    const date = new Date(dateString);
    return date.toLocaleString('fr-FR', {
        day: '2-digit', month: 'long', year: 'numeric',
        hour: '2-digit', minute: '2-digit'
    }).replace(',', ' à');
}
