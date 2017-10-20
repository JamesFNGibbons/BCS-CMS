<?php
	class ConfigFile {
		public function __construct(){
			$this->config = array(
				"db_hostname" => '%hostname%',
				"db_username" => '%username%',
				"db_password" => '%password%',
				"db_database" => '%database%'
			);
		}

		public function get(){ return $this->config; }
	}