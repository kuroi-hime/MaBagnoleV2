<?php
    require_once 'Client.php';

    class Commentaire {
        private $id_commentaire;
        private $contenu;
        private $note;
        private $date_commentaire;
        private $statut;
        private $client_id;
        private $vehicule_id;
        private $article_id;

        public function __get($property){
            if(property_exists($this, $property)){
                return $this->$property;
            }
        }

        public function __set($property, $value){
            if (property_exists($this, $property)){
                $this->$property = $value;
            }
        }

        public function __toString(){
            return "Commentaire: {$this->contenu} Client: {$this->client_id} Article: {$this->article_id} Note: {$this->note}";
        }

        public function ajouter($pdo){
            $sql = "INSERT INTO commentaires(contenu, note, client_id, vehicule_id, article_id)
                    VALUES(?, ?, ?, ?, ?)";
            $stmt = $pdo->prepare($sql);
            return $stmt->execute([$this->contenu, $this->note, $this->client_id, $this->vehicule_id, $this->article_id]);
        }

        public static function commentairesByArticle($pdo, $id_article){
            $sql = "SELECT * FROM commentaires c WHERE article_id = ? AND c.statut<>'deleted' ORDER BY date_commentaire DESC";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$id_article]);
            $commentaires = $stmt->fetchAll(PDO::FETCH_CLASS, 'Commentaire');

            return $commentaires ? $commentaires:[];
        }
        
        public static function allCommentaires($pdo){
            try {
                $sql = "SELECT c.*, u.nom_user as nom_client, v.modele as modele_vehicule 
                        FROM commentaires c
                        JOIN utilisateurs u ON c.client_id = u.id_user
                        JOIN vehicules v ON c.vehicule_id = v.id_vehicule
                        ORDER BY c.date_commentaire DESC";
                $stmt = $pdo->query($sql);

                return $stmt->fetchAll(PDO::FETCH_CLASS, 'Commentaire');  
            }catch (PDOException $e){
                error_log("Erreur allCommentaires: " . $e->getMessage());
                return [];
            }
        }
    }

?>