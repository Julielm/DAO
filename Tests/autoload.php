<?php
// Autochargement des classes
function __autoload($class) { 
    $dirs = [ "../Classes", "." ];
    $found = false;
    while ((list(,$dir) = each($dirs)) && (! $found)) {
        if (@include_once "$dir/$class.php")
            $found = true;
    }
    if (! $found)
        throw new Exception("Class not found : $class");
}
?>
