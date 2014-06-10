<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>NodeSyntax</title>
<style>
pre {
	font-family: Consolas, "Liberation Mono", Courier, monospace;
	line-height: 18px;
	padding:0px;
	margin:16px;
	tab-size:4;
	color: #000000;
	font-size:12px;
	font-weight: bold;
}

.c_v {
	color:#008080;
}
.c_n {
	color:#A70000;
}
.c_k {
	color:#0000FF;
}
.c_s {
	color: #A70000;
}
.c_f {
	color: #268FAD;
}
.c_x {
	color: #006FE0;
}
.c_c {
	color: #008000;
}
.c_t {
	color:#FF0000;
}
.c_o {
	color:#002D7A;
}
</style>
</head>
<body>
<?php
require('node-syntax.php');
?>
<pre><?php
$content = file_get_contents('samples/general.txt');
$content = htmlspecialchars($content);
$nodesyntax = new NodeSyntax();
$content = $nodesyntax->highlight($content);
echo preg_replace('/\r\n/u', '<br />', $content);
?></pre>
<pre><?php
$content = file_get_contents('samples/c.txt');
$content = htmlspecialchars($content);
$nodesyntax = new NodeSyntax();
$content = $nodesyntax->highlight($content, 'c');
echo preg_replace('/\r\n/u', '<br />', $content);
?></pre>
<pre><?php
$content = file_get_contents('samples/php.txt');
$content = htmlspecialchars($content);
$nodesyntax = new NodeSyntax();
$content = $nodesyntax->highlight($content, 'php');
echo preg_replace('/\r\n/u', '<br />', $content);
?></pre>
<pre><?php
$content = file_get_contents('samples/python.txt');
$content = htmlspecialchars($content);
$nodesyntax = new NodeSyntax();
$content = $nodesyntax->highlight($content, 'python');
echo preg_replace('/\r\n/u', '<br />', $content);
?></pre>
</body>
</html>

