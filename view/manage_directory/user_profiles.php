<?php
    //require_once('/util/secure_conn.php');  // require a secure connection
    //require_once('/util/valid_admin.php');  // require a valid admin

    include 'view/uniform/header.php';
?> 

<main>
    <h1>Create New User Profile </h1>

            <form action="." method="post" id="new_user_form" class="aligned">
                <input type="hidden" name="action" value="new_user">

                <label>Username:</label>
                <input type="text" class="text" name="username">
                <br>
                
                
                    <label>Password:</label>
                    <input type="password" class="text" name="password1" pattern="^(?=.*[A-Za-z])[A-Za-z\d]{7,}$" title="Password must be a minimum 7 characters.">
                    <br>

                    <label>Re-enter Password:</label>
                    <input type="password" class="text" name="password2" pattern ="^(?=.*[A-Za-z])[A-Za-z\d]{7,}$" title = "Password must be a minimum of 7 characters.">
                    <br>
                
                
                <label>User Privileges:</label>
                <select name="user_privilege">
                    <?php foreach ($privileges as $privilege) : ?>
                        <option value="<?php echo $privilege; ?>">
                            <?php echo $privilege;?>
                        </option>
                   <?php endforeach; ?>
                </select>
                <br>
                
                <label>User Profile:</label>
                <select name="em_id">
                    <?php foreach ($employees as $employee) : ?>
                        <option value="<?php echo $employee['EM_ID']; ?>">
                            <?php echo $employee['EM_Firstname'] ." ". $employee['EM_Lastname']; ?>
                        </option>
                   <?php endforeach; ?>
                </select>
                <br>
                <label>&nbsp;</label>
                <input type="submit" value="Submit">
            </form>
            

            <p><?php echo $new_user_login_message; ?></p>
        </main>

<?php include 'view/uniform/footer.php'; ?>