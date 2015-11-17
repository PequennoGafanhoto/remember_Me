<?php require ('config.php'); ?>

<form action="#" method="post">
    <label for="user">Login: <input type="text" name="user" id="user" value="<?php echo isset($_COOKIE['_user'])? $_COOKIE['_user']: ""; ?>" /></label>
    <label for="pass">Pass: <input type="password" name="pass" id="pass" value="<?php echo isset($_COOKIE['_pass'])? $_COOKIE['_pass']: ""; ?>" /></label>
    <label for="check"><input type="checkbox" name="remember" id="check"/>Remember-Me</label>&nbsp;
    <input type="submit" name="submit" value="Acess" />
</form>

<?php
    $user = addslashes(strtoupper($_POST['user']));
    $pass = addslashes($_POST['pass']);

    $pdo = conect();
    $verify = $pdo->prepare("SELECT * FROM users WHERE  user = ? && pass = ?");
    $verify->bindValue(1,$user);
    $verify->bindValue(2,$pass);
    $verify->execute();

    if (isset($_POST['submit'])) {
        if (empty($user) || empty($pass)){
          echo "Fill in all fields!";
        } elseif ($verify->rowCount() == 1) {
            header("Location:sucess.php");
        } else {
            echo "User not Authorized! contact your system administrator.";
            exit;
        }
    }
?>
