// GESTION DU FORMULAIRE DE RESERVATION----------------------------------


//récupération du formulaire de demande de réservation
const bookingForm = document.getElementById("booking__form")

if(bookingForm !== null) {
    //si le formulaire de reservation est soumis on vérifie la validité des champs
    bookingForm.addEventListener("submit", checkBookingForm)
}

// récupère la position d'un élément pour le scroll si mal rempli (pour mieux voir directement l'info bulle)
function getOffset(el) {
  const rect = el.getBoundingClientRect();
  return rect.top + window.scrollY
}

//fonction qui gère la validation du formulaire de demande de réservation
function checkBookingForm (e) {
    
    let position
    
    //GESTION DU NOM
    //récupération de l'input nom
    const nameInput = document.querySelector("#name")
    
    //récupération de l'info bulle pour le nom
    let nameInfo = document.querySelector(".name__info")
    
    //si la valeur du nom n'est pas renseignée
    if (nameInput.validity.valueMissing) {
        //on bloque l'envoi du formulaire
        e.preventDefault()
        //on affiche l'info bulle
        nameInfo.innerText = "veuillez renseigner votre nom"
        nameInfo.classList.add("invalid__booking__field")
        //scrolle to info bulle
        if(screen.width >= 1024) {
            position = getOffset(nameInput)
            scrollTo(0, position - 300)
            
        } else {
            window.location.href ="#name"
        }
        return
    } else {
        nameInfo.classList.remove("invalid__booking__field")
    }
    
    //GESTION DU PRENOM
    //récupération de l'input prenom
    const firstNameInput = document.querySelector("#first__name")
    
    //récupération de l'info bulle pour le prenom
    let firstNameInfo = document.querySelector(".first__name__info")
    
    //si la valeur du prenom n'est pas renseignée
    if (firstNameInput.validity.valueMissing) {
        //on bloque l'envoi du formulaire
        e.preventDefault()
        //on affiche l'info bulle
        firstNameInfo.innerText = "veuillez renseigner votre prenom"
        firstNameInfo.classList.add("invalid__booking__field")
        //scrolle to info bulle
        if(screen.width >= 1024) {
            position = getOffset(firstNameInput)
            scrollTo(0, position - 300)
            
        } else {
            window.location.href ="#first__name"
        }
        
        return
    } else {
        firstNameInfo.classList.remove("invalid__booking__field")
    }
    
    //GESTION DE L'EMAIL
    //récupération de l'input email
    const MailInput = document.querySelector("#mail")
    
    //récupération de l'info bulle pour l'email
    let mailInfo = document.querySelector(".mail__info")
    
    //si la valeur de l'email n'est pas renseignée
    if (MailInput.validity.valueMissing) {
        //on bloque l'envoi du formulaire
        e.preventDefault()
        //on affiche l'info bulle
        mailInfo.innerText = "veuillez renseigner votre email"
        mailInfo.classList.add("invalid__booking__field")
        //scrolle to info bulle
        if(screen.width >= 1024) {
            position = getOffset(MailInput)
            scrollTo(0, position - 300)
            
        } else {
            window.location.href ="#mail"
        }
        return
    }else if (!(/^[A-Za-z0-9_!#$%&'*+\/=?`{|}~^.-]+@[A-Za-z0-9.-]+$/.test(MailInput.value))) {
            // on bloque l'envoi du formulaire
            e.preventDefault()
            //on affiche l'info bulle
            mailInfo.innerText = "votre email n'a pas le bon format"
            mailInfo.classList.add("invalid__booking__field");
            return
    } else {
        mailInfo.classList.remove("invalid__booking__field")
    }
    
    //GESTION DU TELEPHONE
    //récupération de l'input phone
    const phoneInput = document.querySelector("#phone")
    
    //récupération de l'info bulle pour le numéro de téléphone
    let phoneInfo = document.querySelector(".phone__info")
    
    //si la valeur du téléphone n'est pas renseignée
    if (phoneInput.validity.valueMissing) {
        //on bloque l'envoi du formulaire
        e.preventDefault()
        //on affiche l'info bulle
        phoneInfo.innerText = "veuillez renseigner votre numéro de téléphone"
        phoneInfo.classList.add("invalid")
        //scrolle to info bulle
        if(screen.width >= 1024) {
            position = getOffset(phoneInput)
            scrollTo(0, position - 300)
            
        } else {
            window.location.href ="#phone"
        }
        return
    }else if (!(/^[a-zA-Z0-9\-().\s]{6,15}$/.test(phoneInput.value))) {
            // on bloque l'envoi du formulaire
            e.preventDefault()
            //on affiche l'info bulle
            phoneInfo.innerText = "votre numéro de téléphone n'a pas le bon format"
            phoneInfo.classList.add("invalid");
            return
    } else {
        phoneInfo.classList.remove("invalid")
    }
    
    //GESTION DE L'ADDRESSE
    //récupération de l'input address
    const addressInput = document.querySelector("#address")
    
    //récupération de l'info bulle pour l'addresse
    let addressInfo = document.querySelector(".address__info")
    
    //si la valeur de l'addresse n'est pas renseignée
    if (addressInput.validity.valueMissing) {
        //on bloque l'envoi du formulaire
        e.preventDefault()
        //on affiche l'info bulle
        addressInfo.innerText = "veuillez renseigner votre adresse"
        addressInfo.classList.add("invalid__booking__field")
        //scrolle to info bulle
        if(screen.width >= 1024) {
            position = getOffset(addressInput)
            scrollTo(0, position - 300)
            
        } else {
            window.location.href ="#address"
        }
        return
    } else {
        addressInfo.classList.remove("invalid__booking__field")
    }
    
    //GESTION DE LA DATE
    // Contrainte de sélection de date (4 jours à l'avance minimum)
    let todayTimestamp = Date.now();
    let timestampDelay = todayTimestamp + 345600000;
    let todayDelay = new Date(timestampDelay);
    let day = todayDelay.getDate();
    let month = todayDelay.getMonth() + 1;
    let year = todayDelay.getFullYear();
    
    if (day < 10) {
        day = "0" + day;
    }
    if (month < 10) {
        month = "0" + month;
    }
    
    todayDelay = year + "-" + month + "-" + day
    
    //récupération de l'input date
    const dateInput = document.querySelector("#date");
    
    //récupération de l'info bulle pour la date
    let dateInfo = document.querySelector(".date__info")
    
    //si la valeur de la date n'est pas renseignée
    if (dateInput.validity.valueMissing) {
        //on bloque l'envoi du formulaire
        e.preventDefault()
        //on affiche l'info bulle
        dateInfo.innerText = "veuillez selectionner une date"
        dateInfo.classList.add("invalid__booking__field")
        //scrolle to info bulle
        if(screen.width >= 1024) {
            position = getOffset(dateInput)
            scrollTo(0, position - 300)
            
        } else {
            window.location.href ="#date"
        }
        return
    
    //si le délai de 4 jours minimums n'es pas respécté
    } else if (dateInput.value < todayDelay) {
        e.preventDefault()
        //on affiche l'info bulle
        dateInfo.innerText = "4 jours à l'avance minimum"
        dateInfo.classList.add("invalid__booking__field")
        //scrolle to info bulle
        if(screen.width >= 1024) {
            position = getOffset(dateInput)
            scrollTo(0, position - 300)
            
        } else {
            window.location.href ="#date"
        }
        return
        
    } else {
            dateInfo.classList.remove("invalid__booking__field")
    }
    
    //GESTION DE CRENEAU HORAIRE
    //récupération de l'input time
    const timeInput = document.querySelector("#time")
    
    //récupération de l'info bulle pour le créneua horaire
    let timeInfo = document.querySelector(".time__info")
    
    //si la valeur du créneau horaire n'est pas renseignée
    if (timeInput.validity.valueMissing) {
        //on bloque l'envoi du formulaire
        e.preventDefault()
        //on affiche l'info bulle
        timeInfo.innerText = "veuillez selectionner un moment"
        timeInfo.classList.add("invalid__booking__field")
        //scrolle to info bulle
        if(screen.width >= 1024) {
            position = getOffset(timeInput)
            scrollTo(0, position - 300)
            
        } else {
            window.location.href ="#time"
        }
        return
    } else {
        timeInfo.classList.remove("invalid__booking__field")
    }
    
    //GESTION DU NOMBRE DE CONVIVES
    //récupération de l'input number of persons
    const personsInput = document.querySelector("#number__of__persons")
    
    //récupération de l'info bulle pour le nombre de convives
    let personsInfo = document.querySelector(".persons__info")
    
    //si la valeur du nombre de convives n'est pas renseignée
    if (personsInput.validity.valueMissing) {
        //on bloque l'envoi du formulaire
        e.preventDefault()
        //on affiche l'info bulle
        personsInfo.innerText = "veuillez renseigner le nombre de convives"
        personsInfo.classList.add("invalid__booking__field")
        //scrolle to info bulle
        if(screen.width >= 1024) {
            position = getOffset(personsInput)
            scrollTo(0, position - 300)
            
        } else {
            window.location.href ="#number__of__persons"
        }
        return
        
    } else if (personsInput.value < 4) {
        e.preventDefault()
        //on affiche l'info bulle
        personsInfo.innerText = "4 personnes minimum"
        personsInfo.classList.add("invalid__booking__field")
        //scrolle to info bulle
        if(screen.width >= 1024) {
            position = getOffset(personsInput)
            scrollTo(0, position - 300)
            
        } else {
            window.location.href ="#number__of__persons"
        }
        return
    } else {
        personsInfo.classList.remove("invalid__booking__field")
    }
    
    //GESTION DU CHOIX DU MENU
    //récupération de l'input menu
    const menuInput = document.querySelector("#menu")
    
    //récupération de l'info bulle pour le choix du menu
    let menuInfo = document.querySelector(".menu__info")
    
    //si on ne choisi pas de menu
    if (menuInput.validity.valueMissing) {
        //on bloque l'envoi du formulaire
        e.preventDefault()
        //on affiche l'info bulle
        menuInfo.innerText = "veuillez choisir un menu"
        menuInfo.classList.add("invalid__booking__field")
        //scrolle to info bulle
        if(screen.width >= 1024) {
            position = getOffset(menuInput)
            scrollTo(0, position - 300)
            
        } else {
            window.location.href ="#menu"
        }
        return
    } else {
        menuInfo.classList.remove("invalid__booking__field")
    }
    
    //GESTION DE LA CHECKBOX RGPD
    //récupération de la checkbox
    const checkboxInput = document.querySelector("#form__checkbox")
    
    //récupération de l'info bulle pour la checkbox
    let checkboxInfo = document.querySelector(".checkbox__info")
    
    //si la case n'est pas cochée
    if (!checkboxInput.checked) {
        //on bloque l'envoi du formulaire
        e.preventDefault()
        //on affiche l'info bulle
        checkboxInfo.innerText = "veuillez cocher la case"
        checkboxInfo.classList.add("invalid__checkbox")
        //scrolle to info bulle
        if(screen.width >= 1024) {
            position = getOffset(checkboxInput)
            scrollTo(0, position - 300)
            
        } else {
            window.location.href ="#form__checkbox"
        }
        return
    } else {
        checkboxInfo.classList.remove("invalid__checkbox")
    }
    
    //GESTION DU RECAPTCHA
    //récupération du recaptcha
    const recaptcha = document.querySelector(".g-recaptcha")
    //récupération de l'info bulle pour le recaptcha
    let recaptchaInfo = document.querySelector(".captcha__info")
    //si le captcha n'est pas coché
    if (grecaptcha.getResponse().length === 0) {
        //on bloque l'envoi du formulaire
        e.preventDefault()
        //on affiche l'info bulle
        recaptchaInfo.innerText = "veuillez cocher la case pour prouver que vous n'êtes pas un robot"
        recaptchaInfo.classList.add("invalid__recaptcha");
    } else {
        recaptchaInfo.classList.remove("invalid__recaptcha")
         recaptchaInfo.innerText = ""
        
    }
}

//GESTION DU FAIT QUE SI L'UTILISATEUR REVIENS REMPLIR UN CHAMP APRES QUE L'INFO BULLE SE SOIT ACTIVEE (on cache l'info bulle)
const inputs = document.querySelectorAll(".form__input")
const changeInputs = document.querySelectorAll(".change__input")
const checkbox = document.querySelector(".form__checkbox")
inputs.forEach((input) => {
    input.addEventListener("keyup", () => {
            
            let infoBulle = input.nextSibling.nextSibling
            let infoBulleClass = infoBulle.classList
            infoBulleClass.remove("invalid__booking__field");
            infoBulleClass.remove("invalid");
    })
    
    changeInputs.forEach((changeInput) => {
        changeInput.addEventListener("change", () => {
            
            let infoBulle = changeInput.nextSibling.nextSibling
            let infoBulleClass = infoBulle.classList
            infoBulleClass.remove("invalid__booking__field");
            infoBulleClass.remove("invalid");
    })
        
    })
    
    
    
    checkbox.addEventListener("change", () => {
            
            let infoBulleCheckBox = document.querySelector(".checkbox__info")
            let infoBulleCheckBoxClass = infoBulleCheckBox.classList
            infoBulleCheckBoxClass.remove("invalid__checkbox");
    })
    
    
})

// CALENDRIER POUR CHOISIR LA DATE DE LA RESERVATION -----------------------------------------------------------
    // Contrainte de sélection de date (4 jours à l'avance minimum)
    let todayTimestamp = Date.now();
    let timestampDelay = todayTimestamp + 345600000;
    let todayDelay = new Date(timestampDelay);
    let day = todayDelay.getDate();
    let month = todayDelay.getMonth() + 1;
    let year = todayDelay.getFullYear();
    
    if (day < 10) {
        day = "0" + day;
    }
    if (month < 10) {
        month = "0" + month;
    }
    
    todayDelay = year + "-" + month + "-" + day
    
     //récupération de l'input date
    let dateInput = document.getElementById("date");
    
    if(dateInput !== null){
        dateInput.setAttribute("min", todayDelay);
    }
    
    



