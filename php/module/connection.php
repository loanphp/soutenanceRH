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

    public function checkExistingData(array $data)
    {
        $field = "";
        try {
            if(!isset($data['table'])){
                throw new Exception("Table name is not set");
            }
            $table = $data['table'];
            if(!isset($data['datas'])){
                throw new Exception("Aucune donnée n'a été entré");
            }
            $datas = $data['datas'];
            foreach ($datas as $key => $value) {
                $field = "WHERE `$key` = $value";
                $sqlQuery = "SELECT * FROM `$table` $field";
                $result = $this->runQuery($sqlQuery);
                if ($result === false) {
                    return [
                        'result'=>$result,
                        'field'=>null
                    ];
                }
                return [
                    'result'=>$result,
                    'field'=>$key
                ];
            }
        } catch (\Throwable $th) {
            throw $th;
        }
        
    }

    private function runQuery(string $query)
    {
        $connect = $this->getConnection();
        $stmt = $connect->prepare($query);
        $stmt->execute();
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        return $data;
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
