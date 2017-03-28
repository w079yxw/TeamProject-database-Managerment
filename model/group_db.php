<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function get_groups() {
    global $db;
    $query = 'SELECT * 
              FROM Groups
              ORDER BY Group_ID';
    $statement = $db->prepare($query);
    $statement->execute();
    $groups = $statement->fetchAll();
    $statement->closeCursor();
    return $groups;       
}

function edit_group( $id,  $name, $descript, $grpldr, $status) {
    global $db;
    $query = 'Update Groups
              SET Group_ID=:id, Group_Name=:name, Group_Description=:descript, Group_Leader_ID = :grpldr, Group_Status = :status
              WHERE Group_ID=:id';
    $statement = $db->prepare($query);
    $statement->bindValue(':id', $id);
    $statement->bindValue(':name', $name);
    $statement->bindValue(':descript', $descript);
    $statement->bindValue(':grpldr', $grpldr);
    $statement->bindValue(':status', $status);
    
    $statement->execute();
    $statement->closeCursor();
    $mbr=search_gp_dpt($grpldr, $id, " ", " ", " ", -1);
    $mgr=search_gp_dpt(" ", $id,"leader", " ", " ", -1);
    $tid= $mgr['GrpMbr_ID'];
        $emid=$mgr['EM_ID'];
        edit_grpmbr($tid, $emid, $id, " ", "Active");
    if($mbr==NULL){
       //search current leader and change the role
        
        $tid1=  get_next_GrpMbr_ID();
        add_grpmbr($tid1, $grpldr, $id, 'Leader', 'Active');
    }
    else {
        $tid2=$mbr['GrpMbr_ID'];
        edit_grpmbr($tid2, $grpldr, $id, 'Leader', 'Active');
    }
}
function searchGrpMbr($id,$option){
    
    switch($option){
    case 0://search if member in the group
       
        break; 
    
    
}}

function get_next_Grp_ID() {
    global $db;
    $query = 'SELECT MAX(Group_ID)
              FROM Groups';
    $statement = $db->prepare($query);
    $statement->execute();
    $row = $statement->fetch(); 
    $next_id = $row[0] + 1;
    return $next_id;
}


function add_group( $id, $name, $descripts, $grpldr, $status) {
    global $db;
    $query = 'INSERT into Groups
              Values (:id, :name, :descripts, :grpldr, :status)';
    $statement = $db->prepare($query);
    $statement->bindValue(':id', $id);
    $statement->bindValue(':name', $name);
    $statement->bindValue(':descripts', $descripts);
    $statement->bindValue(':grpldr', $grpldr);
    $statement->bindValue(':status', $status);
    $statement->execute();
    $statement->closeCursor();       
      //search current leader and change the role
        
        $tid1=  get_next_GrpMbr_ID();
        add_grpmbr($tid1, $grpldr, $id, 'Leader', 'Active');
   
}
function get_grpmbr($id) {
    global $db;
    $query = 'SELECT * 
              FROM TM_Members_Of_Grps 
              WHERE GrpMbr_ID=:id';
    $statement = $db->prepare($query);
    $statement-> bindValue(":id", $id);
    $statement->execute();
    $grpmbr = $statement->fetch();
    $statement->closeCursor();
    return $grpmbr;           
}
function edit_grpmbr( $id,$emid,$grpid,$role,$status) {
    global $db;
    $query = 'Update TM_Members_Of_Grps
              SET  EM_ID=:emid ,Group_ID=:grpid,Group_Role=:role,  Group_Status = :status
              WHERE GrpMbr_ID=:id';
    $statement = $db->prepare($query);
    
    $statement->bindValue(':id', $id);
    $statement->bindValue(':emid', $emid);
    $statement->bindValue(':grpid', $grpid);
    $statement->bindValue(':role', $role);
    $statement->bindValue(':status', $status);
    $statement->execute();
    $statement->closeCursor();          
}
function get_next_GrpMbr_ID() {
    global $db;
    $query = 'SELECT MAX(GrpMbr_ID)
              FROM TM_Members_Of_Grps';
    $statement = $db->prepare($query);
    $statement->execute();
    $row = $statement->fetch(); 
    $next_id = $row[0] + 1;
    return $next_id;
}
    function add_grpmbr( $id,$emid,  $grpid, $role,  $status) {
    global $db;
    $query = 'INSERT into TM_Members_Of_Grps
              Values (:id, :emid, :grpid, :role, :status)';
    $statement = $db->prepare($query);
    $statement->bindValue(':id', $id);
    $statement->bindValue(':emid', $emid);
    $statement->bindValue(':grpid', $grpid);
    $statement->bindValue(':role', $role);
    $statement->bindValue(':status', $status);
    $statement->execute();
    $statement->closeCursor();       
}

?>