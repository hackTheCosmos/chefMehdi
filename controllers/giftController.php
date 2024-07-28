<?php

class giftController {
    
    public static function getGift () {
    
        if (isset($_POST["gift"])) {
            if(isset($_POST['name']) && !empty($_POST['name'])
            && isset($_POST['first__name']) && !empty($_POST['first__name'])
            && isset($_POST['name__client']) && !empty($_POST['name__client'])
            && isset($_POST['first__name__client']) && !empty($_POST['first__name__client'])
            && isset($_POST['mail']) && !empty($_POST['mail'])
            && isset($_POST['phone']) && !empty($_POST['phone'])
            && isset($_POST['number__of__persons']) && !empty($_POST['number__of__persons'])
            && isset($_POST['menu']) && !empty($_POST['menu'])
            ) {
                
                //on instancie la class Sanitize
                $sanitize = new Sanitize();
                
                $name = $sanitize->sanitize($_POST['name']);
                $firstName = $sanitize->sanitize($_POST['first__name']);
                $nameClient = $sanitize->sanitize($_POST['name__client']);
                $firstNameClient = $sanitize->sanitize($_POST['first__name__client']);
                $mmail = $sanitize->sanitize($_POST['mail']);
                $phone = $sanitize->sanitize($_POST['phone']);
                $numberOfPersons = $sanitize->sanitize($_POST['number__of__persons']);
                $menu = $sanitize->sanitize($_POST['menu']);

                if(isset($_POST['g-recaptcha-response'])) {

                    //gestion du recaptcha
                    $recaptcha = new \ReCaptcha\ReCaptcha("6LfWZPYoAAAAAGALd71I2aXrWBMAbj0rTzPs6G-a");
                    $resp = $recaptcha->verify($_POST['g-recaptcha-response']);
                    if ($resp->isSuccess()) {

                        // EVOI D'UN MAIL AU CHEF REPRENANT LES INFORMATIONS DU FORMULAIRE DE RESERVATION ET DES INFORMATIONS DU CLIENT CONNECTE
                        require "messages/messageChefGift.phtml";
                                    
                        $subject = "Demande de bon cadeau";
                        $address = "baileche.theo@gmail.com";
                        $message = $messageChefGift; 

                        Mailer::sendMail($subject, $address, $message);

                        // renvoi vers la page "Confirmation de réservation" et empeche la re-soumission du formulaire quand on actualise la page
                        header("Location: index.php?page=success");
                        die;
                    } else {
                        $errors = $resp->getErrorCodes();
                    }   
                } 

            }  else {
                echo "formulaire mal rempli";
                die;
            }
         
        }

        // variables à prendre en compte pour l'affichage de la page "Faire un cadeau"
        $title = "Faire un cadeau - Chef Mehdi";
        
        // Affiche la page "Réserver une prestation"
        Renderer::render("views/gift.phtml", [
            "title" => $title
        ]);
    }
}   