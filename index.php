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
	color:#FF0000;
}
.c_k {
	color:#0000FF;
}
.c_s {
	color: #A00000;
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
.c_d {
	color:#800080;
}
</style>
</head>
<body>

<pre><?php
require('node-syntax.php');
$content = file_get_contents('samples/php.txt');
$content = htmlspecialchars($content);
echo preg_replace('/\r\n/u', '<br />', $content);
?></pre>
<pre><?php
$content = NodeSyntax::highlight($content);

echo preg_replace('/\r\n/u', '<br />', $content);
?></pre>

</body>
</html>

