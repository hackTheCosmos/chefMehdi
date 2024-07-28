// GESTION DU FORMULAIRE DE DEMANDE DE BON CADEAU----------------------------------


//récupération du formulaire de demande de bon cadeau
const giftgForm = document.getElementById("gift__form")

if(giftgForm !== null) {
    //si le formulaire de demande de bon cadeau est soumis on vérifie la validité des champs
    giftgForm.addEventListener("submit", checkGiftForm)
}

// récupère la position d'un élément pour le scroll si mal rempli (pour mieux voir directement l'info bulle)
function getOffset(el) {
  const rect = el.getBoundingClientRect();
  return rect.top + window.scrollY
}

//fonction qui gère la validation du formulaire de demande de bon cadeau
function checkGiftForm (e) {
    
    let position

    
    //GESTION DU NOM DU BENEFICIAIRE
    //récupération de l'input nom
    const nameInput = document.querySelector("#name")
    
    //récupération de l'info bulle pour le nom
    let nameInfo = document.querySelector(".name__info")
    
    //si on reviens sur l'input on cache l'infobulle
    nameInput.addEventListener("focus", () => {
        nameInfo.classList.remove("invalid")
    })
    
    //si la valeur du nom n'est pas renseignée
    if (nameInput.validity.valueMissing) {
        //on bloque l'envoi du formulaire
        e.preventDefault()
        //on affiche l'info bulle
        nameInfo.innerText = "veuillez renseigner le nom du bénéficiaire"
        nameInfo.classList.add("invalid")
        
        //scrolle to info bulle
        if(screen.width >= 1024) {
            position = getOffset(nameInput)
            scrollTo(0, position - 300)
            
        } else {
            window.location.href ="#name__anchor"
        }
        return
    } else {
        nameInfo.classList.remove("invalid")
    }
    
    //GESTION DU PRENOM DU BENEFICIAIRE
    //récupération de l'input prenom
    const firstNameInput = document.querySelector("#first__name")
    
    //récupération de l'info bulle pour le prenom
    let firstNameInfo = document.querySelector(".first__name__info")
    
    //si on reviens sur l'input on cache l'infobulle
    firstNameInput.addEventListener("focus", () => {
        firstNameInfo.classList.remove("invalid")
    })
    
    //si la valeur du nom n'est pas renseignée
    if (firstNameInput.validity.valueMissing) {
        //on bloque l'envoi du formulaire
        e.preventDefault()
        //on affiche l'info bulle
        firstNameInfo.innerText = "veuillez renseigner le prénom du bénéficiaire"
        firstNameInfo.classList.add("invalid")
            //scrolle to info bulle
        if(screen.width >= 1024) {
            position = getOffset(firstNameInput)
            scrollTo(0, position - 300)
            
        } else {
            window.location.href ="#name__anchor"
        }
        return
    } else {
        nameInfo.classList.remove("invalid")
    }
    
    //GESTION DU NOM DU CLIENT
    //récupération de l'input clientName
    const nameClientInput = document.querySelector("#name__client")
    
    //récupération de l'info bulle pour le nom
    let nameClientInfo = document.querySelector(".name__client__info")
    
    //si on reviens sur l'input on cache l'infobulle
    nameClientInput.addEventListener("focus", () => {
        nameClientInfo.classList.remove("invalid")
    })
    
    //si la valeur du nom n'est pas renseignée
    if (nameClientInput.validity.valueMissing) {
        //on bloque l'envoi du formulaire
        e.preventDefault()
        //on affiche l'info bulle
        nameClientInfo.innerText = "veuillez renseigner votre nom"
        nameClientInfo.classList.add("invalid")
            //scrolle to info bulle
        if(screen.width >= 1024) {
            position = getOffset(nameClientInput)
            scrollTo(0, position - 300)
            
        } else {
            window.location.href ="#name__client__anchor"
        }
        return
    } else {
        nameInfo.classList.remove("invalid")
    }
    
    //GESTION DU PRENOM DU CLIENT
    //récupération de l'input clientFirstName
    const firstNameClientInput = document.querySelector("#first__name__client")
    
    //récupération de l'info bulle pour le prenom
    let firstNameClientInfo = document.querySelector(".first__name__client__info")
    
    //si on reviens sur l'input on cache l'infobulle
    firstNameClientInput.addEventListener("focus", () => {
        firstNameClientInfo.classList.remove("invalid")
    })
    
    //si la valeur du nom n'est pas renseignée
    if (firstNameClientInput.validity.valueMissing) {
        //on bloque l'envoi du formulaire
        e.preventDefault()
        //on affiche l'info bulle
        firstNameClientInfo.innerText = "veuillez renseigner votre prénom"
        firstNameClientInfo.classList.add("invalid")
            //scrolle to info bulle
        if(screen.width >= 1024) {
            position = getOffset(firstNameClientInput)
            scrollTo(0, position - 300)
            
        } else {
            window.location.href ="#name__client__anchor"
        }
        return
    } else {
        nameInfo.classList.remove("invalid")
    }
    
    //GESTION DE L'EMAIL
    //récupération de l'input email
    const mailInput = document.querySelector("#mail")
    
    //récupération de l'info bulle pour l'email
    let mailInfo = document.querySelector(".mail__info")
    
    //si on reviens sur l'input on cache l'infobulle
    mailInput.addEventListener("focus", () => {
        mailInfo.classList.remove("invalid")
    })
    
    //si la valeur de l'email n'est pas renseignée
    if (mailInput.validity.valueMissing) {
        //on bloque l'envoi du formulaire
        e.preventDefault()
        //on affiche l'info bulle
        mailInfo.innerText = "veuillez renseigner votre email"
        mailInfo.classList.add("invalid")
            //scrolle to info bulle
        if(screen.width >= 1024) {
            position = getOffset(mailInput)
            scrollTo(0, position - 300)
            
        } else {
            window.location.href ="#name__client__anchor"
        }
        
        return
     } else if (!(/^[A-Za-z0-9_!#$%&'*+\/=?`{|}~^.-]+@[A-Za-z0-9.-]+$/.test(mailInput.value))) {
            // on bloque l'envoi du formulaire
            e.preventDefault()
            //on affiche l'info bulle
            mailInfo.innerText = "votre email n'a pas le bon format"
            mailInfo.classList.add("invalid");
            return
        
    } else {
        mailInfo.classList.remove("invalid")
    }
    
    //GESTION DU TELEPHONE
    //récupération de l'input phone
    const phoneInput = document.querySelector("#phone")
    
    //récupération de l'info bulle pour le numéro de téléphone
    let phoneInfo = document.querySelector(".phone__info")
    
    //si on reviens sur l'input on cache l'infobulle
    phoneInput.addEventListener("focus", () => {
        phoneInfo.classList.remove("invalid")
    })
    
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
            window.location.href ="#name__client__anchor"
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
    
    //GESTION DU NOMBRE DE CONVIVES
    //récupération de l'input number of persons
    const personsInput = document.querySelector("#number__of__persons")
    
    //récupération de l'info bulle pour le nombre de convives
    let personsInfo = document.querySelector(".persons__info")
    
    //si on reviens sur l'input on cache l'infobulle
    personsInput.addEventListener("focus", () => {
        personsInfo.classList.remove("invalid__booking__field")
    })
    
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
            window.location.href ="#details__anchor"
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
            window.location.href ="#details__anchor"
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
    
     //si on reviens sur l'input on cache l'infobulle
    menuInput.addEventListener("focus", () => {
        menuInfo.classList.remove("invalid")
    })
    
    //si on ne choisi pas de menu
    if (menuInput.validity.valueMissing) {
        //on bloque l'envoi du formulaire
        e.preventDefault()
        //on affiche l'info bulle
        menuInfo.innerText = "veuillez choisir un menu"
        menuInfo.classList.add("invalid")
               //scrolle to info bulle
        if(screen.width >= 1024) {
            position = getOffset(menuInput)
            scrollTo(0, position - 300)
            
        } else {
            window.location.href ="#details__anchor"
        }
        return
    } else {
        menuInfo.classList.remove("invalid")
    }
    
    //GESTION DE LA CHECKBOX RGPD
    //récupération de la checkbox
    const checkboxInput = document.querySelector("#form__checkbox")
    
    //récupération de l'info bulle pour la checkbox
    let checkboxInfo = document.querySelector(".checkbox__info")
    
     //si on coche la case on cache l'infobulle
    checkboxInput.addEventListener("change", () => {
        checkboxInfo.classList.remove("invalid__checkbox")
    })
    
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
const checkbox = document.querySelector(".form__checkbox")
inputs.forEach((input) => {
    input.addEventListener("keyup", () => {
            
            let infoBulle = input.nextSibling.nextSibling
            let infoBulleClass = infoBulle.classList
            infoBulleClass.remove("invalid__booking__field");
            infoBulleClass.remove("invalid");
    })
    
    checkbox.addEventListener("change", () => {
            
            let infoBulleCheckBox = document.querySelector(".checkbox__info")
            let infoBulleCheckBoxClass = infoBulleCheckBox.classList
            infoBulleCheckBoxClass.remove("invalid__checkbox");
    })
    
    
})