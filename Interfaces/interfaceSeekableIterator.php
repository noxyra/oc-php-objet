<?php
    class SeekIte implements SeekableIterator{
        private $pos = 0;
        private $array = [
            "Premier",
            "Second",
            "Troisième",
            "Quatrième",
            "Cinquième"
        ];

        public function current()
        {
            return $this->array[$this->pos];
        }

        public function key()
        {
            return $this->pos;
        }

        public function next()
        {
            $this->pos++;
        }

        public function rewind()
        {
            $this->pos = 0;
        }

        public function seek($position)
        {
            $backupPos = $this->pos;
            $this->pos = $position;

            if(!$this->valid()){
                trigger_error("La position spécifié n'est pas valide.", E_USER_WARNING);
                $this->pos = $backupPos;
            }
        }

        public function valid()
        {
            return isset($this->array[$this->pos]);
        }
    }

    $obj = new SeekIte;

    foreach ($obj as $k => $v){
        echo $k . " => " . $v . "<br />";
    }

    $obj->seek(2);

    echo "<br />" . $obj->current();