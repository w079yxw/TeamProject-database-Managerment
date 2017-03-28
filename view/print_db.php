<!DOCTYPE html>


<?php
//include 'view/uniform/header.php';
function printbyid($employee_id, $num) {
    if (!empty($employee_id)) {
        global $db;
        $query = 'SELECT * 
              FROM Employees 
              WHERE Employees.EM_ID = :employee_id
              ORDER BY EM_ID';
        $statement = $db->prepare($query);
        $statement->bindValue(":employee_id", $employee_id);
        $statement->execute();
        $rows = $statement->fetchAll();
        $statement->closeCursor();
        $statement1 = $db->prepare($query);
        $statement1->bindValue(":employee_id", $employee_id);
        $statement1->execute();
        $row = $statement1->fetch();
        $statement1->closeCursor();
        //  $employee_name = $row['EM_Firstname'];
        $matchingValues = ($statement->rowCount());
        if ($matchingValues > 0) {
            if ($num == '1') //printdep
            //prints($rows);
                return $row;
            else
                prints($rows,0);
        }
        else {
            echo "invalid value";
        }
    } else
        echo "empty input";
}
function printem($fname, $mname, $lname, $email, $phone, $status) {
    global $db;
    $query = 'SELECT * 
              FROM Employees 
              WHERE 
IF(:fname!=" ", Employees.EM_Firstname = :fname,Employees.EM_Firstname=Employees.EM_Firstname)            
AND IF (:mname!=" ",Employees.EM_Middlename =:mname,Employees.EM_Firstname = Employees.EM_Firstname )
AND IF (:lname!=" ",Employees.EM_Lastname = :lname ,Employees.EM_Firstname = Employees.EM_Firstname )
AND IF (:email!=" ",Employees.EM_Email = :email ,Employees.EM_Firstname = Employees.EM_Firstname )
AND IF (:phone!=" ",Employees.EM_Phone = :phone ,Employees.EM_Firstname = Employees.EM_Firstname)
AND IF (:status!=" ",Employees.EM_Status = :status ,Employees.EM_Firstname = Employees.EM_Firstname )
';
    $statement = $db->prepare($query);
    $statement->bindValue(":fname", $fname);
    $statement->bindValue(":mname", $mname);
    $statement->bindValue(":lname", $lname);
    $statement->bindValue(":email", $email);
    $statement->bindValue(":phone", $phone);
    $statement->bindValue(":status", $status);
    $statement->execute();
    $rows = $statement->fetchAll();
    $statement->closeCursor();
    //$matchingValues = ($statement->rowCount());
    prints($rows,0);
}
function search_gp_dpt($id, $gpid, $gprole, $dpid, $dprole, $nonEmptynum) {
    global $db;
    if ($id != " " && $nonEmptynum == 1) {
        
        printbyid($id, 0);
       $statement1 = $db->prepare('SELECT *
    FROM TM_Members_Of_Grps INNER JOIN Groups on TM_Members_Of_Grps.EM_ID= :id AND Groups.Group_ID = TM_Members_Of_Grps.Group_ID
    WHERE TM_Members_Of_Grps.EM_ID=:id');
        $statement1->bindValue(":id", $id);
        $statement1->execute();
        $rows1 = $statement1->fetchALL(PDO::FETCH_GROUP | PDO::FETCH_UNIQUE);
        $statement1->closeCursor();
        prints($rows1,1);
        
        $statement2 = $db->prepare('SELECT *
    FROM Roles INNER JOIN Departments on Roles.EM_ID = :id AND Departments.Dept_ID = Roles.Dept_ID
    WHERE Roles.EM_ID=:id');
                $statement2->bindValue(":id", $id);
        $statement2->execute();
        $rows2 = $statement2->fetchALL(PDO::FETCH_GROUP | PDO::FETCH_UNIQUE);
        $statement1->closeCursor();
        prints($rows2,2);
        //revision that print out duplicate entries
        
     
            } else {
        $query = 'SELECT  *'
               . ' FROM (Employees'
                . '  INNER JOIN TM_Members_Of_Grps ON  '
                . 'IF(:gpid!=" ",Employees.EM_ID = TM_Members_Of_Grps.EM_ID AND TM_Members_Of_Grps.Group_ID = :gpid,Employees.EM_ID = Employees.EM_ID)'
                .'AND IF(:gprole!=" ",TM_Members_Of_Grps.Group_Role = :gprole AND Employees.EM_ID = TM_Members_Of_Grps.EM_ID ,Employees.EM_ID = Employees.EM_ID))'
         . '  JOIN Roles ON '
                . 'IF(:dpid!=" ",Employees.EM_ID = Roles.EM_ID AND Roles.Dept_ID = :dpid,Employees.EM_ID = Employees.EM_ID)
                      AND IF(:dprole!=" ",Roles.Role_Name = :dprole AND Employees.EM_ID = Roles.EM_ID ,Employees.EM_ID = Employees.EM_ID)
         WHERE IF(:id!=" ",(TM_Members_Of_Grps.EM_ID = :id AND TM_Members_Of_Grps.Group_ID = :gpid)OR (Roles.EM_ID = :id AND Roles.Dept_ID = :dpid),Employees.EM_ID = Employees.EM_ID  )
         Group by Employees.EM_ID'
               
             
        ;  
        
         $statement = $db->prepare($query);
        $statement->bindValue(':id', $id != " " ? $id : NULL, PDO::PARAM_INT);
        $statement->bindValue(':gpid', $gpid != " " ? $gpid : NULL, PDO::PARAM_INT);
      $statement->bindValue(':dpid', $dpid != " " ? $dpid : NULL, PDO::PARAM_INT);
     $statement->bindValue(':dprole', $dprole != " " ? $dprole : NULL, PDO::PARAM_STR);
       $statement->bindValue(':gprole', $gprole != " " ? $gprole : NULL, PDO::PARAM_STR);
        $statement->execute();
        $rows = $statement->fetchAll( );
                $statement->closeCursor();
               $statement1 = $db->prepare($query);
        $statement1->bindValue(':id', $id != " " ? $id : NULL, PDO::PARAM_INT);
        $statement1->bindValue(':gpid', $gpid != " " ? $gpid : NULL, PDO::PARAM_INT);
      $statement1->bindValue(':dpid', $dpid != " " ? $dpid : NULL, PDO::PARAM_INT);
     $statement1->bindValue(':dprole', $dprole != " " ? $dprole : NULL, PDO::PARAM_STR);
       $statement1->bindValue(':gprole', $gprole != " " ? $gprole : NULL, PDO::PARAM_STR);
        $statement1->execute();
        $row = $statement1->fetch( );
          $statement1->closeCursor();
        if($nonEmptynum>0){
            prints($rows,0);}
            
            else if($nonEmptynum<0){
            return $row;}
        }
        
      
        
     if($dpid!=" "||$gpid!=" "){ 
       if($gpid!=" "){
           $querygrp= 'SELECT * FROM Groups WHERE 
Groups.Group_ID=:gpid';
 $s = $db->prepare($querygrp);
         $s->bindValue(':gpid', $gpid );
         $s->execute();
        $grps = $s->fetchAll();
        $s1 = $db->prepare($querygrp);
         $s1->bindValue(':gpid', $gpid );
         $s1->execute();   
          $grp = $s1->fetch();
          if($nonEmptynum!=0){
               printgroup($grps);
              
          }  
          else 
              return $grp;
           
       }
if($dpid!=" "){
 $querydpt = 'SELECT * FROM Departments WHERE 
Departments.Dept_ID=:dpid';
     $s = $db->prepare($querydpt);
         $s->bindValue(':dpid', $dpid );
         $s->execute();
        $dpts = $s->fetchAll();
        $s1 = $db->prepare($querydpt);
         $s1->bindValue(':dpid', $dpid );
         $s1->execute(); 
          $dpt = $s1->fetch();
          if($nonEmptynum!=0){
              printDepart($dpts);
              
          }  
          else 
              return $dpt;
           
     }}
     
}
function prints($rows,$option) {
    if($option ==0){
        //only find employee
       
    ?>
    The Employee is:
    <table width="600" border="1" cellpadding = "1" cellspacing = "1">
        <tr>

            <th>Employee ID </th>
            <th>Employee First Name </th>
            <th>Employee Middle Name </th>
            <th>Employee Last Name </th>

            <th>Employee Email </th>
            <th>Employee Phone </th>
            <th>Employee Status </th>
            <th>Employee Department  </th>


            <?php
            foreach ($rows as $row) {
                echo '<tr><td align="right">' .
                $row['EM_ID'] . '</td><td align="middle">' .
                $row['EM_Firstname'] . '</td><td align="middle">' .
                $row['EM_Middlename'] . '</td><td align="middle">' .
                $row['EM_Lastname'] . '</td><td align="middle">' .
                $row['EM_Email'] . '</td><td align="middle">' .
                $row['EM_Phone'] . '</td><td align="middle">' .
                $row['EM_Status'] . '</td><td align="middle">' .
                $row['EM_Department_ID'] . '</td><td align="middle">' 
                ;
                echo '</tr>';
            }
            echo '</table>';
        }
        
        else if($option==1){
          //print the employee in the group  
             ?>
        The group of the Employee: 
        <table width="600" border="1" cellpadding = "1" cellspacing = "1">
            <tr>
                <th>Group Role  </th>
                <th>Group ID  </th>
                <th>Group Name </th>
                <th>Group Description  </th>
                <th>Group Leader  </th>
                <th>Group Status   </th>


                <?php
                foreach ($rows as $row) {
                    echo '<tr><td align="right">' .
                    $row['Group_Role'] . '</td><td align="middle">' .
                    $row['Group_ID'] . '</td><td align="middle">' .
                    $row['Group_Name'] . '</td><td align="middle">' .
                    $row['Group_Description'] . '</td><td align="middle">' .
                    $row['Group_Leader_ID'] . '</td><td align="middle">' .
                    $row['Group_Status'] . '</td><td align="middle">'
                    ;
                    // echo $index;
                    echo '</tr>';
                }
        echo '</table>';
            
            
            
            
            
        }
        else if($option ==2)
        {
            //print employee of department
               ?>
                The Departments of the Employee :
            <table width="600" border="1" cellpadding = "1" cellspacing = "1">
                <tr>
                    <th>Department Role </th>
                    <th>Department ID </th>
                    <th>Department Name </th>
                    <th>Department Description </th>
                    <th>Department Manager ID </th>
                    


                    <?php
                    foreach ($rows as $r) {
                        echo '<tr><td align="right">' .
                        $r['Role_Name']. '</td><td align="middle">' .
                        $r['Dept_ID'] . '</td><td align="middle">' .
                        $r['Dept_Name'] . '</td><td align="middle">' .
                        $r['Dept_Description'] . '</td><td align="middle">' .
                        $r['Manager_ID'] . '</td><td align="middle">';
                          
                        echo "</tr>";
                    }
                    echo "</table>";
            
            
            
            
            
        }
        
        
}
        function printgroup($rows) {
            ?>

        <table width="600" border="1" cellpadding = "1" cellspacing = "1">
            <tr>

                <th>Group ID  </th>
                <th>Group Name </th>
                <th>Group Description  </th>
                <th>Group Leader  </th>
                <th>Group Status   </th>


                <?php
                foreach ($rows as $row) {
                    echo '<tr><td align="right">' .
                    $row['Group_ID'] . '</td><td align="middle">' .
                    $row['Group_Name'] . '</td><td align="middle">' .
                    $row['Group_Description'] . '</td><td align="middle">' .
                    $row['Group_Leader_ID'] . '</td><td align="middle">' .
                    $row['Group_Status'] . '</td><td align="middle">'
                    ;
                    // echo $index;
                    echo '</tr>';
                }
        echo '</table>';}
            
            function printDepart($rs) {
                ?>

            <table width="600" border="1" cellpadding = "1" cellspacing = "1">
                <tr>

                    <th>Department ID </th>
                    <th>Department Name </th>
                    <th>Department Description </th>
                    <th>Department Manager ID </th>



                    <?php
                    foreach ($rs as $r) {
                        echo '<tr><td align="right">' .
                        $r['Dept_ID'] . '</td><td align="middle">' .
                        $r['Dept_Name'] . '</td><td align="middle">' .
                        $r['Dept_Description'] . '</td><td align="middle">' .
                        $r['Manager_ID'] . '</td><td align="middle">';
                        echo "</tr>";
                    }
                    echo "</table>";
                }
                function searchDepart($dpt_id) {
                    global $db;
                    $query = 'SELECT *
    FROM Roles LEFT JOIN Departments ON Departments.Dept_ID=:dpt_id
    WHERE Roles.Depart_ID = :dpt_id  
    ';
                    $statement = $db->prepare($query);
                    $statement->bindValue(":dpt_id", $dpt_id);
                    $statement->execute();
                    $statement1 = $db->prepare($query);
                    $statement1->bindValue(":dpt_id", $dpt_id);
                    $statement1->execute();
                    $r = $statement1->fetch();
                    $rows = $statement->fetchALL();
                    $statement->closeCursor();
                    $statement1->closeCursor();
                    ?>

                <table width="600" border="1" cellpadding = "1" cellspacing = "1">
                    <tr>

                        <th>Department ID </th>
                        <th>Department Name </th>
                        <th>Department Description </th>
                        <th>Department Manager ID </th>



                        <?php
                        echo '<tr><td align="right">' .
                        $r['Dept_ID'] . '</td><td align="middle">' .
                        $r['Dept_Name'] . '</td><td align="middle">' .
                        $r['Dept_Description'] . '</td><td align="middle">' .
                        $r['Manager_ID'] . '</td><td align="middle">';
                        echo "</tr>";
                        echo "</table>";
                        ?>

                    <table width="600" border="1" cellpadding = "1" cellspacing = "2">
                        <tr>

                            <th>Employee ID </th>
                            <th>Employee First Name </th>
                            <th>Employee Middle Name </th>
                            <th>Employee Last Name </th>

                            <th>Employee Email </th>
                            <th>Employee Phone </th>
                            <th>Employee Status </th>
                            <th>Employee Group </th>
                            <th>Employee Role </th>    

                            <?php
                            foreach ($rows as $rs) {
                                $rw = printbyid($rs['EM_ID'], 1);
                                echo '<tr><td align="middle">' .
                                $rw['EM_ID'] . '</td><td align="middle">' .
                                $rw['EM_Firstname'] . '</td><td align="middle">' .
                                $rw['EM_Middlename'] . '</td><td align="middle">' .
                                $rw['EM_Lastname'] . '</td><td align="middle">' .
                                $rw['EM_Email'] . '</td><td align="middle">' .
                                $rw['EM_Phone'] . '</td><td align="middle">' .
                                $rw['EM_Status'] . '</td><td align="middle">' .
                                //$row['EM_Department_ID'] . '</td><td align="middle">' .
                                $rw['EM_Group_ID'] . '</td><td align="middle">' .
                                $rs['Role_Name'] . '</td><td align="middle">';
                                echo '</tr>';
                            }
                        }
                        function searchRole($role_id) {
                            global $db;
                            $query = 'SELECT *
    FROM Roles 
    WHERE Roles.Role_ID = :role_id  
    ';
                            $statement = $db->prepare($query);
                            $statement->bindValue(":role_id", $role_id);
                            $statement->execute();
                            $row = $statement->fetch();
                            $statement->closeCursor();
                            return $row;
                        }
                         function searchRoleinDpt($role_id,$dptid) {
                            global $db;
                            $query = 'SELECT *
    FROM Roles 
    WHERE Roles.Role_ID = :role_id AND Roles.Dept_ID = :dptid
    ';
                            $statement = $db->prepare($query);
                            $statement->bindValue(":role_id", $role_id);
                            $statement->bindValue(":dptid", $dptid);
                            $statement->execute();
                            $row = $statement->fetch();
                            $statement->closeCursor();
                            return $row;
                        }
                        
                        function searchw($id,$word,$status,$mode) {
                           
                            global $db;
                            $query = 'SELECT * 
              FROM Word_Filters 
              WHERE                   
 IF(:word!=" ", Word_Filters.Word=:word,Word_Filters.Word_Status=Word_Filters.Word_Status)             
AND IF (:status!=" ",Word_Filters.Word_Status=:status,Word_Filters.Word=Word_Filters.Word)
';
                            $statement1 = $db->prepare($query);
                            $statement1->bindValue(":id", $id);
                            $statement1->bindValue(":word", $word);
                            $statement1->bindValue(":status", $status);
                            $statement1->execute();
                            $rows = $statement1->fetchAll();
                            $statement1->closeCursor();
                            
                           
                            //$matchingValues = ($statement->rowCount()
                            if($mode==0){
                                 $statement = $db->prepare('SELECT * FROM Word_Filters WHERE Word_Filters.Word_ID = :id');
                            $statement->bindValue(":id", $id);
                            $statement->execute();
                            $row = $statement->fetch();
                            $statement->closeCursor();
                                return $row;
                            }
                            else 
                            printWords($rows);
                        }
                        function printWords($rows) {
                            ?>

                        <table width="600" border="1" cellpadding = "1" cellspacing = "1">
                            <tr>

                                <th>Word ID </th>
                                <th>Word </th>
                                <th>Status </th>



                                <?php
                                foreach ($rows as $row) {
                                    echo '<tr><td align="right">' .
                                    $row['Word_ID'] . '</td><td align="middle">' .
                                    $row['Word'] . '</td><td align="middle">' .
                                    $row['Word_Status'] . '</td><td align="middle">';
                                }
                                echo '</tr>';
                                echo '</table>';
                            }
                            
                            
                            
                            
                         function printAll($option,$mode){
                             global $db;
                             switch ($option){
                                case '1':
                                $emp = $db->prepare('SELECT * FROM Employees WHERE 
Employees.EM_ID=Employees.EM_ID');
         //$s->bindValue(':gpid', $gpid != " " ? $gpid : NULL, PDO::PARAM_INT);
         $emp->execute();
        $empr = $emp->fetchAll();
           prints($empr,0);     
                                    
                                    break;
                                case '2':
                                    
                              $s = $db->prepare('SELECT * FROM Groups WHERE 
Groups.Group_ID=Groups.Group_ID');
         //$s->bindValue(':gpid', $gpid != " " ? $gpid : NULL, PDO::PARAM_INT);
         $s->execute();
        $r = $s->fetchAll();
        if($mode==0){
            
            return $r;
        }
        else 
           printgroup($r);
           
           break;
                                
                                case '3':
                                $word = $db->prepare('SELECT * FROM Word_Filters WHERE 
Word_Filters.Word_ID=Word_Filters.Word_ID');
         $word->execute();
        $wordr = $word->fetchAll();
        if($mode==0){
            
            return $wordr;
        }
        else 
            printWords($wordr);
           break;
                                    
                             case '4':
                                    
                           $dep = $db->prepare('SELECT * FROM Departments WHERE 
Departments.Dept_ID=Departments.Dept_ID');
         $dep->execute();
        $depr = $dep->fetchAll();
         if($mode==0){
            
            return $depr;
        }
        else 
        printDepart($depr);          
                                    
                                    
                                    break;   
                                    
                                      case '5':
                                    
                           $grpmbr = $db->prepare('SELECT * FROM TM_Members_Of_Grps 
ORDER BY GrpMbr_ID');
         $grpmbr->execute();
        $grpmbrs = $grpmbr->fetchAll();
         if($mode==0){
            
            return $grpmbrs;
        }
        else return 0;
                                    
                                    break;   
                                 
                                 
                             }    
                             
                             
                             
                             
                         }
                            ?>