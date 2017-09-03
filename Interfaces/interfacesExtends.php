<?php
    interface iA
    {
        public function test1();
    }

    interface iB extends iA
    {
        public function test1($param1, $param2); // FATAL ERROR. On ne peut pas réecrire la methode.
    }

    interface iC extends iA
    {
        public function test2();
    }

    class MaClasse implements iC
    {
        public function test1(){
            //...
        }

        public function test2()
        {
            //...
        }
    }