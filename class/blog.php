<?php
	class blog extends database{
		function __construct(){
			$this->table = 'blogs';
			database::__construct();
		}
		public function addBlog($data,$is_die=false){
			return $this->addData($data,$is_die);
		}
		// public function getBlogbyId($blog_id,$is_die=false){
			
		// 	$args = array(
		// 		'where'	=> array(
		// 			'and' => array(
		// 					'id' => $blog_id,
		// 				)
		// 			)
		// 		);

		// 	return $this->getData($args,$is_die);
		// }

		public function getBlogById($blog_id,$is_die=false){
			
			$args = array(
				'fields'=>	['id',
				            'title',
				            'content',
				            'quote',
				            'bloggername',
				            'featured',
				            'blogcategoryid',
				            '(SELECT categoryname from blogcategories where id = blogcategoryid) as category',
				            'view',
				            'image',
				            'added_by',
				        	'created_date'],
				 'where'	=> array(
					'and' => array(
							'id' => $blog_id,
						)
					)
				);

			return $this->getData($args,$is_die);
		}
		public function getAllBlog($is_die=false){
			
			$args = array(
				'fields'=>	['id',
				            'title',
				            'content',
				            'quote',
				            'bloggername',
				            'featured',
				            'blogcategoryid',
				            '(SELECT categoryname from blogcategories where id = blogcategoryid) as category',
				            'view',
				            'image',
				            'added_by',
				        	'created_date'],
			    'where'	=> array(
					'and' => array(
							'status' => 'Active',
						)
					),
				);

			return $this->getData($args,$is_die);
		}
		public function getAllBlogWithLimit($offset, $no_of_data, $is_die = false){	
			$args = array(
				'fields'=>	['id',
				            'title',
				            'content',
				            'quote',
				            'bloggername',
				            'featured',
				            'blogcategoryid',
				            '(SELECT categoryname from blogcategories where id = blogcategoryid) as category',
				            'view',
				            'image',
				            'added_by',
				        	'created_date'],
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

		public function getAllBlogByCategoryWithLimit($cat_id,$offset,$no_of_data,$is_die=false){
			
			$args = array(
				'fields'=>	['id',
				            'title',
				            'content',
				            'quote',
				            'bloggername',
				            'featured',
				            'blogcategoryid',
				            '(SELECT categoryname from blogcategories where id = blogcategoryid) as category',
				            'view',
				            'image',
				            'added_by',
				        	'created_date'],
			
				             
				'where'	=> array(
					'and' => array(
							'status' => 'Active',
							'categoryid' => $cat_id
						)
					),
				'limit' => array(
								'offset' => $offset,				//take data leaving some no.
								'no_of_data' => $no_of_data
								)
				);

			return $this->getData($args,$is_die);
		}


		public function updateBlogbyId($data,$id,$is_die = false){
			$args = array(
				'where'	=> array(
					'and' => array(
							'id' => $id,
						)
					)
				);

			return $this->updateData($data,$args,$is_die);
		}

		public function deleteBlogbyId($id,$is_die=false){
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