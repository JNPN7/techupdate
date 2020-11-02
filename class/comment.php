<?php
	class comment extends database{
		function __construct(){
			$this->table = 'comments';
			database::__construct();
		}
		public function addComment($data,$is_die=false){
			return $this->addData($data,$is_die);
		}

		public function getCommentbyId($comment_id,$is_die=false){
			
			$args = array(
				'where'	=> array(
					'and' => array(
							'id' => $comment_id,
						)
					)
				);

			return $this->getData($args,$is_die);
		}

		public function getAllComment($is_die=false){
			
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
		public function getAllWaitingComment($is_die=false){
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
		public function getAllWaitingCommentForNotifications($offset,$no_of_data,$is_die=false){
			
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
		public function getNumberWaitingComments($is_die=false){
			
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
		public function getAllAcceptCommentByBlog($blog_id,$is_die=false){
			
			$args = array(
				'where'	=> array(
					'and' => array(
							'status' => 'Active',
							'state' => 'accept',
							'blogid' => $blog_id,
							'commentType' => 'comment'
						)
					),
				'order' => 'ASC'
				);

			return $this->getData($args,$is_die);
		}
		//reply
		public function getAllAcceptReplyByBlogByComment($blog_id,$comment_id,$is_die=false){
			
			$args = array(
				'where'	=> array(
					'and' => array(
							'status' => 'Active',
							'state' => 'accept',
							'blogid' => $blog_id,
							'commentType' => 'reply',
							'commentid' => $comment_id
						)
					),
				'order' => 'ASC'
				);

			return $this->getData($args,$is_die);
		}
		//count comment
		public function getNumberCommentByBlog($blog_id,$is_die=false){
			
			$args = array(
				'fields'=>	['COUNT(id) as total'],           
				'where'	=> array(
					'and' => array(
							'status' => 'Active',
							'state' => 'accept',
							'blogid' => $blog_id
						)
					)
				);

			return $this->getData($args,$is_die);
		}

		public function updateCommentbyId($data,$id,$is_die=false){
			$args = array(
				'where'	=> array(
					'and' => array(
							'id' => $id,
						)
					)
				);

			return $this->updateData($data,$args,$is_die);
		}

		public function deleteCommentbyId($id,$is_die=false){
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