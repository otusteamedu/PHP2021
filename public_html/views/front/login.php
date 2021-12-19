<?php
$statusLog = $data["log"];
?>
<form action="login" method="post">
    <div class="container">
        <h1>Login</h1>
        <p>Please fill in this form to create an account.</p>
        <hr>
        <label for="email"><b>Email</b></label>
        <input type="text" placeholder="Enter Email" name="email" required>

        <label for="psw"><b>Password</b></label>
        <input type="password" placeholder="Enter Password" name="password" required>

        <p>By creating an account you agree to our <a href="#">Terms & Privacy</a>.</p>
        <button type="submit" class="registerbtn">Log in</button>
    </div>
</form>
<?= $statusLog ?>
