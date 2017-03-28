<?php
    //require_once('util/secure_conn.php');  // require a secure connection
    require_once('util/valid_user.php');  // require a valid user
?>


<?php include 'view/uniform/header.php'; ?>
<section class="individual_statistics"> 
    <div class="left_side">
        <h2>You are logged in as <?php echo $userFirstName." ".$userLastName; ?></h2>
        <h4>Role: <?php  foreach ($userRoles as $userRole) {echo $userRole['Role_Name'] . " ";} ?></h4>
        <h4>Team Memberships: <?php foreach ($userGroups as $userGroup) { echo $userGroup['Group_Name'] . " ";} ?></h4>
        <h4>Last Login: <?php echo $userLastLogin; ?> (EST)</h4>
        <h4>Unread Received Messages: <?php echo $userReceivedMessages." "; ?></h4>
        <h4>Pending Sent Messages: <?php echo $userPendingMessages; ?></h4>
    </div>
</section>

<section class="team_statistics">
    
    <h1>Query Reports</h1>
    <div class="float-box">
        <h4>5 Hour, Trending Keywords</h4>
            <?php foreach ($words_5hrs as $word){
            echo nl2br($word['word']. ": " . $word['count']. "\n"); }?>           
    </div>
    <div class="float-box">
        <h4>24 Hour, Trending Keywords</h4>
            <?php foreach ($words_24hrs as $word){
            echo nl2br($word['word']. ": " . $word['count']. "\n"); }?>      
    </div>
    <div class="float-box">
        <h4>24 Hour, My Team Activity</h4>
        <?php foreach ($popularUsers as $popularUser){
        echo nl2br($popularUser['EM_Firstname']. " " . $popularUser['EM_Lastname'] .": ". $popularUser['EM_ID']. "\n"); }?>    
    </div>    
</section>
<?php include 'view/uniform/footer.php'; 
?>