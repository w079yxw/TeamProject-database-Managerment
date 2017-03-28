
<?php
    //require_once('/util/secure_conn.php');  // require a secure connection
    //require_once('/util/valid_admin.php');  // require a valid user

    include 'view/uniform/header.php';
?> 
<main>
     <aside>
      
        
       
      
    </aside>
    
    <section>
        <!--display a table of members -->
        <table>
            <tr>
                <th> Text ID </th>
                <th> Sender ID </th>
                <th> Phone Number </th>
                <th> Text Content </th>
                <th> Status </th>
                <th> Sent Date </th>
                
                <th>&nbsp;</th>
                <!--Add Role, Manager, split first and last name -->
            </tr>
            <?php foreach ($messages as $message) : ?>
            <tr>
                <td><?php echo $message['Text_ID']; ?></td>
                <td><?php echo $message['Msg_SID']; ?></td>
                <td><?php echo $message['EM_Phone']; ?></td>
                <td><?php echo $message['Text_Content']; ?></td>
                <td><?php echo $message['View_Status']; ?></td>
                <td><?php echo $message['Date_Recieved']; ?></td>
                
               
            </form>
            </tr>
            <?php endforeach; ?>
                <!-- Add an option to delete row -->
        </table>
        
        
        
            <br>
        <p><?php echo $man_msg_message; ?></p>
        
        
    </section>
    
    
</main>

<?php include 'view/uniform/footer.php'; ?>
