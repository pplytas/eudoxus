<?php
class Course {

    // Connection instance
	private $connection;

	// table name
    private $table_name = "courses";
    //associated table names
    private $department_courses_table_name = "DepartmentsCourses";

	// table columns
	public $id;
	public $name;
    public $professor;

    public function __construct($connection){
		$this->connection = $connection;
	}


	public function create(){
        $query = "INSERT INTO " . $this->table_name .
        " (name, professor) " .
        " VALUES (?, ?)";

        $stmt = $this->connection->prepare($query);
        $stmt->execute(
            [$this->name,
            $this->professor]);

        return $this->connection->lastInsertId();
    }

    public function update() {
        $query = "UPDATE " . $this->table_name . " SET " .
        "name=?, professor=? WHERE id=?";

        $stmt = $this->connection->prepare($query);
        $stmt->execute(
            [$this->name,
            $this->professor,
            $this->id]);
    }

    public function delete(){
        $query = "DELETE FROM " . $this->table_name . " WHERE id=?";

        $stmt = $this->connection->prepare($query);
        $stmt->execute([$this->id]);
    }

    public function getAll() {
        $query = "SELECT * FROM " . $this->table_name;

        $result = $this->connect()->query($query);

        $data = [
			"courses" => $stmt->fetchAll(PDO::FETCH_CLASS),
			"count" => $stmt->rowCount()
		];

        return $data;
    }

    public function getById() {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id=?";

		$stmt = $this->connection->prepare($query);
		$stmt->execute([$this->id]);

		$data = $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function getByDepartmentId($departmentId) {
        $query = "SELECT * FROM " . $this->table_name .
                 " WHERE id in (SELECT course_id FROM " . $this->department_courses_table_name . " WHERE department_id=?)";

        $stmt = $this->connection->prepare($query);
        $stmt->execute([$departmentId]);

        $data = [
			"courses" => $stmt->fetchAll(PDO::FETCH_CLASS),
			"count" => $stmt->rowCount()
		];

        return $data;
    }

}
?>