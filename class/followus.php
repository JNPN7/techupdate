<?php
	class followus extends database{
		function __construct(){
			$this->table = 'followuss';
			database::__construct();
		}
		public function addFollowUs($data,$is_die=false){
			return $this->addData($data,$is_die);
		}

		public function getFollowUsbyId($followus_id,$is_die=false){
			
			$args = array(
				'where'	=> array(
					'and' => array(
							'id' => $followus_id,
						)
					)
				);

			return $this->getData($args,$is_die);
		}

		public function getAllFollowUs($is_die=false){
			
			$args = array(
				'where'	=> array(
					'and' => array(
							'status' => 'Active',
						)
					),
				'order' => 'ASC'
				);

			return $this->getData($args,$is_die);
		}

		public function updateFollowUsbyId($data,$id,$is_die=false){
			$args = array(
				'where'	=> array(
					'and' => array(
							'id' => $id,
						)
					)
				);

			return $this->updateData($data,$args,$is_die);
		}

		public function deleteFollowUsbyId($id,$is_die=false){
			$args = array(
				'where'	=> array(
					'and' => array(
							'id' => $id,
						)
					)
				);

			return $this->deleteData($args,$is_die);
		}
	}

?>