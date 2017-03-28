<?php

//user_db.php
//Functions that manage creation of login accounts and process of logging in.
//Author: Zuli Rhodes
//Date: 10/20/2016

//checks to see if the user is valid when logging in
 
function is_valid_user_login($username, $password){
    global $db;
    $encrypted_password = sha1($password);
    $query = 'SELECT User_ID 
             FROM logins 
             WHERE User_name = :username AND 
                   User_Password = :password';
    $statement = $db->prepare($query);
    $statement->bindValue(':username',$username);
    $statement->bindValue(':password', $encrypted_password);
    $statement->execute();  
    $matchingValues = ($statement->rowCount());  
    if( $matchingValues > 0){
        $valid = TRUE;
    } else {
        $valid = FALSE;
    }  
    $statement->closeCursor();
     $GLOBALS['user']=$username;
    return $valid;
}
function getemid($username){
     global $db;
    $query = 'SELECT EM_ID
            FROM logins
            WHERE User_name = :username';
    $statement = $db->prepare($query);
    $statement->bindValue(':username',$username);
    $statement-> execute();
    $row = $statement->fetch(); 
    $id = $row['EM_ID'];
    return $id;
}
//checks to see if the username belongs to an admin
function is_valid_admin($username){
    global $db;
    $query = 'SELECT User_Role
            FROM logins
            WHERE User_name = :username';
    $statement = $db->prepare($query);
    $statement->bindValue(':username',$username);
    $statement-> execute();
    $row = $statement->fetch(); 
    $privilage = $row['User_Role'];
    if( $privilage == 'admin'){
        $valid = TRUE;
    } else {
        $valid = FALSE;
    }  
    $statement->closeCursor();
    return $valid;
}

//returns employee tuples that don't have associated logins
function get_employees_without_logins(){
    global $db;
    //Levar to provide actual query (only show those w/o logins)
    $query = 'SELECT *
              FROM employees';
    $statement = $db->prepare($query);
    $statement-> execute();
    $rows = $statement->fetchAll();
    $statement->closeCursor();
    return $rows;
}

//return list of employee login privilage types
function get_employee_privileges(){
    global $db;
    //Levar to provide actual query (only show those w/o logins)
    //$query = "SHOW COLUMNS FROM logins LIKE User_Role";
    //$result = $db->query($query);
    //$row = $result->fetchRow();
    //$type = $row['Type'];
    //preg_match('/enum\((.*)\)$/', $type, $matches);
    //$vals = explode(',', $matches[1]);
    //$trimmedvals = array();
    //foreach($vals as $key => $value) {
    //    $value=trim($value, "'");
    //   $trimmedvals[] = $value;
    
    $trimmedvals = array('admin','user','view_only');
    return $trimmedvals;
}

//adds a new user to the account
function add_user($username, $password, $privilege, $employee_id) {
    global $db;
    $dateTime = '0000-00-00 00:00:00';
    $encrypted_password = sha1($password);   
    $query = 'INSERT INTO Logins (User_name, User_Password, User_Role, EM_ID, Last_login)'
            . 'VALUES (:username, :password, :privilege, :EM_ID, :Last_login)';
    $statement = $db->prepare($query);
    $statement->bindValue(':username',$username);
    $statement->bindValue(':password', $encrypted_password);
    $statement->bindValue(':privilege', $privilege);
    $statement->bindValue(':EM_ID', $employee_id);
    $statement->bindValue(':Last_login', $dateTime);
    $statement->execute();
    $statement->closeCursor();
}

//Checks to see if the username is unique before creating a new user account
function is_unique_username($username){
    global $db;
    $query = 'SELECT User_ID FROM Logins WHERE User_name = :username';
    $statement = $db->prepare($query);
    $statement->bindValue(':username',$username);
    $statement->execute();   
    $matchingValues = ($statement->rowCount());   
    if( $matchingValues > 0){
        $unique = FALSE;
    } else {
        $unique = TRUE;
    }    
    $statement->closeCursor();

    return $unique;
}

//updates the last_login time variable in the logins table
function set_last_login($username){
    global $db;
    $date = new DateTime("NOW");
    $last_login = $date->format('Y-m-d H:i:s');
    $query = "UPDATE Logins SET Last_login =:last_login FROM Logins WHERE User_name=:username";
    $statement = $db->prepare($query);
    $statement->bindValue(':username',$username);
    $statement->bindValue(':last_login', $last_login);
    $statement->execute();
    $statement->closeCursor();
    global $user;
    $GLOBALS['user']=$username;
    
}
