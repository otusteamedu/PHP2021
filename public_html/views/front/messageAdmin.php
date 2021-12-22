<?php
$allMesages = $data["allMessages"];
$allIdWithImages = $data["allIdWithImages"];
?>

<form enctype="multipart/form-data" action="indexAdmin" method="post">
    <label for="text"><b>Message</b></label>
    <input type="text" placeholder="Enter Text" name="text" required>
    <input name="userfile" type="file"/><br>
    <button type="submit" class="registerbtn">Send</button>
</form>

<form action="indexAdmin" method="GET">
    <ul>
        <? foreach ($allMesages as $message => $inf): ?>
            <li>
                <input name="<?= $inf["id"] ?>" type="submit" value="Удалить">
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
</form>

<style>
    li {
        border: 1px solid black;
        display: flex;
        flex-direction: column;
    }
</style>