<?php
namespace App\Service\PhotoService;

use Doctrine\Persistence\ManagerRegistry;


class PhotoService
{
    public $filename;

    public function __construct($formData, $uploadDirectory) {
        
        if($formData){
            $originalName = $formData->getClientOriginalName();
        
            $filename = $originalName;
            $uploads_directory = $uploadDirectory . "photos/";
            $formData->move(
                $uploads_directory,
                $filename
            );

            $this->filename = $filename;
        }
    
    }

    

    public function getFilename(){

        return $this->filename;

    }

}