<?php

$registered_modules = ['test'];

spl_autoload_register(function($class) {
    global $registered_modules;
    

    foreach($registered_modules as $module) {
        $moduleNamespace = 'PHPX\\' . ucfirst($module); // Beispiel: Namespace\Test
        if(strpos($class, $moduleNamespace) === 0) {
            $relativeClass = str_replace($moduleNamespace . '\\', '', $class);
            $file_modules = __DIR__.'/modules/'.$module.'/'.str_replace('\\', '/', $relativeClass).'.php';
            if(file_exists($file_modules)) {
                require_once $file_modules;
            } 
            break;
        }
    }

    if(strpos($class, 'PHPX\\') === 0) {
        $relativeClass_i = str_replace('PHPX\\', '', $class);
        $file = __DIR__.'/modules/'.str_replace('\\', '/', $relativeClass_i).'.php'; 
        if(file_exists($file)) {
            require_once $file;
        } 
    }
});

?>
