<?php
include("functions.php");
  $pdo = db_conn();
//1. POSTデータ取得

if(
!isset($_POST["kanri_id"])||$_POST["kanri_id"]==""||
!isset($_POST["kanri_name"])||$_POST["kanri_name"]==""||
!isset($_POST["kanri_lid"])||$_POST["kanri_lid"]==""||
!isset($_POST["kanri_lpw"])||$_POST["kanri_lpw"]==""||
!isset($_POST["kanri_flg"])||$_POST["kanri_flg"]==""||
!isset($_POST["upfile"])||$_POST["upfile"]==""
){
	exit('ParamError');
}

$kanri_id = $_POST["kanri_id"];
$kanri_name = $_POST["kanri_name"];
$kanri_lid = $_POST["kanri_lid"];
$kanri_lpw = $_POST["kanri_lpw"];
$kanri_flg = $_POST["kanri_flg"];
$upfile = $_POST["upfile"];


//Fileアップロードチェック
if (isset($_FILES["upfile"] ) && $_FILES["upfile"]["error"] ==0 ) {
    //情報取得
    $file_name = $_FILES["upfile"]["name"];         //"1.jpg"ファイル名取得
    $tmp_path  = $_FILES["upfile"]["tmp_name"]; //"/usr/www/tmp/1.jpg"アップロード先のTempフォルダ
    $file_dir_path = "upload/";  //画像ファイル保管先

    
    //***File名の変更***
    $extension = pathinfo($file_name, PATHINFO_EXTENSION); //拡張子取得(jpg, png, gif)
    $uniq_name = date("YmdHis").md5(session_id()) . "." . $extension;  //ユニークファイル名作成
    $file_name = $file_dir_path.$uniq_name; //ユニークファイル名とパス
   

    // $img="";  //画像表示orError文字を保持する変数
    // // FileUpload [--Start--]
    if ( is_uploaded_file( $tmp_path ) ) {
        if ( move_uploaded_file( $tmp_path, $file_name ) ) {
            chmod( $file_name, 0644 );
            // $img = '<img src="'. $file_name . '" >'; //画像表示用HTML
        } else {
            echo "Error:アップロードできませんでした。"; //Error文字
        }
    }
    // FileUpload [--End--]
}else{
    echo "画像が送信されていません"; //Error文字
}

//2. DB接続します
$pdo = db_conn();

//３．データ登録SQL作成
$sql = "INSERT INTO kanri_db(id,name,lid,lpw,kanri_flg,imge) VALUES(:b1,:b2,:b3,:b4,:b5,:image)";

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':b1', $kanri_id, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':b2', $kanri_name, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':b3', $kanri_lid, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':b4', $kanri_lpw, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':b5', $kanri_flg, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':image', $uniq_name, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute();

//４．データ登録処理後
if($status==false){
  //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
  $error = $stmt->errorInfo();
  exit("sqlのエラーが発生してます。:".$error[2]);
}else{
  //５．index.phpへリダイレクト
header('Location: login.php');
}
?>
