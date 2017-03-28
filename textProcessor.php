<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$servername = "localhost";
$username = "root";
$password = "password";
$dbname = "CEG4981";


// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$ToPhone = "+1".$_POST['ToPhone'];
$Message = $_POST['Message'];
$Group = $_POST['Group'];
$IsGroup = FALSE;
$resultset = array();
$USER = $_POST['user'];

if (isSet($Group)) {
    $sql2 = "SELECT EM_Phone FROM Groups,
TM_Members_Of_Grps,
Employees WHERE Groups.Group_Name= '$Group'
AND Groups.Group_ID=TM_Members_Of_Grps.Group_ID 
AND TM_Members_Of_Grps.EM_ID=Employees.EM_ID";
    $numbers = $conn->query($sql2);

    if ($numbers->num_rows > 0) {
        // output data of each row
        while ($row = $numbers->fetch_assoc()) {
            $resultset[] = $row["EM_Phone"];
        }
    } else {
        echo "0 results";
    }

    $ToCALL = implode(",", $resultset);
    $ToPhone = $ToCALL;
    $IsGroup = TRUE;
}


if ($IsGroup) {
        //this is the groups    
        $myfile = fopen("group.txt", "w") or die("Unable to open file!");
       
        
        //the logged in user id
        $SQL = "SELECT EM_ID FROM logins WHERE User_name = '$USER'";
        $result = $conn->query($SQL);
        $row = $result->fetch_assoc();
        $EM_ID = $row["EM_ID"];

        fwrite($myfile, $USER); 
        fwrite($myfile, "\n");
        
        //phone number of logged in used
        $SQL = " SELECT EM_Phone from employees where EM_ID = '$EM_ID'";
        $result = $conn->query($SQL);
        $row = $result->fetch_assoc();
        $EM_Phone = $row["EM_Phone"];
       

        //insert into texts table
        $INSERT = "insert into texts (Msg_SID,Direction,Sender_Num,Text_Content,Cost, Msg_Status, Date_sent)
        VALUES ('$EM_ID','Outgoing','$EM_Phone','$Message','1','Sent',NOW())";
        $conn->query($INSERT);
       
        fwrite($myfile, $EM_Phone); 
        fwrite($myfile, "\n");
        
        fwrite($myfile, $INSERT);
        
        //the ID of the text (to put into recievers)
        $SQL = "SELECT MAX(Text_ID) AS Text_ID FROM texts WHERE Sender_Num = '$EM_Phone' ";
        $result = $conn->query($SQL);
        $row = $result->fetch_assoc();
        $Text_ID = $row["Text_ID"];
        
        
        if($Text_ID == "")
        {
         $newphone = '+1'.$EM_Phone;   
        $SQL = "SELECT MAX(Text_ID) AS Text_ID FROM texts WHERE Sender_Num = '$newphone' ";
        $result = $conn->query($SQL);
        $row = $result->fetch_assoc();
        $Text_ID = $row["Text_ID"];
        }
  
 foreach ($resultset as $value) {
        
        $SQL = "SELECT EM_ID FROM employees WHERE EM_Phone = '$value'";
        $result = $conn->query($SQL);
        $row = $result->fetch_assoc();
        $REM_ID = $row["EM_ID"];
        
        fwrite($myfile, $value);
        //
        fwrite($myfile, "here?"); 
        fwrite($myfile, "\n");

        $INSERT = "INSERT INTO recievers(`Text_ID`, `Recv_EM_ID`, `View_Status`, `Date_recieved`) VALUES ('$Text_ID','$REM_ID','Unread',NOW())";
        $conn->query($INSERT);
        
        //fwrite($myfile, $INSERT);
        fclose($myfile);
    }
} else {

    $myfile = fopen("newfile.txt", "w") or die("Unable to open file!");
    
    //Get the user's ID
    $SQL = "SELECT EM_ID FROM logins WHERE User_name = '$USER'";
    $result = $conn->query($SQL);
    $row = $result->fetch_assoc();
    $EM_ID = $row["EM_ID"];
    
    fwrite($myfile, $SQL);
    fwrite($myfile,  $EM_ID);
    
    //get the employee ID of reciever
    $SQL = "SELECT EM_ID FROM employees WHERE EM_Phone = '$ToPhone'";
    $result = $conn->query($SQL);
    $row = $result->fetch_assoc();
    $REM_ID = $row["EM_ID"];//Rem is the reciever
    
    fwrite($myfile, $SQL);
    fwrite($myfile,  $REM_ID);

    //get the phone number of the current user
    $SQL = "SELECT EM_Phone from employees where EM_ID = '$EM_ID'";
    $result = $conn->query($SQL);
    $row = $result->fetch_assoc();
    $EM_Phone = $row["EM_Phone"];
    
    fwrite($myfile, $SQL);
    fwrite($myfile,  $EM_Phone);
    
    $INSERT = "INSERT into texts (Msg_SID,Direction,Sender_Num,Text_Content,Cost, Msg_Status, Date_sent)
    VALUES ('$EM_ID','OutgoingAPI','$EM_Phone','$Message','1','Recieved',NOW())";
    $conn->query($INSERT);
    
    fwrite($myfile, $INSERT);

   
    $SQL = "SELECT MAX(Text_ID) AS Text_ID FROM texts WHERE Sender_Num = '$EM_Phone'";
    $result = $conn->query($SQL);
    $row = $result->fetch_assoc();
    $Text_ID = $row["Text_ID"];
    
    fwrite($myfile, $SQL);
    fwrite($myfile,  $Text_ID);
    
    
    $INSERT = "INSERT INTO recievers(`Text_ID`, `Recv_EM_ID`, `View_Status`, `Date_recieved`) VALUES ('$Text_ID','$REM_ID','Unread',NOW())";
    $conn->query($INSERT);
    
    fwrite($myfile, $INSERT);
   

fclose($myfile);
}



$URL = "http://rbscenter.com/teamProjects/newSMS.php?ToPhone=$ToPhone&Message=$Message";


//Process the call USER END
header('Location: ' . $URL);
?>