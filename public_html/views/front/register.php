<?php
$allErrors = $data["error"];
$result = $data["result"];
?>
<form action="register" method="post">
    <div class="container">
        <h1>Register</h1>
        <p>Please fill in this form to create an account.</p>
        <hr>

        <label for="name"><b>Name</b></label>
        <input type="text" placeholder="Enter Name" name="name" required>


        <label for="email"><b>Email</b></label>
        <input type="text" placeholder="Enter Email" name="email" required>

        <label for="psw"><b>Password</b></label>
        <input type="password" placeholder="Enter Password" name="password" required>

        <label for="psw-repeat"><b>Repeat Password</b></label>
        <input type="password" placeholder="Repeat Password" name="password-repeat" required>
        <hr>
        <button type="submit" class="registerbtn">Register</button>
    </div>
    <pre><?= $data["result"] ?></pre>
    <ul>
        <? foreach ($allErrors as $error): ?>
            <li>
                <?= $error ?>
            </li>
        <? endforeach; ?>
    </ul>
    <a href="../user/login">Auth</a>
</form>
