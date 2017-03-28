<?php
    //require_once('/util/secure_conn.php');  // require a secure connection
    //require_once('/util/valid_admin.php');  // require a valid admin

    include 'view/uniform/header.php';
?> 

<main>
    <h1><?php echo $this_action_message; ?></h1>
    <form action="index.php" method="post" id="add_or_edit_group">
        <input type="hidden" name="action" value="add_or_edit_group">
        
        <input type="text" name="grpid" value= "<?php echo $group_id; ?>" readonly>
        
        <label>Group Name:</label>
        <input type="text" name="grpname" pattern="^[-a-zA-Z ]+$" value="<?php echo $group_name; ?>" title="Name input accepts alphabetic characters and dashes only." />
        <br><br>
        
        <label>Group Description:</label>
        <input type="text" name="grpdes" pattern="^[-a-zA-Z ]+$" value="<?php echo $group_des; ?>" title="Name input accepts alphabetic characters and dashes only." />
        <br><br>
        
        <label>Group Manager:</label>
        <input type="text" name="grpldr" pattern="^\d{1,10}+$" value="<?php echo $group_ldr; ?>" title="Name input accepts alphabetic characters and dashes only." />
        <br><br>
        
        
        <label>Status:</label>
          <input type="checkbox" name="status" checked="<?php echo $status_check; ?>"<br>
        
                       
        <label>&nbsp;</label>
        <input type="submit" value="Submit" />
        <br>        
    </form>
    
</main>

<?php include 'view/uniform/footer.php'; ?>