<?php
error_reporting(0);
session_start();
if(!$_SESSION['islogin']){
  header("Location: index.php");exit;
}
?>
<!DOCTYPE HTML>
<html>
<head>
<title>Home</title>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<link rel="stylesheet" href="assets/css/main.css" />
</head>
<body>
<div id="wrapper" class="divided">
<section class="banner style1 orient-left content-align-left image-position-right fullscreen onload-image-fade-in onload-content-fade-right">
<div class="content">
  <h1>2019年4月21日</h1>
  <p class="major">今天，一早上都在出题，没吃饭。中午点了某汉堡，可以送餐上楼，挺好。</p>
  <p class="major">虽然感觉不怎么好吃，连薯条我都没吃多少。好在我也不饿，只是有点口渴。外卖送了冰红茶，挺好。</p>
</div>
<div class="image">
  <iframe src="getimage.php?action=downremoteimage&message=[img]http://b-ssl.duitang.com/uploads/item/201807/16/20180716215758_xgfkh.jpeg[/img]" width="800" height="800" frameborder="0" style="float:middle">
  </iframe>
</div>
</section>

<!-- Footer -->
<footer class="wrapper style1 align-center">
<div class="inner">
  <p>===个人日记===</p>
</div>
</footer>

<!-- Scripts -->
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/jquery.scrollex.min.js"></script>
<script src="assets/js/jquery.scrolly.min.js"></script>
<script src="assets/js/skel.min.js"></script>
<script src="assets/js/util.js"></script>
<script src="assets/js/main.js"></script>
</body>
</html>
