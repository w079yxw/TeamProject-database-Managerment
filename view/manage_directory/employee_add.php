<?php
    //require_once('/util/secure_conn.php');  // require a secure connection
    //require_once('/util/valid_admin.php');  // require a valid admin
    include 'view/uniform/header.php';
?> 

<main>
    <h1><?php echo $this_action_message; ?></h1>
    <form action="index.php" method="post" id="add_or_edit_employee">
        <input type="hidden" name="action" value="add_or_edit_employee">
        
        <input type="text" name="em_id" value= "<?php echo $employee_id; ?>" readonly>
        
        <label>First Name:</label>
        <input type="text" name="fname" pattern="^[-a-zA-Z ]+$" value="<?php echo $fname; ?>" title="Name input accepts alphabetic characters and dashes only." />
        <br><br>
        
        <label>Middle Name:</label>
        <input type="text" name="mname" pattern="^[-a-zA-Z ]+$" value="<?php echo $mname; ?>" title="Name input accepts alphabetic characters and dashes only." />
        <br><br>
        
        <label>Last Name:</label>
        <input type="text" name="lname" pattern="^[-a-zA-Z ]+$" value="<?php echo $lname; ?>" title="Name input accepts alphabetic characters and dashes only." />
        <br><br>
        
        <label>Email:</label>
        <input type="text" name="email" pattern="[^@]+@[^@]+\.[a-zA-Z]{2,}" value="<?php echo $email; ?>" title="Email must be in the form of identifier@address.domain"/>
        <br><br>           
        
        <label>Phone Number:</label>
        <input type="text" name="phone" pattern="^\d{10}$" value="<?php echo $phone; ?>" title="Phone number input must contain a + followed by 9 digits. No extra characters allowed."/>
        <br><br>        
        
        <label>Status:</label>
          <input type="checkbox" name="status" checked="<?php echo $status_check; ?>"<br>
        <br>
        
        <label>Department:</label>
        <select name="dept_id">
            <?php foreach ($departments as $department) : ?>
            <option value="<?php echo $department['Dept_ID']; ?>">
                <?php echo $department['Dept_Name']; ?>
            </option>
            <?php endforeach; ?>
        </select>
        <br><br>
                       
        <label>&nbsp;</label>
        <input type="submit" value="Submit" />
        <br>        
    </form>
    
</main>

<?php include 'view/uniform/footer.php'; ?>