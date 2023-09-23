<?php
    class Block
    {
        private $id;
        private $name;
        private $campusId;

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

        public function getCampusId() {
            return $this->campusId;
        }

        public function setCampusId($campusId) {
            $this->campusId = $campusId;
        }

        public function __construct($name, $campusId) {
            $this->setName($name);
            $this->setCampusId($campusId);
        }
    } 

    function validateBlock()
    {
        $error = false;
        $campusId = $_POST["campusId"];
        $name = $_POST["name"];

        if(empty(trim($name))) {
            echo "Nome é obrigatório <br>";
            $error = true;
        }

        if(is_numeric($name)) {
            echo "Nome deve ser uma string <br>";
            $error = true;
        }

        if(strlen($name) > 50) {
            echo "Nome deve ter entre 4 e 50 caracteres <br>";
            $error = true;
        }

        if(empty(trim($campusId))) {
            echo "É necessário atribuir um campus para esse bloco <br>";
            $error = true;
        }
    
        if (!isset($_COOKIE["campus-cookie"])) {
          echo "É necessário atribuir um campus para esse bloco, crie um campus antes de criar um bloco <br>";
          $error = true;
        } else {
            require_once 'campus.php';
            $value = unserialize($_COOKIE["campus-cookie"]);
            if (!$value) {
                $value = array();
            }
        
            $found = false;
            foreach ($value as $obj) {
                if(isset($obj))
                {
                    if ($obj->getId() == $campusId) 
                    {
                        $found = true;
                        break;
                    }
                }
            }
        
            if (!$found) {
                echo "Campus inválido ou inexistente. <br>";
                $error = true;
            }
        }

        if($error)
        {
            echo '<a href="../static/block.php">Voltar</a><br> '; //voltar para o form de bloco
            return false;
        }

        $block = new Block($name, $campusId);
        createBlockCookie($block);
        return $block;
    }

    function createBlockCookie($block)
    {
        if (!isset($_COOKIE["block-cookie"])) {
            $value = array();
        } 
        else {
            $value = unserialize($_COOKIE["block-cookie"]);
            if (!$value) {
                $value = array();
            }
        }

        $id = 0;
        if (isset($value) && count($value) >= 1) {
            $id = end($value)->getId();
        }

        $block->setId($id + 1);

        array_push($value, $block);

        $serializedValue = serialize($value);
        setcookie("block-cookie", $serializedValue, time() + 360000000, "/");
    }
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if($_POST["entity"] == "block")
        {
            $block = validateBlock();
            if($block != null)
            {      
                header("Location: ../static/info-block.php?id=" . $block->getId());
                die();
            }
        }
    }
?>