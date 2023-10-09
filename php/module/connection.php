<?php
class Database{
    private $servername = "localhost";
    private $username = "root";
    private $password = "";
    private $dbname = "inptic1";
    private $port = "3306";
    private $connect;

    public function getConnection(){
        try {
            $this->connect = new PDO("mysql:host=$this->servername;port=$this->port;dbname=$this->dbname", $this->username, $this->password);
            $this->connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);   
            return $this->connect;
           
        } catch (\PDOException $th) {
            echo "erreur de connection a la base de données". $th->getMessage();
            die();
        }
    }
    public function getFetchResult(string $query){
        return $this->getConnection()->query($query);

    }

    public function getSelect(string $query , array $data = null , bool $fetch = false){
        $statement = $this->connect->prepare($query);
        if($data === null){
            if($fetch){
                $statement->execute($data);
                return $statement->fetch(PDO::FETCH_ASSOC);
            }
            else {
                return $statement->execute();
            }
        }
        foreach ($data as $key => $value){
            $statement->bindValue($key, $value);

        }
        
        if($fetch){
            $statement->execute($data);
            return $statement->fetch(PDO::FETCH_ASSOC);
        }
        else {
            return $statement->execute();
        }
        

    }
    public function close(){
        return $this->connect = null; 
    }


}
