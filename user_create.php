<?php

if (
    !isset($_POST['user_code']) || $_POST['user_code'] === '' ||
    !isset($_POST['user_name']) || $_POST['user_name'] === '' ||
    !isset($_POST['user_flg']) || $_POST['user_flg'] === '' ||
    !isset($_POST['user_mail']) || $_POST['user_mail'] === '' ||
    !isset($_POST['user_pass']) || $_POST['user_pass'] === '' ||
    !isset($_POST['user_flg']) || $_POST['user_flg'] === ''
) {
    exit('paramError');
}

$user_code = $_POST['user_code'];
$user_name = $_POST['user_name'];
$user_flg = $_POST['user_flg'];
$user_mail = $_POST['user_mail'];
$user_pass = $_POST['user_pass'];
$user_flg = $_POST['user_flg'];

include("function.php");

// DB接続用関数を実行
$pdo = db_connect();

// 同じユーザーコードがすでに登録されていないかチェック
$sql = 'SELECT COUNT(*) FROM dev13_user WHERE user_code=:user_code';

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':user_code', $user_code, PDO::PARAM_STR);

try {
    $status = $stmt->execute();
} catch (PDOException $e) {
    echo json_encode(["sql error" => "{$e->getMessage()}"]);
    exit();
}

if ($stmt->fetchColumn() > 0) {
    echo '<p>すでに登録されているユーザコードです．</p>';
    echo '<a href="index.php">ログイン画面へ</a>';
    exit();
}


// 新規ユーザー登録処理

// // パスワードをハッシュ化
// $hashed_password = password_hash($user_pass, PASSWORD_DEFAULT);
// print_r($hashed_password);
// print_r($user_pass);

$sql = 'INSERT INTO dev13_user(user_id, user_code, user_name,user_pass, user_mail,user_flg, created_at, updated_at, deleted_at) VALUES(NULL, :user_code, :user_name,:user_pass, :user_mail,:user_flg, now(), now(), NULL)';

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':user_code', $user_code, PDO::PARAM_STR);
$stmt->bindValue(':user_name', $user_name, PDO::PARAM_STR);
$stmt->bindValue(':user_flg', $user_flg, PDO::PARAM_STR);
$stmt->bindValue(':user_mail', $user_mail, PDO::PARAM_STR);
$stmt->bindValue(':user_pass', $user_pass, PDO::PARAM_STR);
$stmt->bindValue(':user_flg', $user_flg, PDO::PARAM_INT);

try {
    $status = $stmt->execute();
} catch (PDOException $e) {
    echo json_encode(["sql error" => "{$e->getMessage()}"]);
    exit();
}

header("Location:login.php");
exit();
