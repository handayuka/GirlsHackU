<!DOCTYPE html>
<html lang="ja">
  
  <head>
    <meta charset="utf-8">
    <title>koi commics</title>
    <link rel="stylesheet" type="text/css" href="./css/style.css">
    <link rel="stylesheet" type="text/css" href="./css/edit.css">
    <script type="text/javascript" src="./js/jquery-3.1.1.min.js"></script>
    <script type="text/javascript" src="http://jsdo.it/lib/jquery-1.7.2/js"></script>
    <script type="text/javascript" src="http://jsdo.it/lib/jquery.ui-1.8.22/js"></script>
    <script src="./js/jquery.sidebar.min.js"></script>
    <script src="http://jillix.github.io/jQuery-sidebar/js/handlers.js"></script>
    <link href="./css/nav.css" rel="stylesheet"> <!-- Resource style -->
    <script src="./js/nav.js"></script> <!-- Modernizr -->
    <script type="text/javascript" src="//media.line.me/js/line-button.js?v=20140411" ></script>
    <script type="text/javascript">new media_line_me.LineButton({"pc":false,"lang":"ja","type":"a","text":"あなたも自分だけの漫画作りませんか? http://local.ochako.jp","withUrl":false});
    </script>
    <script src="./js/jscolor.min.js"></script>
    <script>
      (function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s); js.id = id;
      js.src = "//connect.facebook.net/ja_JP/sdk.js#xfbml=1&version=v2.8";
      fjs.parentNode.insertBefore(js, fjs);
      }(document, 'script', 'facebook-jssdk'));</script>
  </head>
  
  
  
  <body>
    
    <!-- headerだよ -->
    <header>
      <a href="./selection.html">
	<img src="./imgs/return1.png" width="40" height="40" style="position:absolute;left:20px;top:25px;">
      </a>
      <div style="text-align: left;margin-left: 70px;margin-top: 20px;">もう一度コマを選ぶ</div>
      <img src="./imgs/logo1.png" width="260" height="60" style="margin-top: -40px;">
    </header><!-- header -->
    
    
    
    <div id="nav_edit" style="display:block;">
      <div class="nav">
	<nav>
	  <ol class="cd-multi-steps text-center custom-icons">
            <li class="visited"><em><img src="./imgs/select.png" align="left" >Selection</em></li>
            <li class="current"><em><img src="./imgs/text.png" align="left">Text</em></li>
            <li><em><img src="./imgs/stamp.png" align="left">Stamp</em></li>
            <li><em><img src="./imgs/save.png" align="left">Save</em></li>
	  </ol>
	</nav>
      </div>
    </div><!-- new_edit -->
    
    <div id="nav_stamp" style="display: none;">
      <div class="nav">
	<nav>
	  <ol class="cd-multi-steps text-center custom-icons">
            <li class="visited"><em><img src="./imgs/select.png" align="left" >Selection</em></li>
            <li class="visited"><em><img src="./imgs/text.png" align="left">Text</em></li>
            <li class="current"><em><img src="./imgs/stamp.png" align="left">Stamp</em></li>
            <li class=""><em><img src="./imgs/save.png" align="left">Save</em></li>
	  </ol>
	</nav>
      </div>
    </div><!-- na_edit -->
    
    <div id="wrapper">
      
      
      
      <!-- 文字の設定 -->
      <dev id="edit">
	<h3>文字を入力します</h3>
	<div class="container" align="center">
	  <div><a href="#" class="btn btn-primary" data-action="toggle" data-side="bottom">Hint</a></div>
	</div>
	<div class="sidebars">
          <div class="sidebar bottom" align="left">
            <p>・文字を入力し、サイズ、色を選んでください。</p>
            <p>・絵の中のクリックした場所に文字が縦書きで入力されます。</p>
            <p>・文字を入力する時は全角だと綺麗に入力されます。</p>
            <p>・改行はできません。一行ごとに文字を入力してください。</p>
            <p>・選択した画像が出てこない時はclearボタンを押してください。</p>
            <p>・文字の編集が終わったら"保存"ボタンを押してください。</p>
            <p>・あとは気合いです。頑張ってください。</p>
            <p>・この画面はもう一度Hintを押すと閉まります。</p>
          </div>
	</div>
	<h2>
	  Text: <input id="text" name="text" type="text" placeholder="Example"><br>
	  Size: <input id="size" name="size" type="text" size="3" value="30"><br>
	  Color: <input id="color" class="jscolor" value="cc4499" type="text">
	</h2>
      </dev><!-- edit --> 
      
      
  <div id="stamp" style="display: none; width:60%;margin: 0px auto;">
	<p> 
	  <?php for($i = 1; $i  <= 20; $i++) { ?>
		<input type="image" src="./stamp/stamp<?php echo $i;?>.png" onclick="changeStamp(<?php echo $i;?>)">
		<?php }?>
	</p>
	<p>
	  あなたが選んだスタンプはこれです
	  <img id="num" src="./stamp/stamp1.png">
	</p>
  </div><!-- id stamp -->
      
      
      <!-- 本物のcanvas -->
      <div id="nakami" style="display: block;">
	<canvas id="canvas" name="canvas" width="900" height="761"></canvas>
	<br />
	<br />
	<br />
	<!-- clearボタン -->
	<p id="clear"><a class="btn_c"><span>Clear</span></a>
	  <!-- javascript 写真の読み込みとclearの設定 -->
	  <script type="text/javascript">
	    var canvas, cxt;
	    var flag=0;   //0はtext,1はstamp
	    function clear(){
	    var img = new Image();    //新規画像オブジェクト
	    img.src = "./imgs/<?php echo $_GET["img"]?>.jpg";
    	    canvas = $('#canvas'); 	
    	    cxt.drawImage(img, 0, 0,900,761)		
	    }
	    window.onload = function() {
	    var img = new Image();
    	    img.src = "./imgs/<?php echo $_GET["img"]?>.jpg";
    	    canvas = $('#canvas');
    	    cxt = canvas.get(0).getContext('2d');
    	    cxt.drawImage(img, 0, 0,900,761)
	    }();
	    // clear canvas text
	    $('#clear a').click(function() {
	    clear();
	    })
	    function chgImg(){
	    var cvs = document.getElementById("canvas");
	    var png = cvs.toDataURL();
	    document.getElementById('comic').src = png;
	    $('#stamp').css('display', 'none');
	    $('#chgImg').css('display', 'none');
	    $('#nakami').css('display', 'none');
	    $('#nav_stamp').css('display', 'none');
	    $('#nav_edit').css('display', 'none');
	    $('#toStamp').css('display', 'none');
	    $('#edit').css('display', 'none');
	    $('#save').css('display', 'block');
	    }
	  </script>
	  <script type="text/javascript" src="./js/edit.js"></script>
	  <!-- undo -->
	  <a class="btn_c" onclick="cUndo()"><span>Undo</span></a>
	  <br />
	  <br />
	  <br />
	</p>
      </div><!-- 中身 -->
      
      <!-- textで表示 -->
      <div id="toStamp" style="display: block;">
	<a class="btn_s" onclick="toStampFromText()"><span>次へ</span></a>
	<a class="btn_s" onclick="chgImg()"><span>保存</span></a>
      </div>
      
      <!-- stampで表示 -->
      <!-- 画像保存ボタン -->
      <div id="chgImg" style="display: none;">
	<a class="btn_s" onclick="toTextFromStamp()"><span>戻る</span></a>
	<a class="btn_s" onclick="chgImg()"><span>保存</span></a>
      </div>
      
      
      
    </div><!-- wrapper -->  
    
    <dev id="save" style="display:none;text-align: center;">
      <div class="nav">
	<nav>
	  <ol class="cd-multi-steps text-center custom-icons">
            <li class="visited"><em><img src="./imgs/select.png" align="left" >Selection</em></li>
            <li class="visited"><em><img src="./imgs/text.png" align="left">Text</em></li>
            <li class="visited"><em><img src="./imgs/stamp.png" align="left">Stamp</em></li>
            <li class="current"><em><img src="./imgs/save.png" align="left">Save</em></li>
	  </ol>
	</nav>
      </div><!-- save -->
      <p>写真を長押ししてカメラロールに保存してください!<br>
	お疲れ様です（*＾ω＾*）<br>もう一度最初から作る場合は左上の矢印をクリックしてください</p>
      <!-- 完成したImageの表示 -->
      <img id="comic" src="">
      <a class="btn_c" onclick="back()" ><span>書き足す</span></a>
      <!-- ツイッター共有 -->
      <br><br>
      画像を共有したい場合は、<br>画像を保存してからカメラロールから画像を選択してください。<br>
      <ul class="snsb">
	<!-- LINE -->
	<li><div class="lineButton">
	    <span>
      <script type="text/javascript" src="//media.line.me/js/line-button.js?v=20140411" ></script>
      <script type="text/javascript">
      new media_line_me.LineButton({"pc":false,"lang":"ja","type":"a","text":"あなたも自分だけの漫画作りませんか? http://local.ochako.jp","withUrl":false});
      </script>
	    </span>    
	</div></li>
	<!-- facebook -->
	<li><div id="fb-root"></div>
	  <div class="fb-share-button" data-href="http://local.ochako.jp" data-layout="button" data-size="large" data-mobile-iframe="true"><a class="fb-xfbml-parse-ignore" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Flocal.ochako.jp%2F&amp;src=sdkpreparse">シェア</a></div></li>
	<!-- twitter共有 -->
	<li><a href="https://twitter.com/share" class="twitter-share-button" data-url="http://local.ochako.jp" data-text="あなたも自分だけの漫画作りませんか?" data-size="large">Tweet</a> <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script></li>
      </ul>
    </dev>
    <!-- save -->
    
    
    <!--
	PHPの受け取り方。念のため残しておく
	<img src="./imgs/<?php echo $_GET["img"]?>.jpg" width="30" height="30" style="position:absolute;left:20px;">
	-->
    
  </body>
</html>
