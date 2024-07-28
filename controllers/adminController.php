<?php

class adminController {
    
    /**
    * Cette fonction gère la page de connexion
    *
    * @return void
    */
    public static function getLogin() : void {
        // on initialise le score du formulaire pour la gestion du formulaire côté front
        $formScore = 0;
        
        //on vérifie que le formulaire a bien été rempli
        if(isset($_POST["login"])){
            
            if (isset($_POST["email"]) && !empty($_POST["email"])
                && isset($_POST["pwd1"]) && !empty($_POST["pwd1"])
                ) {
                    
                //le formulaire est soumis, on augmente le score du formulaire
                $formScore++;
                
                //instanciation du modèle User
                $user = new User(); 

                //recherche d'un utilisateur qui a le même email que celui saisi dans le formulaire
                $userByEmail= $user->getFromEmail($_POST['email']);
                
                // si il y a bien un utilisateur avec cet email
                if ($userByEmail) {
                    //l'email est ok, on augmente le score du formulaire
                    $formScore++;
                    // on vérifie que le mot de passe est correct
                    if ($userByEmail->checkPassword($_POST['pwd1'])) {
                        //le mot de passe est ok, on augmente le score du formulaire
                        $formScore++;
                        
                        //on défini ensuite les variables de session
                        $_SESSION['id'] = $userByEmail->getId();
                        $_SESSION["email"] = $userByEmail->getEmail();
                        $_SESSION['admin'] = $userByEmail->getAdmin();
                        
                        // si le champs "new_password" vaut 1, on le remet à zéro pour que l'utilisateur puisse demander un nouveau mot de passe
                        if ($userByEmail->getNewPassword() == 1){
                            $id = $_SESSION["id"];
                            //on remet le compteur de demande de nouveau mot de passe à 0, pour pouvoir faire une nouvelle demande si besoin
                            $userByEmail->refreshNewPassword($id);
                        }
                        //on renvoi vers l'espace personnel, 
                        header("Location: index.php?page=admin-space");
                            
                        
                    }
                } else {
                    header("Location: index.php?page=login");
                }
            }
        }

        // affichage de la page connexion si aucune action n'a été faite
        $title = "Connexion";
        Renderer::render("views/login.phtml", [
            "title" => $title, "formScore" => $formScore
        ]);
    }
    
    public static function getAdminSpace(){

        if($_GET['page'] == 'login') {
            header("Location: index.php?page=admin-space");
        }

        $title = "Espace administrateur";
        $user = User::getById($_SESSION["id"]);
        
        Renderer::render("views/adminSpace.phtml", [
            "title" => $title, "user" => $user
        ]);
    }
    
    public static function getUpdateProfil() {
        $title = "Modifier mon profil";
        $user = User::getById($_SESSION["id"]);
        
        self::updateProfil();
        
        Renderer::render("views/updateAdminProfil.phtml", [
            "title" => $title, "user" => $user
        ]);
    }
    
    public static function updateProfil(){
        $user = new User();
        //update email
        if(isset($_POST["updateEmail"])){
            if(!empty($_POST["email"])){
                $user->updateEmail();
                // redirection vers la page updateProfil à jour
                sleep(1);
                header("Location:index.php?page=updateAdminProfil");
                die();
            }
        }
        //update password
        else if(isset($_POST["password"])){
            if(!empty($_POST["pwd1"]) && !empty($_POST["pwd2"])){
                if($_POST["pwd1"] === $_POST["pwd2"]){
                    $user->updatePassword();
                    // redirection vers la page updateProfil à jour
                    sleep(1);
                    header("Location:index.php?page=updateAdminProfil");
                    die();
                }
            }
        }
    }
    
     //déconnection
    public static function getDisconnect() {
        $_SESSION['id'] = null;
        unset($_SESSION['id']);
        session_destroy();
        
        header("Location: index.php?page=home");
        die;
    }
    
    // UPDATE MENU-------------------------------------------------------------

    /**
    * Cette fonction gère la page qui permet de mettre à jour la carte du chef
    *
    * @return void
    */
    public static function getUpdateMenu() : void {
        
        //on initialise un score pour gérér le formulaire coté front
        $formScore = 0;
        
        // si le formulaire de mise à jour des menus est soumis
        if(isset($_POST["update_file"])) {
            
            // on vérifie que l'utilisateur a bien sélectionné un fichier et que aucune erreur n'a été généré
            if(isset($_FILES["file"]) and $_FILES["file"]["error"] == 0){
                $dossier = "./fichiersBdd/";
                $nomTemporaire = $_FILES["file"]["tmp_name"];
                //on vérifie si le fichier à bien été téléchargé, sinon on affiche un message d'erreur
                if(!is_uploaded_file($nomTemporaire)) {
                    exit("Le fichier est introuvable");
                }
                
                //on vérifie que la taille du fichier n'est pas trop importante, sinon on affiche un message d'erreur
                if ($_FILES["file"]["size"] >= 1000000) {
                    exit ("Erreur, le fichier est trop volumineux");
                }
                
                //on récupère l'extension du fichier
                $fileInformations = pathinfo($_FILES["file"]["name"]);
                $fileExtension = $fileInformations["extension"];
                
                //on converti l'extension en minuscule
                $fileExtension = strtolower($fileExtension);
                //on autorise seulement des extensions type "png", "jpg", "jpeg", et "pdf", sinon message d'erreur
                $extensionsAllowed = array("png", "jpg", "jpeg", "pdf");
                if (!in_array($fileExtension, $extensionsAllowed)) {
                    exit ("Le type de fichier choisi n'est pas autorisé (extensions autorisées: png, jpg, jpeg, pdf)");
                }
                
                //on copie le fichier dans le dossier de destination
                $nomFichier = $_FILES["file"]["name"];
                
                //on vérifie si le fichier a bien été uploader dans le dossier de destination, sinon on affiche un message d'erreur
                if(!move_uploaded_file($nomTemporaire, $dossier.$nomFichier)) {
                    exit("Impossible de copier le fichier dans $dossier");
                }
                
                
                //instanciation du modèle Menu
                $menu = new Menu ();
                
                //on met à jour les documents dans la table "menu"
                if($_POST["file_choice"] =="menu_image"){
                    $file = $_FILES["file"]["name"];
                    $menuName = $_POST["menu"];
                    $menu->updateMenuImage ($file, $menuName);
                    //si le document a été mis à jour on affiche un message de confirmation
                    $formScore = 1;
                }
                
                if($_POST["file_choice"] =="menu_pdf"){
                    $file = $_FILES["file"]["name"];
                    $menuName = $_POST["menu"];
                    $menu->updateMenuPdf ($file, $menuName);
                    
                    //si le document a été mis à jour on affiche un message de confirmation
                    $formScore = 1;
                }
                
                if($_POST["file_choice"] =="menu_price_image"){
                    $file = $_FILES["file"]["name"];
                    $menuName = $_POST["menu"];
                    $menu->updateMenuPriceImage ($file, $menuName);
                    
                    //si le document a été mis à jour on affiche un message de confirmation
                    $formScore = 1;
                }
                
                if($_POST["file_choice"] =="menu_price_pdf"){
                    $file = $_FILES["file"]["name"];
                    $menuName = $_POST["menu"];
                    $menu->updateMenuPricePdf ($file, $menuName);
                    
                    //si le document a été mis à jour on affiche un message de confirmation
                    $formScore = 1;
                }
                
            }
            
        }
        
        //on affiche la page "modifier la carte"
        $title = "Modifier la carte";
        Renderer::render("views/updateMenu.phtml", [
            "title" => $title, "formScore" => $formScore
        ]);
    }
    
    /**
    * Cette fonction gère la page mot de passe oublié
    *
    * @return void
    */
    public static function getNewPassword() : void {
        //instanciation du modèle User
        $user = new User();
        //on initialise le score pour valider le formulaire coté front
        $formScore = 0;
        //si le formulaire de demande de nouveau mot de passe est soumis
        if(isset($_POST["newPassword"])){
            
            //le formulaire est soumis, on incrémente le score
            $formScore++;
            if(!empty($_POST["email"])){
                //on récupère l'email depuis le formulaire
                $email = $user->sanitize(strtolower($_POST["email"]));
                
                //on récupère l'utilisateur depuis son mail
                $findUserByEmail = $user->getFromEmail($email);
                // si le mail existe dans la base de données on rentre dans la condition
                if ($findUserByEmail){
             
                    //l'email est dans la base de données, on incrémente le score
                    $formScore++;
                    // on vérifie si le champs "new_password" de la table est à 0
                    if($findUserByEmail->getNewPassword() == 0 ){
                        // génération d'un mot de passe
                        $newPass = self::getRandomPassword();
                        
                        //modification du mot de passe dans la base de données
                        $email = $_POST["email"];
                        $user->updateNewPassword($newPass, $email);
                         
                        // envoie du nouveau mot de passe par mail à l'utilisteur qui a fait la demande
                        require "messages/messageNewPass.phtml";
                        
                        $subject = "Nouveau mot de passe";
                        //adresse récupérée depuis le formulaire
                        $address = $email;
                      
                        $message = $messageNewPass;
                        
                        Mailer::sendMail($subject, $address, $message);
                        
                        // on redirige vers la page "login"
                        header("Location:index.php?page=login");
                        die();
                    }
                    
                }
            }
        }
        
        //affichage de la passe "nouveau mot de passe"
        $title = "Mot de passe oublié";
        Renderer::render("views/newPassword.phtml", [
             "title" => $title, "formScore" => $formScore
        ]);
        
    }
    
    /**
    * Cette fonction génère un nouveau mot de passe robuste grâce aux expressions régulières
    *
    * @return string
    */
    public static function getRandomPassword() : string {
        //liste des caractères possibles
        $alphabet = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789$@!%*#&";
        
        $pass = array();
        $alphabetLength = strlen($alphabet) - 1;
        $score=0;
        
        //tant que le mot de passe n'est pas assez robuste on relance la création
        //d'un nouveau mot de passe aléatoire
        while($score < 4){
            $pass = [];
            for ($i = 0; $i < 12 ; $i++) {
                $n = rand(0, $alphabetLength);
                $pass[] = $alphabet[$n];
            }
            //on transforme le tableau généré en chaîne de caractères
            $newPassword = implode($pass);
            
            
            //on teste la robustesse du mot de passe avec les expresssions régulières
            preg_match("/[a-z]+/", $newPassword, $matches);
            if(sizeof($matches) != 0){
                $score++;
            }
            
            preg_match("/[A-Z]+/", $newPassword, $matches);
            if(sizeof($matches) != 0){
                $score++;
            }
            
            preg_match("/[0-9]+/", $newPassword, $matches);
            if(sizeof($matches) != 0){
                $score++;
            }
            
            preg_match("/[$@!%*#&]+/", $newPassword, $matches);
            if(sizeof($matches) != 0){
                $score++;
            }
        }
        
        return $newPassword;
    }
    
}