<?php
    class MyArrAcc implements SeekableIterator, ArrayAccess
    {
        private $pos = 0;
        private $array = ['Premier élément', 'Deuxième élément', 'Troisième élément', 'Quatrième élément', 'Cinquième élément'];

        // Methodes de SeekableIterator

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

        // Methode ArrayAccess

        public function offsetExists($offset)
        {
            return isset($this->array[$offset]);
        }

        public function offsetGet($offset)
        {
            return $this->array[$offset];
        }

        public function offsetSet($offset, $value)
        {
            $this->array[$offset] = $value;
        }

        public function offsetUnset($offset)
        {
            unset($this->array[$offset]);
        }
    }

    $obj = new MyArrAcc;

    echo "On parcours l'objet...<br />";

    foreach ($obj as $k => $v){
        echo $k . " => " . $v . "<br />";
    }

    echo '<br />Remise du curseur en troisième position...<br />';
    $obj->seek(2);
    echo 'Élément courant : ', $obj->current(), '<br />';
    
    echo '<br />Affichage du troisième élément : ', $obj[2], '<br />';
    echo 'Modification du troisième élément... ';
    $obj[2] = 'Hello world !';
    echo 'Nouvelle valeur : ', $obj[2], '<br /><br />';
    
    echo 'Destruction du quatrième élément...<br />';
    unset($obj[3]);
    
    if (isset($obj[3]))
    {
        echo '$obj[3] existe toujours... Bizarre...';
    }
    else
    {
        echo 'Tout se passe bien, $obj[3] n\'existe plus !';
    }