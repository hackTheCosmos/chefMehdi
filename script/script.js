//CHARGEMENT DES SCRIPT

//constante qui contient le dernier segment après le caractère "/" d'une url
const getLastItem = document.location.href.substring(document.location.href.lastIndexOf("/") + 1)

/**
 * Cette fonction récupère la valeur d'un paramètre de l'url
 * 
 * @param {string} param
 */
function getPage (param) {
    let url = new URL(document.location.href)
    let nb = url.searchParams.get(param)
    
    return nb;
}

/**
 * Cette fonction permet de charger le script qui correspond à la bonne page
 * 
 * @param {string} page
 * @param {string} scriptSRC
 */
function loadScript(page, scriptSRC) {
    if(getPage("page") === page) {
        let script = document.createElement("script")
        script.setAttribute("src", scriptSRC)
        script.setAttribute("defer", true)
        document.head.appendChild(script);
    }
}

//si on est sur l'index ou sur la page d'accueil on charge le script
// if(getLastItem === "index.php" || getLastItem === "index.php?page=home") {
//     let script = document.createElement("script")
//     script.setAttribute("src","./script/homeScriptCarousel.js")
//     script.setAttribute("defer", true)
//     document.head.appendChild(script);
// }



//si on est sur la page "connexion" on charge le script

// loadScript("sign-in-sign-up", "./script/signinForm.js")
// loadScript("sign-in-sign-up", "https://www.google.com/recaptcha/api.js")






//si on est sur la page "réservation" on charge le script

// loadScript("booking", "./script/bookingForm.js")
// loadScript("booking", "https://www.google.com/recaptcha/api.js")




//si on est sur la page "nouveau mot de passe" on charge le script

// loadScript("new-password", "./script/newPassForm.js")




//si on est sur la page "update menu" on charge le script

// loadScript("update-menu", "./script/updateMenuForm.js")



//si on est sur la page "update profil" on charge le script

// loadScript("update-user-profile", "./script/updateProfilForm.js")



//si on est sur la page "mes clients" on charge le script

// loadScript("my-customers", "./script/ajax.js")







//HEADER-------------------------------------------------------------------

// Menu burger (version mobile et tablet)---------------------

    const nav = document.querySelector(".burgerNav");
    const navClass = nav.classList;
    const burgerIcon = document.querySelector(".burger__icon__wrapper");
    let bars = document.querySelectorAll(".bar")
    
    // affiche/cache navigation, et anime l'icone du menu burger
    burgerIcon.addEventListener("click", () => {
        navClass.toggle("displayNav");
    
        bars.forEach((bar) => {
            bar.classList.toggle("active")
        })
    });

// Animation du logo du header---------------------------------------------

    const logo = document.querySelector(".logo");
    let logoClass = logo.classList;
    // const text = document.querySelector('.logoDiv p')

    logo.addEventListener("click", () => {
        logoClass.toggle("logoRotate");
        // text.style.transform = "translateX(44px)"
        // text.style.opacity = "0"
        // text.style.transition ="all 2s"
        setTimeout("document.location = 'index.php?page=home' ", 2000)
    })


//COLORATION DES LIENS DE LA  NAVIGATION ------------------------------------------------

let navLinks = document.querySelectorAll(".nav__link")
navLinks.forEach((navLink) => {
    navLink.addEventListener("click", () => {
        navLink.style.color = "#e8e0c6"
        // if (!navLink.classList.contains("button")){
        //     let navIcon = navLink.previousSibling.previousSibling.childNodes[1]
        //     navIcon.style.color = "#e8e0c6"
        // }
       
    })
})

//récupération des éléments du DOM
const homeLink = document.getElementById("home__link")
const homeLinkDesktop = document.getElementById("home__link__desktop")
// const homeIconLink = document.getElementById("home__icon__link")
const aboutLink = document.getElementById("about__link")
const aboutLinkDesktop = document.getElementById("about__link__desktop")
// const aboutIconLink = document.getElementById("about__icon__link")
const menuLink = document.getElementById("menu__link")
const menuLinkDesktop = document.getElementById("menu__link__desktop")
// const menuIconLink = document.getElementById("menu__icon__link")
const giftLink = document.getElementById("gift__link")
const giftLinkDesktop = document.getElementById("gift__link__desktop")
// const giftIconLink = document.getElementById("gift__icon__link")
const bookingtLink = document.getElementById("booking__link")
const bookingtLinkDesktop = document.getElementById("booking__link__desktop")




//si on est sur la page d'acceuil
if(document.location.search === "?page=home" || document.location.search === ""){
    homeLink.style.color = "#e8e0c6"
    homeLinkDesktop.style.color = "#e8e0c6"
    // homeIconLink.style.color = "#e8e0c6"
}

//si on est sur la page à propos
if(document.location.search === "?page=about"){
    aboutLink.style.color = "#e8e0c6"
    aboutLinkDesktop.style.color = "#e8e0c6"
    // aboutIconLink.style.color = "#e8e0c6"
}

//si on est sur la page menu
if(document.location.search === "?page=menu"){
    menuLink.style.color = "#e8e0c6"
    menuLinkDesktop.style.color = "#e8e0c6"
    // menuIconLink.style.color = "#e8e0c6"
}

//si on est sur la page faire un cadeau
if(document.location.search === "?page=gift"){
    giftLink.style.color = "#e8e0c6"
    giftLinkDesktop.style.color = "#e8e0c6"
    // giftIconLink.style.color = "#e8e0c6"
}

//si on est sur la page réserver
if(document.location.search === "?page=booking"){
    bookingtLink.style.color = "#e8e0c6"
    bookingtLinkDesktop.style.color = "#e8e0c6"
    // giftIconLink.style.color = "#e8e0c6"
}

//si on active un nouveau lien, le lien de la page actuelle n'est plus doré
navLinks.forEach((navLink) => {
   
    navLink.classList.remove("active")
    navLink.addEventListener("click", () => {
        navLink.classList.add("active")
        navLinks.forEach((activeLink) => {
            if(!activeLink.classList.contains("active") && !activeLink.classList.contains("button")){
                activeLink.style.color = "#000"
                // let activeNavIcon =  activeLink.previousSibling.previousSibling.childNodes[1]
                // activeNavIcon.style.color = "#000"
            }
        })
    })

})


// //FORMULAIRES---------------------------------------------------------------------------

// Inputs de type password
// Affichage / masquage des mots de passe

    const eyeIcons = document.querySelectorAll(".eye__icon");
    const passwordInputs = document.querySelectorAll(".password__input");
    
      // change le type de l'input soit en "password", soit en "text"
    function changeType (input) {
        if (input.type === "password"){
            input.type = "text";
        } else {
            input.type = "password";
        }
    }
    
     // change l'icone
    function changeIcon (icon) {
        let eyeIconClass = icon.classList;
        eyeIconClass.toggle("fa-eye");
        eyeIconClass.toggle("fa-eye-slash");
    }
    
    // script qui gère la visibilité des mots de passe    
    eyeIcons.forEach ((eyeIcon) => {
        eyeIcon.addEventListener("click", () => {
            changeIcon(eyeIcon);
            changeType(eyeIcon.previousSibling.previousSibling);
            
        })
    })
   


//BACK TO TOP ANCHOR------------------------------------------------------------    
const toTop = document.querySelector(".to__top")

//si on scroll vers le bas on affiche le bouton, sinon il disparait
window.addEventListener("scroll", () => {
    if(window.pageYOffset > 500) {
        toTop.classList.add("active")
    } else {
        toTop.classList.remove("active")
    }
})


//MENU FAT AU CLIC (à partir de support tablette)
let menuImages = document.querySelectorAll('.menu__image')
let backs = document.querySelectorAll('.back')
let body = document.querySelector("body")
let header = document.querySelector("header")
let footer = document.querySelector("footer")

if(screen.width >= 768) {
    
    menuImages.forEach((menuImage) => {
        menuImage.addEventListener("click", () => {
            // body.style.overflow = "hidden";
            header.style.display = "none"
            footer.style.display = "none"
            menuImage.style.position ="absolute";
            menuImage.style.top = "0";
            menuImage.style.left = "0";
            menuImage.style.maxWidth = "100vw"
            menuImage.style.objectFit = "contain";
            if (menuImage.parentNode.nextSibling.nextSibling) {
                menuImage.parentNode.nextSibling.nextSibling.style.display = "none"
            }
            if(menuImage.parentNode.previousSibling.previousSibling) {
               menuImage.parentNode.previousSibling.previousSibling.style.display = "none"
            }
            
            // //liens vers la page précédente
            backs.forEach((back) => {
                back.style.display = "flex"
            })
            
        })
    })
}





