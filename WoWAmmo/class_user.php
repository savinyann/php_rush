<?php

class User
{
   protected $_id;
   protected $_username;
   protected $_password;
   protected $_email;
   protected $_admin;

   function __construct($user)
   {
      $this->_id = $user["id"];
      $this->_username = $user["username"];
      $this->_password = $user["password"];
      $this->_email = $user["email"];
      $this->_admin = $user["admin"];
   }

   public function add_user($admin)
   {
      $add_user["username"] = "Name: ";
      $add_user["email"] = "Email: ";
      $add_user["password"] = "Password: ";
      $add_user["password_conf"] = "Password Confirmation: ";
      $submit = ($admin) ? "Add user" : "Register";
      new form($add_user, $submit);
      if(isset($_POST["username"]))
      {
         $verify_addUser = new Verify_input($_POST);


         $verif_all = $verify_addUser->verify_input();
         $_POST["password"] = password_hash($add_user["password"],PASSWORD_DEFAULT);

         $query = "INSERT INTO users values (NULL, ?,?,?,0)";
         $variable = array($_POST["username"],$_POST["password"],$_POST["email"]);
         $SQL = ($verif_all) ? new Query($query,$variable) : FALSE;
         if($SQL!= FALSE)
         {
            $SQL->SQLquery();
            echo "User added";
         }
      }
   }


   public function getId()
   {
      return $this->_id;
   }

   public function getUsername()
   {
      return $this->_username;
   }

   public function getPassword()
   {
      return $this->_password;
   }

   public function getEmail()
   {
      return $this->_email;
   }

   public function getAdmin()
   {
      return $this->_admin;
   }
}
?>
