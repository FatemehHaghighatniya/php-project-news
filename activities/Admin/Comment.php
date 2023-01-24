<?php

namespace Admin;

use database\DataBase;

class Comment extends Admin
{

        public function index()
        {
                $db = new DataBase();
                $comments = $db->select('SELECT comments.* , users.username AS user_name , posts.title AS post_title FROM comments LEFT JOIN users ON comments.user_id = users.id LEFT JOIN posts ON comments.post_id = posts.id ORDER BY `id` DESC')->fetchAll();
                $unseens=$db->select('SELECT * FROM comments WHERE status =?' , ['unseen']);
                foreach($unseens as $unseen){
                        $db->update('comments' , $unseen['id'],['status'],['seen']);
                }
                require_once(BASE_PATH . '/template/admin/comments/index.php');
        }

        public function changeSatus($id){

                $db=new DataBase();
                $comment=$db->select('SELECT * FROM comments WHERE id = ?' , [$id])->fetch();
                if($comment){
                        if($comment['status'] == 'seen'){
                                $db->update('comments', $id , ['status'] , ['approved']);
                        }
                        else{
                                $db->update('comments', $id , ['status'] , ['seen']);

                        }
                }
                $this->redirectBack();

        }

}