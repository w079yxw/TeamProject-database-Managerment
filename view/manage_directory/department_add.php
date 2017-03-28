<?php
    //require_once('/util/secure_conn.php');  // require a secure connection
    require_once('/util/valid_admin.php');  // require a valid admin

    include 'view/uniform/header.php';
?> 

<main>
    <h1><?php echo $this_action_message; ?></h1>
    <form action="index.php" method="post" id="add_or_edit_department">
        <input type="hidden" name="action" value="add_or_edit_department">
        
        <input type="text" name="dpt_id" value= "<?php echo $dept_id; ?>" readonly>
        
        <label>Department Name:</label>
        <input type="text" name="dptame" pattern="^[-a-zA-Z ]+$" value="<?php echo $depname; ?>" title="Name input accepts alphabetic characters,dashes, and spaces only." />
        <br><br>
        
        <label>Department Description:</label>
        <input type="text" name="dpdes" pattern="^[-a-zA-Z ]+$" value="<?php echo $depdes; ?>" title="Description input accepts alphabetic characters and spaces only." />
        <br><br>
        
        <label>Department Manager:</label>
        <input type="text" name="dpmrg"  value="<?php echo $depmanager; ?>" title="Name input accepts alphabetic characters, dashes, and spaces only." />
        <br><br>
        
        
        <label>Status:</label>
          <input type="checkbox" name="status" checked="<?php echo $status_check; ?>"<br>
        
                       
        <label>&nbsp;</label>
        <input type="submit" value="Submit" />
        <br>        
    </form>
    
</main>

<?php include 'view/uniform/footer.php'; ?>