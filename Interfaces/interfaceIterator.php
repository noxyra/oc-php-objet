<?php
    class ToIter implements Iterator
    {
        private $position = 0;
        private $array = [
            "first",
            "second",
            "third",
            "..."
        ];

        public function current()
        {
            return $this->array[$this->position];
        }

        public function key()
        {
            return $this->position;
        }

        public function next()
        {
            $this->position++;
        }

        public function rewind()
        {
            $this->position = 0;
        }

        public function valid()
        {
            return isset($this->array[$this->position]);
        }
    }

    $iter = new ToIter;

    foreach ($iter as $k => $v)
    {
        echo $k . " => " . $v . "<br />";
    }