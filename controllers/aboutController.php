<?php

class aboutController {
    public static function getAbout() {
        $date = date("Y");
        $title = "A propos - Chef Mehdi";
        
        Renderer::render("views/about.phtml", [
            "date" => $date, "title" => $title
        ]);
    }
}