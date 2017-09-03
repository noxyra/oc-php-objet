<?php

    // Ne fonctionnera pas car crée deux fois le traits (dans les includes...)

    include ('Mailer.php');
    include ('Writer.php');

    $w = new Writer;
    $m = new Mailer;

    $w->write("Hello !");
    $m->send("Hello !");