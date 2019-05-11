 <?php
                                                       #-----------------------------#
                                                       #     Author - MI SHAJIB      #
                                                       #-----------------------------#

 #--------------------------------------------------------
 # Include Database and Sesssion Class into User Class
 #--------------------------------------------------------
require_once 'Database.php';
require_once 'Session.php';

#-----------------------------
# User Class
# For User Operations
#-----------------------------

class User
{
  #------------------------------------------------------------------
  # Define private property for database
  # Create construction function for database connection Active.
  # Here instantiate Database Class
  #-------------------------------------------------------------------
    private $db;
    public function __construct()
    {
        $this->db = new Database();
    }

    #----------------------------------------------------
    # This Function will execute for User Registration.
    # It will called into register.php page.
    # This function take one parameter for get form data
    #----------------------------------------------------
    public function userRegistration($data){
      #----------------------------------------------------
      # Here get data from form by $_POST[] Method
      #----------------------------------------------------
        $name = $data['name'];
        $username = $data['username'];
        $email = $data['email'];
        $password = $data['password'];

        #----------------------------------------------------
        # Here Check email existence by this method
        #----------------------------------------------------
        $chk_email = $this->emailCheck($email);

        #-----------------------------
        # Form Validation Part
        #-----------------------------
        if (empty($name) || empty($username) || empty($email) || empty($password)) {
            $msg = "<div class='alert alert-danger'><strong>Error!</strong>Field must not be empty</div>";
            return $msg;
        }
        if(strlen($username) < 3){
            $msg = "<div class='alert alert-danger'><strong>Error!</strong>Username is too short!</div>";
            return $msg;
        }elseif(preg_match("/[^a-z0-9_-]+/i", $username)){
            $msg = "<div class='alert alert-danger'><strong>Error!</strong>Username must only contain alphanumerical, dashes, underscore!</div>";
            return $msg;
        }

        if(filter_var($email, FILTER_VALIDATE_EMAIL) == false){
            $msg = "<div class='alert alert-danger'><strong>Error!</strong>Please enter valid email!</div>";
            return $msg;
        }
        if($chk_email == true){
            $msg = "<div class='alert alert-danger'><strong>Error!</strong>Email already exist!</div>";
            return $msg;
        }
        #--------------------------------
        # Form Validation Part End
        #--------------------------------


        #---------------------------------------------------------------
        # Create md5 / hashed password before insert data into table
        #---------------------------------------------------------------
        $password = md5($data['password']);

        #----------------------------------------------------
        #             Data Insert Into Table
        #----------------------------------------------------
        $sql = "INSERT INTO userlist(name, username, email, password) VALUES(:name, :username, :email, :password)";
        $query = $this->db->pdo->prepare($sql);
        $query->bindValue(':name', $name);
        $query->bindValue(':username', $username);
        $query->bindValue(':email', $email);
        $query->bindValue(':password', $password);
        $result = $query->execute();
        if($result){
            $msg = "<div class='alert alert-success'><strong>Success!</strong>Thank You, You have been registered!</div>";
            return $msg;
        }else{
            $msg = "<div class='alert alert-danger'><strong>Error!</strong>Sorry, There has been problem inserting details!</div>";
            return $msg;
        }


    }

    #-------------------------------------------------------------------------------------
    # This function will check email existence
    # If anyone try to use one email multiple time then
    # this function will execute and show the error.
    # This function is called into userRegistration() & userLogin() function / method
    #--------------------------------------------------------------------------------------
    public function emailCheck($email){
        $sql = "SELECT email FROM userlist WHERE email = :email";
        $query = $this->db->pdo->prepare($sql);
        $query->bindValue(':email', $email);
        $query->execute();
        if($query->rowCount() > 0){
            return true;
        }else{
            return false;
        }

    }

    #--------------------------------------------------------------
    # This function will execute for get User Login Data
    # This function / Method is called into userLogin() Method
    #--------------------------------------------------------------
    public function getUserLogin($email, $password){
        $sql = "SELECT * FROM userlist WHERE email = :email AND password = :password LIMIT 1";
        $query = $this->db->pdo->prepare($sql);
        $query->bindValue(':email', $email);
        $query->bindValue(':password', $password);
        $query->execute();
        $result = $query->fetch(PDO::FETCH_OBJ);
        return $result;
    }

    #----------------------------------------------------
    # User Login Method / Function
    # This Function is called into login.php page
    #----------------------------------------------------
    public function userLogin($data){
        $email = $data['email'];
        $password = md5($data['password']);

        $chk_email = $this->emailCheck($email);
        #----------------------------------------------------
        # Form Validation
        #----------------------------------------------------
        if (empty($email) || empty($password)) {
            $msg = "<div class='alert alert-danger'><strong>Error!</strong>Field must not be empty</div>";
            return $msg;
        }
        if(filter_var($email, FILTER_VALIDATE_EMAIL) == false){
            $msg = "<div class='alert alert-danger'><strong>Error!</strong>Please enter valid email!</div>";
            return $msg;
        }
        if($chk_email == false){
            $msg = "<div class='alert alert-danger'><strong>Error!</strong>Email not exist!</div>";
            return $msg;
        }
        #----------------------------------------------------
        #         Called getUserLogin() Function
        #----------------------------------------------------
        $result = $this->getUserLogin($email, $password);
        #-----------------------------------------------------------------------------------------
        # In the if block if get user login data then start session and set login session true
        # and set id, name, username, email and login message. Otherwise it will throw an error.
        #-----------------------------------------------------------------------------------------
        if($result){
            Session::init();
            Session::set("login", true);
            Session::set("id", $result->id);
            Session::set("name", $result->name);
            Session::set("username", $result->username);
            Session::set("email", $result->email);
            Session::set("loginMsg", "<div class='alert alert-success'><strong>Success ! </strong> You are logged in!</div>");
            header("Location: index.php");
        }else{
            $msg = "<div class='alert alert-danger'><strong>Error!</strong>Data not found!</div>";
            return $msg;
        }
    }
    #----------------------------------------------------
    # This Function is create for get users Data
    #----------------------------------------------------
    public function getUserData(){
      $sql = "SELECT * FROM userlist ORDER BY id DESC";
      $query = $this->db->pdo->prepare($sql);
      $query->execute();
      $result = $query->fetchAll();
      return $result;
    }

    #-----------------------------------------------------------------
    # This is Function / Method is created for get user data by ID.
    # It means it will get single user data by his id.
    #-----------------------------------------------------------------
    public function getUserById($userId){
      $sql = "SELECT * FROM userlist WHERE id = :id LIMIT 1";
      $query = $this->db->pdo->prepare($sql);
      $query->bindValue(':id', $userId);
      $query->execute();
      $result = $query->fetch(PDO::FETCH_OBJ);
      return $result;
    }

    #-------------------------------------------------------------------------
    # This Function / Method is create for Update User Existing Data.
    #-------------------------------------------------------------------------
    public function userUpdate($userId, $data){
      $name = $data['name'];
      $username = $data['username'];
      $email = $data['email'];

      $chk_email = $this->emailCheck($email);

      if (empty($name) || empty($username) || empty($email)) {
          $msg = "<div class='alert alert-danger'><strong>Error!</strong>Field must not be empty</div>";
          return $msg;
      }
      if(strlen($username) < 3){
          $msg = "<div class='alert alert-danger'><strong>Error!</strong>Username is too short!</div>";
          return $msg;
      }elseif(preg_match("/[^a-z0-9_-]+/i", $username)){
          $msg = "<div class='alert alert-danger'><strong>Error!</strong>Username must only contain alphanumerical, dashes, underscore!</div>";
          return $msg;
      }

      if(filter_var($email, FILTER_VALIDATE_EMAIL) == false){
          $msg = "<div class='alert alert-danger'><strong>Error!</strong>Please enter valid email!</div>";
          return $msg;
      }

      $sql = "UPDATE userlist SET name = :name, username = :username, email = :email WHERE id = :id";
      $query = $this->db->pdo->prepare($sql);
      $query->bindValue(':name', $name);
      $query->bindValue(':username', $username);
      $query->bindValue(':email', $email);
      $query->bindValue(':id', $userId);
      $result = $query->execute();
      if($result){
          $msg = "<div class='alert alert-success'><strong>Success!</strong>User Data Updated Successfully !</div>";
          return $msg;
      }else{
          $msg = "<div class='alert alert-danger'><strong>Error!</strong>Sorry, User Data not Updated!</div>";
          return $msg;
      }
    }

    #-------------------------------------------------------------------------------
    # This Function / Method is created for user existing Password from database.
    # This Function is called into userPasswordUpdate() Method
    #-------------------------------------------------------------------------------
    private function checkPassword($userId, $oldPass){
        $pass = md5($oldPass);
        $sql = "SELECT password FROM userlist WHERE id = :id AND password = :password";
        $query = $this->db->pdo->prepare($sql);
        $query->bindValue(':id', $userId);
        $query->bindValue(':password', $pass);
        $query->execute();
        if($query->rowCount() > 0){
            return true;
        }else{
            return false;
        }
    }

    #-----------------------------------------------------------------
    # This Function / Method is created for Update User Password.
    #-----------------------------------------------------------------
    public function userPasswordUpdate($userId, $data){
      $oldPass = $data['old_pass'];
      $newPass = $data['new_pass'];
      $checkPass = $this->checkPassword($userId, $oldPass);

      if (empty($oldPass) || empty($newPass)) {
        $msg = "<div class='alert alert-danger'><strong>Error!</strong>Field must not be empty</div>";
        return $msg;
      }

      if ($checkPass == false) {
        $msg = "<div class='alert alert-danger'><strong>Error!</strong>Old Password Not Matched !!!</div>";
        return $msg;
      }

      if (strlen($newPass) < 6) {
        $msg = "<div class='alert alert-danger'><strong>Error!</strong>Password is too short !!</div>";
        return $msg;
      }

      $password = md5($newPass);
      $sql = "UPDATE userlist SET password = :password WHERE id = :id";
      $query = $this->db->pdo->prepare($sql);
      $query->bindValue(':id', $userId);
      $result = $query->execute();
      if($result){
          $msg = "<div class='alert alert-success'><strong>Success!</strong>Password Updated Successfully !</div>";
          return $msg;
      }else{
          $msg = "<div class='alert alert-danger'><strong>Error!</strong>Sorry, Password not Updated!</div>";
          return $msg;
      }



    }


}
