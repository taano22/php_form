<?php
  session_start();
  $mode = "input";

  //件名で使用
  $kindlist = array(
    ''=>'選択してください', '1'=>'意見', '2'=>'感想', '3'=>'その他'
  );

  //データベース接続情報
  $dsn = 'mysql:dbname=;host=;charset=utf8';
  $user = '';
  $password = '';

  //管理者メールアドレス
  $myemail ="";

  if( isset($_POST["back"] ) && $_POST["back"] ){
  //修正ボタン押下後処理
  } else if( isset($_POST["confirm"] ) && $_POST["confirm"] ){

  //確認ボタン押下後処理
    if( $_POST["kind"] == "選択してください" ){
      $errmessage[] = "件名を選択してください";
    }
    $_SESSION["kind"] = $_POST["kind"];

    if( !$_POST['name'] ) {
      $errmessage[] = "名前を入力してください";
    } else if( mb_strlen($_POST['name']) > 30 ){
      $errmessage[] = "名前は30文字以内にしてください";
    }
    $_SESSION['name'] = htmlspecialchars($_POST['name'], ENT_QUOTES);

    if( !$_POST['email'] ) {
      $errmessage[] = "Eメールを入力してください";
    } else if( mb_strlen($_POST['email']) > 200 ){
      $errmessage[] = "Eメールは50文字以内にしてください";
    } else if( !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) ){
      $errmessage[] = "メールアドレスが不正です";
    }
    $_SESSION['email']    = htmlspecialchars($_POST['email'], ENT_QUOTES);

    if( !$_POST['tel'] ) {
      $errmessage[] = "電話番号を入力してください";
    } else if( mb_strlen($_POST['tel']) > 20 ){
      $errmessage[] = "電話番号は20文字以内にしてください";
    }
    $_SESSION['tel'] = htmlspecialchars($_POST['tel'], ENT_QUOTES);

    if( !$_POST['message'] ){
      $errmessage[] = "お問い合わせ内容を入力してください";
    } else if( mb_strlen($_POST['message']) > 500 ){
      $errmessage[] = "お問い合わせ内容は500文字以内にしてください";
    }
    $_SESSION['message'] = htmlspecialchars($_POST['message'], ENT_QUOTES);

    if (!empty($_FILES['image']['name'])) {

      $fileName = $_FILES['image']['name'];
      $fileType = $_FILES['image']['type'];
      $fileTmp  = $_FILES['image']['tmp_name'];
      $fileSize = $_FILES['image']['size'];
      $imgTypes = array('image/jpeg', 'image/png', 'image/gif');
      $imgSize = 1048576;

      //バリデーション
      if (count(token_get_all($fileName)) >= 2)  {
        exit('ファイル形式が不正です');
      }
      if (!in_array($fileType, $imgTypes)) {
        exit('許可されていないファイルタイプです');
      }  
      if ($fileSize > $imgSize) {
        exit('ファイルサイズが大きすぎます');
      }

      $_SESSION['image']['name'] = $fileName;
      $_SESSION['image']['type'] = $fileType;
      $_SESSION['image']['data'] = file_get_contents($fileTmp);
      $base64 = base64_encode($_SESSION['image']['data']);
    } else {
      $_SESSION['image']['name'] = "";
      $_SESSION['image']['data'] = "";
      $_SESSION['image']['type'] = "";
    }

    if( $errmessage ){
      $mode = 'input';
    } else {
      $mode = 'confirm';
    }

  } else if( isset($_POST["send"] ) && $_POST["send"] ){
  
  //送信ボタン押下後処理

    $kind = $_SESSION['kind'];
    $name = $_SESSION['name'];
    $email = $_SESSION['email'];
    $tel = $_SESSION['tel'];
    $message = $_SESSION['message'];

    if (!empty($_SESSION['image']['name'])) {
      $image = uniqid(mt_rand(), true);
      $image .= '.' . substr(strrchr($_SESSION['image']['name'], '.'), 1);
      file_put_contents('images/' . $image, $_SESSION['image']);
      $imgexist = $_SESSION['image']['name'];
    } else {
      $imgexist = "なし";
    }

    //データベース接続
    $dbh = new PDO($dsn, $user, $password);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

    $sql = "INSERT INTO form(kind, name, email, tel, message, imgname) VALUES (:kind, :name, :email, :tel, :message, :image)";
    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(':email', ($email !== '') ? $email : '0', PDO::PARAM_STR);
    $stmt->bindValue(':tel', ($tel !== '') ? $tel : '0', PDO::PARAM_STR);
    $stmt->bindValue(':message', ($message !== '') ? $message : '0', PDO::PARAM_STR);
    $stmt->bindValue(':image', ($imagename !== '') ? $imgname : '0', PDO::PARAM_STR);
    $params = array(':kind' => $kind, ':name' => $name, ':email' => $email, ':tel' => $tel, ':message' => $message, ':image' => $image);
    $stmt->execute($params);

    $dbh = null;
    
    //メール送信内容
    $boundary = uniqid(rand(), true);
    $subject = "お問い合わせありがとうございます";

    $header = "Content-Type: multipart/mixed;boundary=\"__BOUNDARY__\"\r\n";

    $body .= "下記の内容にてお問い合わせを受け付けました。\r\n"
    . "--__BOUNDARY__\r\n"
    . "【件名】\r\n" . $kind . "\r\n"
    . "【名前】\r\n" . $name . "\r\n"
    . "【メールアドレス】\r\n" . $email . "\r\n"
    . "【電話番号】\r\n" . $tel . "\r\n"
    . "【お問い合わせ内容】\r\n" . preg_replace("/\r\n|\r|\n/", "\r\n", $message) . "\r\n"
    . "【アップロード画像】\r\n" . $imgexist . "\r\n";    

    mb_send_mail($email, $subject, $body, $header);
    mb_send_mail($myemail, $subject, $body, $header);  

    $_SESSION = array();
    $mode = "send";
  } else {
    $_SESSION['kind'] = "";
    $_SESSION['name'] = "";
    $_SESSION['email'] = "";
    $_SESSION['tel'] = "";
    $_SESSION['message'] = "";
    $_SESSION['image']['name'] = "";
    $_SESSION['image']['data'] = "";
    $_SESSION['image']['type'] = "";
  }
?>