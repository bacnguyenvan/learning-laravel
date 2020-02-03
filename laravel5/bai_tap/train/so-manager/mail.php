<?php header("Content-Type:text/html;charset=utf-8"); ?>
<?php //error_reporting(E_ALL | E_STRICT);
##-----------------------------------------------------------------------------------------------------------------##
#
#  PHPメールプログラム　フリー版 最終更新日2018/07/27
#　改造や改変は自己責任で行ってください。
#	
#  HP: http://www.php-factory.net/
#
#  重要！！サイトでチェックボックスを使用する場合のみですが。。。
#  チェックボックスを使用する場合はinputタグに記述するname属性の値を必ず配列の形にしてください。
#  例　name="当サイトをしったきっかけ[]"  として下さい。
#  nameの値の最後に[と]を付ける。じゃないと複数の値を取得できません！
#
##-----------------------------------------------------------------------------------------------------------------##
if (version_compare(PHP_VERSION, '5.1.0', '>=')) {//PHP5.1.0以上の場合のみタイムゾーンを定義
	date_default_timezone_set('Asia/Tokyo');//タイムゾーンの設定（日本以外の場合には適宜設定ください）
}
/*-------------------------------------------------------------------------------------------------------------------
* ★以下設定時の注意点　
* ・値（=の後）は数字以外の文字列（一部を除く）はダブルクオーテーション「"」、または「'」で囲んでいます。
* ・これをを外したり削除したりしないでください。後ろのセミコロン「;」も削除しないください。
* ・また先頭に「$」が付いた文字列は変更しないでください。数字の1または0で設定しているものは必ず半角数字で設定下さい。
* ・メールアドレスのname属性の値が「Email」ではない場合、以下必須設定箇所の「$Email」の値も変更下さい。
* ・name属性の値に半角スペースは使用できません。
*以上のことを間違えてしまうとプログラムが動作しなくなりますので注意下さい。
-------------------------------------------------------------------------------------------------------------------*/


//---------------------------　必須設定　必ず設定してください　-----------------------

//サイトのトップページのURL　※デフォルトでは送信完了後に「トップページへ戻る」ボタンが表示されますので
$site_top = "http://so-manager.com/";

//管理者のメールアドレス ※メールを受け取るメールアドレス(複数指定する場合は「,」で区切ってください 例 $to = "aa@aa.aa,bb@bb.bb";)
$to = "admin@so-manager.com";

//自動返信メールの送信元メールアドレス
//必ず実在するメールアドレスでかつ出来る限り設置先サイトのドメインと同じドメインのメールアドレスとすることを強く推奨します
$from = "admin@so-manager.com";

//フォームのメールアドレス入力箇所のname属性の値（name="○○"　の○○部分）
$Email = "メールアドレス";
//---------------------------　必須設定　ここまで　------------------------------------


//---------------------------　セキュリティ、スパム防止のための設定　------------------------------------

//スパム防止のためのリファラチェック（フォーム側とこのファイルが同一ドメインであるかどうかのチェック）(する=1, しない=0)
//※有効にするにはこのファイルとフォームのページが同一ドメイン内にある必要があります
$Referer_check = 0;

//リファラチェックを「する」場合のドメイン ※設置するサイトのドメインを指定して下さい。
//もしこの設定が間違っている場合は送信テストですぐに気付けます。
$Referer_check_domain = "";

/*セッションによるワンタイムトークン（CSRF対策、及びスパム防止）(する=1, しない=0)
※ただし、この機能を使う場合は↓の送信確認画面の表示が必須です。（デフォルトではON（1）になっています）
※【重要】ガラケーは機種によってはクッキーが使えないためガラケーの利用も想定してる場合は「0」（OFF）にして下さい（PC、スマホは問題ないです）*/
$useToken = 1;
//---------------------------　セキュリティ、スパム防止のための設定　ここまで　------------------------------------


//---------------------- 任意設定　以下は必要に応じて設定してください ------------------------


// 管理者宛のメールで差出人を送信者のメールアドレスにする(する=1, しない=0)
// する場合は、メール入力欄のname属性の値を「$Email」で指定した値にしてください。
//メーラーなどで返信する場合に便利なので「する」がおすすめです。
$userMail = 1;

// Bccで送るメールアドレス(複数指定する場合は「,」で区切ってください 例 $BccMail = "aa@aa.aa,bb@bb.bb";)
$BccMail = "";

// 管理者宛に送信されるメールのタイトル（件名）
$subject = "【So-Manager】お問い合わせを受付けいたしました";

// 送信確認画面の表示(する=1, しない=0)
$confirmDsp = 1;

// 送信完了後に自動的に指定のページ(サンクスページなど)に移動する(する=1, しない=0)
// CV率を解析したい場合などはサンクスページを別途用意し、URLをこの下の項目で指定してください。
// 0にすると、デフォルトの送信完了画面が表示されます。
$jumpPage = 0;

// 送信完了後に表示するページURL（上記で1を設定した場合のみ）※httpから始まるURLで指定ください。（相対パスでも基本的には問題ないです）
$thanksPage = "http://so-manager.com/thanks.html";

// 必須入力項目を設定する(する=1, しない=0)
$requireCheck = 0;

/* 必須入力項目(入力フォームで指定したname属性の値を指定してください。（上記で1を設定した場合のみ）
値はシングルクォーテーションで囲み、複数の場合はカンマで区切ってください。フォーム側と順番を合わせると良いです。 
配列の形「name="○○[]"」の場合には必ず後ろの[]を取ったものを指定して下さい。*/
$require = array('');


//----------------------------------------------------------------------
//  自動返信メール設定(START)
//----------------------------------------------------------------------

// 差出人に送信内容確認メール（自動返信メール）を送る(送る=1, 送らない=0)
// 送る場合は、フォーム側のメール入力欄のname属性の値が上記「$Email」で指定した値と同じである必要があります
$remail = 1;

//自動返信メールの送信者欄に表示される名前　※あなたの名前や会社名など（もし自動返信メールの送信者名が文字化けする場合ここは空にしてください）
$refrom_name = "";

// 差出人に送信確認メールを送る場合のメールのタイトル（上記で1を設定した場合のみ）
$re_subject = "【So-Manager】お問い合わせを受付けいたしました";

//フォーム側の「名前」箇所のname属性の値　※自動返信メールの「○○様」の表示で使用します。
//指定しない、または存在しない場合は、○○様と表示されないだけです。あえて無効にしてもOK
$dsp_name = '氏名';

//自動返信メールの冒頭の文言 ※日本語部分のみ変更可
$remail_text = <<< TEXT

この度はSo-Managerへお問い合わせくださいまして、ありがとうございます。
お問合わせメールを受付けいたしました。
受信いたしました順に開封をさせていただきますが、受信メールの混雑度合やお問い合わせ内容により
お返事に最大１週間程度のお日にちをいただく場合やご返信できない場合がございます。

＊メール応対時間は平日10:00から18:00までとなっております。
　 お急ぎの場合や、Eメールで承れない項目につきましては、お電話でのお問合わせをお願いいたします。
　So-Managerコールセンター　　03-5856-4720　（10:00〜18:00）

なお、このメールは送信専用となり、ご返信されましても弊社には送信されません。

TEXT;


//自動返信メールに署名（フッター）を表示(する=1, しない=0)※管理者宛にも表示されます。
$mailFooterDsp = 1;

//上記で「1」を選択時に表示する署名（フッター）（FOOTER～FOOTER;の間に記述してください）
$mailSignature = <<< FOOTER

──────────────────────
■お問合せ先■
So-Managerコールセンター（ソーマネージャーコールセンター）
●電話：03−5856−4720
●メールでのお問合せ（専用フォームよりお問合せください）
https://so-manager.com/contact.html

※本メールアドレスは送信専用です。ご返信には回答致しかねますのでご了承ください。
※本メールにお心あたりのない場合には、コールセンターまでご連絡くださいますようお願い致します。
──────────────────────

FOOTER;


//----------------------------------------------------------------------
//  自動返信メール設定(END)
//----------------------------------------------------------------------

//メールアドレスの形式チェックを行うかどうか。(する=1, しない=0)
//※デフォルトは「する」。特に理由がなければ変更しないで下さい。メール入力欄のname属性の値が上記「$Email」で指定した値である必要があります。
$mail_check = 1;

//全角英数字→半角変換を行うかどうか。(する=1, しない=0)
$hankaku = 0;

//全角英数字→半角変換を行う項目のname属性の値（name="○○"の「○○」部分）
//※複数の場合にはカンマで区切って下さい。（上記で「1」を指定した場合のみ有効）
//配列の形「name="○○[]"」の場合には必ず後ろの[]を取ったものを指定して下さい。
$hankaku_array = array('電話番号','金額');

//-fオプションによるエンベロープFrom（Return-Path）の設定(する=1, しない=0)　
//※宛先不明（間違いなどで存在しないアドレス）の場合に 管理者宛に「Mail Delivery System」から「Undelivered Mail Returned to Sender」というメールが届きます。
//サーバーによっては稀にこの設定が必須の場合もあります。
//設置サーバーでPHPがセーフモードで動作している場合は使用できませんので送信時にエラーが出たりメールが届かない場合は「0」（OFF）として下さい。
$use_envelope = 0;

//機種依存文字の変換
/*たとえば㈱（かっこ株）や①（丸1）、その他特殊な記号や特殊な漢字などは変換できずに「？」と表示されます。それを回避するための機能です。
確認画面表示時に置換処理されます。「変換前の文字」が「変換後の文字」に変換され、送信メール内でも変換された状態で送信されます。（たとえば「㈱」の場合、「（株）」に変換されます） 
必要に応じて自由に追加して下さい。ただし、変換前の文字と変換後の文字の順番と数は必ず合わせる必要がありますのでご注意下さい。*/

//変換前の文字
$replaceStr['before'] = array('①','②','③','④','⑤','⑥','⑦','⑧','⑨','⑩','№','㈲','㈱','髙');
//変換後の文字
$replaceStr['after'] = array('(1)','(2)','(3)','(4)','(5)','(6)','(7)','(8)','(9)','(10)','No.','（有）','（株）','高');

//------------------------------- 任意設定ここまで ---------------------------------------------


// 以下の変更は知識のある方のみ自己責任でお願いします。

//----------------------------------------------------------------------
//  関数実行、変数初期化
//----------------------------------------------------------------------
//トークンチェック用のセッションスタート
if($useToken == 1 && $confirmDsp == 1){
	session_name('PHPMAILFORMSYSTEM');
	session_start();
}
$encode = "UTF-8";//このファイルの文字コード定義（変更不可）
if(isset($_GET)) $_GET = sanitize($_GET);//NULLバイト除去//
if(isset($_POST)) $_POST = sanitize($_POST);//NULLバイト除去//
if(isset($_COOKIE)) $_COOKIE = sanitize($_COOKIE);//NULLバイト除去//
if($encode == 'SJIS') $_POST = sjisReplace($_POST,$encode);//Shift-JISの場合に誤変換文字の置換実行
$funcRefererCheck = refererCheck($Referer_check,$Referer_check_domain);//リファラチェック実行

//変数初期化
$sendmail = 0;
$empty_flag = 0;
$post_mail = '';
$errm ='';
$header ='';

if($requireCheck == 1) {
	$requireResArray = requireCheck($require);//必須チェック実行し返り値を受け取る
	$errm = $requireResArray['errm'];
	$empty_flag = $requireResArray['empty_flag'];
}
//メールアドレスチェック
if(empty($errm)){
	foreach($_POST as $key=>$val) {
		if($val == "confirm_submit") $sendmail = 1;
		if($key == $Email) $post_mail = h($val);
		if($key == $Email && $mail_check == 1 && !empty($val)){
			if(!checkMail($val)){
				$errm .= "<p class=\"error_messe\">【".$key."】はメールアドレスの形式が正しくありません。</p>\n";
				$empty_flag = 1;
			}
		}
	}
}
  
if(($confirmDsp == 0 || $sendmail == 1) && $empty_flag != 1){
	
	//トークンチェック（CSRF対策）※確認画面がONの場合のみ実施
	if($useToken == 1 && $confirmDsp == 1){
		if(empty($_SESSION['mailform_token']) || ($_SESSION['mailform_token'] !== $_POST['mailform_token'])){
			exit('ページ遷移が不正です');
		}
		if(isset($_SESSION['mailform_token'])) unset($_SESSION['mailform_token']);//トークン破棄
		if(isset($_POST['mailform_token'])) unset($_POST['mailform_token']);//トークン破棄
	}
	
	//差出人に届くメールをセット
	if($remail == 1) {
		$userBody = mailToUser($_POST,$dsp_name,$remail_text,$mailFooterDsp,$mailSignature,$encode);
		$reheader = userHeader($refrom_name,$from,$encode);
		$re_subject = "=?iso-2022-jp?B?".base64_encode(mb_convert_encoding($re_subject,"JIS",$encode))."?=";
	}
	//管理者宛に届くメールをセット
	$adminBody = mailToAdmin($_POST,$subject,$mailFooterDsp,$mailSignature,$encode,$confirmDsp);
	$header = adminHeader($userMail,$post_mail,$BccMail,$to);
	$subject = "=?iso-2022-jp?B?".base64_encode(mb_convert_encoding($subject,"JIS",$encode))."?=";
	
	//-fオプションによるエンベロープFrom（Return-Path）の設定(safe_modeがOFFの場合かつ上記設定がONの場合のみ実施)
	if($use_envelope == 0){
		mail($to,$subject,$adminBody,$header);
		if($remail == 1 && !empty($post_mail)) mail($post_mail,$re_subject,$userBody,$reheader);
	}else{
		mail($to,$subject,$adminBody,$header,'-f'.$from);
		if($remail == 1 && !empty($post_mail)) mail($post_mail,$re_subject,$userBody,$reheader,'-f'.$from);
	}
}
else if($confirmDsp == 1){ 

/*　▼▼▼送信確認画面のレイアウト※編集可　オリジナルのデザインも適用可能▼▼▼　*/
?>
<!doctype html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="format-detection" content="telephone=no">
    <link rel="alternate" media="handheld" href="./index.html">
    <link rel="alternate" media="only screen and (max-width: 768px)" href="./index.html">
    <link rel="icon" href="./favicon.ico">

    <title>お問い合わせ｜So-Manager</title>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/typicons/2.0.9/typicons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/earlyaccess/roundedmplus1c.css" rel="stylesheet" />

    <!-- Bootstrap core CSS -->
    <link href="./bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="./assets/css/style.css" rel="stylesheet">

    <meta property="og:title" content="so-manager">
    <meta property="og:url" content="./index.html">
    <meta property="og:image" content="./assets/img/so-rin_logo.png">
    <meta property="og:site_name" content="so-manager">
    <meta property="og:description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="./assets/js/ie-emulation-modes-warning.js"></script><![endif]-->
    <script src="./assets/js/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
<style type="text/css">
/* 自由に編集下さい */
#formWrap {
	width:700px;
	margin:0 auto;
	color:#555;
	line-height:120%;
	font-size:90%;
}
table.formTable{
	width:100%;
	margin:0 auto;
	border-collapse:collapse;
}
table.formTable td,table.formTable th{
	border:1px solid #ccc;
	padding:10px;
}
table.formTable th{
	width:30%;
	font-weight:normal;
	background:#efefef;
	text-align:left;
}
p.error_messe{
	margin:5px 0;
	color:red;
}
/*　簡易版レスポンシブ用CSS（必要最低限のみとしています。ブレークポイントも含め自由に設定下さい）　*/
@media screen and (max-width:572px) {
#formWrap {
	width:95%;
	margin:0 auto;
}
table.formTable th, table.formTable td {
	width:auto;
	display:block;
}
table.formTable th {
	margin-top:5px;
	border-bottom:0;
}
input[type="submit"], input[type="reset"], input[type="button"] {
	display:block;
	width:100%;
	height:40px;
}
}
</style>
</head>
<body>
    <header id="top" class="bg-light">
      <div class="container pt10">
        <div class="row mt10 mb10">
          <div class="col-5 col-lg-4">
            <a id="site-logo" class="navbar-brand" href="./index.html">
              <img src="./assets/img/so-rin_logo.png" alt="logo" />
              <h1>
                <span class="small pc">駐車場・駐輪場総合サポートの株式会社ソーリン<br></span>
                So-Manager
              </h1>
            </a>
          </div>
          <div class="col-lg-4 d-none d-lg-inline tl-search-area">
<!--            <form class="form-inline pc" action="./search-finish.html">
              <div class="form-group">
                <input class="ml10 form-control" type="text" placeholder="キーワードを入力…" aria-label="Search">
                <button class="ml10 btn btn-outline-success badge-pill" type="submit">検索</button>
              </div>
            </form>
-->          </div>
          <div class="col-6 col-lg-4 offset-1 offset-lg-0 tl-btn-area">
            <a href="./login.html" class="btn btn-success badge-pill" id="login-btn">マイページ<span class="pc">へログイン</span></a>
            <a href="./SWO-2.html" class="btn btn-outline-secondary badge-pill pc" id="sub-btn">会員登録</a>
            <a class="d-lg-none h2" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample" href="#collapseExample" id="nav-menu-btn"><span class="typcn typcn-th-menu"></span></a>
            <!--<a href="" class="pc"><img src="./assets/img/fb.png" alt="fb" class="rounded-circle" /></a>-->            
          </div>
        </div>
        <div class="row">
          <nav class="col-12 navbar navbar-expand-lg justify-content-around" id="pc-nav-menu"><!-- PC用メインナビゲーション -->
            <ul class="navbar-nav pc">
              <li class="nav-item"><a class="nav-link" href="#">HOME <span class="sr-only">(current)</span></a></li>
              <li class="nav-item"><a class="nav-link" href="./howto.html">かんたんご利用ガイド</a></li>
              <li class="nav-item"><a class="nav-link" href="./search.html">空き駐輪場検索</a></li>
              <li class="nav-item"><a class="nav-link" href="./faq.html">よくある質問</a></li>
              <li class="nav-item active"><a class="nav-link" href="./contact.html">お問い合わせ</a></li>
            </ul>            
          </nav><!-- ./PC用メインナビゲーション -->          
        </div>
      </div>
      <div class="bg-dark" id="nav-menu"><!-- モバイル用メインナビゲーション -->
        <div class="container">
        <nav class="collapse pb10" id="collapseExample">
          <ul class="navbar-nav">
            <li class="nav-item active"><a class="nav-link" href="./index.html">HOME <span class="sr-only">(current)</span></a></li>
            <li class="nav-item"><a class="nav-link" href="./howto.html">So-Managerの使い方</a></li>
            <li class="nav-item"><a class="nav-link" href="./search.html">空き駐輪場検索</a></li>
            <li class="nav-item"><a class="nav-link" href="./faq.html">よくある質問</a></li>
            <li class="nav-item"><a class="nav-link" href="./contact.html">お問い合わせ</a></li>
          </ul>
          <form class="container mt10 mb10" action="./search-finish.html">
            <div class="row">
<!--              <input class="form-control col-7 offset-1" type="text" placeholder="キーワードを入力…" aria-label="Search">
              <button class="ml10 btn btn-success col-2" type="submit">検索</button>
-->            </div>
          </form>
        </nav>          
        </div>
      </div><!-- ./モバイル用メインナビゲーション -->
    </header>

<!-- ▲ Headerやその他コンテンツなど　※自由に編集可 ▲-->

<!-- ▼************ 送信内容表示部　※編集は自己責任で ************ ▼-->
<div id="formWrap">
<?php if($empty_flag == 1){ ?>
<div align="center">
<h4>入力にエラーがあります。下記をご確認の上「戻る」ボタンにて修正をお願い致します。</h4>
<?php echo $errm; ?><br /><br /><input type="button" value=" 前画面に戻る " onClick="history.back()">
</div>
<?php }else{ ?>
<h2 class="text-center mt50 mb30">確認画面</h2>
<p align="center">以下の内容で間違いがなければ、「送信する」ボタンを押してください。</p>
<form action="<?php echo h($_SERVER['SCRIPT_NAME']); ?>" method="POST">
<table class="formTable table">
<?php echo confirmOutput($_POST);//入力内容を表示?>
</table>
<p align="center" class="mt50 mb50"><input type="hidden" name="mail_set" value="confirm_submit">
<input type="hidden" name="httpReferer" value="<?php echo h($_SERVER['HTTP_REFERER']);?>">
<input type="submit" class="btn btn-success" value="　送信する　">
<input type="button" class="btn btn-outline-success" value="前画面に戻る" onClick="history.back()"></p>
</form>
<?php } ?>
</div><!-- /formWrap -->
<!-- ▲ *********** 送信内容確認部　※編集は自己責任で ************ ▲-->
    <footer class="jumbotron">
      <section class="container">
        <div class="row">
          <div class="col-12 text-center">
            <ul class="footer-nav-menu">
              <li><a href="./summary.html">運営会社</a></li>
              <li><a href="./privacy.html">個人情報保護方針</a></li>
              <li class="pc"><a href="./tokusyo.html">特定商取引法に基づく表示</a></li>
              <li class="w-100 sp"><a href="./tokusyo.html">特定商取引法に基づく表示</a></li>
              <li><a href="./riyokiyaku.html">利用規約</a></li>
              <li><a href="./sitemap.html">サイトマップ</a></li>
            </ul>
          </div>
          <div class="col-12 col-md-10 offset-0 offset-md-1 text-lg-center">
            <p class="small text-secondary mt20">
              株式会社ソーリン　<br class="sp">
              〒121-0073　東京都足立区六町4-12-25　<br class="sp">
              tel:03-5856-4647　fax:03-5856-4648<br>
            </p>
            <p class="small text-secondary">            
              Copyright© so-rin Co.,Ltd. All Rights Reserved.              
            </p>
          </div>
        </div>
      </section>
      <figure class="p-mark"><img src="./assets/img/10740034_06_75_JP.gif" alt="Pマーク" /></figure>
    </footer>

    <!-- ▼　文字サイズCSS変更ボタン　▼ -->
    <section id="scale-control-area" class="text-center">
      <button class="btn btn-success mt10">文字を大きく+</button>
      <button class="btn btn-success btn-submit mt10 d-none">文字を大きく++</button>
      <br class="pc">
      <button class="btn btn-secondary mt10">文字を小さく-</button>
      <button class="btn btn-secondary btn-cancel mt10 d-none">元のサイズへ</button>
    </section>
    <!-- ▲　文字サイズCSS変更ボタン　▲ -->

   </div><!-- ./#font-scale -->
<!-- ▼ Footerその他コンテンツなど　※編集可 ▼-->
</body>
</html>
<?php
/* ▲▲▲送信確認画面のレイアウト　※オリジナルのデザインも適用可能▲▲▲　*/
}

if(($jumpPage == 0 && $sendmail == 1) || ($jumpPage == 0 && ($confirmDsp == 0 && $sendmail == 0))) { 

/* ▼▼▼送信完了画面のレイアウト　編集可 ※送信完了後に指定のページに移動しない場合のみ表示▼▼▼　*/
?>
<!doctype html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="format-detection" content="telephone=no">
    <link rel="alternate" media="handheld" href="./index.html">
    <link rel="alternate" media="only screen and (max-width: 768px)" href="./index.html">
    <link rel="icon" href="./favicon.ico">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/typicons/2.0.9/typicons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/earlyaccess/roundedmplus1c.css" rel="stylesheet" />

    <!-- Bootstrap core CSS -->
    <link href="./bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="./assets/css/style.css" rel="stylesheet">

    <meta property="og:title" content="so-manager">
    <meta property="og:url" content="./index.html">
    <meta property="og:image" content="./assets/img/so-rin_logo.png">
    <meta property="og:site_name" content="so-manager">
    <meta property="og:description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="./assets/js/ie-emulation-modes-warning.js"></script><![endif]-->
    <script src="./assets/js/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]--><title>完了画面｜So-Manager</title>
</head>
<body>
    <header id="top" class="bg-light">
      <div class="container pt10">
        <div class="row mt10 mb10">
          <div class="col-5 col-lg-4">
            <a id="site-logo" class="navbar-brand" href="./index.html">
              <img src="./assets/img/so-rin_logo.png" alt="logo" />
              <h1>
                <span class="small pc">駐車場・駐輪場総合サポートの株式会社ソーリン<br></span>
                So-Manager
              </h1>
            </a>
          </div>
          <div class="col-lg-4 d-none d-lg-inline tl-search-area">
<!--            <form class="form-inline pc" action="./search-finish.html">
              <div class="form-group">
                <input class="ml10 form-control" type="text" placeholder="キーワードを入力…" aria-label="Search">
                <button class="ml10 btn btn-outline-success badge-pill" type="submit">検索</button>
              </div>
            </form>
-->          </div>
          <div class="col-6 col-lg-4 offset-1 offset-lg-0 tl-btn-area">
            <a href="./login.html" class="btn btn-success badge-pill" id="login-btn">マイページ<span class="pc">へログイン</span></a>
            <a href="./SWO-2.html" class="btn btn-outline-secondary badge-pill pc" id="sub-btn">会員登録</a>
            <a class="d-lg-none h2" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample" href="#collapseExample" id="nav-menu-btn"><span class="typcn typcn-th-menu"></span></a>
            <!--<a href="" class="pc"><img src="./assets/img/fb.png" alt="fb" class="rounded-circle" /></a>-->            
          </div>
        </div>
        <div class="row">
          <nav class="col-12 navbar navbar-expand-lg justify-content-around" id="pc-nav-menu"><!-- PC用メインナビゲーション -->
            <ul class="navbar-nav pc">
              <li class="nav-item"><a class="nav-link" href="#">HOME <span class="sr-only">(current)</span></a></li>
              <li class="nav-item"><a class="nav-link" href="./howto.html">かんたんご利用ガイド</a></li>
              <li class="nav-item"><a class="nav-link" href="./search.html">空き駐輪場検索</a></li>
              <li class="nav-item"><a class="nav-link" href="./faq.html">よくある質問</a></li>
              <li class="nav-item active"><a class="nav-link" href="./contact.html">お問い合わせ</a></li>
            </ul>            
          </nav><!-- ./PC用メインナビゲーション -->          
        </div>
      </div>
      <div class="bg-dark" id="nav-menu"><!-- モバイル用メインナビゲーション -->
        <div class="container">
        <nav class="collapse pb10" id="collapseExample">
          <ul class="navbar-nav">
            <li class="nav-item active"><a class="nav-link" href="./index.html">HOME <span class="sr-only">(current)</span></a></li>
            <li class="nav-item"><a class="nav-link" href="./howto.html">So-Managerの使い方</a></li>
            <li class="nav-item"><a class="nav-link" href="./search.html">空き駐輪場検索</a></li>
            <li class="nav-item"><a class="nav-link" href="./faq.html">よくある質問</a></li>
            <li class="nav-item"><a class="nav-link" href="./contact.html">お問い合わせ</a></li>
          </ul>
          <form class="container mt10 mb10" action="./search-finish.html">
            <div class="row">
<!--              <input class="form-control col-7 offset-1" type="text" placeholder="キーワードを入力…" aria-label="Search">
              <button class="ml10 btn btn-success col-2" type="submit">検索</button>
-->            </div>
          </form>
        </nav>          
        </div>
      </div><!-- ./モバイル用メインナビゲーション -->
    </header>

<div align="center">
<?php if($empty_flag == 1){ ?>
<h4>入力にエラーがあります。下記をご確認の上「戻る」ボタンにて修正をお願い致します。</h4>
<div style="color:red"><?php echo $errm; ?></div>
<br /><br /><input type="button" value=" 前画面に戻る " onClick="history.back()">
</div>
</body>
</html>
<?php }else{ ?>
送信ありがとうございました。<br />
送信は正常に完了しました。<br /><br />
<a href="<?php echo $site_top ;?>" class="mb50">トップページへ戻る&raquo;</a>
</div>
<!--  CV率を計測する場合ここにAnalyticsコードを貼り付け -->
    <footer class="jumbotron">
      <section class="container">
        <div class="row">
          <div class="col-12 text-center">
            <ul class="footer-nav-menu">
              <li><a href="./summary.html">運営会社</a></li>
              <li><a href="./privacy.html">個人情報保護方針</a></li>
              <li class="pc"><a href="./tokusyo.html">特定商取引法に基づく表示</a></li>
              <li class="w-100 sp"><a href="./tokusyo.html">特定商取引法に基づく表示</a></li>
              <li><a href="./riyokiyaku.html">利用規約</a></li>
              <li><a href="./sitemap.html">サイトマップ</a></li>
            </ul>
          </div>
          <div class="col-12 col-md-10 offset-0 offset-md-1 text-lg-center">
            <p class="small text-secondary mt20">
              株式会社ソーリン　<br class="sp">
              〒121-0073　東京都足立区六町4-12-25　<br class="sp">
              tel:03-5856-4647　fax:03-5856-4648<br>
            </p>
            <p class="small text-secondary">            
              Copyright© so-rin Co.,Ltd. All Rights Reserved.              
            </p>
          </div>
        </div>
      </section>
      <figure class="p-mark"><img src="./assets/img/10740034_06_75_JP.gif" alt="Pマーク" /></figure>
    </footer>

    <!-- ▼　文字サイズCSS変更ボタン　▼ -->
    <section id="scale-control-area" class="text-center">
      <button class="btn btn-success mt10">文字を大きく+</button>
      <button class="btn btn-success btn-submit mt10 d-none">文字を大きく++</button>
      <br class="pc">
      <button class="btn btn-secondary mt10">文字を小さく-</button>
      <button class="btn btn-secondary btn-cancel mt10 d-none">元のサイズへ</button>
    </section>
    <!-- ▲　文字サイズCSS変更ボタン　▲ -->

   </div><!-- ./#font-scale -->

   <!-- Bootstrap core JavaScript
   ================================================== -->
   <!-- Placed at the end of the document so the pages load faster -->
   <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
   <script>window.jQuery || document.write('<script src="./assets/js/vendor/jquery.min.js"><\/script>')</script>
   <script src="./assets/js/vendor/popper.min.js"></script>
   <script src="./bootstrap/js/bootstrap.min.js"></script>
   <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
   <script src="./assets/js/ie10-viewport-bug-workaround.js"></script>    
   <script src="./assets/js/commons.js"></script>    
  </body>
</html>
<?php 
/* ▲▲▲送信完了画面のレイアウト 編集可 ※送信完了後に指定のページに移動しない場合のみ表示▲▲▲　*/
  }
}
//確認画面無しの場合の表示、指定のページに移動する設定の場合、エラーチェックで問題が無ければ指定ページヘリダイレクト
else if(($jumpPage == 1 && $sendmail == 1) || $confirmDsp == 0) { 
	if($empty_flag == 1){ ?>
<div align="center"><h4>入力にエラーがあります。下記をご確認の上「戻る」ボタンにて修正をお願い致します。</h4><div style="color:red"><?php echo $errm; ?></div><br /><br /><input type="button" value=" 前画面に戻る " onClick="history.back()"></div>
<?php 
	}else{ header("Location: ".$thanksPage); }
}

// 以下の変更は知識のある方のみ自己責任でお願いします。

//----------------------------------------------------------------------
//  関数定義(START)
//----------------------------------------------------------------------
function checkMail($str){
	$mailaddress_array = explode('@',$str);
	if(preg_match("/^[\.!#%&\-_0-9a-zA-Z\?\/\+]+\@[!#%&\-_0-9a-zA-Z]+(\.[!#%&\-_0-9a-zA-Z]+)+$/", "$str") && count($mailaddress_array) ==2){
		return true;
	}else{
		return false;
	}
}
function h($string) {
	global $encode;
	return htmlspecialchars($string, ENT_QUOTES,$encode);
}
function sanitize($arr){
	if(is_array($arr)){
		return array_map('sanitize',$arr);
	}
	return str_replace("\0","",$arr);
}
//Shift-JISの場合に誤変換文字の置換関数
function sjisReplace($arr,$encode){
	foreach($arr as $key => $val){
		$key = str_replace('＼','ー',$key);
		$resArray[$key] = $val;
	}
	return $resArray;
}
//送信メールにPOSTデータをセットする関数
function postToMail($arr){
	global $hankaku,$hankaku_array;
	$resArray = '';
	foreach($arr as $key => $val) {
		$out = '';
		if(is_array($val)){
			foreach($val as $key02 => $item){ 
				//連結項目の処理
				if(is_array($item)){
					$out .= connect2val($item);
				}else{
					$out .= $item . ', ';
				}
			}
			$out = rtrim($out,', ');
			
		}else{ $out = $val; }//チェックボックス（配列）追記ここまで
		if(get_magic_quotes_gpc()) { $out = stripslashes($out); }
		
		//全角→半角変換
		if($hankaku == 1){
			$out = zenkaku2hankaku($key,$out,$hankaku_array);
		}
		if($out != "confirm_submit" && $key != "httpReferer") {
			$resArray .= "【 ".h($key)." 】 ".h($out)."\n";
		}
	}
	return $resArray;
}
//確認画面の入力内容出力用関数
function confirmOutput($arr){
	global $hankaku,$hankaku_array,$useToken,$confirmDsp,$replaceStr;
	$html = '';
	foreach($arr as $key => $val) {
		$out = '';
		if(is_array($val)){
			foreach($val as $key02 => $item){ 
				//連結項目の処理
				if(is_array($item)){
					$out .= connect2val($item);
				}else{
					$out .= $item . ', ';
				}
			}
			$out = rtrim($out,', ');
			
		}else{ $out = $val; }//チェックボックス（配列）追記ここまで
		if(get_magic_quotes_gpc()) { $out = stripslashes($out); }
		$out = nl2br(h($out));//※追記 改行コードを<br>タグに変換
		$key = h($key);
		$out = str_replace($replaceStr['before'], $replaceStr['after'], $out);//機種依存文字の置換処理
		
		//全角→半角変換
		if($hankaku == 1){
			$out = zenkaku2hankaku($key,$out,$hankaku_array);
		}
		
		$html .= "<tr><th>".$key."</th><td>".$out;
		$html .= '<input type="hidden" name="'.$key.'" value="'.str_replace(array("<br />","<br>"),"",$out).'" />';
		$html .= "</td></tr>\n";
	}
	//トークンをセット
	if($useToken == 1 && $confirmDsp == 1){
		$token = sha1(uniqid(mt_rand(), true));
		$_SESSION['mailform_token'] = $token;
		$html .= '<input type="hidden" name="mailform_token" value="'.$token.'" />';
	}
	
	return $html;
}

//全角→半角変換
function zenkaku2hankaku($key,$out,$hankaku_array){
	global $encode;
	if(is_array($hankaku_array) && function_exists('mb_convert_kana')){
		foreach($hankaku_array as $hankaku_array_val){
			if($key == $hankaku_array_val){
				$out = mb_convert_kana($out,'a',$encode);
			}
		}
	}
	return $out;
}
//配列連結の処理
function connect2val($arr){
	$out = '';
	foreach($arr as $key => $val){
		if($key === 0 || $val == ''){//配列が未記入（0）、または内容が空のの場合には連結文字を付加しない（型まで調べる必要あり）
			$key = '';
		}elseif(strpos($key,"円") !== false && $val != '' && preg_match("/^[0-9]+$/",$val)){
			$val = number_format($val);//金額の場合には3桁ごとにカンマを追加
		}
		$out .= $val . $key;
	}
	return $out;
}

//管理者宛送信メールヘッダ
function adminHeader($userMail,$post_mail,$BccMail,$to){
	$header = '';
	if($userMail == 1 && !empty($post_mail)) {
		$header="From: $post_mail\n";
		if($BccMail != '') {
		  $header.="Bcc: $BccMail\n";
		}
		$header.="Reply-To: ".$post_mail."\n";
	}else {
		if($BccMail != '') {
		  $header="Bcc: $BccMail\n";
		}
		$header.="Reply-To: ".$to."\n";
	}
		$header.="Content-Type:text/plain;charset=iso-2022-jp\nX-Mailer: PHP/".phpversion();
		return $header;
}
//管理者宛送信メールボディ
function mailToAdmin($arr,$subject,$mailFooterDsp,$mailSignature,$encode,$confirmDsp){
	$adminBody="「".$subject."」からメールが届きました\n\n";
	$adminBody .="＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝\n\n";
	$adminBody.= postToMail($arr);//POSTデータを関数からセット
	$adminBody.="\n＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝\n";
	$adminBody.="送信された日時：".date( "Y/m/d (D) H:i:s", time() )."\n";
	$adminBody.="送信者のIPアドレス：".@$_SERVER["REMOTE_ADDR"]."\n";
	$adminBody.="送信者のホスト名：".getHostByAddr(getenv('REMOTE_ADDR'))."\n";
	if($confirmDsp != 1){
		$adminBody.="問い合わせのページURL：".@$_SERVER['HTTP_REFERER']."\n";
	}else{
		$adminBody.="問い合わせのページURL：".@$arr['httpReferer']."\n";
	}
	if($mailFooterDsp == 1) $adminBody.= $mailSignature;
	return mb_convert_encoding($adminBody,"JIS",$encode);
}

//ユーザ宛送信メールヘッダ
function userHeader($refrom_name,$to,$encode){
	$reheader = "From: ";
	if(!empty($refrom_name)){
		$default_internal_encode = mb_internal_encoding();
		if($default_internal_encode != $encode){
			mb_internal_encoding($encode);
		}
		$reheader .= mb_encode_mimeheader($refrom_name)." <".$to.">\nReply-To: ".$to;
	}else{
		$reheader .= "$to\nReply-To: ".$to;
	}
	$reheader .= "\nContent-Type: text/plain;charset=iso-2022-jp\nX-Mailer: PHP/".phpversion();
	return $reheader;
}
//ユーザ宛送信メールボディ
function mailToUser($arr,$dsp_name,$remail_text,$mailFooterDsp,$mailSignature,$encode){
	$userBody = '';
	if(isset($arr[$dsp_name])) $userBody = h($arr[$dsp_name]). " 様\n";
	$userBody.= $remail_text;
	$userBody.="\n＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝\n\n";
	$userBody.= postToMail($arr);//POSTデータを関数からセット
	$userBody.="\n＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝\n\n";
	$userBody.="送信日時：".date( "Y/m/d (D) H:i:s", time() )."\n";
	if($mailFooterDsp == 1) $userBody.= $mailSignature;
	return mb_convert_encoding($userBody,"JIS",$encode);
}
//必須チェック関数
function requireCheck($require){
	$res['errm'] = '';
	$res['empty_flag'] = 0;
	foreach($require as $requireVal){
		$existsFalg = '';
		foreach($_POST as $key => $val) {
			if($key == $requireVal) {
				
				//連結指定の項目（配列）のための必須チェック
				if(is_array($val)){
					$connectEmpty = 0;
					foreach($val as $kk => $vv){
						if(is_array($vv)){
							foreach($vv as $kk02 => $vv02){
								if($vv02 == ''){
									$connectEmpty++;
								}
							}
						}
						
					}
					if($connectEmpty > 0){
						$res['errm'] .= "<p class=\"error_messe\">【".h($key)."】は必須項目です。</p>\n";
						$res['empty_flag'] = 1;
					}
				}
				//デフォルト必須チェック
				elseif($val == ''){
					$res['errm'] .= "<p class=\"error_messe\">【".h($key)."】は必須項目です。</p>\n";
					$res['empty_flag'] = 1;
				}
				
				$existsFalg = 1;
				break;
			}
			
		}
		if($existsFalg != 1){
				$res['errm'] .= "<p class=\"error_messe\">【".$requireVal."】が未選択です。</p>\n";
				$res['empty_flag'] = 1;
		}
	}
	
	return $res;
}
//リファラチェック
function refererCheck($Referer_check,$Referer_check_domain){
	if($Referer_check == 1 && !empty($Referer_check_domain)){
		if(strpos($_SERVER['HTTP_REFERER'],$Referer_check_domain) === false){
			return exit('<p align="center">リファラチェックエラー。フォームページのドメインとこのファイルのドメインが一致しません</p>');
		}
	}
}
function copyright(){
	echo '<a style="display:block;text-align:center;margin:15px 0;font-size:11px;color:#aaa;text-decoration:none" href="http://www.php-factory.net/" target="_blank">- PHP工房 -</a>';
}
//----------------------------------------------------------------------
//  関数定義(END)
//----------------------------------------------------------------------
?>