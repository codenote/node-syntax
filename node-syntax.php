<?php
/*
i: PCRE_CASELESS
m: PCRE_MULTILINE
	^ and $ fit both \r and \n
s: PCRE_DOTALL
	. fit also fit \r \n

*/



class NodeSyntax {
	public static function highlight($s) {
		$s = preg_replace_callback('/(\/\/.*?(?:\R|$)|\/\*.*?\*\/|&quot;.*?(?<!\\\\)(?:\\\\\\\\)*&quot;|\'.*?(?<!\\\\)(?:\\\\\\\\)*\')/s','self::_callback_debug', $s);
		return $s;
	}
	
	static function _callback_debug( $matches ) {
		//print_r($matches);
		
		$token = $matches[0];
		if (strlen($token) == 0) return '';
		
		if( $token[0] == '&' || $token[0] == "'" ) {
			return '<span class="c_s">'.$token.'</span>';
		} else {
			return '<span class="c_c">'.$token.'</span>';
		}
	}
}