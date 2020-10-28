<?php
	class blogcategory extends database{
		function __construct(){
			$this->table = 'blogcategories';
			database::__construct();
		}
		public function addBlogCategory($data,$is_die=false){
			return $this->addData($data,$is_die);
		}
		public function getBlogCategorybyId($blogcategory_id,$is_die = false){
			
			$args = array(
				'where'	=> array(
					'and' => array(
							'id' => $blogcategory_id,
						)
					)
				);

			return $this->getData($args,$is_die);
		}
		public function getAllBlogCategory($is_die = false){	
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

		public function updateBlogCategorybyId($data,$id,$is_die = false){
			$args = array(
				'where'	=> array(
					'and' => array(
							'id' => $id,
						)
					)
				);

			return $this->updateData($data,$args,$is_die);
		}

		public function deleteBlogCategorybyId($id,$is_die=false){
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