<?php
	class ConfigFile {
		public function __construct(){
			$this->config = array(
				"db_hostname" => 'localhost',
				"db_username" => 'jgibbons',
				"db_password" => '',
				"db_database" => 'cms'
			);
		}

		public function get(){ return $this->config; }
	}
