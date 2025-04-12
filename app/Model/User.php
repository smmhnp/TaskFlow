<?php

class User {
    private $db;

    function __construct (){
        $this -> db = new Database;
    }

    // find user by email
    function FindUserByEmail ($email){
        $this -> db -> query('SELECT * FROM `users` WHERE email = :email');
        $this -> db -> bind('email', $email);                                                               // Bidn parameter
        $this -> db -> fetch();                                                                             // Execute 

        if ($this -> db -> RowCount() > 0){
            return true;                                                                                    // Check row (if find row -> find email and email is repetitive)
        }
        return false;
    }

    function FindUserByNickname ($nickname){
        $this -> db -> query('SELECT * FROM `users` WHERE nickname = :nickname');
        $this -> db -> bind('nickname', $nickname);
        $this -> db -> fetch();

        if ($this -> db -> RowCount() > 0){
            return true;  
        }
        return false;
    }

    function GetUserById ($id){
        $this -> db -> query ('SELECT * FROM users WHERE id = :id');
        $this -> db -> bind(':id', $id);
        return $this -> db -> fetch();
    }

    function GetUsers (){
        $this -> db -> query("
            SELECT * FROM `users` WHERE 1
        ");
        
        return $this -> db -> fetchAll();
    }

    // register User
    function register ($data){                  
        $this -> db -> query ('
            INSERT INTO `users` (role, unit, name, nickname, email, password)
            VALUES (:role, :unit, :name, :nickname, :email, :password)
        ');

        $this -> db -> bind (':role', $data['role']);
        $this -> db -> bind (':unit', $data['unit']);
        $this -> db -> bind (':name', $data['name']);
        $this -> db -> bind (':nickname', $data['nickname']);
        $this -> db -> bind (':email', $data['email']);
        $this -> db -> bind (':password', $data['password']);

        if ($this -> db -> execute()){
            return true;
        }
        return false;
    }

    // check user exists
    function login ($data){
        $this -> db -> query('SELECT * FROM `users` WHERE email = :email');
        $this -> db -> bind(':email', $data['email']);
        $row = $this -> db -> fetch();
        $hash_password = $row -> password;

        if (password_verify($data['password'], $hash_password)){
            return $row;
        }
        return false;
    }

    function passwordUpdate ($data){
        $this -> db -> query ("
            UPDATE `users` SET 
            `password`= :password
            WHERE id = :id
        ");

        $hash_password = password_hash($data['new_password'], PASSWORD_DEFAULT);

        $this -> db -> bind(':password', $hash_password);
        $this -> db -> bind(':id', $_SESSION['user_id']);

        if ($this -> db -> execute()){
            return true;
        }
        return false;
    }
}