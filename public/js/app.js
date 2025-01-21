
// v_header.php
const searchForm = document.querySelector('#searchForm')
searchForm.addEventListener('submit', event => {
    const query = searchForm.q.value
    //if check !OK
    if (query.trim().length === 0 || typeof query === 'undefined') {
        alert("Champs vide")
        event.preventDefault()
        event.stopPropagation()
    } else {  //else faire recherche
        const res = `Votre recherche est : ${query}`
        alert(res)
    }
})


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
        if (!form.checkValidity()) {
            event.preventDefault()
            event.stopPropagation()
        }

        form.classList.add('was-validated')
    }, false)
})

//v_announcement.php
const reportAnnouncementButtons = document.querySelectorAll('.reportAnnouncement')
reportAnnouncementButtons.forEach(reportAnnouncementButton => {
    reportAnnouncementButton.addEventListener('click', (event) => {
        const contentId = event.target.getAttribute("data-content-id")
        alert(`Contenu signalé avec l'ID : ${contentId} !!`)
    })
})


const contactOwnerButtons = document.querySelectorAll('.contactOwner')
contactOwnerButtons.forEach(contactOwnerButton => {
    contactOwnerButton.addEventListener('click', (event) => {
        const ownerEmail = event.target.getAttribute("data-content-owner-email")
        alert(`Contacter le owner avec son email  : ${ownerEmail} !!`)
    })
})

// v_announcement
const cancelAnnouncementButton = document.querySelector('#cancelAnnouncementButton')
cancelAnnouncementButton.addEventListener('click', (event) => {
    history.back()
    event.preventDefault()
    event.stopPropagation()
})
//----
const fileInput = document.getElementById('fileInput')
const previewContainer = document.getElementById('previewContainer1')

fileInput.addEventListener('change', (event)=> {
    file = event.target.files[0]

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
        reader.onload = function(e) {
            const img = document.createElement('img')
            img.setAttribute('alt','announcement preview image')
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

//TODO fonction test mot de passe identife et mot de passe forte