<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/service/computer.php';
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $computerId = $_GET['id'];
    $computers = unserialize($_COOKIE["computer-cookie"]);
    
    foreach ($computers as $computer) {
        if ($computer->getId() == $computerId) {
            $cpu = $computer->getCpu();
            $ram = $computer->getRam();
            $labId = $computer->getLab();
            break;
        }
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $computers = unserialize($_COOKIE["computer-cookie"]);
    $computerId = $_POST["id"];
    $cpu = $_POST["cpu"];
    $ram = $_POST["ram"];
    $labId = $_POST["lab_id"];
    foreach ($computers as &$computer) {
        if ($computer->getId() == $computerId) {

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
        
            if(strlen($ram) > 50 || strlen($ram) < 3) {
                echo "RAM deve ter entre 3 e 50 caracteres <br>";
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
              require_once 'lab.php';
        
              $value = unserialize($_COOKIE["lab-cookie"]);
              if (!$value) {
                  $value = array();
              }
          
              $found = false;
              foreach ($value as $obj) {
                if ($obj->getId() == $labId) {
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
                echo "<a href='../static/edit-computers.php?id={$computerId}'/>Voltar</a><br>";
                break;
            }
            else
            {
                $computer->setCpu($cpu);
                $computer->setRam($ram);
                $computer->setLabId($labId);
                $serializedComputers = serialize($computers);
                setcookie("computer-cookie", $serializedComputers, time() + 360000000, "/");
                header("Location: ../static/info-computer.php?id=$computerId");
                die();

            }  
        }
    }
}
?>