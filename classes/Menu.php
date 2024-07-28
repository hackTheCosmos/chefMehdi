<?php

class Menu {
    
    private $id_menu;
    private $menu_name;
    private $menu_image;
    private $menu_pdf;
    private $menu_price_image;
    private $menu_price_pdf;
    
    public function getId(): int {
        return $this->id_menu;
    }
    public function setId(int $id_menu) {
        $this->id_menu = $id_menu;
    }
     public function getMenuName(): blob {
        return $this->menu_name;
    }
    public function setMenuName(blob $menuName) {
        $this->menu_name = $menuName;
    }
     public function getMenuImage(): blob {
        return $this->menu_image;
    }
    public function setMenuImage(blob $menuImage) {
        $this->menu_image = $menuImage;
    }
     public function getMenuPdf(): blob {
        return $this->menu_pdf;
    }
    public function setMenuPdf(blob $menuPdf) {
        $this->menu_pdf = $menuPdf;
    }
     public function getMenuPriceImage(): blob {
        return $this->menu_price_image;
    }
    public function setMenuPriceImage(blob $menuPriceImage) {
        $this->menu_price_image = $menuPriceImage;
    }
     public function getMenuPricePdf(): blob {
        return $this->menu_price_pdf;
    }
    public function setMenuPricePdf(blob $menuPricePdf) {
        $this->menu_price_pdf = $menuPricePdf;
    }
    
//METHODES------------------------------------------------------------------
    
    
    //on met à jour les documents du menu----------------------------------------
    
    /**
    * Cette fonction permet de mettre à jour l'image du menu
    *
    * @param string $file
    * @param string $menu
    * @return void
    */
    public function updateMenuImage (string $file, string $menu) : void {
        $query = "
        UPDATE menu 
        SET menu_image = :menu_file 
        WHERE menu_name = :menu_name";
        $sth = Db::getDbh()->prepare($query);
        $sth->execute([
            ":menu_file" => $file,
            ":menu_name" => $menu,
        ]);
    }
    

    /**
    * Cette fonction permet de mettre à jour le pdf du menu
    *
    * @param string $file
    * @param string $menu
    * @return void
    */
    public function updateMenuPdf (string $file, string $menu) : void {
        $query = "
        UPDATE menu 
        SET menu_pdf = :menu_file 
        WHERE menu_name = :menu_name";
        $sth = Db::getDbh()->prepare($query);
        $sth->bindParam(":menu_file", $file);
        $sth->bindParam(":menu_name", $menu);
        $sth->execute();
    }
    

    /**
    * Cette fonction permet de mettre à jour l'image des tarifs
    *
    * @param string $file
    * @param string $menu
    * @return void
    */
    public function updateMenuPriceImage (string $file, string $menu) : void {
        $query = "
        UPDATE menu 
        SET menu_price_image = :menu_file 
        WHERE menu_name = :menu_name";
        $sth = Db::getDbh()->prepare($query);
        $sth->bindParam(":menu_file", $file);
        $sth->bindParam(":menu_name", $menu);
        $sth->execute();
    }
    
    
    /**
    * Cette fonction permet de mettre à jour le pdf des tarifs
    *
    * @param string $file
    * @param string $menu
    * @return void
    */
    public function updateMenuPricePdf (string $file, string $menu) : void {
        $query = "
        UPDATE menu 
        SET menu_price_pdf = :menu_file 
        WHERE menu_name = :menu_name";
        $sth = Db::getDbh()->prepare($query);
        $sth->bindParam(":menu_file", $file);
        $sth->bindParam(":menu_name", $menu);
        $sth->execute();
    }
    
    // on va chercher les documents dans la table "menu"-----------------------
    
    /**
    * Cette fonction va chercher le chemin du document dans la table "menu" de la base de données
    *
    * @param string $menuName
    * @param string $menuFile
    * @return string|null
    */
    public function selectFile(string $menuName, string $menuFile) : ?string {
        $query = "
        SELECT $menuFile 
        FROM menu 
        WHERE menu_name = :menu_name";
        $sth = Db::getDbh()->prepare($query);
        $sth->bindParam(":menu_name", $menuName);
        $sth->execute();
        
        $menuDocument = $sth->fetch();
        if($menuDocument) {
            return $menuDocument[0];
        } else {
            return null;
        }
    }
}
    