<?php
class Question
{
    private $connection;
    private $table_name = "question";
    public $question_id;
    public $question_type;
    public $question_note;
    public $question_detail;
    public $question_result;
    public $subject_id;

    public function __construct($connection)
    {
        $this->connection = $connection;
    }
    //C
    public function create()
    {
        $query = "INSERT INTO " . $this->table_name . " SET question_note = :question_note, question_detail = :question_detail, question_result = :question_result, subject_id = :subject_id";
        $stmt = $this->connection->prepare($query);

        // bind new values
        $stmt->bindParam(':question_note', $this->question_note);
        $stmt->bindParam(':question_type', $this->question_type);
        $stmt->bindParam(':question_detail', $this->question_detail);
        $stmt->bindParam(':question_result', $this->question_result);
        $stmt->bindParam(':subject_id', $this->subject_id);

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
        $query = "SELECT question.question_id, question.question_detail, question.question_type, question.question_note, question.question_result, question.subject_id, subject.subject_name, subject.subject_detail, standard.standard_id,standard.standard_name, standard.standard_detail, school.school_id, school.school_name, school.school_detail FROM " . $this->table_name . " JOIN subject ON question.subject_id = subject.subject_id JOIN standard ON subject.standard_id = standard.standard_id JOIN school ON standard.school_id = school.school_id";
        $stmt = $this->connection->prepare($query);
        $stmt->execute();
        return $stmt;
    }
    //R
    public function readById()
    {
        $query = "SELECT * FROM " . $this->table_name . " WHERE question_id = '" . $this->$question_id . "'";
        $stmt = $this->connection->prepare($query);
        $stmt->execute();
        return $stmt;
    }
    //U
    public function update()
    {
        $query = "UPDATE " . $this->table_name . " SET question_id = :question_id, question_type = :question_type, question_note = :question_note, question_detail = :question_detail, subject_id = :subject_id WHERE question_id = :question_id";
        $stmt = $this->connection->prepare($query);
        $stmt->bindParam(':question_id', $this->$question_id);
        $stmt->bindParam(':question_type', $this->question_type);
        $stmt->bindParam(':question_note', $this->question_note);
        $stmt->bindParam(':question_detail', $this->question_detail);
        $stmt->bindParam(':question_result', $this->question_result);
        $stmt->bindParam(':subject_id', $this->subject_id);
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
    //D
    public function delete()
    {
        $query = "DELETE FROM " . $this->table_name . " WHERE question_id = '" . $this->$question_id . "'";
        $stmt = $this->connection->prepare($query);
        $stmt->execute();
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}
