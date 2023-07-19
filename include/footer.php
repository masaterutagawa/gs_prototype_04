<?php
if (!isset($_SESSION['chk_ssid']) || $_SESSION['chk_ssid'] != session_id()) {
    exit();
} else if ($_SESSION['user_flg'] == 1) {
    include('include/footer-view.php');
} else {
    include('include/footer-editor.php');
}
