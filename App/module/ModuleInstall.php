<?php
class ModuleInstall extends LmlBase{

	protected function getHtmlBegin(){
		return
		'
		<!DOCTYPE html>
		<html>
		<head>
		<meta http-equiv="content-type" content="text/html;charset=utf-8">
		<meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no"/>
		<title>'.lang('LBlog Install Guard').'</title>
		</head>
		<body>';
	}

	protected function getHtmlend(){
		return '</body></html>';
	}

	public function index(){

		lang('', require APP_PATH.'conf/lang/lang_'.DEFAULT_LANG.'.php');
		
		if(!$_POST){
			echo $this->getHtmlBegin().
'
<form action="'.WEB_APP_PATH.'install" method="post">
<table align="center">
<tr>
	<th colspan="2"><h3>'.lang('LBlog Install Guard').'</h3></th>
</tr>

<tr>
	<th colspan="2">'.lang('Database Config').'</th>
</tr>

<tr>
	<td>'.lang('HostName').':</td>
	<td><input type="text" name="hostname" value="localhost"/></td>
</tr>

<tr>
	<td>'.lang('HostPort').':</td>
	<td><input type="text" name="hostport" value="3306"/></td>
</tr>

<tr>
	<td>'.lang('UserName').':</td>
	<td><input type="text" name="username"/></td>
</tr>

<tr>
	<td>'.lang('Password').':</td>
	<td><input type="password" name="password"/></td>
</tr>

<tr>
	<td>'.lang('Database Name').':</td>
	<td><input type="text" name="database"/></td>
</tr>

<tr>
	<td>'.lang('Charset').':</td>
	<td><input type="text" name="charset" value="utf8"/></td>
</tr>

<tr>
	<td>'.lang('Table Prefix').':</td>
	<td><input type="text" name="dbprefix" value="lblog_"/></td>
</tr>

<tr>
	<th colspan="2">'.lang('Admin').'</th>
</tr>

<tr>
	<td>'.lang('Email').':</td>
	<td><input type="text" name="email" value="admin"/></td>
</tr>

<tr>
	<td>'.lang('Password').':</td>
	<td><input type="password" name="admin_passwd" value=""/></td>
</tr>

<tr align="center">
	<td colspan="2"><input type="submit" value="'.lang('Submit').'"/></td>
</tr>

</table>
</form>
'.$this->getHtmlend();
			return;
		}

		$sql_file = APP_PATH.'lblog.sql';

		$fp = fopen($sql_file, 'r');

		if(
			!isset($_POST['hostname']) || !isset($_POST['hostport']) ||
			!isset($_POST['username']) || !isset($_POST['password']) ||
			!isset($_POST['database']) || !isset($_POST['charset']) ||
			!isset($_POST['dbprefix']) ||

			!$_POST['hostname'] || !$_POST['hostport'] ||
			!$_POST['username'] || !$_POST['password'] ||
			!$_POST['database'] || !$_POST['charset'] ||
			!$_POST['dbprefix']

		){
			echo $this->getHtmlBegin();
			echo '<p>'.lang('Please input completely!').'</p>';
			$this->outputBack();
			echo $this->getHtmlend();
			return;
		}


		$hostname = trim($_POST['hostname']);
		$hostport = trim($_POST['hostport']);
		$username = trim($_POST['username']);
		$password = trim($_POST['password']);
		$database = trim($_POST['database']);
		$charset = trim($_POST['charset']);
		$dbprefix = trim($_POST['dbprefix']);
		$email = trim($_POST['email']);
		$admin_passwd = trim($_POST['admin_passwd']);

		$config = compact('hostname', 'hostport', 'username', 'password', 'database', 'charset', 'dbprefix');

		try{
			$db = db($config);
		}catch(Exception $e){
			echo $this->getHtmlBegin();
			echo '<p>'.lang('Database connect fail!').'</p>';
			$this->outputBack();
			echo $this->getHtmlend();
			return;
		}

		if(!is_writeable(APP_PATH)){
			echo $this->getHtmlBegin();
			echo '<p>'.lang('App directory can\'t be writeable!').'</p>';
			$this->outputBack();
			echo $this->getHtmlend();
			return;
		}

		echo $this->getHtmlBegin();
		echo '<p>'.lang('Begin').'</p>';

		$statement = '';

		try{
			echo '<p>';
			while($line = fgets($fp)){
				$line = trim($line);

				if(!$line) {
					continue;
				}

				$statement .= $line;
				if(substr($line, -1) == ';'){
					$statement = str_replace('`lblog_', '`'.$dbprefix, $statement);
					$statement = str_replace('unix_timestamp()', time(), $statement);
					$db->query($statement);
					echo '-';
					$statement = '';
				}
			}
			echo '</p><p>'.lang('Execute success!').'</p>';
			$admin_data = array(
					'email' => $email,
					'passwd' => generate_passwd($admin_passwd),
					'createtime' => time()
				);
			$db->update($config['dbprefix'].'user', $admin_data, "id=1");
			echo '<p>'.lang('Install success!').'</p><p><a href="'.WEB_PATH.'">'.lang('Go home page').'</a></p>';
			echo $this->getHtmlend();
		}catch (Exception $e){
			echo $this->getHtmlBegin();
			echo '<p>'.lang('Cause Error!').'</p>';
			$this->outputBack();
			echo $this->getHtmlend();
			return;
		}

		// save to config file
		$config['persist'] = false;
		$this->saveConfig($config);
		$GLOBALS['dbconfig'] = $config;
		$this->generateSalt();

		// rename this file
		rename(APP_PATH.'module/ModuleInstall.php', APP_PATH.'module/.ModuleInstall.php');
	}

	public function saveConfig($config=array()){
		$str = '<?php return $dbconfig='.var_export($config, true).';';
		file_put_contents(APP_PATH.'conf/dbconfig.php', $str);
	}

	public function outputBack(){
		echo '<p><a href="javascript:history.go(-1);">'.lang('Go back').'</a></p>';
	}

	public function generateSalt(){
		$str = $this->randStr();
		q('config')->add(array(
			'name' => 'LBLOGSALT',
			'data' => $str.'_'.md5($str.$GLOBALS['start_time']),
		));
		$str2 = $this->randStr();
		q('config')->add(array(
			'name' => 'LBLOGASALT',
			'data' => $str2.'_'.md5($str2.$GLOBALS['start_time']),
		));
	}
	
	public function randStr(){
		$str = '';
		for( $i=0; $i<200; $i++ ) {
			$char = chr(mt_rand(33, 126));
			if ($char == "'" || $char == '\\') {
				$char = '\\'.$char;
			}
			$str .= $char;
		}
		return $str;
	}
}
