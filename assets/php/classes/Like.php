<?php
    class Like{
        private $client_id;
        private $commentaire_id;
        private $statut;

        public function __get($property){
            if(!property_exists($this, $property))
                throw new Exception($property . ' est une propriété invalide.');
            
            return $this->$property;
        }
    }
?>