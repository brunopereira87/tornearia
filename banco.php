<?php


class Banco{
	private $pdo;
	private $numColunas;
	private $array;

	public function __construct($dbname,$host,$dbuser,$dbpass){
		try{
			$this->pdo = new PDO("mysql:dbname=".$dbname.";host=".$host,$dbuser,$dbpass);
			$this->pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
		}catch(PDOException $e){
			echo "Erro ao conectar ao banco de dados: ".$e->getMessage();
		}
	}

	public function query($sql){
		$query = $this->pdo->query($sql);
		$numColunas = $query->rowCount();
		$array = $query->fetchAll();
	}

	public function resultado(){
		return $this->$array;
	}

	public function insert($tabela,$campos){
		$sql = "INSERT INTO ".$tabela."(";
		$campos_tabela = array();
		$dados = array();
		foreach($campos as $chave=> $valor){
			$campos_tabela[] = $chave;
			$dados[] = " '".addslashes($valor)."'"; 
		}
		$sql.=implode(", ", $campos_tabela).") VALUES(".implode(", ", $dados).")";
		echo ($sql);
		$this->pdo->query($sql);
	}
	public function update($tabela,$campos,$where = array(),$condicao_where = "AND"){
		if(isset($tabela) &&( is_array($campos) && count($campos) > 0) && is_array($where)){
			$sql = "UPDATE ".$tabela." SET ";
			$dados = array();

			foreach ($campos as $chave => $valor) {
				$dados[] = $chave." = '".addslashes($valor)."'";
			}

			$sql.= implode(", ", $dados);

			if(count($where) > 0){
				$dados = array();

				foreach ($where as $campo => $valor) {
					$dados[] = $campo." = ".$valor;
				}
				$sql.= " WHERE ".implode(" ".$condicao_where." ", $dados);

				echo($sql);
			}
		}
	}
}
$banco = new Banco("tornearia","localhost","root","");
$banco->update("produtos", array(
	"nome" => "Produto 13",
	"preco" => "250"),
	array(
		"id"=>"10",
		"preco"=>"0"
	),"OR"
)
?>