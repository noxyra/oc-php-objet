<?php
    include("HTMLFormater.php");

    class Writer
    {
        use HTMLFormater;

        public function write($text)
        {
            file_put_contents("fichier.txt", $this->format($text));
        }
    }