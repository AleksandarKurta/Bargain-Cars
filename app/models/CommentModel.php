<?php

class CommentModel extends Model {

    public static function getAllCommentsByPostId($postId){
        $SQL = "SELECT * FROM comment WHERE post_id = ? AND parent_comment_id = 0 ORDER BY comment_id DESC;";
        $prep = DataBase::getInstance()->prepare($SQL);
        $res = $prep->execute([$postId]);
        if($res){
            return $prep->fetchAll(PDO::FETCH_OBJ);
        }else{
            return [];
        }
    }

    public static function deleteCommentById($commentId){
        $SQL = "DELETE FROM comment WHERE comment_id = ? OR parent_comment_id = ?;";
        $prep = DataBase::getInstance()->prepare($SQL);
        if($prep){
            return $prep->execute([$commentId, $commentId]);
        }else{
            return false;
        }
    }

    public static function getReplyCommentOnParentId($parentId = 0, $marginLeft = 0, $users){
        $output = '';
        $SQL = "SELECT * FROM comment WHERE parent_comment_id = ?;";
        $prep = DataBase::getInstance()->prepare($SQL);
        $prep->execute([$parentId]);
        $marginLeft += 48;
        $comments = $prep->fetchAll(PDO::FETCH_OBJ);
            foreach($comments as $comment){
                $comment->username = $users[$comment->user_id];
                $buttons = null;
                if(Session::get('user_id') == $comment->user_id){
                    $buttons = "<button type='button' class='btn btn-warning edit'>Edit</button><button type='button' class='btn btn-danger delete' id='$comment->comment_id' >Delete</button>";
                }
                $output .= '
                <div class="card" style="margin-left:'.$marginLeft.'px">
                    <div class="card-header">By <strong>'.$comment->username. '</strong><b></b> on <i>'.$comment->created_at.'</i></div>
                    <div class="card-body">'.$comment->comment.'</div>
                    <div class="card-footer" align="right"><button type="button" class="btn btn-default reply" id="'.$comment->comment_id.'">Reply</button>'.$buttons.'</div>
                </div>';

                $output .= self::getReplyCommentOnParentId($comment->comment_id, $marginLeft, $users);
            }
        return $output;
    }
}