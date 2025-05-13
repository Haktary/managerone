<?php
$db = new PDO('sqlite:' . __DIR__ . '/../data/database.sqlite');
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
