<?php
    include("HTMLFormater.php");

    class Mailer
    {
        use HTMLFormater;

        public function send($text)
        {
            mail("log@fai.tld", "test avec les traits", $this->format($text));
        }
    }