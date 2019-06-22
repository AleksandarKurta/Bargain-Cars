<?php

class ApiCommentController extends ApiController {

    public function show(){
		$comments = CommentModel::getAll();
		$output = '';
		foreach($comments as  $comment){
			$output .= $comment->comment . "<br>";
		}
		return $output;
    }

	public function addComment(){
		$error = '';
		$comment = filter_input(INPUT_POST, "comment", FILTER_SANITIZE_STRING);
		$userId = Session::get('user_id');
		$postId = filter_input(INPUT_POST, 'postId', FILTER_SANITIZE_NUMBER_INT);
		$parentCommentId = filter_input(INPUT_POST, 'comment_id', FILTER_SANITIZE_NUMBER_INT);

		if(empty($comment)){
			$error .= "<div class='alert alert-danger' role='alert'>Comment is required</div>";
		}

		$data = [
			'comment' => $comment,
			'parent_comment_id' => $parentCommentId,
			'user_id' => $userId,
			'post_id' => $postId
		];
		if($error == ''){
			$addComment = CommentModel::add($data);
		} 

		if($addComment){
			$error .= "<div class='alert alert-success' role='alert'>Comment added</div>";
		}

		$data = [
			'error' => $error
		];

		echo json_encode($data);
	}

    public function showComment($postId){
		$comments = CommentModel::getAllCommentsByPostId($postId);
		$usernames = UserModel::getAllUsernames();
		$users = $this->getUsers();

		foreach($comments as $comment){
			$comment->username = $users[$comment->user_id];
			$buttons = null;
			if(Session::get('user_id') == $comment->user_id){
				$buttons = "<button type='button' class='btn btn-warning edit'>Edit</button><button type='button' class='btn btn-danger delete' id='$comment->comment_id' >Delete</button>";
			}
			$output .=  "<div class='card'><div class='card-header'>By <b>$comment->username</b> on <i>$comment->created_at</i></div><div class='card-body'>$comment->comment</div><div class='card-footer'><button type='button' class='btn btn-default reply' id='$comment->comment_id'>Reply</button>$buttons</div></div>";

			$output .= $this->getReplyComment($comment->comment_id);

		}

        $this->set('output', $output);
	}

	public function deleteComment($commentId){
		$delComment = CommentModel::deleteCommentById($commentId);
	}

	public function getReplyComment($parentId = 0, $marginLeft = 0){
		$comments = CommentModel::getReplyCommentOnParentId($parentId, $marginLeft, $this->getUsers());
		return $comments;
	}

	public function getUsers(){
		$usernames = UserModel::getAllUsernames();
		$users = [];
		foreach($usernames as $username){
			$users[$username->user_id] = $username->username;
		}
		return $users;
	}


}

