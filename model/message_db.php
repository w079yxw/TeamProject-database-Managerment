
<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
function get_outmessages($id) {
    global $db;
    $query = 'SELECT * FROM Employees,Texts,Recievers WHERE Texts.Msg_SID=:id AND Texts.Text_ID=Recievers.Text_ID AND Employees.EM_ID=Recievers.Recv_EM_ID';
    $statement = $db->prepare($query);
     $statement->bindValue(':id',$id);
    $statement->execute();
    $messages = $statement->fetchAll();
    $statement->closeCursor();
    return $messages;       
}


function get_inmessages($id) {
    global $db;
    $query = 'SELECT * FROM Texts,Employees,Recievers WHERE Recievers.Recv_EM_ID=:id AND Recievers.Text_ID=Texts.Text_ID AND Texts.Msg_SID=Employees.EM_ID';
    $statement = $db->prepare($query);
     $statement->bindValue(':id',$id);
    $statement->execute();
    $messages = $statement->fetchAll();
    $statement->closeCursor();
    return $messages;       
}

?>
