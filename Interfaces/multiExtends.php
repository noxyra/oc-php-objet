<?php
    interface iAA
    {
        public function testA();
    }

    interface iBB
    {
        public function testB();
    }

    interface iCC extends iAA, iBB
    {
        public function testC();
    }

    // Avec une classe qui implémente les trois

    class Testing implements iCC
    {
        public function testA()
        {
            // TODO: Implement test1() method.
        }

        public function testB()
        {
            // TODO: Implement test2() method.
        }

        public function testC()
        {
            // TODO: Implement test3() method.
        }
    }