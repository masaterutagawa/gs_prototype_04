<?php
session_start();
$user_id = $_GET['user_id'];
$diary_id = $_GET['diary_id'];

// 関数ファイル読み込み
include('function.php');

// DB接続用関数を実行
$pdo = db_connect();

// データ保存件数確認ＳＱＬ作成
$sql = 'SELECT COUNT(*) FROM dev13_like_table WHERE user_id=:user_id AND diary_id=:diary_id';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);
$stmt->bindValue(':diary_id', $diary_id, PDO::PARAM_INT);

try {
    $status = $stmt->execute();
} catch (PDOException $e) {
    echo json_encode(["sql error" => "{$e->getMessage()}"]);
    exit();
}
// Like数を取得
$like_count = $stmt->fetchColumn();

if ($like_count !== 0) {
    // likeがある場合はデータ削除するSQL
    $sql = 'DELETE FROM dev13_like_table WHERE user_id=:user_id AND diary_id=:diary_id';
} else {
    // likeがない場合はデータ追加するSQL
    $sql = 'INSERT INTO dev13_like_table (like_id, user_id, diary_id, created_at) VALUES (NULL, :user_id, :diary_id, now())';
}


$stmt = $pdo->prepare($sql);
// 変数をバインド
$stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);
$stmt->bindValue(':diary_id', $diary_id, PDO::PARAM_INT);

try {
    $status = $stmt->execute();
} catch (PDOException $e) {
    echo json_encode(["sql error" => "{$e->getMessage()}"]);
    exit();
}

header("Location: diary-entry.php?diary_id={$diary_id}");
exit();
