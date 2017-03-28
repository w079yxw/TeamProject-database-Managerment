<?php
    //require_once('/util/secure_conn.php');  // require a secure connection
    //require_once('/util/valid_admin.php');  // require a valid user

    include 'view/uniform/header.php';
?> 

<main>
     <aside>
        <h2>Roles Directory</h2>
        
       
      
    </aside>
    
    <section>
        <!--display a table of members -->
        <table>
            <tr>
                <th> Role ID </th>
                <th> Role Name </th>
                <th> Role Description </th>
                <th> Department ID </th>
                <th> Employee ID </th>
                <th> Status </th>
                <th>&nbsp;</th>
                <!--Add Role, Manager, split first and last name -->
            </tr>
            <?php foreach ($roles as $role) : ?>
            <tr>
                <td><?php echo $role['Role_ID']; ?></td>
                <td><?php echo $role['Role_Name']; ?></td>
                <td><?php echo $role['Role_Description']; ?></td>
                <td><?php echo $role['Dept_ID']; ?></td>
                <td><?php echo $role['EM_ID']; ?></td>
                <td><?php echo $role['Role_Status']; ?></td>
                <td><form action="." method="post">
                    <input type="hidden" name="action"
                           value="edit_role">
                    <input type="hidden" name="Role_ID"
                           value="<?php echo $role['Role_ID']; ?>">
                    <input type="submit" value="Edit">
                    </form></td>
            </tr>
            <?php endforeach; ?>
                <!-- Add an option to delete row -->
        </table>
        
        
        <p class="last_paragraph">
            <a href="index.php?action=add_role">Add New Role</a>
        </p>
            <br>
        <p><?php echo $man_role_message; ?></p>
        
        
    </section>
    
    
</main>

<?php include 'view/uniform/footer.php'; ?>
