<?php
class Lab {
  private $id;
  private $name;
  private $number;
  private $block;

  public function __construct($cpu, $ram, $lab) {
    $this->setName($cpu);
    $this->setNumber($ram);
    $this->setBlock($lab);
  }

	public function getId() {
		return $this->id;
	}
	
	public function setId($id) {
		$this->id = $id;
	}

	public function getName() {
		return $this->name;
	}
	
	public function setName($name) {
		$this->name = $name;
	}

	public function getNumber() {
		return $this->number;
	}
	
	public function setNumber($number) {
		$this->number = $number;
	}

	public function getBlock() {
		return $this->block;
	}
	
	public function setBlock($block) {
		$this->block = $block;
	}
}

function validateLab() {
    $error = false;
    $cpu = $_POST["cpu"];
    $ram = $_POST["ram"];
    $labId = $_POST["labId"];

    if(empty(trim($cpu))) {
        echo "CPU é obrigatória <br>";
        $error = true;
    }

    if(is_numeric($cpu)) {
        echo "CPU deve ser uma string <br>";
        $error = true;
    }

    if(strlen($cpu) > 50 || strlen($cpu) < 4) {
        echo "CPU deve ter entre 4 e 50 caracteres <br>";
        $error = true;
    }

    if(empty(trim($ram))) {
        echo "RAM é obrigatória <br>";
        $error = true;
    }

    if(is_numeric($ram)) {
        echo "RAM deve ser uma string <br>";
        $error = true;
    }

    if(strlen($ram) > 50 || strlen($ram) < 4) {
        echo "RAM deve ter entre 4 e 50 caracteres <br>";
        $error = true;
    }

    if(empty(trim($labId))) {
        echo "É necessário atribuir um laboratório para esse computador <br>";
        $error = true;
    }

    if($error)
    {
        echo '<a href="../static/index.php">Voltar</a><br> '; //voltar para o form de campus
        return false;
    }

    $campus = new Computer($cpu, $ram, $labId);
    createLabCookie($campus);
    return true;
}

function createLabCookie($lab) {
    if (!isset($_COOKIE["lab-cookie"])) {
        $value = array();
    } 
    else {
        $value = unserialize($_COOKIE["lab-cookie"]);
        if (!$value) {
            $value = array();
        }
    }

    $id = 0;
    if (isset($value) && count($value) >= 1) {
        $id = end($value)->getId();
    }

    $lab->setId($id + 1);

    array_push($value, $lab);

    $serializedValue = serialize($value);
    setcookie("lab-cookie", $serializedValue, time() + 360000000, "/");
}

$entity = $_POST["entity"];
if($entity == "campus")
{
    $result = validateLab();
    if($result)
    {      
        header("Location: ../static/index.php"); //detalhes do campus
        die();
    }
}
?>