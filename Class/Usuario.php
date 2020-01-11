 <?php 

 class Usuario {
 	//atributos
 	private $id;
 	private $deslogin;
 	private $dessenha;
 	private $dtcadastro;

    //Métodos
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
 	//recuperando o atributo dtcadastro em uma funcao publica
 	public function getDtcadastro(){
 		return $this->dtcadastro;
 	}
 	//setando valor ao atributo dtcadastro 
 	public function setDtcadastro($value) {
 		return $this->dtcadastro = $value;
 	}

 	//Este método está recuperando o usuário do id especificado 
 	public function loadById($id) {
 		$sql = new Sql();

 		//seleciona a tabela usuarios onde o id e igual ao parameter :ID atribuindo ao mesmo 
 		//o valor vindo da variável $id
 		$result = $sql->select("SELECT * FROM tb_usuarios WHERE id = :ID", array(
 			":ID"=>$id
 		));
 		//se existir algum registro(se for maior do que zero), 
 		//execute os sets 
 		if (count($result) > 0) {
 			$this->setData($result[0]);
 		}
 	}

 	//método para listar todos os usuários...
 	//
 	//Consultando e exibindo uma lista de usuários
 	public static function getList() {
 		//instanciando o objeto Sql e atribuindo na variavel $sql
 		$sql = new Sql();
 		//consultando informações do banco por meio do atributo select 
 		return $sql->select("SELECT * FROM tb_usuarios ORDER BY deslogin;");
 	}
 	//Método para consulta de registros no banco
 	//
 	public static function search($login){
 		$sql = new Sql();

 	return $sql->select("SELECT * FROM tb_usuarios WHERE deslogin LIKE :SEARCH ORDER BY deslogin", array(
 			':SEARCH'=>"%".$login."%"
 		));
 	}

 	//Método para exibir user e pass com validação
 	public function login($login, $password){
 		$sql = new Sql();

 		//seleciona a tabela usuarios onde o id e igual ao parameter :ID atribuindo ao mesmo 
 		//o valor vindo da variável $id
$result = $sql->select("SELECT * FROM tb_usuarios WHERE deslogin = :LOGIN AND dessenha = :PASSWORD", array(
 			":LOGIN"=>$login,
 			":PASSWORD"=>$password
 		));
 		//se existir algum registro(se for maior do que zero), 
 		//execute os sets 
 		if (count($result) > 0) {
 			$this->setData($result[0]);
 		} else {
 			throw new Exception("Login e/ou senha incorretos.");
 			
 		}
 	}

 	//Método SetData
 	public function setData($data){

 			$this->setId($data['id']);
 			$this->setDeslogin($data['deslogin']);
 			$this->setDessenha($data['dessenha']);
 			//função DateTime, formatando a data
 			$this->setDtcadastro(new DateTime($data['dtcadastro']));
 	}

 	//Método INSERT
 	public function insert(){
 		$sql = new Sql();
 		$results = $sql->select("CALL sp_usuarios_insert(:LOGIN, :PASSWORD)", array(
 				':LOGIN'=>$this->getDeslogin(),
 				':PASSWORD'=>$this->getDessenha()
 		));

 		if(count($results) > 0) {
 			$this->setData($results[0]);
 		}
 	}

 	//Método UPDATE - DAO
 	public function update($login, $password) {

 		$this->setDeslogin($login);
 		$this->setDessenha($password);

 		$sql = new Sql();

 	$sql->query("UPDATE tb_usuarios SET deslogin = :LOGIN, dessenha = :PASSWORD WHERE id = :ID", array(
 		':LOGIN'=>$this->getDeslogin(),
 		':PASSWORD'=>$this->getDessenha(),
 		':ID'=>$this->getId()

 	));
 	}

 	//Método construtor - para evitar erros, os parametros são pre carregados com 
 	//valor vazio para nao ser obrigatorio inserir os mesmos como parametro no metodo 
 	//construtor em index.php
 	public function __construct($login = "", $password = ""){
 		$this->setDeslogin($login);
 		$this->setDessenha($password);
 	}

 	//formatando os dados do banco em string e inserindo em um array
 	public function __toString() {
 		return json_encode(array(
 			"id"=>$this->getId(),
 			"deslogin"=>$this->getDeslogin(),
 			"dessenha"=>$this->getDessenha(),
 			"dtcadastro"=>$this->getDtcadastro()->format("d/m/Y H:i:s")
 		));
 	}
 }
 ?>