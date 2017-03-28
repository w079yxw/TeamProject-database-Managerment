<?php
    //require_once('/util/secure_conn.php');  // require a secure connection
    //require_once('/util/valid_admin.php');  // require a valid user

    include 'view/uniform/header.php';
?> 

<main>
     <aside>
        <h2>Group Memeber Directory</h2>
        
       
      
    </aside>
    
    <section>
        <!--display a table of members -->
        <table>
            <tr><th> Group Member ID </th>
                <th> Employee ID </th>
                <th> Group ID  </th>
                <th> Group Role </th>
                <th> Status </th>
                <th>&nbsp;</th>
                <!--Add Role, Manager, split first and last name -->
            </tr>
            <?php foreach ($grpmbrs as $grpmbr) : ?>
            <tr>
                 <td><?php echo $grpmbr['GrpMbr_ID']; ?></td>
                <td><?php echo $grpmbr['EM_ID']; ?></td>
                <td><?php echo $grpmbr['Group_ID']; ?></td>
                <td><?php echo $grpmbr['Group_Role']; ?></td>
                <td><?php echo $grpmbr['Group_Status']; ?></td>
                <td><form action="." method="post">
                    <input type="hidden" name="action"
                           value="edit_grpmbr">
                    <input type="hidden" name="GrpMbr_ID"
                           value="<?php echo $grpmbr['GrpMbr_ID']; ?>">
                   
                    
                    <input type="submit" value="Edit">
                    </form></td>
            </tr>
            <?php endforeach; ?>
                <!-- Add an option to delete row -->
        </table>
        
        
        <p class="last_paragraph">
            <a href="index.php?action=add_grpmbr">Add New Group Member</a>
        </p>
            <br>
        <p><?php echo $man_grpmbr_message; ?></p>
        
        
    </section>
    
    
</main>

<?php include 'view/uniform/footer.php'; ?>
