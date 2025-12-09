<?php

//autoload de classen
require_once __DIR__ . '/../vendor/autoload.php';

use rekenmachine\Class\rekenmachine;
$rekenmachine = new rekenmachine();

echo $rekenmachine->add(5, 10);
echo "<br>";
echo $rekenmachine->add(20, 30);

?>