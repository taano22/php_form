<?php require('function.php'); ?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>お問い合わせフォーム</title>
    <link href="css/style.css" rel="stylesheet" type="text/css">
    <link href="css/responsive.css" rel="stylesheet" type="text/css">    
</head>
<body>
  <?php if( $mode == 'input' ){ ?>
  <!--フォームページ-->
    <?php
      if( $errmessage ){
        echo '<div style="color:red;">';
        echo implode('<br>', $errmessage );
        echo '</div>';
      }
    ?>
    <div class="form-area">
      <h1>お問い合わせフォーム</h1>
      <form action="./form.php" enctype="multipart/form-data" method="post">
        <table>
          <tr>
            <th>件名<span class="req">(必須)</span></th>
            <td>
              <select name="kind" value="<?php echo $_SESSION['kind'] ?>" required>
                <?php
                  foreach($kindlist as $key => $value){
                    if($value == $_SESSION["kind"]){
                      echo "<option value='$value' selected>".$value."</option>";
                    }else{
                      echo "<option value='$value'>".$value."</option>";
                    }
                  }
                ?>
              </select><br>
            </td>
          </tr>
          <tr>              
            <th>名前<span class="req">(必須)</span></th>
            <td>
              <div class="input-area">
                <input type="text" name="name" value="<?php echo $_SESSION['name'] ?>" id="name" required>
                <div class="counter"><span id="count_name">0</span>/30</div>
              </div>
            </td>
          </tr>
          <tr>
            <th>メールアドレス<span class="req">(必須)</span></th>
            <td>
              <div class="input-area">
                <input type="email" name="email" value="<?php echo $_SESSION['email'] ?>" id="email" required>
                <div class="counter"><span id="count_email">0</span>/50</div>
              </div>
            </td>
          </tr>
          <tr>  
            <th>電話番号<span class="req">(必須)</span></th>
            <td>
              <div class="input-area">
                <input type="tel" name="tel" value="<?php echo $_SESSION['tel'] ?>" id="tel" required>
                <div class="counter"><span id="count_tel">0</span>/20</div>
              </div>
            </td>
          </tr>
          <tr>
            <th>お問い合わせ内容<span class="req">(必須)</span></th>
            <td>
              <div class="input-area">
                <textarea name="message" id="" cols="50" rows="10" id="message" required><?php echo $_SESSION['message'] ?></textarea>
                <div class="counter"><span id="count_message">0</span>/500</div>
              </div>
            </td>
          </tr>
          <tr>
            <th>
              画像ファイルをアップロード<span>(任意)</span><br>
              <span>対応ファイル形式(jpeg,png,gif)</span>            
            </th>
            <td>
              <input type="file" name="image" id="image" accept="image/*"><br>
              <div class="previmg-area"><img id="previmg"></div><br><br>
            </td>
          </tr>
        </table>
        <div class="btn-area"><div class="btn-confirm"><input type="submit" name="confirm" value="確認" class="button"></div></div>    
      </form>
    </div>
  <?php } else if( $mode == "confirm" ){ ?>
  <!--確認ページ-->
    <div class="form-area">
      <h1>以下の内容で送信してよろしいですか。</h1>
      <form action="./form.php" method="post">
        <table>
          <tr>
            <th>件名<span class="req">(必須)</span></th>
            <td><?php echo $_SESSION['kind'] ?></td>
          </tr>
          <tr>
            <th>名前<span class="req">(必須)</span></th>
            <td><?php echo $_SESSION['name'] ?></td>
          </tr>
          <tr>
            <th>メールアドレス<span class="req">(必須)</span></th>
            <td><?php echo $_SESSION['email'] ?></td>
          </tr>
          <tr>
            <th>電話番号<span class="req">(必須)</span></th>
            <td><?php echo $_SESSION['tel'] ?></td>
          </tr>
          <tr>
            <th>お問い合わせ内容<span class="req">(必須)</span></th>
            <td><?php echo $_SESSION['message'] ?></td>
          </tr>
          <tr>
            <th>アップロード画像<span>(任意)</span></th>
            <td>
              <?php if(empty($_SESSION['image']['name'])){
                echo "なし";
              } else {              
                print "<img src=\"data:image/*;base64,${base64}\">";
                echo $_SESSION['image']['name'];            
              } ?>
            </td>
          </tr>
        </table>
        <div class="btn-area">          
          <div class="btn-back"><input type="submit" name="back" value="修正" /></div>
          <div class="btn-send"><input type="submit" name="send" value="送信" /></div>
        </div>        
      </form>
    </div>
  <?php } else { ?>
  <!--送信完了ページ-->
    <div class="result-message">
      お問い合わせいただきありがとうございます。お問い合わせ内容を受け付けました。<br>
      また、受付内容を登録のメールアドレスに送信しました。<br>
    </div>
  <?php } ?>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
  <script src="js/main.js"></script>
</body>
</html>