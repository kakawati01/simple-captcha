<!DOCTYPE html>
<html>
<head>
</head>

<body>
    <table>
    <h4>USER ACCOUNT REGISTRATION</h4>
    <form method="POST">
        <!-- REGISTRATION -->
        <tr>
            <td>Username:</td>
            <td><input type="text" name="username" autofocus required></td>
        </tr>

        <tr>
            <td>Enter Password: </td>
            <td><input type="password" name="password1" required></td>
        </tr>

        <tr>
            <td>Confirm Password: </td>
            <td><input type="password" name="password2" required></td>
        </tr>


        <!-- CAPTCHA -->
        <tr>
            <td colspan="2" align="center"><br>Are you a human? Answer this.</td>
        </tr>

        <tr>
            <td colspan="2" align="center">
                <?php
                    $op = array('+', '-', '*');
                    $randomizeOp = rand(0, 2);
                    switch($randomizeOp){
                        case 0:
                            $num1 = rand(1, 100);
                            $num2 = rand(1, 100);
                            $result = $num1 + $num2;
                            break;

                        case 1:
                            $num1 = rand(1, 100);
                            $num2 = rand(1, $num1-1);
                            $result = $num1 - $num2;
                            break;

                        case 2:
                            $num1 = rand(1, 20);
                            $num2 = rand(1, 10);
                            $result = $num1 * $num2;
                            break;
                    }

                    echo '<br><b>'.$num1.$op[$randomizeOp].$num2.'=</b>';
                    
                        setcookie("prevValue", $result, time() + 86400, "/");
                    
                ?>
                <input type="number" name="answer">
            </td>
        </tr>

        <tr>
            <td colspan="2" align="center">
                <input type="submit" name="register" value="REGISTER">
                <input type="reset" name="clear" value="CLEAR">
            </td>
        </tr>

        <tr>
            <td><br></td>
        </tr>

    <!-- SUBMIT -->
        <?php
            if(isset($_REQUEST['register'])){
                $username = $_POST['username'];
                $password1 = $_POST['password1'];
                $password2 = $_POST['password2'];
                $answer = $_POST['answer'];
                $result = $_COOKIE["prevValue"];

                // PASSWORD NOT MATCHED
                if($password1 != $password2){
                    ?>
                    <tr>
                        <td colspan="2" align="center" style="color:red;">Password did not match. Please try again!</td>
                    </tr>
                    <?php
                }

                // FAILED CAPTCHA
                if($result != $answer){
                    ?>
                    <tr>
                        <td colspan="2" align="center" style="color:red;">Retry registration. Failed CAPTCHA!</td>
                    </tr>
                    <?php
                }

                // ACOUNT REGISTERED
                if($password1 === $password2 && $result == $answer){
                    ?>
                    <tr>
                        <td colspan="2" style="color:blue;">
                            Account for <b><?php echo $username ?></b> has been registered!<br>
                        </td>
                    </tr>
    </form>
    </table>
    <br><b>Your Password Hashes:</b>
    <?php
                echo "<br><b>MD4: </b>".hash('md4',$password1);
                echo "<br><b>MD5: </b>".hash('md5',$password1);
                echo "<br><b>SHA1: </b>".hash('sha1',$password1);
                echo "<br><b>CRC32B: </b>".hash('crc32b',$password1);
                echo "<br><b>TIGER128,3: </b>".hash('tiger128,3',$password1);
                }
            }
    ?>
</body>
</html>
