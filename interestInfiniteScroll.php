<?php
require_once("connect.php");
$load = htmlentities(strip_tags($_POST['load'])) * 10;

    $interests_query = $connect->query("
        SELECT *
        FROM interests
        ORDER BY interest_score DESC, interest_name ASC
        LIMIT $load, 10
    ");

    while($interest = $interests_query->fetch()){ ?>
        <li class="cat-item cat-item-2"><a href="/events.php?interest=<?php echo $interest['interest_id'] ?>"><?php echo $interest['interest_name'] ?></a></li>
<?php } ?>