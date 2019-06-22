<?php

class UserRoleController extends Controller {

    public function __pre(){
        $userId = Session::get('user_id');

        if($userId === NULL){
            Misc::redirect('login/');
        }
    }
}