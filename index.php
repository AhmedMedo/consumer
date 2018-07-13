<?php 
require("loader.php");

use Consumer\Consumer;


$consumer = new Consumer();

var_dump($consumer->API('https://reqres.in/api/','users','GET',[]));

var_dump($consumer->file(__DIR__,'json','dummy.json'));




 ?>