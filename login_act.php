<?php
// var_dump($_POST);

session_start();
$user_code = $_POST['user_code'];
$user_flg = $_POST['user_flg'];
$user_pass = $_POST['user_pass'];

// print_r(session_id());

// 関数ファイル読み込み
include('function.php');

// DB接続用関数を実行
$pdo = db_connect();

// データ選択ＳＱＬ作成
// user_code，user_pass，deleted_atの3項目全ての条件満たすデータを抽出する．
$sql = "SELECT * FROM dev13_user WHERE user_code=:user_code AND user_flg=:user_flg AND user_pass=:user_pass AND deleted_at IS NULL";
$stmt = $pdo->prepare($sql);
// 変数をバインド
$stmt->bindValue(':user_code', $user_code, PDO::PARAM_STR);
$stmt->bindValue(':user_flg', $user_flg, PDO::PARAM_INT);
$stmt->bindValue(':user_pass', $user_pass, PDO::PARAM_STR);

try {
    $status = $stmt->execute();
} catch (PDOException $e) {
    echo json_encode(["sql error" => "{$e->getMessage()}"]);
    exit();
}

$user = $stmt->fetch(PDO::FETCH_ASSOC); //1レコードだけ取得する方法
if (!$user) {
    echo "<p>ログイン情報に誤りがあります</p>";
    echo "<a href=login.php>ログイン</a>";
    exit();
} else {
    $_SESSION = array();
    // セッション変数に session_idと必要となるユーザtableのデータを保存
    $_SESSION['chk_ssid'] = session_id();
    $_SESSION['user_name'] = $user['user_name'];
    $_SESSION['user_id'] = $user['user_id'];
    $_SESSION['user_flg'] = $user['user_flg'];
    header("Location: index.php");
    exit();
}



// $res = $stmt->execute(); // SQL実行

// // データ登録処理後
// if ($res == false) {
//     // SQL実行時にエラーがある場合
//     $error = $stmt->errorInfo();
//     exit("QueryError:" . $error[2]);
// }

// // 抽出データ数を取得
// // $count = $stmt->fetchColumn(); //SELECT COUNT(*)で使用可能()
// $val = $stmt->fetch(); //1レコードだけ取得する方法

// // 該当レコードがあればSESSIONに値を代入
// if ($val["user_id"] != "") {
//     $_SESSION['chk_ssid'] = session_id();
//     $_SESSION['user_name'] = $val["user_name"];
//     // login処理OKの場合ほにゃらら.phpへ遷移
//     header('Location: diary-index.php');
// } else {
//     // login処理NGの場合login.phpへ遷移
//     header('Location: index.php');
// }
// // 処理終了
// exit();
