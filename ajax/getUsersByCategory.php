<?php
require_once '../core/config.php';
$user_category = $mysqli_connect->real_escape_string($_POST['user_category']);
$encoded_by  = $_SESSION['rm_user_id']; ?>

<option value="">Please Select</option>
<?php
$fetch_program = $mysqli_connect->query("SELECT * FROM tbl_users WHERE user_category='$user_category'") or die(mysqli_error());
while ($pRpow = $fetch_program->fetch_array()) { ?>
    <option value='<?= $pRpow['user_id'] ?>'><?= $pRpow['first_name'] . " " . $pRpow['middle_name'] . " " . $pRpow['last_name'] ?></option>";
<?php }  ?>