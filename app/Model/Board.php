<?php 

class Board {
    private $db;

    function __construct (){
        $this -> db = new Database;
    }

    function Getwork (){
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

    function GetWorkById ($id){
        $this -> db -> query ('SELECT * FROM task WHERE id = :id');
        $this -> db -> bind(':id', $id);
        return $this -> db -> fetch();
    }
}