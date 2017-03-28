<?php
    //require_once('/util/secure_conn.php');  // require a secure connection
    //require_once('/util/valid_admin.php');  // require a valid user

    include 'view/uniform/header.php';
?> 

<main>
     <aside>
        <h2>Department Directory</h2>
        
       
      
    </aside>
    
    <section>
        <!--display a table of members -->
        <table>
            <tr>
                <th> Department ID </th>
                <th> Department Name </th>
                <th> Department Description </th>
                <th> Manager ID </th>
                <th> Status </th>
                <th>&nbsp;</th>
                <!--Add Role, Manager, split first and last name -->
            </tr>
            <?php foreach ($departments as $department) : ?>
            <tr>
                <td><?php echo $department['Dept_ID']; ?></td>
                <td><?php echo $department['Dept_Name']; ?></td>
                <td><?php echo $department['Dept_Description']; ?></td>
                <td><?php echo $department['Manager_ID']; ?></td>
                <td><?php echo $department['Dept_Status']; ?></td>
                <td><form action="." method="post">
                    <input type="hidden" name="action"
                           value="edit_department">
                    <input type="hidden" name="Dept_ID"
                           value="<?php echo $department['Dept_ID']; ?>">
                    <input type="submit" value="Edit">
                    </form></td>
            </tr>
            <?php endforeach; ?>
                <!-- Add an option to delete row -->
        </table>
        
        
        <p class="last_paragraph">
            <a href="index.php?action=add_department">Add New Department</a>
        </p>
            <br>
        <p><?php echo $man_dpt_message; ?></p>
        
        
    </section>
    
    
</main>

<?php include 'view/uniform/footer.php'; ?>
