<?php
class ModuleFile extends LmlBase{
	public function image(){
		$matches = route_match('([\d]+)');
		$id = arr_get($matches, 1, false);
		if(!$id){
			Tool::status(404);
			return;
		}
		lml()->app()->setOneSloc(false);
		$image = q('file_image')->find($id);
		if(!$image){
			return Tool::status(404);
		}
		$filename = APP_PATH.'repository/image/'.$image['path'];
		if(!file_exists($filename)){
			return Tool::status(404);
		}
		$image_content = file_get_contents($filename);		
		$cache_seconds = 86400*365;
		
		header('Pragma: none');
		header('Content-Type: '.$image['type']);
		header('Etag: "'.$image['hash'].'"');
		header('Last-Modified: '.date('D, d M Y H:i:s e', $image['createtime']));
		header('Cache-Control: max-age='.$cache_seconds);
		header('Expires: '.date('D, d M Y H:i:s e', $GLOBALS['start_time'] + $cache_seconds));
		
		$if_none_match = arr_get($_SERVER, 'HTTP_IF_NONE_MATCH');
		
		if($if_none_match){
			if (trim($if_none_match, '"') == $image['hash']) {
				return Tool::status(304);
			}
		}
		
		header('Content-Length: '.strlen($image_content));
		echo $image_content;
	}
}