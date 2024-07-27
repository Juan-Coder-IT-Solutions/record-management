<?php
require_once '../core/config.php';
$assigned_task_id  = $_POST['assigned_task_id'];
$user_id  = $_SESSION['rm_user_id'];
$fetchComments = $mysqli_connect->query("SELECT * FROM tbl_comments WHERE assigned_task_id='$assigned_task_id'");
while ($comRow = $fetchComments->fetch_array()) { ?>

    <?php if ($comRow['user_id'] != $user_id) { ?>
        <div class="col-md-8">
            <address class="text-primary">
                <p style="text-align: left;" class="font-weight-bold"><?= $comRow['comment'] ?></p>
                <p style="text-align: left;font-size:8px;color: #9E9E9E;"><?= time_ago($comRow['date_added']) ?></p>
            </address>
        </div>
        <div class="col-md-4">
        </div>
    <?php } ?>
    <?php if ($comRow['user_id'] == $user_id) { ?>
        <div class="col-md-4">
        </div>
        <div class="col-md-8">
            <address class="text-success">
                <p style="text-align: right;" class="font-weight-bold">
                    <?= $comRow['comment'] ?>
                </p>
                <p style="text-align: right;font-size:8px;color: #9E9E9E;"><?= time_ago($comRow['date_added']) ?></p>
            </address>
        </div>
    <?php } ?>
<?php } ?>