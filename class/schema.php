<?php
	class schema extends database{
		function __construct(){
			database::__construct();
		}

		function create($sql){
			return $this->runQuery($sql);
		}
	} 
?>

