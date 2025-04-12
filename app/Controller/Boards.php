<?php 

class Boards extends Controller {
    protected $boardModel;
    protected $userModel;

    function __construct (){
        if (!is_user_logged_in()){                                                                          // if user not login -> redirect to login page (this page just show for logged in user)
            Redirect('users/login');
        }

        $this -> boardModel = $this -> model('board');
        $this -> userModel = $this -> model('User');
    }

    function index (){
        $task = $this -> boardModel -> Getwork();

        $data = [
            'task' => $task
        ];

        $this -> view('boards/index', $data);
    }

    function project (){
        $task = $this -> boardModel -> Getwork();

        $data = [
            'task' => $task
        ];

        $this -> view('boards/project', $data);
    }
}