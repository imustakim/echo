<?php 
// application/models/UserModel.class.php

class UserModel extends Model{

    public function getUsers(){

        $sql = "SELECT * FROM $this->table";
        $users = $this->db->getAll($sql);
        return $users;
    }

    
}