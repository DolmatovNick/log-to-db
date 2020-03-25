<?php

include 'vendor/autoload.php';

PrepareStructures::exec();

try {
    (new ImportFileLog())->import('./logs/1.txt', 10);
    (new ImportFileIp())->import('./logs/2.txt', 10);
    header("Location: /index.php");
} catch (\Exception $ex) {
    echo $ex->getMessage();
}