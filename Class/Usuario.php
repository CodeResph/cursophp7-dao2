 <?php 

 class Usuario {
 	
 	private $id;
 	private $deslogin;
 	private $dessenha;
 	private $dtcadastro;

 	public function getId() {
 		return $this->id;
 	}
 	
 	public function setId($value) {
 		$this->id = $value;
 	}

 	public function getDeslogin(){
 		return $this->deslogin;
 	}

 	public function setDeslogin($value) {
 		return $this->deslogin = $value;
 	}
 	
 	public function getDessenha(){
 		return $this->dessenha;
 	}

 	public function setDessenha($value) {
 		return $this->dessenha = $value;
 	}

 	public function getDtCadastro(){
 		return $this->dtcadastro;
 	}

 	public function setDtCadastro($value) {
 		return $this->dtcadastro = $value;
 	}

 	public function loadById($id) {
 		$sql = new Sql();

 		$result = $sql->select("SELECT * FROM tb_usuarios WHERE id = :ID", array(
 			":ID"=>$id
 		));

 		if (count($result) > 0) {

 			$row = $result[0];

 			$this->setId($row['id']);
 			$this->setDeslogin($row['deslogin']);
 			$this->setDessenha($row['dessenha']);
 			$this->setDtCadastro(new DateTime($row['dtcadastro']));
 		}
 	}

 	public function __toString() {
 		return json_encode(array(
 			"id"=>$this->getId(),
 			"deslogin"=>$this->getDeslogin(),
 			"dessenha"=>$this->getDessenha(),
 			"dtcadastro"=>$this->getDtCadastro()->format("d/m/Y H:i:s")
 		));
 	}

 }

 ?>