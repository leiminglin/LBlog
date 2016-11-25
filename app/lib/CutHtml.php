<?php
/**
 * LMLPHP Framework
 * Copyright (c) 2014 http://lmlphp.com All rights reserved.
 * Licensed ( http://mit-license.org/ )
 * Author: leiminglin <leiminglin@126.com>
 *
 * A fully object-oriented PHP framework.
 * Keep it light, magnificent, lovely.
 *
 */
class CutHtml {
	private static $charset = 'utf-8';
	private static $returnChars = '';
	private static $length = 0;
	private static $tagContainer = array();
	private static $htmlSingleTags = array( 'meta', 'img', 'hr', 'br', 'input', 'link' );
	public function __construct() {
	}
	public static function init( $options ) {
		self::$charset = $options['charset'];
		self::$returnChars = '';
		self::$length = 0;
		self::$tagContainer = array();
	}

	public static function doCut( $str, $length, $charset = 'utf-8' ) {
		self::init( array('charset' => $charset) );
		$str = self::htmlPreProcess($str);
		$parts = preg_split( '/(<[^<>]+?>)/i', $str, -1, PREG_SPLIT_NO_EMPTY | PREG_SPLIT_DELIM_CAPTURE );
		self::getReturnChars( $parts, $length );

		// Complete not closing tags
		for ( $c = count(self::$tagContainer) - 1; $c >= 0; $c-- ) {
			if( self::$tagContainer[$c]['close'] == false ) {
				self::$returnChars .= '</'.self::$tagContainer[$c]['tagname']. '>';
			}
		}
		return self::$returnChars;
	}

	private static function htmlPreProcess( $html ) {
		$html = preg_replace('/<img.*?\/?>/i', '', $html);
		$html = preg_replace('/<p>\s+<\/p>/i', '', $html);
		
		return $html;
		if( $html == '' ) return;
		$html = preg_replace('/[^\'"]{1}<script.*?<\/script>/is', "", $html);
		$html = preg_replace('/<!--?.*-->/','',$html);
		$html = preg_replace('/<style.*?<\/style>/is', "", $html);
		$html = preg_replace('/<iframe.*?<\/iframe>/is', "", $html);
		$html = preg_replace('/<object.*?<\/object>/is', "", $html);
		return $html;
	}

	private static function getReturnChars( $parts, $length ) {
		foreach ( $parts as $v ) {
			
			$v_copy = preg_replace('/[\f\n\r\t]+/', '', $v);
			if( $v_copy == '' || $v_copy == ' ' ){
				self::$returnChars .= $v;
				continue;
			}
			
			
			if ( preg_match('/<(.*)>/', $v) ) {
				// html tags
				if ( substr($v, -2) == '/>' ) {
					// single tag
					self::$returnChars .= $v;
					continue;
				}
				if ( preg_match('/<([a-zA-Z1-9]+).*>/', $v, $matches) ) {
					// tag begin
					if ( !in_array( strtolower($matches[1]), self::$htmlSingleTags ) ) {
						self::$tagContainer[] = array( 'tagname' => $matches[1], 'close' => false );
					}
					self::$returnChars .= $v;
					continue;
				}
				if ( preg_match('/<\/([a-zA-Z1-9]+)>/', $v, $matches) ) {
					// tag end
					for ( $c = count(self::$tagContainer) - 1; $c >= 0; $c-- ) {
						if( self::$tagContainer[$c]['close'] == false && self::$tagContainer[$c]['tagname'] == $matches[1] ) {
							self::$tagContainer[$c]['close'] = true;
							self::$returnChars .= $v;
							break;
						}
					}
				}


			}else {
				// not html tags
				// $v = preg_replace('/[ ]+/', '', $v);
				// html entities ignore
				/* $temp_entities_len = 0;
				 preg_match_all('/&[0-9a-z]{2,8};|&#[0-9]{1,7};|&#x[0-9a-f]{1,6};/i', $v, $matches);
				foreach ($matches[0] as $t) {
				$temp_entities_len += strlen($t);
				} */

				$chars_length = self::mstrlen( $v, self::$charset );
				if ( $chars_length < $length - self::$length ) {
					self::$returnChars .= $v;
					self::$length += $chars_length;
				}else {
					// self::$returnChars .= self::msubstr( $v, 0, $length - self::$length, self::$charset );
					self::$returnChars .= $v;
					return;
				}
			}
		}
	}

	public static function msubstr($str, $start = 0, $length, $charset = "utf-8", $suffix = true) {
		if (function_exists ( "mb_substr" )) {
			return mb_substr ( $str, $start, $length, $charset );
		} elseif (function_exists ( 'iconv_substr' )) {
			return iconv_substr ( $str, $start, $length, $charset );
		}
		$re ['utf-8'] = "/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|[\xe0-\xef][\x80-\xbf]{2}|[\xf0-\xff][\x80-\xbf]{3}/";
		$re ['gb2312'] = "/[\x01-\x7f]|[\xb0-\xf7][\xa0-\xfe]/";
		$re ['gbk'] = "/[\x01-\x7f]|[\x81-\xfe][\x40-\xfe]/";
		$re ['big5'] = "/[\x01-\x7f]|[\x81-\xfe]([\x40-\x7e]|\xa1-\xfe])/";
		preg_match_all ( $re [$charset], $str, $match );
		$slice = join ( "", array_slice ( $match [0], $start, $length ) );
		if ($suffix)
			return $slice . "…";
		return $slice;
	}

	public static function mstrlen($str, $charset = 'UTF-8') {
		if (function_exists ( 'mb_substr' )) {
			$length = mb_strlen ( $str, $charset );
		} elseif (function_exists ( 'iconv_substr' )) {
			$length = iconv_strlen ( $str, $charset );
		} else {
			preg_match_all ( "/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|\xe0[\xa0-\xbf][\x80-\xbf]|[\xe1-\xef][\x80-\xbf][\x80-\xbf]|\xf0[\x90-\xbf][\x80-\xbf][\x80-\xbf]|[\xf1-\xf7][\x80-\xbf][\x80-\xbf][\x80-\xbf]/", $str, $ar );
			$length = count ( $ar [0] );
		}
		return $length;
	}
}