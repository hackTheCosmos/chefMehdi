<?php

class BookingController {
    
    /**
    *Cette fonction gère l'affichage et les fonctionailités de la page "demande de réservation" (formulaire de demande de réservation)
    *
    * @return void
    */
    public static function getBooking () : void {
    
        if (isset($_POST["booking"])) {

            //on vérifie que le formulaire de demande de réservation à bien été rempli
            if (
                isset($_POST['name']) && !empty($_POST['name'])
            && isset($_POST['first__name']) && !empty($_POST['first__name'])
            && isset($_POST['mail']) && !empty($_POST['mail'])
            && isset($_POST['phone']) && !empty($_POST['phone'])
            && isset($_POST['address']) && !empty($_POST['address'])
            && isset($_POST['date']) && !empty($_POST['date'])
            && isset($_POST['time']) && !empty($_POST['time'])
            && isset($_POST['number__of__persons']) && !empty($_POST['number__of__persons'])
            && isset($_POST['menu']) && !empty($_POST['menu'])
            
            ) {

                //on instancie le trait sanitize
                $sanitize = new Sanitize();
                
                $name = $sanitize->sanitize($_POST['name']);
                $firstName = $sanitize->sanitize($_POST['first__name']);
                $mail = $sanitize->sanitize($_POST['mail']);
                $phone = $sanitize->sanitize($_POST['phone']);
                $address = $sanitize->sanitize($_POST['address']);
                $date = indexController::formatTheDate($sanitize->sanitize($_POST["date"]));
                $time = $sanitize->sanitize($_POST['time']);
                $numberOfPersons = $sanitize->sanitize($_POST['number__of__persons']);
                $menu = $sanitize->sanitize($_POST['menu']);
                $bookingDetails = $sanitize->sanitize($_POST["booking__details"]);
                
                if(isset($_POST['g-recaptcha-response'])) {

                    //gestion du recaptcha
                    $recaptcha = new \ReCaptcha\ReCaptcha("6LfWZPYoAAAAAGALd71I2aXrWBMAbj0rTzPs6G-a");
                    $resp = $recaptcha->verify($_POST['g-recaptcha-response']);
                    if ($resp->isSuccess()) {
                        // si le recaptcha est vérifié on envoie le mail
                        require "messages/messageChefBooking.phtml";
                        
                        $subject = "Demande de réservation";
                        $address = "baileche.theo@gmail.com"; 
                        $message = $messageChefBooking; 
                    
                        Mailer::sendMail($subject, $address, $message);
                        
                        // renvoi vers la page "Confirmation de réservation" et empeche la re-soumission du formulaire quand on actualise la page
                        header("Location: index.php?page=success");
                        die;
                    } else {
                        $errors = $resp->getErrorCodes();
                    }
                }
            
                

                // //instanciation du modèle Booking
                // $booking = new Booking();
                
                // // récupèration des données du formulaire de demande de réservation 
                // $numberOfPersons = intval($_POST['number_of_persons']);
                // $date = $_POST["date"];
                // $time = $_POST['time'];
                // $menu = $_POST['menu'];
                // $bookingDetails = $_POST['booking_details'];
                
                // $booking->loadFromBookingPost($numberOfPersons,$date,$time,$menu, $bookingDetails);
                
                // //sauve dans la table "booking" les données saisies par le client via le formulaire de demande de réservation 
                // $booking->save($_SESSION["id"]);
                
            } else {
                echo "le formulaire est mal rempli";
                die;
            }
        } else {
            
            // variables à prendre en compte pour l'affichage de la page "Réserver une prestation"
            $title = "Réserver - Chef Mehdi";
             
            
            // Affiche la page "Réserver une prestation"
            Renderer::render("views/booking.phtml", [
                "title" => $title
            ]);
        }
    }  
}
