<?php 

require_once("config.php");

// $sql = new Sql();

// $usuarios = $sql->select("SELECT * FROM tb_usuarios");

// echo json_encode($usuarios);

//Carrega um usuário
// $jhon = new Usuario();
// $jhon->loadById(3);

// echo $jhon;


//Exibindo uma lista de usuários...
// $list = Usuario::getList(); //Só é possível instanciar o objeto dessa forma por que o método é estatico
// echo json_encode($list);


//Carrega uma lista de usuários buscando pelo login
// $search = Usuario::search("J");
// echo json_encode($search);

//carrega um usuario autenticado (login e senha)
// $usuario = new Usuario();
// $usuario->login("isa345", "2615489Okhg"); //deve-se informar os dois paramtros esperados (login e senha)
// echo $usuario; 	


//Carregando a procedure INSERT - Criando um novo user
/*$aluno = new Usuario("Jhona", "@34er");		
$aluno->insert();
echo $aluno;
*/

//Alterando dados do usuário
/*$usuario = new Usuario();
$usuario->loadById(8);
$usuario->update("Isaque", "!@#$");
echo $usuario;
*/

$user = new Usuario();
$user->loadById(33);

$user->delete();

echo $user;



?>