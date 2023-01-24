<?php

namespace Admin;

use Auth\Auth;
class Admin{

        function __construct(){
             
                $this->currentDomain = CURRENT_DOMAIN;
                $this->basePath = BASE_PATH;
        }

        protected function redirect($url)
        {
                header('Location: '. trim($this->currentDomain, '/ ') . '/' . trim($url, '/ '));
                exit;
        }
        
        protected function redirectBack()
        {
                header('Location: '. $_SERVER['HTTP_REFERER']);
                exit;
        }

        protected function saveImage($image, $imageFolder, $imageName = null)
        {

                if($imageName)
                {
                        $extension = explode('/', $image['type'])[1];
                        $imageName = $imageName . '.' . $extension;
                }
                else{
                        $extension = explode('/', $image['type'])[1];
                        $imageName = date("Y-m-d-H-i-s") . '.' . $extension;
                }

                $imageTemp = $image['tmp_name'];
                $imageFolder = 'public/'. $imageFolder . '/';

                if(is_uploaded_file($imageTemp))
                {
                        if(move_uploaded_file($imageTemp, $imageFolder . $imageName)){
                                return $imageFolder. $imageName;
                        }
                        else{
                                return false;
                        }
                }
                else{
                        return false;
                }

        }

        protected function removeImage($path)
        {
                // $path = trim($this->currentDomain, '/ ') . '/' . trim($path, '/ ');
                $path =trim($path, '/ ');
                if(file_exists($path))
                {
                        unlink($path);
                }
        }

}