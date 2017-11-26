<?php
namespace ShinyBaseWeb;
use QeyWork\QeyWork;

include "boot.php";

$website = QeyWork::createWebsite(ShinyBaseWeb::class);
$website->getAsProcessor()->run();