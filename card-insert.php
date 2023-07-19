<?php
// 入力チェック（受信確認処理追加）
if (
    !isset($_FILES['card_filename']['name']) || $_FILES['card_filename']['name'] == ''
) {
    exit('ParamError: ファイルがアップロードされていません');
}

// POSTデータ取得
$card_filename = $_FILES['card_filename']['name']; //File名

//FileUpload処理
$upload = 'card_images/'; //画像アップロードフォルダへのパス

//アップロードした画像を../img/へ移動させる記述↓
if (move_uploaded_file($_FILES['card_filename']['tmp_name'], $upload . $card_filename)) {
    // file upload:OK
} else {
    // file upload:NG
    echo 'ファイルアップロードエラー';
    echo $_FILES['card_filename']['error'];
}


// 関数ファイル読み込み
include('function.php');
// DB接続用関数を実行
$pdo = db_connect();


// データ登録ＳＱＬ作成
$sql = "INSERT INTO dev13_card(card_id,card_filename,card_indate)VALUES(NULL,:card_filename, now())";
$stmt = $pdo->prepare($sql);

// 変数をバインド
$stmt->bindValue(':card_filename', $card_filename, PDO::PARAM_STR); // Integer（数値の場合は PDO::PARAM_INT）
$status = $stmt->execute(); // SQL実行

// データ登録処理後
if ($status == false) {
    // SQL実行時にエラーがある場合
    $error = $stmt->errorInfo();
    exit("QueryError:" . $error[2]);
} else {
    // 登録ページへ移動
    header('Location: card-regist.php');
    exit;
}
