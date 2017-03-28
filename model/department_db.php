<?php

//returns all departments
function get_departments() {
    global $db;
    $query = 'SELECT * 
              FROM Departments
              ORDER BY Dept_ID';
    $statement = $db->prepare($query);
    $statement->execute();
    $departments = $statement->fetchAll();
    $statement->closeCursor();
    return $departments;       
}

function edit_department( $id,  $name, $descript, $mgrid, $status) {
      
    
    global $db;
    $query = 'Update Departments
              SET Dept_ID=:id, Dept_Name=:name, Dept_Description=:descript, Manager_ID = :mgrid, Dept_Status = :status
              WHERE Dept_ID=:id';
    $statement = $db->prepare($query);
    $statement->bindValue(':id', $id);
    $statement->bindValue(':name', $name);
    $statement->bindValue(':descript', $descript);
    $statement->bindValue(':mgrid', $mgrid);
    $statement->bindValue(':status', $status);
    
    $statement->execute();
    $statement->closeCursor();     
    $mbr=search_gp_dpt($mgrid, " ", " ", $id, " ", -1);
    $mgr=search_gp_dpt(" ", " "," ", $id, 'manager', -1);
    $tid= $mgr['Role_ID'];
        $emid=$mgr['EM_ID'];
        edit_role($tid, " ", " ", $id, $emid, "Active");
    if($mbr==NULL){
       //search current leader and change the role
        
        $tid1= get_next_Role_ID();
        add_role($tid1, "manager", "manager of the department", $id, $mgrid, "Active");
    }
    else {
        $tid2=$mbr['Role_ID'];
        edit_role($tid2, "manager", "manager of the department", $id, $mgrid, "Active");
    }
}
function get_next_Dept_ID() {
    global $db;
    $query = 'SELECT MAX(Dept_ID)
              FROM Departments';
    $statement = $db->prepare($query);
    $statement->execute();
    $row = $statement->fetch(); 
    $next_id = $row[0] + 1;
    return $next_id;
}
function add_department( $id, $name, $descripts, $mrgid, $status) {
    global $db;
    $query = 'INSERT into Departments
              Values (:id, :name, :descripts, :mrgid, :status)';
    $statement = $db->prepare($query);
    $statement->bindValue(':id', $id);
    $statement->bindValue(':name', $name);
    $statement->bindValue(':descripts', $descripts);
    $statement->bindValue(':mrgid', $mrgid);
    $statement->bindValue(':status', $status);
    $statement->execute();
    $statement->closeCursor();       
    $tid1= get_next_Role_ID();
        add_role($tid1, "manager", "manager of the department", $id, $mrgid, "Active");
   
}
function get_roles() {
    global $db;
    $query = 'SELECT * 
              FROM Roles
              ';
    $statement = $db->prepare($query);
    $statement->execute();
    $role = $statement->fetchAll();
    $statement->closeCursor();
    return $role;       
}
function edit_role( $id,  $name, $descript, $depid,$emid, $status) {
    
       global $db;
    $query = 'Update Roles
              SET Role_ID=:id, Role_Name=:name, Role_Description=:descript, Dept_ID = :depid,EM_ID=:emid, Role_Status = :status
              WHERE Role_ID=:id';
    $statement = $db->prepare($query);
    $statement->bindValue(':id', $id);
    $statement->bindValue(':name', $name);
    $statement->bindValue(':descript', $descript);
    $statement->bindValue(':depid', $depid);
    $statement->bindValue(':emid', $emid);
    $statement->bindValue(':status', $status);
    
    $statement->execute();
    $statement->closeCursor();          
}
function get_next_Role_ID() {
    global $db;
    $query = 'SELECT MAX(Role_ID)
              FROM Roles';
    $statement = $db->prepare($query);
    $statement->execute();
    $row = $statement->fetch(); 
    $next_id = $row[0] + 1;
    return $next_id;
}
function add_role( $id, $name, $descripts, $dpid, $emid,$status) {
    global $db;
    $query = 'INSERT into Roles
              Values (:id, :name, :descripts, :dpid, :emid,:status)';
    $statement = $db->prepare($query);
    $statement->bindValue(':id', $id);
    $statement->bindValue(':name', $name);
    $statement->bindValue(':descripts', $descripts);
    $statement->bindValue(':dpid', $dpid);
    $statement->bindValue(':emid', $emid);
    $statement->bindValue(':status', $status);
    $statement->execute();
    $statement->closeCursor();       
}