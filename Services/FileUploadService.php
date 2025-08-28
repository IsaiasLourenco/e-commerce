<?php 

namespace App\Services;

class FileUploadService
{
    private $uploadDir;

    public function __construct($uploadDir)
    {
        $this->uploadDir = $uploadDir;
    }

    public function upload($file)
    {
        if (!empty($file['name'])) {
            $filename = uniqid() .'_'. $file['name'];
            $filepath = $this->uploadDir . '/' . $filename;
            move_uploaded_file($file['tmp_name'], $filepath);
            return $filename;
        }
        return null;
    }
}