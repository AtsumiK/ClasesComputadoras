<?php


class PostgresConnection {
    
    private $connection;
    
    /**
     * Crea una conexi�n de postgres y la retiene en atributo privado.
     *
     * @return PostgresConnection
     */
    function PostgresConnection() {
        $this->connection = null;
    }
    
     
    public function connect($dbHost,$dbPort,$dbName,$dbUserName,$dbUserPass) {
        $this->connection = pg_connect("host=".$dbHost." port=".$dbPort." dbname=".$dbName." user=".$dbUserName." password=".$dbUserPass);
        if(!$this->connection){
            return false;
        }
        return true;
    }
    public function disconnect() {
        pg_close($this->connection);
    }
        
    public function beginTransaction(){
        $res = pg_query($this->connection,'BEGIN');
        if(!$res){
            return false;
        }
        return true;
    }
    
    public function commit(){
        $res = pg_query($this->connection,'COMMIT');
        if(!$res){
            return false;
        }
        return true;
    }
    
    public function rollback(){
        $res = pg_query($this->connection,'ROLLBACK');
        if(!$res){
            return false;
        }
        return true;
    }
    
    public function performQuery($query){
        return pg_query($this->connection,$query);
    }
}
?>