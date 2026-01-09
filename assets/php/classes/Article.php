<?php
    require_once 'DataBase.php';
    require_once 'Image.php';
    require_once 'Client.php';
    require_once 'Tag.php';

    class Article{
        private $titre_article;
        private $id_article;
        private $contenu_article;
        private $statut;
        private $date_creation;
        private $date_publication;
        private $auteur;
        private $tags;
        private $images;

        public function __get($property){
            if(!property_exists($this, $property))
                throw new Exception($property . ' est une propriété invalide.');
            
            return $this->$property;
        }

        public function __set($property, $value){
            $this->$property = $value;
        }

        public function __toString(){
            return 'Article';
        }

        static function getById($pdo, $id_article){
            $sql = "SELECT a.*, nom_user, nom_theme
                    FROM articles a
                    JOIN utilisateurs u ON a.user_id = u.id_user
                    JOIN themes t ON a.theme_id = t.id_theme
                    WHERE id_article = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$id_article]);
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Article');
            $article = $stmt->fetch();
            $article->auteur = Client::getById($article->user_id, $pdo);
            $article->tags = Tag::tagsByArticle($pdo, $article->id_article);
            $article->images = Image::imagesByArticle($pdo, $article->id_article);

            return $article?$article:null; 
        }

        static function articlesByTheme($pdo, $id_theme){
            $sql = "SELECT a.*, nom_user, nom_theme
                    FROM articles a
                    JOIN utilisateurs u ON a.user_id = u.id_user
                    JOIN themes t ON a.theme_id = t.id_theme
                    WHERE id_theme = ?
                    ORDER BY a.date_publication DESC";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$id_theme]);
            $articles = $stmt->fetchAll(PDO::FETCH_CLASS, 'Article');
            foreach($articles as $article){
                $article->auteur = Client::getById($article->user_id, $pdo);
                $article->tags = Tag::tagsByArticle($pdo, $article->id_article);
                $article->images = Image::imagesByArticle($pdo, $article->id_article);
            }

            return $articles;
        }
    }

    // $pdo = DataBase::getPDO();
    // var_dump(Article::articlesByTheme($pdo, 2));
?>