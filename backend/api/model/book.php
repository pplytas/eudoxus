<?php
class Book {

    // Connection instance
	private $connection;

	// table name
    private $table_name = "books";
    //associated table names
    private $secretary_declaration_books_table_name = "SecretaryDeclarationBooks";
    private $student_declaration_books_table_name = "StudentDeclarationBooks";

	// table columns
	public $id;
	public $course_id;
	public $name;
	public $code;
	public $author;
	public $pages;

	public function __construct($connection){
		$this->connection = $connection;
	}


	public function create() {
        $query = "INSERT INTO " . $this->table_name . 
        " (course_id, name, code, author, pages) " . 
        " VALUES (?, ?, ?, ?, ?)";

        $stmt = $this->connection->prepare($query);
        $stmt->execute(
            [$this->course_id,
            $this->name,
            $this->code,
            $this->author,
            $this->pages]);

        return $this->connection->lastInsertId;
    }
    
    public function update() {
        $query = "UPDATE " . $this->table_name . " SET " .
        "course_id=?, name=?, code=?, author=?, pages=? WHERE id=?";
        
        $stmt = $this->connection->prepare($query);
        $stmt->execute(
            [$this->course_id,
            $this->name,
            $this->code,
            $this->author,
            $this->pages,
            $this->id]);
    }

    public function delete(){
        $query = "DELETE FROM " . $this->table_name . " WHERE id=?";
        
        $stmt = $this->connection->prepare($query);
        $stmt->execute([$this->id]);
    }

    public function getAll(){
		$query = "SELECT * FROM " . $this->table_name;

		$stmt = $this->connection->prepare($query);
		$stmt->execute();

		$data = [
			"books" => $stmt->fetchAll(PDO::FETCH_CLASS),
			"count" => $stmt->rowCount()
		];

		return $data;
	}

    public function getById() {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id=?";

		$stmt = $this->connection->prepare($query);
		$stmt->execute([$this->id]);

		$data = [
			"book" => $stmt->fetch()
		];

		return $data;
    }
    
    public function getByStudentDeclarationId($declarationId) {
        $query = "SELECT b.* FROM " . $this->table_name . " b, " .
                  $this->student_declaration_books_table_name . " sd WHERE sd.declaration_id=?";

        $stmt = $this->connection->prepare($query);
        $stmt->execute([$declarationId]);

        $data = [
			"books" => $stmt->fetchAll(PDO::FETCH_CLASS),
			"count" => $stmt->rowCount()
		];

        return $data;
    }

    public function getBySecretaryDeclarationId($declarationId) {
        $query = "SELECT b.* FROM " . $this->table_name . " b, " .
                  $this->secretary_declaration_books_table_name . " sd WHERE sd.declaration_id=?";

        $stmt = $this->connection->prepare($query);
        $stmt->execute([$declarationId]);

        $data = [
			"books" => $stmt->fetchAll(PDO::FETCH_CLASS),
			"count" => $stmt->rowCount()
		];

        return $data;
    }

}
?>