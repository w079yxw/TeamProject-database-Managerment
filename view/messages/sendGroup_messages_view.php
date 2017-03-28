<?php
include 'view/uniform/header.php';

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

$sql = "select * from groups";
$result = $conn->query($sql);
?>

<style>
    input {
        border: 2px solid #eeeeee;
        height: 46px;
        margin: 10px 0 0 0;
        padding: 1%;
        font-size: 1.2em;
        line-height: 1.5em;
        color: #333333;
        letter-spacing: .01em;
        font-style: normal;
        font-weight: 300;
    }

    select {
        border: 2px solid #eeeeee;
        height: 46px;
        margin: 10px 0 0 0;
        padding: 1%;
        font-size: 1.2em;
        line-height: 1.5em;
        color: #333333;
        letter-spacing: .01em;
        font-style: normal;
        font-weight: 300;
    }

    #ToPhone{
        width:100%;
    }

    #Message{
        width:100%;
    }

    #group {
        width:100%;
    }


    input[type=checkbox] {
        visibility: hidden;
    }

    #checkbox {
        position: absolute;
        top: 0;
        left: 0;
        margin: 0;
        padding: 0;
        width: 20px;
        height: 20px;
    }

    .customCheck {
        width: 90%;
        float: left;
        margin-top: 20px;
        position: relative;
    }

    .customCheck label {
        cursor: pointer;
        position: absolute;
        width: 20px;
        height: 20px;
        top: 0;
        left: 0;
        background: #eee;
        border:1px solid #ddd;
    }

    .customCheck label:after {
        opacity: 0.2;
        content: '';
        position: absolute;
        width: 9px;
        height: 5px;
        background: transparent;
        top: 5px;
        left: 4px;
        border: 3px solid #333;
        border-top: none;
        border-right: none;

        -webkit-transform: rotate(-45deg);
        -moz-transform: rotate(-45deg);
        -o-transform: rotate(-45deg);
        -ms-transform: rotate(-45deg);
        transform: rotate(-45deg);
    }

    .customCheck label:hover::after {
        opacity: 0.5;
    }

    .customCheck input[type=checkbox]:checked + label:after {
        opacity: 1;
    }

    .robot {
        display: inline-block;
        position: relative;
        width: 60%;
        margin: 0 0 0 30px;
        line-height: 1em;
    }

    #submit {
        display: block;
        border: 0;
        width: 25%;
        height: 60px;
        margin: 30px auto 0;
        background: #eee;
        color: #333;
        text-align: center;
        border: 0;
        font-size: 1.2em;
        line-height: 1.5em;
        color: #333333;
        letter-spacing: .01em;
        font-style: normal;
        font-weight: 300;

    }

    #submit:hover {
        background: #DADADA;
        border: 1px #DADADA;
        color: #C43C3E;
    }

    /* Top-level Styling */

    * {
        margin:0;
        padding:0; 
        -webkit-margin-before: 0; 
        -webkit-margin-after: 0;
        -webkit-padding-start: 0;
    }

    body {
        background-color:WHITE;
        margin: 0 auto;
    }

    #wrapper {
        max-width: 1020px;
        height: 100%;
        background: #fff;
        margin: 0px auto 0;
        padding: 20px;
    }

    /* Div Layout Styling */

    #subscribeBox {
        position: relative;
        margin: 0 auto;
        padding:10px 0;
        height: auto;
        width: 50%;
        min-width: 325px;
    }


    *:focus {
        outline: none;
    }

    .subscribeForm {
        display: block;
        margin: 20px 0 0 0;
        width: 90%;
    }

    /* Text Styling for h2, p, a */

    h2 {
        font-weight: 500;
        letter-spacing: .05em;
        color: #333333;
        font-style:normal;
        font-family: source-sans-pro, sans-serif;
    }

    .thin {
        font-weight:200;
    }

    a {
        text-decoration:none;
        color: #333333;
    }

    a:hover {
        text-decoration:none;
        color: #C43C3E;
    }


    p {
        display: block;
        width: 90%;
        margin: 20px 0 0 0;
        font-size: 1.2em;
        line-height: 1.5em;
        color: #333333;
        letter-spacing: .01em;
        font-style: normal;
        font-weight: 300;
    }
</style>

<head>
    <meta charset="UTF-8">
    <title>SEND AN SMS</title>
    <link href="style.css" rel="stylesheet" type="text/css">
    <!--The following script tag downloads a font from the Adobe Edge Web Fonts server for use within the web page. We recommend that you do not modify it.-->

    <script src="http://use.edgefonts.net/source-sans-pro:n2,i2,n3,i3,n4,i4,n6,i6,n7,i7,n9,i9:default;source-serif-pro:n4:default.js" type="text/javascript"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/jquery.form-validator.min.js"></script>
    <script type="text/javascript">
        jQuery(document).ready(function () {

            jQuery('.ajaxform').submit(function () {

                $.ajax({
                    url: $(this).attr('action'),
                    type: $(this).attr('method'),
                    data: $(this).serialize(),
                    success: function (results) {
                        alert(results);
                    }
                });

                return false;
            });

        });

    </script>



</head>

<body>

    <div id="wrapper">

        <div id="subscribeBox">
            <h2><span class="thin">SEND GROUP</span> Message</h2>
              <p>Please Complete The Following To Send An SMS Message. 
                <a href="/view/messages/sendGroup_messages_view.php">CLICK HERE TO SEND SINGLE MESSAGE</a></p>

            <!-- Start Here: Web Form tutorial -->
            <form class="ajaxform form row" method="POST" action="http://localhost/emergency_command/textProcessor.php" onSubmit="alert('Message Sent');">

                <select name="Group" id="Group">
                    <option selected="selected">NONE</option>
                    <?php foreach ($result as $row) { ?>
                        <option value="<?= $row['Group_Name'] ?>"><?= $row['Group_Name'] ?></option>

                    <?php }
                    ?>
                </select> 
                <input type="hidden" name="user" value="<?php echo $_SESSION['username'] ?>">
                <input id="Message" type="text" placeholder="Type Message You Want To Send" name="Message" required>
                <input id="submit" type="submit" value="Send">

            </form>

        </div> <!-- end subscribeBox -->

    </div> <!-- end wrapper -->
</html>

<?php include 'view/uniform/footer.php'; ?>
