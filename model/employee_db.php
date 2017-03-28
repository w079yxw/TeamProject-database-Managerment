<?php

function get_members_by_department($department_id) {
    global $db;
    $query = 'SELECT * 
              FROM employees 
              WHERE employees.EM_Department_ID = :dept_id
              ORDER BY memberID';
    $statement = $db->prepare($query);
    $statement-> bindValue(":dept_id", $department_id);
    $statement->execute();
    $employees = $statement->fetchAll();
    $statement->closeCursor();
    return $employees;           
}

//returns employees based on employee ID
function get_employee($employee_id) {
    global $db;
    $query = 'SELECT * 
              FROM Employees 
              WHERE EM_ID = :employee_id';
    $statement = $db->prepare($query);
    $statement-> bindValue(":employee_id", $employee_id);
    $statement->execute();
    $employee = $statement->fetch();
    $statement->closeCursor();
    return $employee;           
}

//returns all employees
function get_employees() {
    global $db;
    $query = 'SELECT * 
              FROM Employees 
              ORDER BY EM_Lastname';
    $statement = $db->prepare($query);
    $statement->execute();
    $employees = $statement->fetchAll();
    $statement->closeCursor();
    return $employees;       
}

        $employee_id = filter_input(INPUT_POST, 'em_id');
        $fname = filter_input(INPUT_POST, 'fname');
        $mname = filter_input(INPUT_POST, 'mname');
        $lname = filter_input(INPUT_POST, 'lname');
        $email = filter_input(INPUT_POST, 'email');
        $phone = filter_input(INPUT_POST, 'phone');
        $status = filter_input(INPUT_POST, 'status');
        $dept_id = filter_input(INPUT_POST, 'dept_id');

function add_employee( $employee_id, $fname, $mname, $lname, $email, $phone, $status, $dept_id) {
    global $db;
    $query = 'INSERT into Employees
              Values (:em_id, :fname, :mname, :lname, :email, :phone, :status, :dept_id)';
    $statement = $db->prepare($query);
    $statement->bindValue(':em_id', $employee_id);
    $statement->bindValue(':fname', $fname);
    $statement->bindValue(':mname', $mname);
    $statement->bindValue(':lname', $lname);
    $statement->bindValue(':email', $email);
    $statement->bindValue(':phone', $phone);
    $statement->bindValue(':status', $status);
    $statement->bindValue(':dept_id', $dept_id);
    $statement->execute();
    $statement->closeCursor();  
     $roleid=  get_next_Role_ID();
     add_role($roleid, " ", " ", $dept_id, $employee_id, 'Active');
        
}

function get_next_EM_ID() {
    global $db;
    $query = 'SELECT MAX(EM_ID)
              FROM Employees';
    $statement = $db->prepare($query);
    $statement->execute();
    $row = $statement->fetch(); 
    $next_id = $row[0] + 1;
    return $next_id;
}

function edit_employee( $employee_id, $fname, $mname, $lname, $email, $phone, $status, $dept_id) {
    global $db;
    $query = 'Update Employees
              SET EM_Firstname=:fname, EM_Middlename=:mname, EM_Lastname=:lname, EM_Email=:email, EM_Phone=:phone, EM_Status=:status, EM_Department_ID=:dept_id
              WHERE EM_ID=:em_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':em_id', $employee_id);
    $statement->bindValue(':fname', $fname);
    $statement->bindValue(':mname', $mname);
    $statement->bindValue(':lname', $lname);
    $statement->bindValue(':email', $email);
    $statement->bindValue(':phone', $phone);
    $statement->bindValue(':status', $status);
    $statement->bindValue(':dept_id', $dept_id);
    $statement->execute();
    $statement->closeCursor();   
    $row= search_gp_dpt($employee_id, " ", " ", $dept_id, " ", -1);
    if($row==NULL){
        $roleid=  get_next_Role_ID();
        add_role($roleid, " ", " ", $dept_id, $employee_id, 'Active');
        
    }
    
    
}

function is_existing_employee($em_id){
    global $db;
    $query = 'SELECT * 
              FROM Employees 
              WHERE EM_ID = :employee_id';
    $statement = $db->prepare($query);
    $statement-> bindValue(":employee_id", $em_id);
    $statement->execute();
    $employee = $statement->fetch();
    $statement->closeCursor();
    $is_employee = true;
    if ($employee==null){
        $is_employee = false;
    }
    return $is_employee; 
}

function get_employees_by_dept_id($dept_id){
    global $db;
    $query = 'SELECT * 
              FROM Employees 
              WHERE EM_Department_ID = :dept_id';
    $statement = $db->prepare($query);
    $statement-> bindValue(":dept_id", $dept_id);
    $statement->execute();
    $employees = $statement->fetchAll();
    $statement->closeCursor();
    return $employees;     
}