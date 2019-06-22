<?php

class UserDashboardController extends UserRoleController {

    public function profile(){
        $userId = Session::get('user_id');

        if($userId === NULL){
            Misc::redirect('login/');
        }
    }
}