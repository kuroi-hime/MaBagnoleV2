<?php
    class Tag{
        private $id_tag;
        private $nom_tag;

        public function __get($property){
            if(!property_exists($this, $property))
                throw new Exception($property . ' est une propriété invalide.');
            
            return $this->$property;
        }

        public function __set($property, $value){
            $this->$property = $value;
        }

        public function __toString(){
            return 'Tag ';
        }

        static function tagsByArticle($pdo, $id_article){
            $sql = "SELECT t.* FROM tags t INNER JOIN articles_tags ON id_tag = tag_id WHERE article_id = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$id_article]);

            return $stmt->fetchAll(PDO::FETCH_CLASS, 'Tag') ?? [];
        }
    }
?>