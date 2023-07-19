<?php
// 入力チェック（受信確認処理追加）
if (
    !isset($_POST['today_events']) || $_POST['today_events'] == '' ||
    !isset($_POST['events_impression']) || $_POST['events_impression'] == '' ||
    !isset($_POST['events_emotions']) || $_POST['events_emotions'] == '' ||
    !isset($_POST['events_points']) || $_POST['events_points'] == '' ||
    !isset($_POST['events_points_reason']) || $_POST['events_points_reason'] == '' ||
    !isset($_POST['select_card_filename']) || $_POST['select_card_filename'] == '' ||
    !isset($_POST['photo_keyword']) || $_POST['photo_keyword'] == '' ||
    !isset($_POST['photo_keyword_reason']) || $_POST['photo_keyword_reason'] == '' ||
    !isset($_POST['photo_emotions']) || $_POST['photo_emotions'] == '' ||
    !isset($_POST['photo_points']) || $_POST['photo_points'] == '' ||
    !isset($_POST['photo_points_reason']) || $_POST['photo_points_reason'] == ''
) {
    exit('ParamError');
}

// POSTデータ取得
$today_events = $_POST['today_events'];
$events_impression = $_POST['events_impression'];
$events_emotions = $_POST['events_emotions'];
$events_points = $_POST['events_points'];
$events_points_reason = $_POST['events_points_reason'];
$select_card_filename = $_POST['select_card_filename'];
$photo_keyword = $_POST['photo_keyword'];
$photo_keyword_reason = $_POST['photo_keyword_reason'];
$photo_emotions = $_POST['photo_emotions'];
$photo_points = $_POST['photo_points'];
$photo_points_reason = $_POST['photo_points_reason'];

// 関数ファイル読み込み
include('function.php');
// DB接続用関数を実行
$pdo = db_connect();


// データ登録ＳＱＬ作成
$sql = "INSERT INTO dev13_diary(diary_id,registration_date,created_date,update_date,today_events,events_impression,events_emotions,events_points,events_points_reason,select_card_filename,photo_keyword,photo_keyword_reason,photo_emotions,photo_points,photo_points_reason)VALUES(NULL, now(),now(),now(),:today_events, :events_impression, :events_emotions,:events_points, :events_points_reason,:select_card_filename, :photo_keyword, :photo_keyword_reason, :photo_emotions, :photo_points, :photo_points_reason)";
$stmt = $pdo->prepare($sql);

// 変数をバインド
$stmt->bindValue(':today_events', $today_events, PDO::PARAM_STR); // Integer（数値の場合は PDO::PARAM_INT）
$stmt->bindValue(':events_impression', $events_impression, PDO::PARAM_STR); // Integer（数値の場合は PDO::PARAM_INT）
$stmt->bindValue(':events_emotions', $events_emotions, PDO::PARAM_STR); // Integer（数値の場合は PDO::PARAM_INT）
$stmt->bindValue(':events_points', $events_points, PDO::PARAM_INT); // Integer（数値の場合は PDO::PARAM_INT）
$stmt->bindValue(':events_points_reason', $events_points_reason, PDO::PARAM_STR); // Integer（数値の場合は PDO::PARAM_INT）
$stmt->bindValue(':select_card_filename', $select_card_filename, PDO::PARAM_STR); // Integer（数値の場合は PDO::PARAM_INT）
$stmt->bindValue(':photo_keyword', $photo_keyword, PDO::PARAM_STR); // Integer（数値の場合は PDO::PARAM_INT）
$stmt->bindValue(':photo_keyword_reason', $photo_keyword_reason, PDO::PARAM_STR); // Integer（数値の場合は PDO::PARAM_INT）
$stmt->bindValue(':photo_emotions', $photo_emotions, PDO::PARAM_STR); // Integer（数値の場合は PDO::PARAM_INT）
$stmt->bindValue(':photo_points', $photo_points, PDO::PARAM_INT); // Integer（数値の場合は PDO::PARAM_INT）
$stmt->bindValue(':photo_points_reason', $photo_points_reason, PDO::PARAM_STR); // Integer（数値の場合は PDO::PARAM_INT）
$status = $stmt->execute(); // SQL実行

// データ登録処理後
if ($status == false) {
    // SQL実行時にエラーがある場合
    $error = $stmt->errorInfo();
    exit("QueryError:" . $error[2]);
} else {
    // 登録ページへ移動
    header('Location: admin-index.php');
    exit;
}
