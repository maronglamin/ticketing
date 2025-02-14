<?php

namespace http\resource\view;

use eftec\bladeone\BladeOne;


class Render 
{
    public static function view($path, $attributes = [])
    {
        extract($attributes);
    
        require base_path('view/partial/resource/head.php');
        require base_path('view/partial/resource/nav.php');
        require base_path('view/partial/resource/pagesNav.php');
        require base_path('view/partial/resource/KPI.php');    

        // Initialize BladeOne
        $blade = new BladeOne(BASE_PATH . 'view', BASE_PATH . 'cache/reports', BladeOne::MODE_AUTO);
    
        // Convert the template path to Blade's format
        $bladeTemplate = str_replace('/', '.', $path);
    
        // Render the template with data
        echo $blade->run($path, $attributes);

        require base_path('view/partial/resource/footer.php');    

    }
}