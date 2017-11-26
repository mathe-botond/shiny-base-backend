<?php
namespace ShinyBaseWeb;
use QeyWork\QeyWork;

include "boot.php";

$website = QeyWork::createWebsite(ShinyBaseWeb::class);
echo $website->getAsRenderer()->render();