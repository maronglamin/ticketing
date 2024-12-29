<?php

namespace core;

use core\Router;


class UploadImg 
{
    public static function saveFile($instance)
    {
    $uploadDir = 'public/operations/forms/';
    
    // Check if upload directory exists
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0755, true);
    }

    if (empty($_FILES['upload_file']['name'])) {

        return '/'; // Return / if no file was uploaded
    }

        $fileInfo = pathinfo($_FILES['upload_file']['name']);
        $file_ext = strtolower($fileInfo['extension']);
            
        // Validate file type
        if (! in_array($file_ext, ['jpeg', 'jpg', 'png'])) {
            $instance->error('upload_file', 'File type not supported. Please choose jpg or png file.')->throw();
    }

        // Sanitize filename and create a unique name
        $fileName = uniqid() . '.' . $file_ext;
        $upload_path = $uploadDir . $fileName;

        // Check for successful upload
        if (! move_uploaded_file($_FILES['upload_file']['tmp_name'], $upload_path)) {
            $instance->error('upload_file', 'Failed to move uploaded file.')->throw();
    }

    return '/' . $upload_path;

}

}
