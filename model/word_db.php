<?php

 function edit_word( $id, $word,$status) {
    global $db;
    $query = 'Update Word_Filters
              SET Word_ID=:id, Word=:word,  Word_Status = :status
              WHERE Word_ID=:id';
    $statement = $db->prepare($query);
    $statement->bindValue(':id', $id);
    $statement->bindValue(':word', $word);
    
    $statement->bindValue(':status', $status);
    
    $statement->execute();
    $statement->closeCursor();          
}
function get_next_wd_ID() {
    global $db;
    $query = 'SELECT MAX(Word_ID)
              FROM Word_Filters';
    $statement = $db->prepare($query);
    $statement->execute();
    $row = $statement->fetch(); 
    $next_id = $row[0] + 1;
    return $next_id;
}
function add_word( $id, $word,$status) {
    global $db;
    $query = 'INSERT into Word_Filters
              Values (:id, :word, :status)';
    $statement = $db->prepare($query);
    $statement->bindValue(':id', $id);
    $statement->bindValue(':word', $word);
    $statement->bindValue(':status', $status);
    $statement->execute();
    $statement->closeCursor();       
}

?>
