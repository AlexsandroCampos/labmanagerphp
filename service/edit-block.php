<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/service/block.php';

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $blockId = $_GET['id'];
    $blocks = unserialize($_COOKIE["block-cookie"]);
    
    foreach ($blocks as $block) {
        if ($block->getId() == $blockId) {
            $name = $block->getName();
            $campusId = $block->getCampusId();
            break;
        }
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $blocks = unserialize($_COOKIE["block-cookie"]);
    $blockId = $_POST["id"];
    $name = $_POST["name"];
    $campusId = $_POST["campusId"];
    foreach ($blocks as &$block) {
        if ($block->getId() == $blockId) {
            $error = false;
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

                if($error)
                {
                    echo "<a href='../static/edit-blocks.php?id={$blockId}'/>Voltar</a><br>";
                    break;
                }

                else
                {
                    $block->setName($name);
                    $block->setCampusId($campusId);
                    $serializedBlocks = serialize($blocks);
                    setcookie("block-cookie", $serializedBlocks, time() + 360000000, '/');
                    header("Location: ../static/info-block.php?id=$blockId");
                    die();
                }
            
            }
        }
    }
}
?>