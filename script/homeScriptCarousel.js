// CAROUSEL-----------------------------------------------------------------------

//variables globales
let compteur = 0; //compteur qui permet de connaitre l'image sur laquelle on se trouve
let timer, elements, slides, slideWidth, speed, transition;

//on vérifie que le DOM est chargé
window.onload = () => {
    //on récupère le carousel
    const carousel = document.querySelector(".carousel__global__wrapper");
    // on récupère la vitesse de défilement des slides
    speed = carousel.dataset.speed;
    // on récupère la vitesse de transition
    transition = carousel.dataset.transition;
    // on récupère les éléments
    elements = document.querySelector(".elements__wrapper");
    
    //après avoir récupéré les éléments, on clone la première image
    let firstSlide = elements.firstElementChild.cloneNode(true);
    // on injecte ensuite le clone à la fin du carousel
    elements.appendChild(firstSlide);
    
    //on récupère chaque slide dans un tableau depuis elements
    slides = Array.from(elements.children);
    //on récupère la largeur d'une slide
    slides.forEach((slide)  => {
        slideWidth = slide.getBoundingClientRect().width;
    })
    
    //on modifie la grosseur des images quand on passe la souris dessus
    // let images = carousel.querySelectorAll("img");
    // images.forEach((image) => {
    //     image.addEventListener("mouseover", () => {
    //         image.style.width ="100%";
    //     })
        
    //     image.addEventListener("mouseout", () => {
    //         image.style.width ="90%"
    //     })
         
    // })
   
    
    //on gère la responsivité du carousel----------------------------------------------------------
    
    if (screen.width > 400) {
        let firstDoubleSlide = document.querySelector(".elements__wrapper :nth-child(2)").cloneNode(true);
        elements.appendChild(firstDoubleSlide);
    }
    if ((screen.width > 900) || (screen.orientation.type == "landscape-secondary") || (screen.orientation.type == "landscape-primary"))  {
        let firstTripleSlide = document.querySelector(".elements__wrapper :nth-child(3)").cloneNode(true);
        elements.appendChild(firstTripleSlide);
    }
    
    if (screen.orientation.type == "portrait-secondary" || screen.orientation.type == "portrait-primary") {
    }
    
    //si on change d'orientation on recharge la page
    window.addEventListener("orientationchange", () => {
        setTimeout(() => {
            document.location.reload();
        }, "5")
    })
    
    
    //si on revient sur l'onglet de la page d'acceuil la page se recharge
    if(document.location.search === "?page=home" || document.location.search=== ""){
        window.addEventListener('visibilitychange', () => {
            if(document.visibilityState === "visible"){
                setTimeout(() => {
                     document.location.reload();
                }, "5")
            }
        })
    }
    
    //-------------------------------------------------------------------------------------
        
    //on récupère les flèches de navigation
    // let next = document.querySelector(".next")
    // let previous = document.querySelector(".previous")
    
    // //on gère le click sur les flèche de navigation 
    // next.addEventListener("click", getNextSlide);
    // previous.addEventListener("click", getPreviousSlide);
    
    
    //on gère le swipe sur mobile et tablet-------------------------------------------
    
    //on détecte les évènements de swipe sur mobile et tablet
    carousel.addEventListener('touchstart', handleTouchStart, false);        
    carousel.addEventListener('touchmove', handleTouchMove, false);
  
    
    var xDown = null;                                                        
    var yDown = null;
    
    function getTouches(evt) {
      return evt.touches ||             // browser API
             evt.originalEvent.touches; // jQuery
    }                                                     
                                                                             
    function handleTouchStart(evt) {
        const firstTouch = getTouches(evt)[0];                                      
        xDown = firstTouch.clientX;                                      
        yDown = firstTouch.clientY;                                      
    };                                                
                                                                             
    function handleTouchMove(evt) {
        if ( ! xDown || ! yDown ) {
            return;
        }
    
        var xUp = evt.touches[0].clientX;                                    
        var yUp = evt.touches[0].clientY;
    
        var xDiff = xDown - xUp;
        var yDiff = yDown - yUp;
                                                                             
        if ( Math.abs( xDiff ) > Math.abs( yDiff ) ) {/*most significant*/
            if ( xDiff > 0 ) {
                getNextSlide();
            } else {
                getPreviousSlide();
            }                       
        } else {
            if ( yDiff > 0 ) {
                /* down swipe */ 
            } else { 
                /* up swipe */
            }                                                                 
        }
        /* reset values */
        xDown = null;
        yDown = null;                                             
    };

    //on automatise le défilement------------------------------------------
    
    getNextSlide(); //pour lancer le défilemnt directement sans attendre le timer
    timer = setInterval(getNextSlide,speed);
    //on gère l'arret et la reprise du défilement automatique
    // carousel.addEventListener("mouseover", stopTimer);
    // carousel.addEventListener("mouseout", startTimer);
     carousel.addEventListener('touchstart', stopTimer);
    carousel.addEventListener('touchmove', stopTimer);
    carousel.addEventListener('touchend', startTimer);
    
    //fonctions qui permettent d'arreter le défilement automatique
    function stopTimer() {
        clearInterval(timer);
    }
    
    function startTimer () {
        timer = setInterval(getNextSlide, speed);
    }
    
    //-----------------------------------------------------------------------
    
    //fonction qui fait défiler le carousel vers la droite
    function getNextSlide() {
        // on incrémente le compteur
        compteur++;
        
        //on fait une transition pour le décalage
        elements.style.transition = transition+"ms linear";
        
        //variable qui correspond à la largeur de décalage
        let decal = -slideWidth * compteur;
        
        // on décale les slide de la valeur de decal
        elements.style.transform = `translateX(${decal}px)`;
        
        //on attend la fin de la dernière transition, et on rembobine
        setTimeout(function() {
            //si on a fait défiler toutes les images, on remet le compteur à 0, on annule la transition
            //et on réinitialise le décalage à 0
            if (compteur >= slides.length -1) {
                compteur = 0;
                elements.style.transition ="unset";
                elements.style.transform = "translateX(0)";
                
            }
        },transition)
    }
    
    //fonction qui fait défiler le carousel vers la gauche
    function getPreviousSlide() {
        //on décrémente le compteur
        compteur--;
        //on fait une transition pour le décalage
        elements.style.transition = transition+"ms linear";
        
       
        
        //si on est à la première image
        if(compteur < 0) {
            // on remet le compeur au maximum
            compteur = slides.length - 1;
            //on défini la largeur de décalage pour rembobiner le carousel (à l'envers)
            let decal = -slideWidth * compteur;
            //on annule la transition et on réinitialise le décalage à 0
            elements.style.transition ="unset";
            elements.style.transform = `translateX(${decal}px)`;
            
            setTimeout(getPreviousSlide,1);
        }
        
        let decal = -slideWidth * compteur;
        elements.style.transform = `translateX(${decal}px)`;
    }
}




