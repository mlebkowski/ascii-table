<?php

include 'vendor/autoload.php';

$parser = new Nassau\Ascii\TableParser;

$table = file_get_contents('/home/puck/serwisy/api.atiu.pl/dev/data/entities.text');
print_r($parser->parse($table));
