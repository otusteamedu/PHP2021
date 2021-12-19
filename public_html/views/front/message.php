<?php
$allMesages = $data["allMessages"];
$allIdWithImages = $data["allIdWithImages"];
?>

<form enctype="multipart/form-data" action="index" method="post">
    <label for="text"><b>Message</b></label>
    <label>
        <input type="text" placeholder="Enter Text" name="text" required>
    </label>
    <label>
        <input name="userfile" type="file"/><br>
    </label>
    <button type="submit" class="registerbtn">Send</button>
</form>

<ul>
    <? foreach ($allMesages as $message => $inf): ?>
        <li>
            <pre><?= strip_tags($inf["text"]) ?></pre>
            <pre><?= $inf["date"] ?></pre>
            <pre><?= $inf["name"] ?></pre>
            <?php foreach($allIdWithImages as $image) {
                if (in_array($inf["id"], $image)) { ?>
                    <img src="/images/<?=$inf["id"]?>.jpg" alt="pic">
                <?php }
            }
            ?>
        </li>
    <? endforeach; ?>
</ul>

<style>
    li {
        border: 1px solid black;
        display: flex;
        flex-direction: column;
    }
</style>