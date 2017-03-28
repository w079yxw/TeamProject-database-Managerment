<?php
    //require_once('/util/secure_conn.php');  // require a secure connection
    //require_once('/util/valid_admin.php');  // require a valid user

    include 'view/uniform/header.php';
?> 

<main>
     <aside>
        <h2>Word Directory</h2>
        
       
      
    </aside>
    
    <section>
        <!--display a table of members -->
        <table>
            <tr>
                <th> Word ID </th>
                <th> Word </th>
                <th> Word Status </th>
                <th>&nbsp;</th>
                <!--Add Role, Manager, split first and last name -->
            </tr>
            <?php foreach ($words as $word) : ?>
            <tr>
                <td><?php echo $word['Word_ID']; ?></td>
                <td><?php echo $word['Word']; ?></td>
                <td><?php echo $word['Word_Status']; ?></td>
                <td><form action="." method="post">
                    <input type="hidden" name="action"
                           value="edit_word">
                    <input type="hidden" name="Word_ID"
                           value="<?php echo $word['Word_ID']; ?>">
                    <input type="submit" value="Edit">
                    </form></td>
            </tr>
            <?php endforeach; ?>
                <!-- Add an option to delete row -->
        </table>
        
        
        <p class="last_paragraph">
            <a href="index.php?action=add_word">Add New word</a>
        </p>
            <br>
        <p><?php echo $man_word_message; ?></p>
        
        
    </section>
    
    
</main>

<?php include 'view/uniform/footer.php'; ?>
