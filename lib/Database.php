<?php
                                                        #-----------------------------#
                                                        #     Author - MI SHAJIB      #
                                                        #-----------------------------#

#-------------------------------------------
# Database Connection
# Database Class
#-------------------------------------------
class Database{
  #-------------------------------------------
  # define properties as private
  #-------------------------------------------
    private $hostdb = "localhost";
    private $userdb = "root";
    private $passdb = "";
    private $namedb = "oop_lr";
    public $pdo;
    #----------------------------------------------------
    # Make Construction for Database Connection Active
    #----------------------------------------------------
    public function __construct()
    {
      #----------------------------------------------------
      # if not set pdo then execute try catch block
      #----------------------------------------------------
        if (!isset($this->pdo))
        {
            try{
              #----------------------------------------------------
              # Make Database Connection into try block
              #----------------------------------------------------
                $link = new PDO("mysql:host=".$this->hostdb.";dbname=".$this->namedb, $this->userdb, $this->passdb);
                $link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $link->exec("SET CHARACTER SET utf8");
                $this->pdo = $link;
            }catch(PDOException $e){
              #------------------------------------------------------------
              # Catch the error into catch block and return error message
              #------------------------------------------------------------
                die("Failed to Connect With Database ".$e->getMessage());
            }
        }
    }
}
