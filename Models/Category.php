<?php


class Category
{
    //for the database (connection and table)
    private $connection;
    private $table_name = "categories";

    //object attributes
    public $id;
    public $name;
    public $description;
    public $created_date;

    public function __construct($db)
    {
        $this->connection = $db;
    }

    //used by select drop-down list
    public function readAll(){
        var_dump($this->connection);
        $query = "SELECT
                    id, name, description
                  FROM " . $this->table_name . " 
                  ORDER BY name";

        $stmt = $this->connection->prepare($query);
        $stmt->execute();

        return $stmt;

    }

    //used by select drop-down list
    /*public function read(){

        $query = "SELECT
                    id, name, description
                 FROM " . $this->table_name . "
                 ORDER BY name";

        $stmt=$this->connection->prepare($query);
        $stmt->execute();

        return $stmt;
    }*/
}
