<?php
    abstract class Personnage{

    }

    // Class finale.
    final class Guerrier extends Personnage{

    }

    // Fatal Error. Nous essayons d'étendre une classe finale.
    class GentilGuerrier extends Guerrier{

    }
