<?php
class NodeSyntax {

	private $list_preg = [];
	private $list_type = [];
	private $list_style = [];
	private $token_last;
	private $type_last;
	
	function highlight($string, $language = null) {
		$callback = '_callback_general';
		if ($language == null || $language == 'general') {
			$this->prepare_preg('comment', 'comment_1');
			$this->prepare_preg('comment', 'comment_2');
			$this->prepare_preg('comment', 'comment_3');
			$this->prepare_preg('string', 'string_1');
			$this->prepare_preg('string', 'string_2');
			$this->prepare_preg('tag', 'tag_1');
			$this->prepare_preg('xml', 'xml_1');
			$this->prepare_preg('operator', 'operator_1');
			$this->prepare_preg('number', 'number_1');
			$this->prepare_preg('keyword', 'keyword_1');
			$this->prepare_preg('keyword', 'keyword_2');
			$this->prepare_preg('variable', 'variable_1');
			$this->prepare_preg('macro', 'macro_1');
		} else if ($language == 'c') {
			$this->prepare_preg('comment', 'comment_1');
			$this->prepare_preg('comment', 'comment_2');
			$this->prepare_preg('string', 'string_1');
			$this->prepare_preg('string', 'string_2');
			$this->prepare_preg('operator', 'operator_2');
			$this->prepare_preg('operator', 'operator_3');
			$this->prepare_preg('number', 'number_1');
			$this->prepare_preg('keyword', 'keyword_1');
			$this->prepare_preg('macro', 'macro_1');
		} else if ($language == 'php') {
			$this->prepare_preg('comment', 'comment_1');
			$this->prepare_preg('comment', 'comment_2');
			$this->prepare_preg('string', 'string_1');
			$this->prepare_preg('string', 'string_2');
			$this->prepare_preg('tag', 'tag_1');
			$this->prepare_preg('operator', 'operator_4');
			$this->prepare_preg('operator', 'operator_2');
			$this->prepare_preg('operator', 'operator_3');
			$this->prepare_preg('number', 'number_1');
			$this->prepare_preg('keyword', 'keyword_1');
			$this->prepare_preg('keyword', 'keyword_2');
			$this->prepare_preg('variable', 'variable_1');
			$this->prepare_preg('function', 'function_1');
		} else if ($language == 'python') {
			$this->prepare_preg('comment', 'comment_4');
			$this->prepare_preg('comment', 'comment_5');
			$this->prepare_preg('string', 'string_1');
			$this->prepare_preg('string', 'string_2');
			$this->prepare_preg('operator', 'operator_4');
			$this->prepare_preg('operator', 'operator_2');
			$this->prepare_preg('operator', 'operator_3');
			$this->prepare_preg('number', 'number_1');
			$this->prepare_preg('keyword', 'keyword_python');
			$this->prepare_preg('function', 'function_python');
			$this->prepare_preg('function', 'decorator_1');
		}
		
		$regex = implode(')|(', $this->list_preg);
		$regex = '/('.$regex.')/su';
		// echo htmlspecialchars($regex);
		$string = preg_replace_callback($regex, array( &$this, $callback), $string);
		return $string;
	}
	
	private static $lib_grep = array (
		'comment_1' => '\/\/.*?(?:\R|$)',
		'comment_2' => '\/\*.*?\*\/',
		'comment_3' => '\&lt\;!--.*--\&gt\;',
		'comment_4' => '#.*?(?:\R|$)',
		'comment_5' => "'''.*?'''",
		'string_1' => '&quot;.*?(?<!\\\\)(?:\\\\\\\\)*&quot;',
		'string_2' => '\'.*?(?<!\\\\)(?:\\\\\\\\)*\'',
		'operator_1' => '&gt;&gt;\=|&lt;&lt;\=|\+\=|\-\=|\*\=|\/\=|%\=|&\=|\^\=||\=|&gt;&gt;|&lt;&lt;|\+\+|\-\-|\-&gt;|&amp;&amp;|\|\||&lt;\=|&gt;\=|\=\=|!\=|;|\{|&lt;%|\}|%&gt;|,|:|\=|\(|\)|\[|&lt;:|\]|:&gt;|\.|&amp;|!|~|\-|\+|\*|\/|%|&lt;|&gt;|\^|\||\?',
		'operator_2' => '&gt;&gt;\=|&lt;&lt;\=|\+\=|\-\=|\*\=|\/\=|%\=|&\=|\^\=||\=|&gt;&gt;|&lt;&lt;|\+\+|\-\-|&amp;&amp;|\|\||&lt;\=|&gt;\=|\=\=|!\=|\=|&amp;|!|~|\-|\+|\*|\/|%|&lt;|&gt;|\^|\|',
		'operator_3' => '\{|\}|\(|\)|\[|\]|;',
		'operator_4' => '\?\|::|:|\.|\-&gt;|\=&gt;',
		'number_1' => '(?<!\w)(?:0x[\da-fA-F]+|\d+)(?!\w)',
		'token_1' => '(?<![\w\d])[a-zA-Z_]+\w*(?!\w)',
		'variable_1' => '(?<!\w)(?:\$)(?:\w)+(?!\w)',
		'macro_1' => '(?<!\w)(?:\#)(?:\w)+(?!\w)',
		'keyword_1' => '(?<![\w\d])(?:auto|break|case|char|const|continue|default|do|double|else|enum|extern|float|for|goto|if|inline|int|long|register|restrict|return|short|signed|sizeof|static|struct|switch|typedef|union|unsigned|void|volatile|while|NULL)(?!\w)',
		'keyword_2' => '(?<![\w\d])(?:public|private|class|self|function|null|foreach|as|new|TRUE|true|FALSE|false|global|try|catch|array|bool|string|mixed)(?!\w)',
		'keyword_python' => '(?<![\w\d])(?:True|False|None|class|def|return|and|or|not|import|from|as|try|except|finally|raise|pass|if|else|elif|while|for|in|continue|break|global|nonlocal|del|with|is|lambda|yield|assert)(?!\w)',
		'tag_1' => '(?<!\w)(?:(?:(?:&lt;\?)(?:php|asp)?)|(?:\?&gt;))(?!\w)',
		'decorator_1' => '(?<!\w)(?:\@)(?:\w)+(?!\w)',
		'xml_1' => '\&lt\;[\/]?[a-zA-Z_]+[a-zA-Z0-9_]*[ ]*[\/]?\&gt\;',
		'function_1' => '(?<![\w\d])(?:echo|print|require|include|count|strlen|pack|ltrim|chr)(?!\w)',
		'function_2' => '(?<![\w\d])(?:foreach|in|Exception|Console)(?!\w)',
		'function_python' => '(?<![\w\d])(?:range|tuple|list|object|self|cls|exec|print|cast|byref|__init__|_fields_)(?!\w)',
	);
	
	private static $lib_style = array (
		'comment' => 'c_c',
		'string' => 'c_s',
		'operator' => 'c_o',
		'number' => 'c_n',
		'variable' => 'c_v',
		'keyword' => 'c_k',
		'function' => 'c_f',
		'macro' => 'c_k',
		'tag' => 'c_t',
		'xml' => 'c_x',
	);
	
	private function prepare_preg($type, $grep) {
		array_push($this->list_preg, self::$lib_grep[$grep]);
		array_push($this->list_style, self::$lib_style[$type]);
		array_push($this->list_type, $type);
	}
	
	private function _callback_general( $matches ) {
		$index = count($matches)-2;
		$token = $matches[0];
		if (strlen($token) == 0) return '';
		return '<span class="'.$this->list_style[$index].'">'.$token.'</span>';
	}
}