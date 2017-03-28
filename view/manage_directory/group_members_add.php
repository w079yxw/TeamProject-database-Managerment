<?php
    //require_once('/util/secure_conn.php');  // require a secure connection
    //require_once('/util/valid_admin.php');  // require a valid admin

    include 'view/uniform/header.php';
?> 

<main>
    <h1><?php echo $this_action_message; ?></h1>
    <form action="index.php" method="post" id="add_or_edit_grpmbr">
        <input type="hidden" name="action" value="add_or_edit_grpmbr">
         <input type="text" name="gpmbid" value= "<?php echo $grpmbr_ID; ?>" readonly>
        
       <label> Employee ID:</label>
        <input type="text" name="emid" value= "<?php echo $em_id; ?>" >
        <br>
         <label>Group ID:</label>
       <input type="text" name="grpid" value= "<?php echo $grp_id; ?>" >
        <br>
        <label> Role:</label>
        <input type="text" name="grprole" pattern="^[-a-zA-Z ]+$" value="<?php echo $role; ?>" title="Name input accepts alphabetic characters and dashes only." />
        <br>
        
       
        
        <label>Status:</label>
          <input type="checkbox" name="status" checked="<?php echo $status_check; ?>"<br>
        
                       
        <label>&nbsp;</label>
        <input type="submit" value="Submit" />
        <br>        
    </form>
    
</main>

<?php include 'view/uniform/footer.php'; ?>