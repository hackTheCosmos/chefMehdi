<?php

class MenuController {
    
    /**
    * Cette fonction gère l'affichage de la page "menu"
    *
    * @return void
    */
    public static function getMenu(): void {
        $title = "Menus - Chef Mehdi";
        
        Renderer::render("views/menu.phtml", [
            "title" => $title
        ]);
    }
    
    
    /**
     * Cette fonction gère l'affichage de la page 'menuGourmet'
    *
    * @return void
    */
    public static function getMenuGourmet () : void {
       
        $menuName = "menuGourmet";
        
        //instanciation du modèle Menu
        $menu = new Menu ();
        
        //récupération les documents de la table "menu" pour les afficher sur la page
        $imageMenu = $menu->selectFile($menuName, 'menu_image');
        $menuPdf = $menu->selectFile($menuName, "menu_pdf");
        $menuPriceImage = $menu->selectFile($menuName, "menu_price_image");
        $menuPricePdf = $menu->selectFile($menuName, "menu_price_pdf");
        
        //on affiche la page
        $title = "Menu Gourmet - Chef Mehdi";
        Renderer::render("views/menuGourmet.phtml", [
            "title" => $title,"imageMenu"=>$imageMenu, "menuPriceImage" => $menuPriceImage, "menuPdf" => $menuPdf, "menuPricePdf" => $menuPricePdf
        ]);
    }
    
    /**
    * Cette fonction gère l'affichage de la page 'menuPrestige'
    *
    * @return void
    */
    public static function getMenuPrestige (): void {
        
        $menuName ="menuPrestige";
        
        //instanciation du modèle Menu
        $menu = new Menu();
        
        //récupération les documents de la table "menu" pour les afficher sur la page
        $imageMenu = $menu->selectFile($menuName, "menu_image");
        $menuPdf = $menu->selectFile($menuName, "menu_pdf");
        $menuPriceImage = $menu->selectFile($menuName, "menu_price_image");
        $menuPricePdf = $menu->selectFile($menuName, "menu_price_pdf");
        
        //on affiche la page
        $title = "Menu Prestige - Chef Mehdi";
        Renderer::render("views/menuPrestige.phtml", [
            "title" => $title, "imageMenu" => $imageMenu, "menuPriceImage" => $menuPriceImage, "menuPdf" => $menuPdf, "menuPricePdf" => $menuPricePdf
        ]);
    }
    
    /**
    * Cette fonction gère l'affichage de la page 'cocktail'
    *
    * @return void
    */
    public static function getCocktailDinatoire () : void{
       
        $menuName ="cocktail";
        
        //instanciation du modèle Menu
        $menu = new Menu();
        
        //récupération les documents de la table "menu" pour les afficher sur la page
        $imageMenu = $menu->selectFile($menuName, "menu_image");
        $menuPdf = $menu->selectFile($menuName, "menu_pdf");
        $menuPriceImage = $menu->selectFile($menuName, "menu_price_image");
        $menuPricePdf = $menu->selectFile($menuName, "menu_price_pdf");
        
        //on affiche la page
        $title = "Cockatail dînatoire - Chef Mehdi";
        Renderer::render("views/cocktailDinatoire.phtml", [
            "title" => $title,"imageMenu" => $imageMenu, "menuPriceImage" => $menuPriceImage, "menuPdf" => $menuPdf, "menuPricePdf" => $menuPricePdf
        ]);
    }
}




