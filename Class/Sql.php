<?php 

class Sql extends PDO {

	private $conn;
	//Oque é o método construtor?
	//É um tipo especial de função do PHP. Normalmente o programador utiliza o método construtor para inicializar os atributos de um objeto, como por exemplo: Estabelecer conexão com um banco de dados, abertura de um arquivo que será utilizado para escrita de log, etc
	public function __construct() {
		$this->conn = new PDO("mysql:host=localhost;dbname=db_php7", "root", ""); 
	}

	private function setParams($statement, $parameters = array()){
		foreach ($parameters as $key => $value) {
			$this->setParam($statement, $key, $value);
		}
	}

	private function setParam($statement, $key, $value){
		$statement->bindParam($key, $value);
	}

	public function query($rawQuery, $params = array()){

		$stmt = $this->conn->prepare($rawQuery);
		$this->setParams($stmt, $params);

		$stmt->execute();

		return $stmt;
	}

	public function select($rawQuery, $params = array()){
		$stmt = $this->query($rawQuery, $params);

		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}
}	

?>