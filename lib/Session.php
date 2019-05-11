<?php
                                                          #-----------------------------#
                                                          #     Author - MI SHAJIB      #
                                                          #-----------------------------#

#----------------------------------------------------
#                   Session Class
#----------------------------------------------------

class Session
{
  #----------------------------------------------------
  # Session Initialize with PHP version control
  #----------------------------------------------------
    public static function init(){
      #----------------------------------------------------
      # if block for php older version
      #----------------------------------------------------
        if (version_compare(phpversion(), '5.4.0', '<')) {
            if(empty(session_id())){
                session_start();
            }
        }else{
          #----------------------------------------------------
          # Else Block for PHP new Version
          #----------------------------------------------------
            if(session_status() == PHP_SESSION_NONE){
                session_start();
            }
        }
    }
    #----------------------------------------------------
    # Create Setter and Getter for set and get value & Key
    #----------------------------------------------------
    public static function set($key, $val){
        $_SESSION[$key] = $val;
    }

    public static function get($key){
        if(isset($_SESSION[$key])){
            return $_SESSION[$key];
        }else{
            return false;
        }
    }
    #----------------------------------------------------------------
    # Check Session for Logout User if any logged out user try
    # to access logged in user data then this function will execute.
    # This function / method is called into index.php page
    #----------------------------------------------------------------
    public static function checkSession(){
        if (self::get("login") == false) {
            self::destroy();
            header("Location: login.php");
        }
    }
    #-----------------------------------------------------------
    # Check Session for Login User if any logged in user try
    # to access login page then this function will execute.
    #-----------------------------------------------------------
    public static function checkLogin(){
        if (self::get("login") == true) {
            header("Location: index.php");
        }
    }

    #----------------------------------------------------
    # When anyone want to log out then it will execute.
    # This function used for destroy the session.
    #----------------------------------------------------
    public static function destroy(){
        session_destroy();
        session_unset();
        header("Location: login.php");
    }
}
