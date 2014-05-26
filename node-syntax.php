<?php
/*
i: PCRE_CASELESS
m: PCRE_MULTILINE
	^ and $ fit both \r and \n
s: PCRE_DOTALL
	. fit also fit \r \n

*/



class NodeSyntax {
	static $pregs = array (
			'\/\/.*?(?:\R|$)',
			'\/\*.*?\*\/',
			'&quot;.*?(?<!\\\\)(?:\\\\\\\\)*&quot;',
			'\'.*?(?<!\\\\)(?:\\\\\\\\)*\'',
		);
	static $types = array (
			'c_c',
			'c_c',
			'c_s',
			'c_s',
		);
	
	static function highlight($s) {
		
		
		
		$rgex = implode(')|(', self::$pregs);
		$rgex = '/('.$rgex.')/s';
		$s = preg_replace_callback($rgex,'self::_callback_debug', $s);
		//$s = preg_replace_callback('/(\/\/.*?(?:\R|$)|\/\*.*?\*\/|&quot;.*?(?<!\\\\)(?:\\\\\\\\)*&quot;|\'.*?(?<!\\\\)(?:\\\\\\\\)*\')/s','self::_callback_debug', $s);
		return $s;
	}
	
	static function _callback_debug( $matches ) {
	
		
		// print_r($matches);
		$index = count($matches)-2;
		$token = $matches[0];
		if (strlen($token) == 0) return '';
		return '<span class="'.self::$types[$index].'">'.$token.'</span>';
		/*
		if( $token[0] == '&' || $token[0] == "'" ) {
			return '<span class="c_s">'.$token.'</span>';
		} else {
			return '<span class="c_c">'.$token.'</span>';
		}
		*/
	}
}