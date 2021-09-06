<?php
class School
{
    private $connection;
    private $table_name = "school";
    public $school_id;
    public $school_name;
    public $school_detail;

    public function __construct($connection)
    {
        $this->connection = $connection;
    }
    //C
    public function create()
    {
        $query = "INSERT INTO " . $this->table_name . " SET school_name = :school_name, school_detail = :school_detail";
        $stmt = $this->connection->prepare($query);

        // bind new values
        $stmt->bindParam(':school_name', $this->school_name);
        $stmt->bindParam(':school_detail', $this->school_detail);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
    //R
    public function read()
    {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->connection->prepare($query);
        $stmt->execute();
        return $stmt;
    }
    //R
    public function readById()
    {
        $query = "SELECT * FROM " . $this->table_name . " WHERE school_id = '" . $this->$school_id . "'";
        $stmt = $this->connection->prepare($query);
        $stmt->execute();
        return $stmt;
    }
    //U
    public function update()
    {
        $query = "UPDATE " . $this->table_name . " SET school_id = :school_id, school_name = :school_name, school_detail = :school_detail WHERE school_id = :school_id";
        $stmt = $this->connection->prepare($query);
        $stmt->bindParam(':school_id', $this->$school_id);
        $stmt->bindParam(':school_name', $this->school_name);
        $stmt->bindParam(':school_detail', $this->school_detail);
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
    //D
    public function delete()
    {
        $query = "DELETE FROM " . $this->table_name . " WHERE school_id = '" . $this->$school_id . "'";
        $stmt = $this->connection->prepare($query);
        $stmt->execute();
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}
