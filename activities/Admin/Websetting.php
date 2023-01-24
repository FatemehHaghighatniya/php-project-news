<?php

namespace Admin;

use database\DataBase;

class Websetting extends Admin
{

        public function index()
        {
                $db = new DataBase();
                $websetting = $db->select('SELECT * FROM `websetting`')->fetch();
               
                require_once(BASE_PATH . '/template/admin/websetting/index.php');
        }


      
        public function edit()
        {
        $db=new DataBase();
        $websetting=$db->select('SELECT * FROM websetting')->fetch();
                require_once(BASE_PATH . '/template/admin/websetting/edit.php');
        }





        public function update($request)
        {
            $db=new DataBase();
            $websetting=$db->select('SELECT * FROM websetting')->fetch();

            if($request['logo']['tmp_name'] != null)
            {
                $request['logo'] = $this->saveImage($request['logo'], 'setting-image' , 'logo');

             }else{
                unset($request['logo']);
             }

/////////////////////////
             if($request['icon']['tmp_name'] != null)
            {
                $request['icon'] = $this->saveImage($request['icon'], 'setting-image' , 'icon');

             }else{
                unset($request['icon']);
             }
 
                if(!empty($websetting)){

                    $db->update('websetting',$websetting['id'], array_keys($request), $request);

                }
                else{
                    $db->insert('websetting',array_keys($request) , $request);

                }
$this->redirect('admin/websetting');
}
           }
        