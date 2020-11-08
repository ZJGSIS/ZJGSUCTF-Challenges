<?php
//error_reporting(0);
session_start();
if(!$_SESSION['islogin']){
  header("Location: index.php");exit;
}
function dfsockopen($url, $limit = 0, $post = '', $cookie = '', $bysocket = FALSE, $ip = '', $timeout = 15, $block = TRUE, $encodetype  = 'URLENCODE', $allowcurl = TRUE, $position = 0, $files = array()) {
  return _dfsockopen($url, $limit, $post, $cookie, $bysocket, $ip, $timeout, $block, $encodetype, $allowcurl, $position, $files);
}

function _dfsockopen($url, $limit = 0, $post = '', $cookie = '', $bysocket = FALSE, $ip = '', $timeout = 15, $block = TRUE, $encodetype  = 'URLENCODE', $allowcurl = TRUE, $position = 0, $files = array()) {
  $return = '';
  $matches = parse_url($url);
  $scheme = $matches['scheme'];
  $host = $matches['host'];
  $path = !empty($matches['path']) ? $matches['path'].(!empty($matches['query']) ? '?'.$matches['query'] : '') : '/';
  $port = !empty($matches['port']) ? $matches['port'] : ($scheme == 'http' ? '80' : '');
  $boundary = $encodetype == 'URLENCODE' ? '' : random(40);

  if(function_exists('curl_init') && function_exists('curl_exec') && $allowcurl) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $scheme.'://'.($ip ? $ip : $host).($port ? ':'.$port : '').$path);
    curl_setopt($ch, CURLOPT_HEADER, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $data = curl_exec($ch);
    return $data;
  }
}
?>

