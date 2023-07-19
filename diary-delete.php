<?php
session_start();
// 関数ファイル読み込み
include('function.php');

// LOGIN認証チェック関数を実行
loginCheck();

//1.GETでidを取得
$diary_id = $_GET["diary_id"];

// DB接続用関数を実行
$pdo = db_connect();

//3.UPDATE gs_an_table SET ....; で更新(bindValue)
$sql = 'DELETE FROM dev13_diary WHERE diary_id=:diary_id';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':diary_id', $diary_id, PDO::PARAM_INT);    //更新したいidを渡す
$status = $stmt->execute();

//４．データ登録処理後
if ($status == false) {
    //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
    $error = $stmt->errorInfo();
    exit("QueryError:" . $error[2]);
} else {
    //select.phpへリダイレクト
    header("Location: admin-index.php");
    exit;
}
