<?php

if(isset($_POST['dbname']) && isset($_POST['dbuser']) && isset($_POST['dbpass']) && isset($_POST['dbhost']))

{

        $dbname = $_POST['dbname'];
        $dbuser = $_POST['dbuser'];
        $dbpass = $_POST['dbpass'];
        $dbhost = $_POST['dbhost'];


        $link = mysqli_connect($dbhost, $dbuser, $dbpass) or die("Unable to Connect to '$dbhost'");
        mysqli_select_db($link, $dbname) or die("Could not open the db '$dbname'");

        $test_query = "SHOW TABLES FROM $dbname";
        $result = mysqli_query($link, $test_query);

        $tblCnt = 0;
        while($tbl = mysqli_fetch_array($result)) {
         $tblCnt++;
         #echo $tbl[0]."<br />\n";
        }

        if (!$tblCnt) {
                echo "There are no tables<br />\n";
                } else {
                echo "There are $tblCnt tables<br />\n";
                }

                }
?>


<form action="testConnexion.php" method="post">
        Enter Database_name: <input type="text" name="dbname" />
        Enter Database_username: <input type="text" name="dbuser" />
        Enter Database_password: <input type="password" name="dbpass" />
        Enter Database_host: <input type="text" name="dbhost" />
<input type="submit" value="Submit" />
</form>
