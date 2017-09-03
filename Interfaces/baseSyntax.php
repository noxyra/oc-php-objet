<?php
    interface Movable
    {
        public function move($destination);
    }

    class Voiture implements Movable
    {
        public function move($destination){
            return true;
        }
    }