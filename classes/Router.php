<?php

class Router {
    
    public static function route(): void {
        if (isset($_GET['page'])) {
            
            
            // --------------------------------- FRONT OFFICE--------------------------------------------------
            
            //page d'acceuil
            if ($_GET['page'] == "home") {
                    indexController::getIndex();
            }
            
            //à propos du chef
            if ($_GET['page'] == "about") {
                    aboutController::getAbout();
            }
            
            //menus
            if ($_GET['page'] == "menu") {
                    menuController::getMenu();
            }
            
            //menu Gourmet
            if ($_GET['page'] == "menu-gourmet") {
                    menuController::getMenuGourmet();
            }
            
            //menu Prestige
            if ($_GET['page'] == "menu-prestige") {
                    menuController::getMenuPrestige();
            }
            
            //menu cocktail dinatoire
            if ($_GET['page'] == "cocktail-dinatoire") {
                    menuController::getCocktailDinatoire();
            }
            
            //faire un cadeau
            if ($_GET['page'] == "gift") {
                    giftController::getGift();
            }
            
            
            //vue "demande de réservation"
            if($_GET["page"] == "booking"){
                bookingController::getBooking();
            }
            
             // vue confirmation d'envoi d'un formulaire
            if ($_GET['page'] == "success") {
                    indexController::messageSucces();
            }
            
            // vue mentions legales
            if ($_GET['page'] == "legal-notice") {
                    indexController::getLegal();
            }
            
            // vue politique de confidentialité
            if ($_GET['page'] == "confidentiality") {
                    indexController::getConfidentiality();
            }
           
          
            
            // ------------------------------------------ BACK OFFICE -------------------------------------------------
            
            // vue login (formulaire de connexion) ou espace admin
            if ($_GET['page'] == "login") {
                if(isset($_SESSION['id'])) {
                    if($_SESSION['admin'] == 1) {
                        adminController::getAdminSpace();
                    }
                } else {
                    adminController::getLogin();
                }
            }

            //espace admin
            if($_GET['page'] == 'admin-space') {
                if(isset($_SESSION['admin'])) {
                    if ($_SESSION['admin'] == 1) {
                        adminController::getAdminSpace();
                    }
                }
            }
            
            //modification de la carte
            if($_GET["page"] == "update-menu") {
                if(isset($_SESSION['admin'])) {
                    if($_SESSION['admin'] == 1) {
                        adminController::getUpdateMenu();
                    }
                }
            }
            
            //vue modifier mon profil
            if($_GET["page"] == "update-user-profile" and isset($_SESSION['id'])  and $_SESSION['admin'] == 1) {
                adminController::getUpdateProfil();
            }
            
            
            //vue mot de passe oublié
            if($_GET["page"] == "new-password") {
                adminController::getNewPassword();
            }
            
           
            
            
            
            // deconnexion
            if ($_GET['page'] == "disconnect") {
                adminController::getDisconnect();
            }
            
            // -----------------------------------------------------------------------------------------------------------

        } else {
            // Défaut
            indexController::getIndex();
        }
    }
}
