<?php
class Standard
{
    private $connection;
    private $table_name = "standard";
    public $standard_id;
    public $standard_name;
    public $standard_detail;
    public $school_id;

    public function __construct($connection)
    {
        $this->connection = $connection;
    }
    //C
    public function create()
    {
        $query = "INSERT INTO " . $this->table_name . " SET standard_name = :standard_name, standard_detail = :standard_detail, school_id = :school_id";
        $stmt = $this->connection->prepare($query);

        // bind new values
        $stmt->bindParam(':standard_name', $this->standard_name);
        $stmt->bindParam(':standard_detail', $this->standard_detail);
        $stmt->bindParam(':school_id', $this->school_id);

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
    }//R
    public function readAll()
    {
        //$query = "SELECT * FROM " . $this->table_name;
        $query = "SELECT standard.standard_id, standard.standard_name, standard.standard_detail, standard.school_id, school.school_name, school.school_detail FROM " . $this->table_name . " JOIN school ON standard.school_id = school.school_id";
        $stmt = $this->connection->prepare($query);
        $stmt->execute();
        return $stmt;
    }
    //R
    public function readById()
    {
        $query = "SELECT * FROM " . $this->table_name . " WHERE standard_id = '" . $this->$standard_id . "'";
        $stmt = $this->connection->prepare($query);
        $stmt->execute();
        return $stmt;
    }
    //U
    public function update()
    {
        $query = "UPDATE " . $this->table_name . " SET standard_id = :standard_id, standard_name = :standard_name, standard_detail = :standard_detail, school_id = :school_id WHERE standard_id = :standard_id";
        $stmt = $this->connection->prepare($query);
        $stmt->bindParam(':standard_id', $this->$standard_id);
        $stmt->bindParam(':name', $this->standard_name);
        $stmt->bindParam(':detail', $this->standard_detail);
        $stmt->bindParam(':school_id', $this->school_id);
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
    //D
    public function delete()
    {
        $query = "DELETE FROM " . $this->table_name . " WHERE standard_id = '" . $this->$standard_id . "'";
        $stmt = $this->connection->prepare($query);
        $stmt->execute();
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}
