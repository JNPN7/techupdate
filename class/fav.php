<?php
	class fav extends database{
		function __construct(){
			$this->table = 'favs';
			database::__construct();
		}
		public function addFav($data,$is_die=false){
			return $this->addData($data,$is_die);
		}
		public function getPassiveFavbyId($fav_id,$is_die=false){
			
			$args = array(
				'where'	=> array(
					'and' => array(
							'product_id' => $fav_id,
						)
					)
				);

			return $this->getData($args,$is_die);
		}
		public function getFavbyId($fav_id,$is_die=false){
			
			$args = array(
				'where'	=> array(
					'and' => array(
							'status' => 'Active',
							'product_id' => $fav_id,
						)
					)
				);

			return $this->getData($args,$is_die);
		}
		public function getFavbyProductIdandUserId($fav_id,$user_id,$is_die=false){
			
			$args = array(
				'where'	=> array(
					'and' => array(
							'product_id' => $fav_id,
							'user_id' => $user_id,
						)
					)
				);

			return $this->getData($args,$is_die);
		}
		public function getAllFavById($fav_id ,$is_die = false){	
			$args = array(
				'where'	=> array(
					'and' => array(
							'status' => 'Active',
							'product_id' => $fav_id,
						)
					),
				'order' => 'ASC'
				);


			return $this->getData($args,$is_die);
		}
		public function getAllFavWithoutLimitByUser($user_id,$is_die = false){	
			$args = array(
				'where'	=> array(
					'and' => array(
							'status' => 'Active',
							'user_id' => $user_id
						)
					),
				'order' => 'DESC'
				);
			return $this->getData($args,$is_die);
		}

		public function getAllFavByUser($user_id,$offset,$no_of_data,$is_die = false){	
			$args = array(
				'where'	=> array(
					'and' => array(
							'status' => 'Active',
							'user_id' => $user_id
						)
					),
				'order' => 'DESC',
				'limit' => array(
								'offset' => $offset,				//take data leaving some no.
								'no_of_data' => $no_of_data
								)
				);

			return $this->getData($args,$is_die);
		}
		public function getNumberFavByProduct($product_id,$is_die=false){
			
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

		public function getNumberFavByUser($user_id,$is_die=false){
			
			$args = array(
				'fields'=>	['COUNT(id) as total'],           
				'where'	=> array(
					'and' => array(
							'status' => 'Active',
							'user_id' => $user_id
						)
					)
				);

			return $this->getData($args,$is_die);
		}

		public function updateFavbyId($data,$id,$is_die = false){
			$args = array(
				'where'	=> array(
					'and' => array(
							'id' => $id,
						)
					)
				);

			return $this->updateData($data,$args,$is_die);
		}
		public function updateFavbyProductIdandUserId($data,$pid,$user_id,$is_die = false){
			$args = array(
				'where'	=> array(
					'and' => array(
							'product_id' => $pid,
							'user_id' => $user_id,
						)
					)
				);

			return $this->updateData($data,$args,$is_die);
		}

		public function deleteFavbyId($id,$is_die=false){
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