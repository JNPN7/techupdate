<?php
	class query extends database{
		function __construct(){
			$this->table = 'querys';
			database::__construct();
		}
		public function addQuery($data,$is_die=false){
			return $this->addData($data,$is_die);
		}

		public function getQuerybyId($query_id,$is_die=false){
			
			$args = array(
				'where'	=> array(
					'and' => array(
							'id' => $query_id,
						)
					)
				);

			return $this->getData($args,$is_die);
		}

		public function getAllQuery($is_die=false){
			
			$args = array(
				'where'	=> array(
					'and' => array(
							'status' => 'Active',
						)
					),
				'order' => 'DESC'
				);

			return $this->getData($args,$is_die);
		}
		public function getAllWaitingQuery($is_die=false){
			$args = array(
				'where'	=> array(
					'and' => array(
							'status' => 'Active',
							'state' => 'waiting'
						)
					),
				'order' => 'ASC'
				);

			return $this->getData($args,$is_die);
		}
		public function getAllWaitingQueryForNotifications($offset,$no_of_data,$is_die=false){
			
			$args = array(
				'where'	=> array(
					'and' => array(
							'status' => 'Active',
							'state' => 'waiting'
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
		public function getNumberWaitingQuerys($is_die=false){
			
			$args = array(
				'fields'=>	['COUNT(id) as total'],           
				'where'	=> array(
					'and' => array(
							'state' => 'waiting'
						)
					)
				);

			return $this->getData($args,$is_die);
		}
		public function getAllAcceptQueryByProduct($product_id,$is_die=false){
			
			$args = array(
				'where'	=> array(
					'and' => array(
							'status' => 'Active',
							'state' => 'accept',
							'productid' => $product_id,
							'queryType' => 'question'
						)
					),
				'order' => 'ASC'
				);

			return $this->getData($args,$is_die);
		}
		//reply
		public function getAllAcceptReplyByProductByQuery($product_id,$query_id,$is_die=false){
			
			$args = array(
				'where'	=> array(
					'and' => array(
							'status' => 'Active',
							'state' => 'accept',
							'productid' => $product_id,
							'queryType' => 'reply',
							'questionid' => $query_id
						)
					),
				'order' => 'ASC'
				);

			return $this->getData($args,$is_die);
		}
		//count query
		public function getNumberQueryByProduct($product_id,$is_die=false){
			
			$args = array(
				'fields'=>	['COUNT(id) as total'],           
				'where'	=> array(
					'and' => array(
							'status' => 'Active',
							'state' => 'accept',
							'productid' => $product_id
						)
					)
				);

			return $this->getData($args,$is_die);
		}

		public function updateQuerybyId($data,$id,$is_die=false){
			$args = array(
				'where'	=> array(
					'and' => array(
							'id' => $id,
						)
					)
				);

			return $this->updateData($data,$args,$is_die);
		}

		public function deleteQuerybyId($id,$is_die=false){
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