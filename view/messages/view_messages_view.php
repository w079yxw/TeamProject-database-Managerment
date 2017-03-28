<?php
    //require_once('/util/secure_conn.php');  // require a secure connection
   // require_once('/util/valid_user.php');  // require a valid user

    include 'view/uniform/header.php';
?> 

<main>
   <html>
<head>
<title>Choose box</title>
</head>
<body>
     <form action="." method="post" id="search_group" class="aligned">
                <input type="hidden" name="action" value="viewmessages">

<p>
Choose the Box?
<select name="option">
  <option value="">Select...</option>
  <option value="inbox">Inbox</option>
  <option value="outbox">Outbox</option>
</select>
</p>
<label>&nbsp;</label>
                <input type="submit" value="search">
         
    


    
    </form>
</main>

<?php include 'view/uniform/footer.php';?>

