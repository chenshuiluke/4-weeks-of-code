<?php

function autoLoader($class){
    $possibilities = [];

    $possibilities['original'] = $class;
    $possibilities['lowercase'] = strtolower($class);
    $possibilities['withoutNamespace'] = substr($class, strrpos($class, '\\') + 1);
    $possibilities['lowercaseWithoutNamespace'] = strtolower($possibilities['withoutNamespace']);

    foreach($possibilities as $possibility){
        include_once "../app/{$possibility}.php";
        include_once "../app/controllers/{$possibility}.php";        
        //var_dump(get_included_files());
    }


    
}
spl_autoload_register('autoLoader');

?>