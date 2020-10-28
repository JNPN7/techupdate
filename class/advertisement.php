<?php
	class advertisement extends database{
		function __construct(){
			$this->table = 'advertisements';
			database::__construct();
		}
		public function addAdvertisement($data,$is_die=false){
			return $this->addData($data,$is_die);
		}

		public function getAdvertisementbyId($advertisement_id,$is_die=false){
			
			$args = array(
				'where'	=> array(
					'and' => array(
							'id' => $advertisement_id,
						)
					)
				);

			return $this->getData($args,$is_die);
		}

		public function getAdvertisementbyType($advertisement_type,$is_die=false){
			
			$args = array(
				'where'	=> array(
					'and' => array(
							'type' => $advertisement_type,
						)
					)
				);

			return $this->getData($args,$is_die);
		}

		public function getAllAdvertisement($is_die=false){
			
			$args = array(
				'where'	=> array(
					'and' => array(
							'status' => 'Active',
						)
					)
				);

			return $this->getData($args,$is_die);
		}

		public function updateAdvertisementbyId($data,$id,$is_die=false){
			$args = array(
				'where'	=> array(
					'and' => array(
							'id' => $id,
						)
					)
				);

			return $this->updateData($data,$args,$is_die);
		}

		public function deleteAdvertisementbyId($id,$is_die=false){
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