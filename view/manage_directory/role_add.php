<?php
    //require_once('/util/secure_conn.php');  // require a secure connection
    //require_once('/util/valid_admin.php');  // require a valid admin

    include 'view/uniform/header.php';
?> 

<main>
    <h1><?php echo $this_action_message; ?></h1>
    <form action="index.php" method="post" id="add_or_edit_role">
        <input type="hidden" name="action" value="add_or_edit_role">
        
        <input type="text" name="rid" value= "<?php echo $role_id; ?>" readonly>
        
        <label>Role Name:</label>
        <input type="text" name="rname" pattern="^[-a-zA-Z ]+$" value="<?php echo $role_name; ?>" title="Name input accepts alphabetic characters and dashes only." />
        <br><br>
        
        <label>Role Description:</label>
        <input type="text" name="rdes" pattern="^[-a-zA-Z ]+$" value="<?php echo $role_des; ?>" title="Name input accepts alphabetic characters and dashes only." />
        <br><br>
        
        <label>Department ID:</label>
        <input type="text" name="rdepid" pattern="^\d{1,10}$" value="<?php echo $role_dpt; ?>" title="Name input accepts alphabetic characters and dashes only." />
        <br><br>
        
        <label>Employee ID:</label>
        <input type="text" name="remid" pattern="^\d{1,10}+$" value="<?php echo $role_em; ?>" title="Name input accepts alphabetic characters and dashes only." />
        <br><br>
        
        <label>Status:</label>
          <input type="checkbox" name="status" checked="<?php echo $status; ?>"<br>
        
                       
        <label>&nbsp;</label>
        <input type="submit" value="Submit" />
        <br>        
    </form>
    
</main>

<?php include 'view/uniform/footer.php'; ?>