<?php
	class ConfigFile {
		public function __construct(){
			$this->config = array(
				"db_hostname" => 'localhost',
				"db_username" => 'root',
				"db_password" => 'jimbob11',
				"db_database" => 'cms'
			);
		}

		public function get(){ return $this->config; }
	}