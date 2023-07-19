<?php
// xss対応化関数
function h($value)
{
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}

// LOGIN認証チェック関数
function loginCheck()
{
    if (!isset($_SESSION['chk_ssid']) || $_SESSION['chk_ssid'] != session_id()) {
        header("Location: index.php");
        exit();
    } else {
        // セッションIDを新しく発行（前のSESSION_IDは無効）※セッションハイジャック対策
        session_regenerate_id(true);
        $_SESSION['chk_ssid'] = session_id();
        // echo $_SESSION['chk_ssid'];
    }
}



// DB接続用関数
function db_connect()
{
    $dsn = 'mysql:dbname=gs_prototype01;charset=utf8;host=localhost';
    $usr = 'tagawa';
    $password = 'tagawa';
    try {
        $pdo = new PDO($dsn, $usr, $password);
        // print '接続成功';
    } catch (PDOException $e) {
        exit('データベースに接続できませんでした' . $e->getMessage());
    }
    return $pdo; // PDOオブジェクトを戻り値として返す
}
