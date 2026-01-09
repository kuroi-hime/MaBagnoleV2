<?php
    class Image{
        private $id_image;
        private $url_image;

        public function __get($property){
            if(!property_exists($this, $property))
                throw new Exception($property . ' est une propriété invalide.');
            
            return $this->$property;
        }

        public function __set($property, $value){
            $this->$property = $value;
        }

        static function imagesByArticle($pdo, $id_article){
            $sql = "SELECT id_image, url_image FROM images WHERE article_id = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$id_article]);
            return $stmt->fetchAll(PDO::FETCH_CLASS, 'Image');
        }
    }
?>