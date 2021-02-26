<?php

use App\Controller\HomeController;

$home = new HomeController();

echo "<pre>";
print_r($home->index(1));
echo "</pre>";
