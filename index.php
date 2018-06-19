<?php
require 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';

use App\Tree;

try {
    $tree = new Tree(5);
    $tree->draw();
    $tree->index(4, 2);
    $tree->index(5, 3);
} catch (\Exception $e) {
    echo 'Error: ' . $e->getMessage() . ' | ' . $e->getFile() . ':' . $e->getLine() . "\n";
}
