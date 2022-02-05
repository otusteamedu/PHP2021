<?php if (empty($_POST)) { ?>
    <form method="POST">    
        <input type="text" name="String">
        <input type="submit">
    </form>

    <?php
    exit();
} else {
    if (!empty($string = $_POST["String"])) {
        $left = 0;
        foreach (str_split($string)as $symbol) {
            if ($symbol == ")") {
                $left -= 1;
            } else
            if ($symbol == "(") {
                $left += 1;
            }
            if ($left < 0) {
                break;
            }
        }
        if ($left == 0) {
            header('HTTP/1.1 200 Ok');
            echo $string;
            exit();
        }
    }
}
header('HTTP/1.1 400 Bad request');
echo $string;
?>

