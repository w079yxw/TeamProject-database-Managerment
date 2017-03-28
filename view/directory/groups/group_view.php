<?php
    //require_once('/util/secure_conn.php');  // require a secure connection
   // require_once('/util/valid_user.php');  // require a valid user

    include 'view/uniform/header.php';
?> 

<main>
   <html>
<head>
<title>Search Employee</title>
</head>
<body>
     <form action="." method="post" id="search_group" class="aligned">
                <input type="hidden" name="action" value="search_grp_dpt">
<p> Search the Employee ID:
<input type="text" name="emid" size="30" value="" />
</p>
<p>Search the Group:
<input type="text" name="grp" size="30" value="" />
</p>
<p> Search the Group Role Name:
<input type="text" name="gprolenm" size="30" value="" />
</p>
<p>Search the Department:
<input type="text" name="dep" size="30" value="" />
</p>
<p> Search the Department Role Name:
    <input type="text" name="dptrolenm" size="30" value="" />
</p>

<label>&nbsp;</label>
                <input type="submit" value="search">
         </form>
    


    
     <form action="." method="post" id="search_word" class="aligned">
                <input type="hidden" name="action" value="searchword">



<p> Search the Word:
<input type="text" name="word" size="30" value="" />
</p>
<p> Search the Word's Status:
<input type="text" name="wdstat" size="30" value="" />
</p>

<label>&nbsp;</label>
                <input type="submit" value="search">
               
            </form>
</main>

<?php include 'view/uniform/footer.php';?>

