<?php
    //require_once('/util/secure_conn.php');  // require a secure connection
    //require_once('/util/valid_admin.php');  // require a valid user

    include 'view/uniform/header.php';
?> 

<main>
     <aside>
        <h2>Group Directory</h2>
        
       
      
    </aside>
    
    <section>
        <!--display a table of members -->
        <table>
            <tr>
                <th> Group ID </th>
                <th> Group Name </th>
                <th> Group Description </th>
                <th> Group Leader ID </th>
                <th> Status </th>
                <th>&nbsp;</th>
                <!--Add Role, Manager, split first and last name -->
            </tr>
            <?php foreach ($groups as $group) : ?>
            <tr>
                <td><?php echo $group['Group_ID']; ?></td>
                <td><?php echo $group['Group_Name']; ?></td>
                <td><?php echo $group['Group_Description']; ?></td>
                <td><?php echo $group['Group_Leader_ID']; ?></td>
                <td><?php echo $group['Group_Status']; ?></td>
                <td><form action="." method="post">
                    <input type="hidden" name="action"
                           value="edit_group">
                    <input type="hidden" name="Group_ID"
                           value="<?php echo $group['Group_ID']; ?>">
                    <input type="submit" value="Edit">
                    </form></td>
            </tr>
            <?php endforeach; ?>
                <!-- Add an option to delete row -->
        </table>
        
        
        <p class="last_paragraph">
            <a href="index.php?action=add_group">Add New Group</a>
        </p>
            <br>
        <p><?php echo $man_group_message; ?></p>
        
        
    </section>
    
    
</main>

<?php include 'view/uniform/footer.php'; ?>
