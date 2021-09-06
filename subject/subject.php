<?php
class subject
{
    private $connection;
    private $table_name = "subject";
    public $subject_id;
    public $subject_name;
    public $subject_detail;
    public $standard_id;

    public function __construct($connection)
    {
        $this->connection = $connection;
    }
    //C
    public function create()
    {
        $query = "INSERT INTO " . $this->table_name . " SET subject_name = :subject_name, subject_detail = :subject_detail, standard_id = :standard_id";
        $stmt = $this->connection->prepare($query);

        // bind new values
        $stmt->bindParam(':subject_name', $this->subject_name);
        $stmt->bindParam(':subject_detail', $this->subject_detail);
        $stmt->bindParam(':standard_id', $this->standard_id);

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
    public function readAll()
    {
        // $query = "SELECT * FROM " . $this->table_name;
        $query = "SELECT subject.subject_id, subject.subject_name, subject.subject_detail, standard.standard_name, standard.standard_detail, standard.standard_id, school.school_name, school.school_detail, school.school_id FROM " . $this->table_name . " JOIN standard ON subject.standard_id = standard.standard_id JOIN school ON standard.school_id = school.school_id";
        $stmt = $this->connection->prepare($query);
        $stmt->execute();
        return $stmt;
    }
    //R
    public function readById()
    {
        $query = "SELECT * FROM " . $this->table_name . " WHERE subject_id = '" . $this->$subject_id . "'";
        $stmt = $this->connection->prepare($query);
        $stmt->execute();
        return $stmt;
    }
    //U
    public function update()
    {
        $query = "UPDATE " . $this->table_name . " SET subject_id = :subject_id, subject_name = :subject_name, subject_detail = :subject_detail, standard_id = :standard_id WHERE subject_id = :subject_id";
        $stmt = $this->connection->prepare($query);
        $stmt->bindParam(':subject_id', $this->$subject_id);
        $stmt->bindParam(':subject_name', $this->subject_name);
        $stmt->bindParam(':subject_detail', $this->subject_detail);
        $stmt->bindParam(':standard_id', $this->standard_id);
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
    //D
    public function delete()
    {
        $query = "DELETE FROM " . $this->table_name . " WHERE subject_id = '" . $this->$subject_id . "'";
        $stmt = $this->connection->prepare($query);
        $stmt->execute();
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}
