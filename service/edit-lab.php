<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/service/lab.php';
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $labId = $_GET['id'];
    $labs = unserialize($_COOKIE["lab-cookie"]);
    
    foreach ($labs as $lab) {
        if ($lab->getId() == $labId) {
            $name = $lab->getName();
            $number = $lab->getNumber();
            $block = $lab->getBlock();
            break;
        }
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $labs = unserialize($_COOKIE["lab-cookie"]);
    $labId = $_POST["id"];
    $name = $_POST["name"];
    $number = $_POST["number"];
    $blockId = $_POST["block_id"];

    foreach ($labs as &$lab) {
        if ($lab->getId() == $labId) {

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
  
                if($error)
                {
                    echo "<a href='../static/edit-labs.php?id={$labId}'/>Voltar</a><br>";
                    break;
                }

                else
                {
                    $lab->setName($name);
                    $lab->setNumber($number);
                    $lab->setBlockId($blockId);
                    $serializedLabs = serialize($labs);
                    setcookie("lab-cookie", $serializedLabs, time() + 360000000, "/");
                    header("Location: ../static/info-lab.php?id=$labId");
                    die();
                }
            }
        }
    }
}
?>