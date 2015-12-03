<?php
class ModuleInstall extends LmlBase{

	public function index(){

		if(!$_POST){
			echo
'
<form action="'.WEB_APP_PATH.'install" method="post">
<table align="center">
<tr>
	<th colspan="2">LBlog Install</th>
</tr>

<tr>
	<td>hostname:</td>
	<td><input type="text" name="hostname" value="localhost"/></td>
</tr>

<tr>
	<td>hostport:</td>
	<td><input type="text" name="hostport" value="3306"/></td>
</tr>

<tr>
	<td>username:</td>
	<td><input type="text" name="username"/></td>
</tr>

<tr>
	<td>password:</td>
	<td><input type="password" name="password"/></td>
</tr>

<tr>
	<td>database:</td>
	<td><input type="text" name="database"/></td>
</tr>

<tr>
	<td>charset:</td>
	<td><input type="text" name="charset" value="utf8"/></td>
</tr>

<tr>
	<td>dbprefix:</td>
	<td><input type="text" name="dbprefix"/></td>
</tr>

<tr align="center">
	<td colspan="2"><input type="submit" value="Submit"/></td>
</tr>

</table>
</form>
';
			exit;
		}

		$sql_file = APP_PATH.'lblog.sql';

		$fp = fopen($sql_file, 'r');

		if(!isset($_POST['hostname']) || !isset($_POST['hostport']) ||
				!isset($_POST['username']) || !isset($_POST['password']) ||
				!isset($_POST['database']) || !isset($_POST['charset']) ||
				!isset($_POST['dbprefix'])
				){
			echo '<p>please input completely!</p>';
            $this->outputBack();
			exit;
		}


		$hostname = $_POST['hostname'];
		$hostport = $_POST['hostport'];
		$username = $_POST['username'];
		$password = $_POST['password'];
		$database = $_POST['database'];
		$charset = $_POST['charset'];
		$dbprefix = $_POST['dbprefix'];

		$config = compact('hostname', 'hostport', 'username', 'password', 'database', 'charset', 'dbprefix');

		try{
			if (extension_loaded('pdo_mysql') && extension_loaded('PDO')) {
				$db = MysqlPdoEnhance::getInstance($config);
			} else {
				$db = Mysql::getInstance($config);
			}
		}catch(Exception $e){
			echo '<p>connect database fail!</p>';
			$this->outputBack();
			exit;
		}

		echo '<p>begin</p>';

		$statement = '';

		try{
			while($line = fgets($fp)){
				$line = trim($line);

				if(!$line) {
					continue;
				}

				$statement .= $line;
				if(substr($line, -1) == ';'){
					$statement = str_replace('`lblog_', '`'.$dbprefix, $statement);

					echo '<p>execute success!</p>';

					$db->query($statement);
					$statement = '';
				}
			}
			echo '<p>install success!</p><p><a href="/">go home page</a></p>';
		}catch (Exception $e){
			echo '<p>error!</p>';
			$this->outputBack();
			exit;
		}


		// save to config file
		$config['persist'] = false;
		$this->saveConfig($config);

		// rename this file
		rename(APP_PATH.'module/ModuleInstall.php', APP_PATH.'module/.ModuleInstall.php');

	}

	public function saveConfig($config=array()){
		$str = '<?php return $dbconfig='.var_export($config, true).';';
		file_put_contents(APP_PATH.'conf/dbconfig.php', $str);
	}

	public function outputBack(){
		echo '<p><a href="javascript:history.go(-1);">go back</a></p>';
	}
}
