<?php

namespace core;

use core\Router;


class UploadImg 
{

    public static function saveFile($instance)
    {
        $router = new Router();
        
        if (!empty($_FILES['upload_file']['name'])) {
            $file_ext = strtolower(end(explode('.', $_FILES['upload_file']['name'])));

            if(! in_array($file_ext, array('jpeg','jpg','png'))){
                $instance->error(
                    'upload_file', 'File type not supported. Please choose jng, jpg, or jpeg file.'
                )->throw();
            }

            $upload_path = 'public/ticketScreenshots/'. $_FILES['upload_file']['name'];
            move_uploaded_file($_FILES['upload_file']['tmp_name'], $upload_path);
        }
        
        return '/' . $upload_path;

    }
}
