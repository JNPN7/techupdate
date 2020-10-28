<?php
	class contact extends database{
		function __construct(){
			$this->table = 'contacts';
			database::__construct();
		}
		public function addContact($data,$is_die=false){
			return $this->addData($data,$is_die);
		}

		public function getContactbyId($contact_id,$is_die=false){
			
			$args = array(
				'where'	=> array(
					'and' => array(
							'id' => $contact_id,
						)
					)
				);

			return $this->getData($args,$is_die);
		}

		public function getAllContact($is_die=false){
			
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
		public function getAllWaitingContact($is_die=false){
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
		public function getAllWaitingContactForNotifications($offset,$no_of_data,$is_die=false){
			
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
		public function getNumberWaitingContacts($is_die=false){
			
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
		public function getAllAcceptContactByProduct($product_id,$is_die=false){
			
			$args = array(
				'where'	=> array(
					'and' => array(
							'status' => 'Active',
							'state' => 'accept',
							'productid' => $product_id,
							'contactType' => 'question'
						)
					),
				'order' => 'ASC'
				);

			return $this->getData($args,$is_die);
		}
		//reply
		public function getAllAcceptReplyByProductByContact($product_id,$contact_id,$is_die=false){
			
			$args = array(
				'where'	=> array(
					'and' => array(
							'status' => 'Active',
							'state' => 'accept',
							'productid' => $product_id,
							'contactType' => 'reply',
							'questionid' => $contact_id
						)
					),
				'order' => 'ASC'
				);

			return $this->getData($args,$is_die);
		}
		//count contact
		public function getNumberContactByProduct($product_id,$is_die=false){
			
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

		public function updateContactbyId($data,$id,$is_die=false){
			$args = array(
				'where'	=> array(
					'and' => array(
							'id' => $id,
						)
					)
				);

			return $this->updateData($data,$args,$is_die);
		}

		public function deleteContactbyId($id,$is_die=false){
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