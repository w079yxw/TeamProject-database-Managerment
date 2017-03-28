<?php
    //require_once('/util/secure_conn.php');  // require a secure connection
    //require_once('/util/valid_admin.php');  // require a valid admin

    include 'view/uniform/header.php';
?> 

<main>
    <h1><?php echo $this_action_message; ?></h1>
    <form action="index.php" method="post" id="add_or_edit_word">
        <input type="hidden" name="action" value="add_or_edit_word">
        
        <input type="text" name="wd_id" value= "<?php echo $word_id; ?>" readonly>
        
        <label>Word Content:</label>
        <input type="text" name="wd_cont" pattern="^[-a-zA-Z]+$" value="<?php echo $word_content; ?>" title="Name input accepts alphabetic characters and dashes only." />
        <br><br>
        
        
        
        <label>Status:</label>
          <input type="checkbox" name="status" checked="<?php echo $status_check; ?>"<br>
        
                       
        <label>&nbsp;</label>
        <input type="submit" value="Submit" />
        <br>        
    </form>
    
</main>

<?php include 'view/uniform/footer.php'; ?>