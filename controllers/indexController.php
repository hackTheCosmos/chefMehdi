<?php

class indexController {
    public static function getIndex() {
        
        // affiche la page "Accueil"
        $title = "Accueil - Chef Mehdi";
        
        Renderer::render("views/home.phtml", [
            "title" => $title
        ]);
    }
    
     /**
    * Cette fonction gère l'affichage de la page 'success' après la soumission du formulaire
    * de demande de réservation. Elle redirige l'utilisateur sur la page "accueil" au bout de 
    * 5 secondes
    *
    * @return void
    */
    public static function messageSucces() : void {
        header("Refresh: 7; url=index.php");
        
        $title = "Demande envoyée avec succès";
        
        Renderer::render("views/success.phtml", [
            "title" => $title, 
        ]);
    }
    
    /**
    * Cette fonction formate la date depuis année/mois/jour vers jour/mois/année
    *
    * @param string $date
    * @return string
    */
    public static function formatTheDate (string $date): string {
        $timestamp = strtotime($date);
        return date("d/m/Y", $timestamp);
    }

     // vue mentions légales 
     public static function getLegal() {
        $title = "Mentions légales";
        
        Renderer::render("views/legalNotice.phtml", [
            "title" => $title,
        ]); 
    }
    
     // vue politique de confidentialité
    public static function getConfidentiality() {
        $title = "Politique de confidentialité";
        
        Renderer::render("views/confidentiality.phtml", [
            "title" => $title,
        ]); 
    }
}
    