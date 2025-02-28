// v_header.php


/*
const searchForm = document.querySelector('#searchForm')

searchForm.addEventListener('submit', event => {
    const query = searchForm.q.value
    //if check !OK
    if (query.trim().length === 0 || typeof query === 'undefined') {
        alert("Champs vide")
        event.preventDefault()
        event.stopPropagation()
    } /*else {  //else faire recherche
        const res = `Votre recherche est : ${query}`
        alert(res)
    }
})*/
// v_announcements
import {setFavorites, loadFavorites, isStrongPassword} from "./functions.js";
document.addEventListener('DOMContentLoaded', async () => {
    try {
        console.log("🔄 Chargement des favoris...");
        await loadFavorites();
        console.log("✅ Favoris chargés !");
    } catch (error) {
        console.error("❌ Erreur lors du chargement des favoris :", error);
    }

    try {
        console.log("🔄 Application des favoris...");
        setFavorites();
        console.log("✅ Favoris appliqués !");
    } catch (error) {
        console.error("❌ Erreur lors de l'application des favoris :", error);
    }
})

//const favoriteListLoader = setInterval( () => { if(document.querySelector('#listFavorites')){ loadFavorites(); setFavorites(); clearInterval(favoriteListLoader);  }},1000)

/* v_favorites */
//Observer
/*
const observer = new IntersectionObserver((entries) => {
    entries.forEach((entry) => {
        if(entry.isIntersecting){

            if(entry.target.id == "listFavorites"){
                loadFavorites();
            }
        }
    });
});*/


// v_signIn.php v_signUp.php v_announcement.php
const notificationAlert = document.querySelector('.alert');
if (notificationAlert != null) {
    setTimeout(
        () => {
            if (notificationAlert.classList.contains('alert-success')) {
                setTimeout(
                    () => {
                        location.href = 'index.php';
                    }
                    , 1000)
            }
            notificationAlert.style.display = 'none';
        }
        , 1000)
}

const forms = document.querySelectorAll('.needs-validation')
Array.from(forms).forEach(form => {
    form.addEventListener('submit', event => {

     /*  let isValid = true;

        const password = form.querySelector("input[name='password']").value;
        const confirmPassword = form.querySelector("input[name='confirmPassword']").value;



        if( password != null && confirmPassword != null){

            //console.log([password,confirmPassword,isStrongPassword(password)])
            if(isStrongPassword(password) == false){
                password.classList.add("is-invalid")
                isValid = false;
            }else{
                password.classList.remove("is-invalid")
            }

        }
*/
/*
        if( confirmPassword != null ){
            if( password != confirmPassword){
                confirmPassword.classList.add("is-invalid");
                isValid = false;
            } else {
                confirmPassword.classList.remove("is-invalid");
            }


        }*/


        if (!form.checkValidity() ) {
            event.preventDefault()
            event.stopPropagation()
        }

        form.classList.add('was-validated')
    }, false)
})

// v_signUp

const popoverTriggerList = document.querySelectorAll('[data-bs-toggle="popover"]')
const popoverList = [...popoverTriggerList].map(popoverTriggerEl => new bootstrap.Popover(popoverTriggerEl))


// v_dashboard
const soldButtons = document.querySelectorAll(".soldButton")
soldButtons.forEach(soldButton => {
    soldButton.addEventListener('click', (event) => {
        const announcementId = event.target.getAttribute("data-content-id")
        if (confirm('Etres vous vraiment sur ?')) {
            location.href = `index.php?action=announcement&announcementAction=announcementSold&announcementId=${announcementId}`;

        }
    })
})

const statusBadges = document.querySelectorAll('.status-badge')
statusBadges.forEach(statusBadge => {
    if (statusBadge.getAttribute('data-content-id') !== undefined && statusBadge.getAttribute('data-content-id') !== null) {
        statusBadge.addEventListener('click', (event) => {
            const announcementId = event.target.getAttribute("data-content-id")
            location.href = `index.php?action=announcement&announcementAction=announcementStatus&announcementId=${announcementId}&announcementStatus=${status}`;

        })
    }

})

//v_announcement.php
const reportAnnouncementButtons = document.querySelectorAll('.reportAnnouncement')
reportAnnouncementButtons.forEach(reportAnnouncementButton => {
    reportAnnouncementButton.addEventListener('click', (event) => {
        const contentId = event.target.getAttribute("data-content-id")
        alert(`Contenu signalé  !!`)
    })
})


const contactOwnerButtons = document.querySelectorAll('.contactOwner')
contactOwnerButtons.forEach(contactOwnerButton => {
    contactOwnerButton.addEventListener('click', (event) => {
        const ownerEmail = event.target.getAttribute("data-content-owner-email")
        alert(`Contacter le propirétaire avec son email  : ${ownerEmail} !!`)
    })
})

// v_announcement v_settings

const cancelButtons = document.querySelectorAll('.cancelButton')

cancelButtons.forEach(cancelButton => {
    cancelButton.addEventListener('click', (event) => {
        history.back()
        event.preventDefault()
        event.stopPropagation()
    })

})
//----
const fileInput = document.getElementById('fileInput')
const previewContainer = document.getElementById('previewContainer1')


if(fileInput){
    fileInput.addEventListener('change', (event) => {
        const file = event.target.files[0]

        // Vérifier si un fichier a été sélectionné
        if (file) {
            let extension = file.name.split('.').pop().toLowerCase()
            let extensionsAutorisees = ["jpg", "jpeg", "png", "gif"]
            let message
            if (!extensionsAutorisees.includes(extension)) {
                message = "⚠️ Extension non autorisée ! Veuillez choisir un fichier JPG, JPEG, PNG ou GIF."
                event.target.value = ""
            } else {
                message = "✅ Fichier valide : " + file.name
            }
            alert(message);
            // Créer un objet FileReader pour lire le fichier
            const reader = new FileReader()

            // Quand le fichier est lu
            reader.onload = function (e) {
                const img = document.createElement('img')
                img.setAttribute('alt', 'announcement preview image')
                img.classList.add('announcement-preview')
                img.style.width = '100%'
                img.style.height = '100%'
                img.src = e.target.result
                const deleteBtn = document.createElement('button');
                deleteBtn.classList.add('delete-button')
                deleteBtn.innerHTML = '×';
                deleteBtn.onclick = (e) => {
                    previewContainer.removeChild(previewContainer.firstChild)
                    previewContainer.removeChild(previewContainer.firstChild)
                    e.preventDefault()
                }
                if (previewContainer.hasChildNodes()) {
                    previewContainer.removeChild(previewContainer.firstChild)
                    previewContainer.removeChild(previewContainer.firstChild)
                    previewContainer.appendChild(img)
                    previewContainer.appendChild(deleteBtn)
                } else {
                    previewContainer.appendChild(img)
                    previewContainer.appendChild(deleteBtn)
                }

            }

            // Lire le fichier
            reader.readAsDataURL(file);
        }
    });
}

