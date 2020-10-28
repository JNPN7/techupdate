<?php
	class contactinfo extends database{
		function __construct(){
			$this->table = 'contactinfos';
			database::__construct();
		}
		public function addContactinfo($data,$is_die=false){
			return $this->addData($data,$is_die);
		}
		public function getContactinfobyId($contactinfo_id,$is_die=false){
			
			$args = array(
				'where'	=> array(
					'and' => array(
							'id' => $contactinfo_id,
						)
					)
				);

			return $this->getData($args,$is_die);
		}
		public function getAllContactinfo($is_die = false){	
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

		public function updateContactinfobyId($data,$id,$is_die = false){
			$args = array(
				'where'	=> array(
					'and' => array(
							'id' => $id,
						)
					)
				);

			return $this->updateData($data,$args,$is_die);
		}

		public function deleteContactinfobyId($id,$is_die=false){
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