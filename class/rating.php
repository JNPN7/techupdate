<?php
	class rating extends database{
		function __construct(){
			$this->table = 'ratings';
			database::__construct();
		}
		public function addRating($data,$is_die=false){
			return $this->addData($data,$is_die);
		}
		public function getRatingbyId($rating_id,$is_die=false){
			
			$args = array(
				'where'	=> array(
					'and' => array(
							'product_id' => $rating_id,
						)
					)
				);

			return $this->getData($args,$is_die);
		}
		public function getAllRating($is_die = false){	
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
		public function getAllRatingById($rating_id ,$is_die = false){	
			$args = array(
				'where'	=> array(
					'and' => array(
							'status' => 'Active',
							'product_id' => $rating_id,
						)
					),
				'order' => 'ASC'
				);


			return $this->getData($args,$is_die);
		}
		public function getNumberRatingByProduct($product_id,$is_die=false){
			
			$args = array(
				'fields'=>	['COUNT(id) as total'],           
				'where'	=> array(
					'and' => array(
							'status' => 'Active',
							'product_id' => $product_id
						)
					)
				);

			return $this->getData($args,$is_die);
		}

		public function updateRatingbyId($data,$id,$is_die = false){
			$args = array(
				'where'	=> array(
					'and' => array(
							'id' => $id,
						)
					)
				);

			return $this->updateData($data,$args,$is_die);
		}

		public function deleteRatingbyId($id,$is_die=false){
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