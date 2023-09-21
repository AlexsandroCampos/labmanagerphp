<?php
    class Campus
    {
        private $id;
        private $name;
        private $address;
        private $acronym;

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
    
        public function getAddress() {
            return $this->address;
        }
    
        public function setAddress($address) {
            $this->address = $address;
        }

        public function getAcronym() {
            return $this->acronym;
        }
    
        public function setAcronym($acronym) {
            $this->acronym = $acronym;
        }
    
        public function __construct($name, $address, $acronym) {
            $this->setName($name);
            $this->setAddress($address);
            $this->setAcronym($acronym);
        }
    } 

    function validateCampus()
    {
        $error = false;
        $name = $_POST["name"];
        $address = $_POST["address"];
        $acronym = $_POST["acronym"];

        if(empty(trim($name))) {
            echo "Nome é obrigatório <br>";
            $error = true;
        }

        if(is_numeric($name)) {
            echo "Nome deve ser uma string <br>";
            $error = true;
        }

        if(strlen($name) > 50 || strlen($name) < 4) {
            echo "Nome deve ter entre 4 e 50 caracteres <br>";
            $error = true;
        }

        if(empty(trim($address))) {
            echo "Endereço é obrigatório <br>";
            $error = true;
        }

        if(is_numeric($address)) {
            echo "Endereço deve ser uma string <br>";
            $error = true;
        }

        if(strlen($address) > 50 || strlen($address) < 4) {
            echo "Endereço deve ter entre 4 e 50 caracteres <br>";
            $error = true;
        }

        if(empty(trim($acronym))) {
            echo "Sigla é obrigatória <br>";
            $error = true;
        }

        if(is_numeric($acronym)) {
            echo "Sigla deve ser uma string <br>";
            $error = true;
        }

        if(strlen($acronym) > 50 || strlen($acronym) < 4) {
            echo "Sigla deve ter entre 4 e 50 caracteres <br>";
            $error = true;
        }

        if($error)
        {
            echo '<a href="../static/index.php">Voltar</a><br> ';
            return false;
        }

        $campus = new Campus($name, $address, $acronym);
        createCampusCookie($campus);
        return true;
    }

    function createCampusCookie($campus)
    {
        if (!isset($_COOKIE["campus-cookie"])) {
            $value = array();
        } 
        else {
            $value = unserialize($_COOKIE["campus-cookie"]);
            if (!$value) {
                $value = array();
            }
        }

        $id = 0;
        if (isset($value) && count($value) >= 1) {
            $id = end($value)->getId();
        }

        $campus->setId($id + 1);

        array_push($value, $campus);

        $serializedValue = serialize($value);
        setcookie("campus-cookie", $serializedValue, time() + 360000000, "/");
    }

    $entity = $_POST["entity"];
    if($entity == "campus")
    {
        $result = validateCampus();
        if($result)
        {      
            header("Location: ../static/index.php"); //detalhes do campus
            die();
        }
    }
?>