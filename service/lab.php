<?php
class Lab {
  private $id;
  private $name;
  private $number;
  private $block;

  public function __construct($name, $number, $block) {
    $this->setName($name);
    $this->setNumber($number);
    $this->setBlock($block);
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
    $name = $_POST["name"];
    $number = $_POST["number"];
    $block = $_POST["block"];

    if(empty(trim($name))) {
        echo "Nome do laboratório é obrigatório <br>";
        $error = true;
    }

    if(strlen($name) > 50 || strlen($name) < 4) {
        echo "Nome do laboratório deve ter entre 4 e 50 caracteres <br>";
        $error = true;
    }

    if(empty(trim($number))) {
        echo "Número do laboratório é obrigatório <br>";
        $error = true;
    }

    if(strlen($number) > 50 || strlen($number) < 4) {
        echo "Número do laboratório deve ter entre 4 e 50 caracteres <br>";
        $error = true;
    }

    if(empty(trim($block))) {
        echo "ID do Bloco do laboratório é obrigatório <br>";
        $error = true;
    }

    if($error)
    {
        echo '<a href="../static/labs.php">Voltar</a><br> ';
        return false;
    }

    $lab = new Lab($name, $number, $block);
    createLabCookie($lab);
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

if($_POST["entity"] == "lab")
{
    $result = validateLab();
    if($result)
    {      
        header("Location: ../static/info-lab.php");
        die();
    }
}
?>
