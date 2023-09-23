<?php
class Computer {
  private $id;
  private $cpu;
  private $ram;
  private $lab;

	public function getLab() {
		return $this->lab;
	}
	
	public function setLab($lab) {
		$this->lab = $lab;
	}

	public function getRam() {
		return $this->ram;
	}
	
	public function setRam($ram) {
		$this->ram = $ram;
	}

	public function getCpu() {
		return $this->cpu;
	}
	
	public function setCpu($cpu) {
		$this->cpu = $cpu;
	}

	public function getId() {
		return $this->id;
	}
	
	public function setId($id) {
		$this->id = $id;
	}

  public function __construct($cpu, $ram, $lab) {
    $this->setCpu($cpu);
    $this->setRam($ram);
    $this->setLab($lab);
  }
}
function validateComputer() {
    $error = false;
    $cpu = $_POST["cpu"];
    $ram = $_POST["ram"];
    $labId = $_POST["lab"];

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

    if (!isset($_COOKIE["lab-cookie"])) {
      echo "É necessário atribuir um laboratório para esse computador, crie um laboratório antes de criar um computador <br>";
      $error = true;
    } else {
      $value = unserialize($_COOKIE["lab-cookie"]);
      if (!$value) {
          $value = array();
      }
  
      $found = false;
      foreach ($value as $obj) {
        if ($obj->id === $labId) {
          $found = true;
          break;
        }
      }

      if (!$found) {
        echo "Laboratório inválido ou não existente. <br>";
        $error = true;
      }
    }

    
    if($error)
    {
      echo '<a href="../static/computers.php">Voltar</a><br> ';
      return false;
    }
    
    $campus = new Computer($cpu, $ram, $labId);
    createComputerCookie($campus);
    return true;
}

function createComputerCookie($computer) {
    if (!isset($_COOKIE["computer-cookie"])) {
        $value = array();
    } 
    else {
        $value = unserialize($_COOKIE["computer-cookie"]);
        if (!$value) {
            $value = array();
        }
    }

    $id = 0;
    if (isset($value) && count($value) >= 1) {
        $id = end($value)->getId();
    }

    $computer->setId($id + 1);

    array_push($value, $computer);

    $serializedValue = serialize($value);
    setcookie("computer-cookie", $serializedValue, time() + 360000000, "/");
}

if($_POST["entity"] == "computer")
{
    $result = validateComputer();
    if($result)
    {      
        header("Location: ../static/info-computer.php");
        die();
    }
}
?>