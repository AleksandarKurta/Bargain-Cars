<?php

class AdminPostController extends Controller {

    public function index(){
       
        $posts = PostModel::getAll();
        $users_ids = UserModel::getAll();
        $users = [];
        foreach($users_ids as $user){
            $users[$user->user_id] = $user->username;
        }

        $this->set('posts',$posts);
        $this->set('users',$users);
    }

    public function posts(){
        $posts = PostModel::getAll();
        $users_ids = UserModel::getAll();
        $users = [];
        foreach($users_ids as $user){
            $users[$user->user_id] = $user->username;
        }

        $this->set('posts',$posts);
        $this->set('users',$users);
    }

    public function showPost($id){
        $this->set('post', PostModel::getById($id));
        $this->set('posts', PostModel::getAll());
        $user = UserModel::getById($id);
    }

}