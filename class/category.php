<?php
	class category extends database{
		function __construct(){
			$this->table = 'categories';
			database::__construct();
		}
		public function addCategory($data,$is_die=false){
			return $this->addData($data,$is_die);
		}
		public function getCategorybyId($category_id,$is_die=false){
			
			$args = array(
				'where'	=> array(
					'and' => array(
							'id' => $category_id,
						)
					)
				);

			return $this->getData($args,$is_die);
		}
		public function getAllCategory($is_die = false){	
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

		public function updateCategorybyId($data,$id,$is_die = false){
			$args = array(
				'where'	=> array(
					'and' => array(
							'id' => $id,
						)
					)
				);

			return $this->updateData($data,$args,$is_die);
		}

		public function deleteCategorybyId($id,$is_die=false){
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