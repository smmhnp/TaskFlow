<?php

class Users extends Controller {  
    protected $userModel;
      
    function __construct (){
        $this -> userModel = $this -> model ('user');
    }

    function register (){
        if ($_SERVER['REQUEST_METHOD'] == 'POST'){                                                          // if data sended whit post method :
            // secure data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_SPECIAL_CHARS);

            // init data
            $data = [
                "name" => trim($_POST['name']),
                "nickname" => trim($_POST['nickname']),
                "email" => trim($_POST['email']),
                "role" => trim($_POST['role']),
                "unit" => trim($_POST['unit']),
                "password" => trim($_POST['password']),
                "confirm_password" => trim($_POST['confirm_password']),
                "name_error" => '',
                "nickname_error" => '',
                "email_error" => '',
                "role_error" => '',
                "unit_error" => '',
                "password_error" => '',
                "confirm_password_error" => ''
            ];

            $error = true;

            // validation name
            if (empty($data['name'])){
                $data['name_error'] = "لطفا نام را وارد کنید";
                $error = false;
            }

            // validation nickname
            if (empty($data['nickname'])){
                $data['nickname_error'] = "لطفا نام مستعار را وارد کنید";
                $error = false;
            } else if ($this -> userModel -> FindUserByNickname($data['nickname'])){
                $data['nickname_error'] = "نام مستعار قبلا انتخاب شده";
                $error = false;
            }
            
            // validation email
            if (empty($data['email'])){                                                                     // check email field not empty
                $data['email_error'] = "لطفا ایمیل را وارد کنید";
                $error = false;
            } else if ($this -> userModel -> FindUserByEmail($data['email'])){                              // check repetitive email
                    $data['email_error'] = "ایمیل قبلا انتخاب شده";
                    $error = false;
            }

            // valitation role
            if (empty($data['role'])){
                $data['role_error'] = "لطفا نقش را وارد کنید";
                $error = false;
            }
            
            switch ($data['role']):
                case 'توسعه دهنده':
                    $data['role'] = 'developer';
                    break;
                case 'مدیر':
                    $data['role'] = 'admin';
                    break;
                default:
                    $data['role'] = 'user';
                    break;
            endswitch;

            // validation unit
            if (empty($data['unit'])){
                $data['unit_error'] = "لطفا واحد کاری را وارد کنید";
                $error = false;
            }
            
            // validation password
            if (empty($data['password'])){
                $data['password_error'] = "لطفا رمز عبور خود را وارد کنید";
                $error = false;
            } else if (strlen($data['password'] < 6)) {
                $data['password_error'] = "تعداد حروف رمز عبور باید بیشتر از شش کاراکتر باشد";
                $error = false;
            }
            
            // validation confirm password
            if (empty($data['confirm_password'])){
                $data['confirm_password_error'] = "لطفا تکرار رمز عبور خود را وارد کنید";
                $error = false;
            } else if ($data['password'] != $data['confirm_password']) {
                $data['confirm_password_error'] = "تکرار رمز عبور با رمز عبور مطابقت ندارد";
                $error = false;
            }

            // make sure all data validated
            if ($error){

                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);                     // hash password

                if ($this -> userModel -> register ($data)){
                    flash('register_success', 'کاربر جدید با موفقیت اضافه شد');                                  // create success maesage and show message on login page
                    Redirect('users/admin');
                } else {
                    die ('Error register');
                }

            } else {
                $this -> view ("users/register", $data);
            }

        } else {                                                                                            // if data sended whit get method :
            if ($_SESSION['user_role'] != 'admin'){
                Redirect("tasks/index");
            }

            $data = [
                "name" => '',
                "nickname" => '',
                "email" => '',
                "role" => '',
                "unit" => '',
                "password" => '',
                "confirm_password" => '',
                "name_error" => '',
                "nickname_error" => '',
                "email_error" => '',
                "role_error" => '',
                "unit_error" => '',
                "password_error" => '',
                "confirm_password_error" => ''
            ];

            $this -> view("users/register", $data);
        }
    }

    function login (){
        if ($_SERVER['REQUEST_METHOD'] == "POST"){
           // secure data
           $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_SPECIAL_CHARS);

           // init data
            $data = [
               "email" => trim($_POST['email']),
               "password" => trim($_POST['password']),
               "email_error" => '',
               "password_error" => '',
            ];

            // validation email
            if (empty($data['email'])){
                $data['email_error'] = "لطفا ایمیل خود را وارد کنید";
            } elseif ($this -> userModel -> FindUserByEmail($data['email'])){
                // user email found
            } else {
                $data['email_error'] = "کاربری با این ایمیل یافت نشد";
            }
            
            // validation password
            if (empty($data['password'])){
                $data['password_error'] = "لطفا رمز عبور خود را وارد کنید";
            }
            
            // make sure all data validated
            if (empty($data['email_error']) and empty($data['password_error'])){
                $loggedIn = $this -> userModel -> login($data);                                             // save user info or save false

                if ($loggedIn){
                    $this -> CreateUserSession($loggedIn);
                } else {
                    $data['password_error'] = 'رمز عبور نادرست است';
                    $this -> view ("users/login", $data);
                }

            } else {
                $this -> view ("users/login", $data);
            }

        } else {
            if (is_user_logged_in()){
                Redirect('tasks/index');
            }

            $data = [
                "email" => '',
                "password" => '',
                "email_error" => '',
                "password_error" => '',
            ];

            $this -> view ("users/login", $data);
        }
    }

    function profile (){
        if ($_SERVER['REQUEST_METHOD'] == 'GET'){
            if (!is_user_logged_in()){
                Redirect('users/login');
            }

            $user = $this -> userModel -> GetUserById($_SESSION['user_id']);

            $data = [
                'user' => $user,
                'current_password_error' => '',
                'new_password_error' => '',
                'confirm_new_password_error' => ''
            ];

            $this -> view("users/profile", $data);

        } else {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_SPECIAL_CHARS);
            
            $user = $this -> userModel -> GetUserById($_SESSION['user_id']);
            $user_password = $user -> password;
            $error = true;

            $data = [
                'user' => $user,
                'current_password' => $_POST['current_password'],
                'new_password' => $_POST['new_password'],
                'confirm_new_password' => $_POST['confirm_new_password'],
                'current_password_error' => '',
                'new_password_error' => '',
                'confirm_new_password_error' => ''
            ];
            

            if (empty($data['current_password'])){
                $data['current_password_error'] = "رمز عبور فعلی را وارد کنید";
                $error = false;
            } elseif (!password_verify($data['current_password'], $user_password)){
                $data['current_password_error'] = "رمز عبور فعلی نادرست است";
                $error = false;
            }
            

            if (empty($data['new_password'])){
                $data['new_password_error'] = "رمز عبور جدید را وارد کنید";
                $error = false;
            } elseif (strlen($data['new_password']) < 6){
                $data['new_password_error'] = "رمزعبور باید بیشتر از 6 کاراکتر باشد";
                $error = false;
            }

            if(empty($data['confirm_new_password'])){
                $data['confirm_new_password_error'] = "تکرار رمزعبور را وارد کنید";
                $error = false;
            } elseif ($data['new_password'] != $data['confirm_new_password']){
                $data['confirm_new_password_error'] = "تکرار رمز عبور با رمز عبور جدید یکسان نیست";
                $error = false;
            }

            if ($error) {
                if ($this -> userModel -> passwordUpdate ($data)){
                    flash('password_update', 'رمز عبور با موفقیت ویرایش شد');
                    Redirect('users/profile');
                }
            } else {
                $this -> view('users/profile', $data);
            }  
        }
    }

    function admin (){
        if ($_SERVER['REQUEST_METHOD'] == 'GET'){
            if (!is_user_logged_in()){
                Redirect('users/login');
            }

            if ($_SESSION['user_role'] != 'admin'){
                Redirect('tsaks/index');
            }

            $users = $this -> userModel -> GetUsers();

            $data = [
                'users' => $users
            ];

            $this -> view("users/admin", $data);

        } else {

        }
    }

    function CreateUserSession ($user){
        $_SESSION['user_id'] = $user -> id;
        $_SESSION['user_name'] = $user -> name;
        $_SESSION['user_email'] = $user -> email;
        $_SESSION['user_role'] = $user -> role;

        Redirect('tasks/index');                                                                               // when user success login redirect to define page or file 
    }


    function logout (){
        unset($_SESSION['user_id']);
        unset($_SESSION['user_name']);
        unset($_SESSION['user_email']);

        session_destroy();

        Redirect('users/login');
    }
}