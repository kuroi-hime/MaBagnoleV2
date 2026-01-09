<?php

    class Theme{
        private $id_theme;
        private $nom_theme;
        private $description_theme;
        // private $articles; //array articles

        public function __get($property){
            if(!property_exists($this, $property))
                throw new Exception($property . ' est une propriété invalide.');
            
            return $this->$property;
        }

        public function __set($property, $value){
            switch($property){
                case 'id_theme':
                    $this->$property = trim($value);
                    break;
                case 'nom_theme': 
                    $this->$property = trim($value);
                    break;
                case 'description_theme': 
                    $this->$property = trim($value);
                    break;
                case 'articles': 
                    if(is_array($value))
                        $this->$property = $value;
                    $this->$property = [];
                    break;
            }
        }

        public function __toString(){
            return 'Article '.$this->id_theme.''.$this->nom_theme.''.$this->description_theme;
        }

        static function allThemes($pdo){
            try{
                $sql = "SELECT * FROM themes";
                $stmt = $pdo->prepare($sql);
                $stmt->execute();

                $themes = $stmt->fetchAll(PDO::FETCH_CLASS, 'Theme');
            }catch(Exception $e){
                echo $e;
            }

            return $themes ? $themes:[];
        }
    }

?>