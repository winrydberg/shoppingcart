<?php

    /**
    * 
    */
    class DBConnection
    {
    	
            private $servername = "localhost";
            private $username = "root";
            private $password = "";
            private $connection;

       	public function __construct(){
        	
            try {
                $this->connection = new PDO("mysql:host=$this->servername;dbname=employment", $this->username, $this->password);
                // set the PDO error mode to exception
                $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                //echo "Connected successfully";
                }
            catch(PDOException $e)
                {
                echo "Connection failed: " . $e->getMessage();
                die();
                }

        }

        public function getProducts(){
           try{
                $stmt = $this->connection->prepare("SELECT * FROM products"); 
                $stmt->execute();
                $stmt->setFetchMode(PDO::FETCH_ASSOC); 
                $result = $stmt->fetchAll();
                return $result;

           }catch(PDOException $e){
              echo "Error".$e->getMessage();
           }
        }


    }




?>