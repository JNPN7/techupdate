<?php
	class sale extends database{
		function __construct(){
			$this->table = 'sales';
			database::__construct();
		}
		public function addSale($data,$is_die=false){
			return $this->addData($data,$is_die);
		}
		public function getSalebyId($sale_id,$is_die=false){
			
			$args = array(
				'where'	=> array(
					'and' => array(
							'id' => $sale_id,
						)
					)
				);

			return $this->getData($args,$is_die);
		}
		public function getSalebyProductId($product_id,$is_die=false){
			
			$args = array(
				'where'	=> array(
					'and' => array(
							'productid' => $product_id,
						)
					)
				);

			return $this->getData($args,$is_die);
		}
		public function getAllSale($is_die = false){	
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
		public function getAllSaleWithLimit($offset, $no_of_data, $is_die = false){	
			$args = array(
				'where'	=> array(
					'and' => array(
							'status' => 'Active',
						)
					),
				'order' => 'ASC',
				'limit' => array(
								'offset' => $offset,				//take data leaving some no.
								'no_of_data' => $no_of_data
								)
				);

			return $this->getData($args,$is_die);
		}

		public function updateSalebyId($data,$id,$is_die = false){
			$args = array(
				'where'	=> array(
					'and' => array(
							'id' => $id,
						)
					)
				);

			return $this->updateData($data,$args,$is_die);
		}

		public function deleteSalebyId($id,$is_die=false){
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