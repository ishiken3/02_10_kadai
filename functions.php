<?php
//共通で使うものを別ファイルにしておきましょう。

//管理者DB接続関数（PDO）
function db_conn(){
  try {
    return new PDO('mysql:dbname=ishi-ken_test;host=mysql630.db.sakura.ne.jp','ishi-ken','qZWAXQh8');
  } catch (PDOException $e) {
    exit('DbConnectError:'.$e->getMessage());
  }
}

//SQL処理エラー
function errorMsg($stmt){
  $error = $stmt->errorInfo();
  exit("ErrorQuery:".$error[2]);
}

/**
* XSS
* @Param:  $str(string) 表示する文字列
* @Return: (string)     サニタイジングした文字列
*/
function h($str){
  return htmlspecialchars($str, ENT_QUOTES, "UTF-8");
}

//SESSIONチェック＆リジェネレイト
function chk_ssid(){
  if(!isset($_SESSION["chk_ssid"]) || $_SESSION["chk_ssid"]!=session_id()){
    exit("Login Error.");
  }else{
    session_regenerate_id(true);
    $_SESSION["chk_ssid"]=session_id();
  }
}

?>
