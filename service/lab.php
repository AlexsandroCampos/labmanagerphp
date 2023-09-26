<?php
class Lab {
    private $id;
    private $name;
    private $number;
    private $blockId;

    public function __construct($name, $number, $blockId) {
        $this->setName($name);
        $this->setNumber($number);
        $this->setBlockId($blockId);
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

	public function getBlockId() {
		return $this->blockId;
	}
	
	public function setBlockId($blockId) {
		$this->blockId = $blockId;
	}
}

function validateLab() {
    $error = false;
    $name = $_POST["name"];
    $number = $_POST["number"];
    $blockId = $_POST["block_id"];

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

    if($number <= 0) {
        echo "Número do laboratório deve ser positivo <br>";
        $error = true;
    }

    if(empty(trim($blockId))) {
        echo "ID do Bloco do laboratório é obrigatório <br>";
        $error = true;
    }

    if (!isset($_COOKIE["block-cookie"])) {
        echo "É necessário atribuir um bloco para esse laboratório, crie um bloco antes de criar um laboratório <br>";
        $error = true;
      } else {
        require_once 'block.php';
        $value = unserialize($_COOKIE["block-cookie"]);
        if (!$value) {
            $value = array();
        }
      
        $found = false;
        foreach ($value as $obj) {
            if(isset($obj))
            {
                if ($obj->getId() == $blockId) 
                {
                    $found = true;
                    break;
                }
            }
        }
      
        if (!$found) {
            echo "Bloco inválido ou inexistente. <br>";
            $error = true;
        }
    }

    if($error)
    {
        echo '<a href="../static/labs.php">Voltar</a><br> ';
        return false;
    }

    $lab = new Lab($name, $number, $blockId);
    createLabCookie($lab);
    return $lab;
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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if($_POST["entity"] == "lab")
    {
        $lab = validateLab();
        if($lab != null)
        {      
            header("Location: ../static/info-lab.php?id=" . $lab->getId());
            die();
        }
    }
}
?>
