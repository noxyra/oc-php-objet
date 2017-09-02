<?php
$db = new PDO('mysql:host=localhost;dbname=OCCombat', 'root', 'killerjr');
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);