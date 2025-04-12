<?php

class Tasks extends controller {
    protected $taskModel;
    protected $userModel;

    function __construct (){
        if (!is_user_logged_in()){                                                                          // if user not login -> redirect to login page (this page just show for logged in user)
            Redirect('users/login');
        }

        $this -> taskModel = $this -> model('task');
        $this -> userModel = $this -> model('User');
    }

    function index (){
        $tasks = $this -> taskModel -> Gettask();

        $data = [
            'task' => $tasks
        ];

        $this -> view('tasks/index', $data);
    }

    function add (){
        if ($_SERVER['REQUEST_METHOD'] == 'POST'){
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_SPECIAL_CHARS);
            $users = $this -> userModel -> GetUsers();

            $data = [
                'users' => $users,
                'user_id' => $_SESSION['user_id'],
                'title' => trim($_POST['title']),
                'project_name' => trim($_POST['project_name']),
                'content' => trim($_POST['content']),
                'undertaking' => trim($_POST['undertaking']),
                'preference' => trim($_POST['preference']),
                'deadline' => trim($_POST['deadline']),
                'status' => trim($_POST['status']),
                'title_error' => '',
                'project_name_error' => '',
                'content_error' => '',
                'undertaking_error' => '',
                'preference_error' => '',
                'deadline_error' => '',
                'status_error' => '',
            ];

            $returning = true;

            if (empty($data['title'])){
                $data['title_error'] = 'عنوان پروژه نمیتواند خالی باشد';
                $returning = false;
            }

            if (empty($data['project_name'])){
                $data['title_error'] = 'نام پروژه نمیتواند خالی باشد';
                $returning = false;
            }
            
            if (empty($data['content'])){
                $data['project_name_error'] = 'شرح پروژه نمیتواند خالی باشد';
                $returning = false;
            }

            if (empty($data['undertaking'])){
                $data['undertaking_error'] = 'مسئول نمیتواند خالی باشد';
                $returning = false;
            }

            if (empty($data['preference'])){
                $data['preference_error'] = 'اولویت نمیتواند خالی باشد';
                $returning = false;
            }

            if (empty($data['deadline'])){
                $data['deadline_error'] = 'مهلت تحویل نمیتواند خالی باشد';
                $returning = false;
            }

            if (empty($data['status'])){
                $data['status_error'] = 'وضعیت نمیتواند خالی باشد';
                $returning = false;
            }


            if ($returning){
                if ($this -> taskModel -> Addtask($data)){
                    flash('task_message', 'پروژه اضافه شد');
                    Redirect('tasks/index');
                } else {
                    die ('add task error');
                }

            } else {
                $this -> view('tasks/add', $data);
            }
            
        } else {
            $users = $this -> userModel -> GetUsers();

            $data = [
                'users' => $users,
                'title' => '',
                'project_name' => '',
                'content' => '',
                'undertaking' => '',
                'preference' => '',
                'deadline' => '',
                'status' => '',
                'title_error' => '',
                'project_name_error' => '',
                'content_error' => '',
                'undertaking_error' => '',
                'preference_error' => '',
                'deadline_error' => '',
                'status_error' => '',
            ];

            $this -> view('tasks/add', $data);
        }
    }

    function show ($id){
        $task = $this -> taskModel -> GetTaskById($id);                                            // receve task id and get task info
        $user = $this -> userModel -> GetUserById($task -> user_id);                                     // receve user id and get user info

        $data = [
            'task' => $task,
            'user' => $user
        ];

        $this -> view('tasks/show', $data);
    }

    function edit ($id){
        if ($_SERVER['REQUEST_METHOD'] == 'POST'){
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_SPECIAL_CHARS);

            $data = [
                'id' => $id,
                'user_id' => $_SESSION['user_id'],
                'title' => trim($_POST['title']),
                'project_name' => trim($_POST['project_name']),
                'content' => trim($_POST['content']),
                'undertaking' => trim($_POST['undertaking']),
                'preference' => trim($_POST['preference']),
                'deadline' => trim($_POST['deadline']),
                'status' => trim($_POST['status']),
                'title_error' => '',
                'project_name_error' => '',
                'content_error' => '',
                'undertaking_error' => '',
                'preference_error' => '',
                'deadline_error' => '',
                'status_error' => '',
            ];

            $returning = true;

            if (empty($data['title'])){
                $data['title_error'] = 'عنوان پروژه نمیتواند خالی باشد';
                $returning = false;
            }

            if (empty($data['project_name'])){
                $data['title_error'] = 'نام پروژه نمیتواند خالی باشد';
                $returning = false;
            }
            
            if (empty($data['content'])){
                $data['project_name_error'] = 'شرح پروژه نمیتواند خالی باشد';
                $returning = false;
            }

            if (empty($data['undertaking'])){
                $data['undertaking_error'] = 'مسئول نمیتواند خالی باشد';
                $returning = false;
            }

            if (empty($data['preference'])){
                $data['preference_error'] = 'اولویت نمیتواند خالی باشد';
                $returning = false;
            }

            if (empty($data['deadline'])){
                $data['deadline_error'] = 'مهلت تحویل نمیتواند خالی باشد';
                $returning = false;
            }

            if (empty($data['status'])){
                $data['status_error'] = 'وضعیت نمیتواند خالی باشد';
                $returning = false;
            }

            if ($returning){
                if ($this -> taskModel -> Updatetask($data)){
                    flash('task_message', 'پروژه ویرایش شد');
                    Redirect('tasks/index');
                } else {
                    die ('update task error');
                }

            } else {
                $this -> view('tasks/edit', $data);
            }

        } else {
            $task = $this -> taskModel -> GetTaskById($id);
            
            // check content owner
            if ($task -> user_id != $_SESSION['user_id']){
                Redirect('tasks/index');
            }

            $data = [
                'id' => $id,
                'title' => $task -> title,
                'project_name' => $task -> project_name,
                'content' => $task -> content,
                'undertaking' => $task -> undertaking,
                'preference' => $task -> preference,
                'deadline' => $task -> deadline,
                'status' => $task -> status,
                'title_error' => '',
                'project_name_error' => '',
                'content_error' => '',
                'undertaking_error' => '',
                'preference_error' => '',
                'deadline_error' => '',
                'status_error' => '',
            ];

            $this -> view('tasks/edit', $data);
        }
    }

    function delete ($id){
        if ($_SERVER['REQUEST_METHOD'] == 'POST'){
            
            $task = $this -> taskModel -> GetTaskById($id);

            // check contetn owner
            if ($task -> user_id != $_SESSION['user_id']){
                Redirect('tasks/index');
            }

            if ($this -> taskModel -> Deletetask($id)){
                flash('task_message', 'مقاله حذف شد');
                Redirect('tasks/index');
            } else {
                die ('delete task error');
            }

        } else {
            Redirect('tasks/index');
        }
    }
}