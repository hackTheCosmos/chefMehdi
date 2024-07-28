<?php

class User {
    
    private $id;
    private $email;
    private $password;
    private $new_password;
    private $admin;
    
    public function getId(): int {
        return $this->id;
    }
    public function setId(int $id) {
        $this->id = $id;
    }

    public function getEmail(): string {
        return $this->email;
    }
    public function setEmail(string $email) {
        $this->email = $email;
    }
    
    public function getPassword(): string {
        return $this->password;
    }
    public function setPassword(string $password) {
        $this->password = $password;
    }
    
    public function getNewPassword() : int {
        return $this->new_password;
    }
    
    public function setNewPassword(int $new_password) {
        $this->new_password = $new_password;
    }
    
    public function getAdmin(): bool {
        return $this->admin;
    }
    public function setAdmin(bool $admin) {
        $this->admin = $admin;
    }
    
    // récupération des valeurs du formulaire d'inscription
    public function loadFromPost(): void {
        $this->setLastname($this->sanitize($_POST['name']));
        $this->setFirstname($this->sanitize($_POST['firstname']));
        $this->setEmail($this->sanitize($_POST['email']));
        $this->setPhone($this->sanitize($_POST['phone']));
        $this->setAddress($this->sanitize($_POST["address"]));
    }
    
    // vérification que le formulaire est correctement rempli
    //  public function checkSubscribePost(): bool {
    //     if (!isset($this->lastname, $this->firstname, $this->email, $this->phone, $this->password)) {
    //         return false;
    //     }
        
    //     if (empty($this->email)) {
    //         return false;
    //     }
        
    //     if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
    //         return false;
    //     }
    //     return true;
    // }
    
    // récupération d'un utilisateur à partir de son email
    
    public static function getFromEmail($email) {
        $query = "SELECT * FROM user WHERE email=:email";
        $sth = Db::getDbh()->prepare($query);
        $sth->setFetchMode(PDO::FETCH_CLASS, 'User'); 
        $sth->execute([
            ":email" => $email
        ]);
        return $sth->fetch();
    }

    // CONNEXION

    // Vérification du mot de passe lors de la connexion
    public function checkPassword($pwd): bool {
        return password_verify($pwd, $this->getPassword());
    }

    
    
    // récupération d'un utilisateur à partir de son id
    public static function getById($id) {
        $query = "SELECT * FROM user WHERE id=:id";
        $sth = Db::getDbh()->prepare($query);
        $sth->setFetchMode(PDO::FETCH_CLASS,"User");
        $sth->execute([
            ":id" => $id
        ]);
        return $sth->fetch();
    }
    
    // récupération de tout les clients de la bases de données
    
    public function getCustomers($first, $perPage) {
        $query = "SELECT lastname, firstname, email, phone, address FROM users  WHERE admin = :admin ORDER BY lastName LIMIT :first, :perPage";
        $sth = Db::getDbh()->prepare($query);
        $sth->setFetchMode(PDO::FETCH_CLASS, 'User'); 
        

        $sth->bindValue(":admin", 0, PDO::PARAM_INT);
        $sth->bindValue(":first", $first, PDO::PARAM_INT);
        $sth->bindValue(":perPage", $perPage, PDO::PARAM_INT);
        
        $sth->execute();
        $myCustomers = $sth->fetchAll();
        if($myCustomers) {
            return $myCustomers;
        } else {
            return null;
        }
    }
    
    //détermine le nombre total de clients
    public static function getNumberOfCustomers () {
        $query = "SELECT COUNT(*) AS nb_customers FROM users WHERE admin = 0";
        $sth = Db::getDbh()->prepare($query);
        $sth->execute();
        $result = $sth->fetch();
        $nbCustomers = (int) $result["nb_customers"];
        if($nbCustomers) {
            return $nbCustomers;
        } else {
            return null;
        }
    }
    
    
    // enregistrement d'un client dans la base de données
    public function save() {
        $query = "INSERT INTO users (lastname, firstname, email, phone, address) VALUES (:lastname, :firstname, :email, :phone, :address)";
        $sth = Db::getDbh()->prepare($query);
        $sth->execute([
            ":lastname" => $this->getLastname(),
            ":firstname" => $this->getFirstname(),
            ":email" => $this->getEmail(),
            ":phone" => $this->getPhone(),
            ":address" => $this->getAddress()
        ]);
    }
    
    /* Cette fonction met à jour le nouveau mot de passe qui a été généré lors de la
    * demande de nouveau mot de passe (mot de passe oublié)
    *
    * @param string $Pass
    * @param string $email
    * @return void
    */
    public function updateNewPassword(string $Pass, string $email) :void {
        $query = "
        UPDATE user 
        SET password=:password, new_password=:new_password 
        WHERE email=:email";
        $sth = Db::getDbh()->prepare($query);
        $sth->execute([
            ":password" => password_hash($Pass, PASSWORD_DEFAULT),
            ":new_password" => 1,
            ":email" => $email
        ]);
    }
    

    /**
    * Cette fonction remet à zéro le champs new_password pour permetre à l'utilisateur de faire une nouvelle demande de nouveau mot de passe
    *
    * @param integer $id
    * @return void
    */
    public function refreshNewPassword(int $id):void {
        $query = "
        UPDATE user 
        SET new_password=:new_password 
        WHERE id=:id";
        $sth = Db::getDbh()->prepare($query);
        $sth->execute([
            ":new_password" => 0,
            ":id" => $id
            ]);
    }
    


// UPDATE USER PROFIL
    
    // update lastName
    public function updateLastName() {
        $query = "UPDATE users SET lastname = :lastname WHERE id = :id";
        $sth = Db::getDbh()->prepare($query);
        $sth->execute([
            ":lastname" => $_POST["lastName"],
            ":id" => $_SESSION["ID"]
            ]);
    }
    
    // update firstName
    public function updatefirstName() {
        $query = "UPDATE users SET firstname = :firstname WHERE id = :id";
        $sth = Db::getDbh()->prepare($query);
        $sth->execute([
            ":firstname" => $_POST["firstName"],
            ":id" => $_SESSION["ID"]
            ]);
    }
    
    // update email
    public function updateEmail() {
        $query = "UPDATE users SET email = :email WHERE id = :id";
        $sth = Db::getDbh()->prepare($query);
        $sth->execute([
            ":email" => $_POST["email"],
            ":id" => $_SESSION["ID"]
            ]);
    }
    
    // update phone
    public function updatePhone() {
        $query = "UPDATE users SET phone = :phone WHERE id = :id";
        $sth = Db::getDbh()->prepare($query);
        $sth->execute([
            ":phone" => $_POST["phone"],
            ":id" => $_SESSION["ID"]
            ]);
    }
    
     // update password
    public function updatePassword() {
        $query = "UPDATE users SET password = :password WHERE id = :id";
        $sth = Db::getDbh()->prepare($query);
        $sth->execute([
            ":password" => password_hash($_POST["pwd1"], PASSWORD_DEFAULT),
            ":id" => $_SESSION["ID"]
            ]);
    }
}
    
    
