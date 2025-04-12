<?php

class task {
    private $db;

    function __construct (){
        $this -> db = new Database;
    }

    function Gettask (){
        // task.id as taskID -> mean: from task table in mvc database, id column save as taskID
        // ON task.user_id = users.id -> mean: on task table, user_id column just show row that equal to users table, id column
        // ORDER BY task.CreateDate DESC -> mean: sort tasks from newwst ti oldest

        $this->db->query("
            SELECT 
                task.id,
                task.user_id,
                task.title,
                task.project_name,
                task.content,
                task.undertaking,
                task.preference,
                task.deadline,
                task.status,
                users.id AS userID
            FROM 
                task
            INNER JOIN 
                users 
            ON 
                task.user_id = users.id
            ORDER BY 
                task.deadline DESC;
        ");

        return $this -> db -> fetchAll();
    }

    function Addtask ($data){
        $this -> db -> query ('
            INSERT INTO `task`
            (`user_id`, `title`, `project_name`, `content`, `undertaking`, `preference`, `deadline`, `status`) 
            VALUES (:user_id, :title, :project_name, :content, :undertaking, :preference, :deadline, :status)
        ');

        
        $this -> db -> bind(':title', $data['title']);
        $this -> db -> bind(':user_id', $data['user_id']);
        $this -> db -> bind(':project_name', $data['project_name']);
        $this -> db -> bind(':content', $data['content']);
        $this -> db -> bind(':undertaking', $data['undertaking']);
        $this -> db -> bind(':preference', $data['preference']);
        $this -> db -> bind(':deadline', $data['deadline']);
        $this -> db -> bind(':status', $data['status']);

        if ($this -> db -> execute()){
            return true;
        }
        return false;
    }

    function GetTaskById ($id){
        $this -> db -> query ('SELECT * FROM task WHERE id = :id');
        $this -> db -> bind(':id', $id);
        return $this -> db -> fetch();
    }

    function Updatetask ($data){
        $this -> db -> query ('
            UPDATE `task` SET 
            `title` = :title,
            `project_name` = :project_name,
            `content` = :content,
            `undertaking` = :undertaking,
            `preference` = :preference,
            `deadline` = :deadline,
            `status` = :status
            WHERE id = :id
        ');

        $this -> db -> bind(':title', $data['title']);
        $this -> db -> bind(':project_name', $data['project_name']);
        $this -> db -> bind(':content', $data['content']);
        $this -> db -> bind(':undertaking', $data['undertaking']);
        $this -> db -> bind(':preference', $data['preference']);
        $this -> db -> bind(':deadline', $data['deadline']);
        $this -> db -> bind(':status', $data['status']);
        $this -> db -> bind(':id', $data['id']);
        
        if ($this -> db -> execute()){
            return true;
        }
        return false;
    }

    function Deletetask ($id){
        $this -> db -> query ('DELETE FROM `task` WHERE id = :id');
        $this -> db -> bind(':id', $id);

        if ($this -> db -> execute()){
            return true;
        }
        return false;
    }
}