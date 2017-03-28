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
     <form action="." method="post" id="member_view" class="aligned">
                <input type="hidden" name="action" value="searchEmployee">

<p>Search Employee By ID:
<input type="text" name="emid" size="30" value="" />
</p>
<p>Search Employee By First Name:
<input type="text" name="emfname" size="30" value="" />
</p>
<p>Search Employee By Middle Name:
<input type="text" name="emmname" size="30" value="" />
</p>
<p>Search Employee By Last Name:
<input type="text" name="emlsname" size="30" value="" />
</p>
<p>Search Employee By Email:
<input type="text" name="ememail" size="30" value="" />
</p>
<p>Search Employee By Phone:
<input type="text" name="emphone" size="30" value="" />
</p>
<p>Search Employee By Status:
<input type="text" name="emstatus" size="30" value="" />
</p>
<p>Search Employee By Start Date:
<input type="text" name="emstdat" size="30" value="" />
</p>


<label>&nbsp;</label>
                <input type="submit" value="search">
               
            </form>
</main>

<?php include 'view/uniform/footer.php';?>
