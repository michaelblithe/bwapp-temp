    
    <h1>Directory Traversal - Files</h1>

    <?php
<br>/*
<br>
<br>bWAPP, or a buggy web application, is a free and open source deliberately insecure web application.
<br>It helps security enthusiasts, developers and students to discover and to prevent web vulnerabilities.
<br>bWAPP covers all major known web vulnerabilities, including all risks from the OWASP Top 10 project!
<br>It is for security-testing and educational purposes only.
<br>
<br>Enjoy!
<br>
<br>Malik Mesellem
<br>Twitter: @MME_IT
<br>
<br>bWAPP is licensed under a Creative Commons Attribution-NonCommercial-NoDerivatives 4.0 International License (http://creativecommons.org/licenses/by-nc-nd/4.0/). Copyright © 2014 MME BVBA. All rights reserved.
<br>
<br>*/
<br>
<br>include("connect_i.php");
<br>include("admin/settings.php");
<br>
<br>session_start();
<br>
<br>$message = "";
<br>
<br>if(isset($_POST["form"]))
<br>{
<br>
<br>    $login = $_POST["login"];
<br>    $login = mysqli_real_escape_string($link, $login);
<br>
<br>    $password = $_POST["password"];
<br>    $password = mysqli_real_escape_string($link, $password);
<br>    $password = hash("sha1", $password, false);
<br>
<br>    $sql = "SELECT * FROM users WHERE login = '" . $login;
<br>    $sql.= "' AND BINARY password = '" . $password . "'";
<br>    // Checks if the user is activated
<br>    $sql.= " AND activated = 1";
<br>
<br>    // Debugging
<br>    // echo $sql;
<br>
<br>    $recordset = $link-&gt;query($sql);
<br>
<br>    if(!$recordset)
<br>    {
<br>
<br>        die("Error: " . $link-&gt;error);
<br>
<br>    }
<br>
<br>    else
<br>    {
<br>
<br>        $row = $recordset-&gt;fetch_object();
<br>
<br>        // Debugging
<br>        // print_r($row);
<br>
<br>        if($row)
<br>        {
<br>
<br>            session_regenerate_id(true);
<br>
<br>            $token = sha1(uniqid(mt_rand(0,100000)));
<br>
<br>            $_SESSION["login"] = $row-&gt;login;
<br>            $_SESSION["admin"] = $row-&gt;admin;
<br>            $_SESSION["token"] = $token;
<br>            $_SESSION["amount"] = 1000;
<br>
<br>            $security_level_cookie = $_POST["security_level"];
<br>
<br>            switch($security_level_cookie)
<br>            {
<br>
<br>                case "0" :
<br>
<br>                    $security_level_cookie = "0";
<br>                    break;
<br>
<br>                case "1" :
<br>
<br>                    $security_level_cookie = "1";
<br>                    break;
<br>
<br>                case "2" :
<br>
<br>                    $security_level_cookie = "2";
<br>                    break;
<br>
<br>                default :
<br>
<br>                    $security_level_cookie = "0";
<br>                    break;
<br>
<br>            }
<br>
<br>            if($evil_bee == 1)
<br>            {
<br>
<br>                setcookie("security_level", "666", time()+60*60*24*365, "/", "", false, false);
<br>
<br>            }
<br>
<br>            else
<br>            {
<br>
<br>                setcookie("security_level", $security_level_cookie, time()+60*60*24*365, "/", "", false, false);
<br>
<br>            }
<br>
<br>            header("Location: portal.php");
<br>
<br>            exit;
<br>
<br>        }
<br>
<br>        else
<br>        {
<br>
<br>        $message = "<font color="\&quot;red\&quot;">Invalid credentials or user not activated!</font>";
<br>
<br>        }
<br>
<br>    }
<br>
<br>}
<br>
?>
