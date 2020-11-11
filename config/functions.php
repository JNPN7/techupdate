<?php 
	function debugger($data,$is_die=false){
		echo "<pre>";
		print_r($data);
		echo "</pre>";
		if ($is_die) {
			exit();
		}
	}


	function sanitize($str){
		return trim(stripcslashes(strip_tags($str)));
	}


	function tokenize($length=100){
		$char = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQESTUVWXYZ0123456789';
		$len = strlen($char);
		$token='';
		for ($i=0; $i < $length; $i++) { 
			$token.=$char[rand(0,$len-1)];
		}
		return $token;
	}


	function redirect($loc,$key="",$message=""){
		$_SESSION[$key]=$message;
		@header('location: '.$loc);
		exit();
	}

	function flashMessage(){
		if(isset($_SESSION['error']) && !empty($_SESSION['error'])){
			echo "<span class='alert alert-danger'>".$_SESSION['error']."</span>";
			unset($_SESSION['error']);
		}else if(isset($_SESSION['success']) && !empty($_SESSION['success'])){
			echo "<span class='alert alert-success'>".$_SESSION['success']."</span>";
			unset($_SESSION['success']);
		}else if(isset($_SESSION['warning']) && !empty($_SESSION['warning'])){
			echo "<span class='alert alert-warning'>".$_SESSION['warning']."</span>";
			unset($_SESSION['warning']);
		}
	}
?>
	<script type="text/javascript">
		setTimeout(function(){
			$('.alert').slideUp('slow');
		}, 2000);
	</script>

<?php

		function uploadMultiImage($data, $loc='image'){
			// debugger(sizeof($data['name']),true);
			if ($data){
				for ($i=0; $i < sizeof($data['name']); $i++) { 
					if ($data['size'][$i]<5000000) {
							$ext = pathinfo($data['name'][$i],PATHINFO_EXTENSION);
							if(in_array(strtolower($ext), ALLOWED_EXTENSION)){
								$destination = UPLOAD_PATH.strtolower($loc).'/';
								if (!is_dir($destination)) {
									mkdir($destination,0777,true);
								}
								$filename[$i] = ucfirst(strtolower($loc)).'-'.date('Ymdhisa').$i.rand(0,999).'.'.$ext;
								$success = move_uploaded_file($data['tmp_name'][$i], $destination.$filename[$i]);								
							}else{
								return false;
							}
						}else{
							return false;
						}
				}
				if ($success) {
					$combo = implode(" ", $filename);
					// debugger($combo,true);
					return $combo;
				}else{
					return false;
				}
			}else{
				return false;
			}		
		}	
		function uploadImage($data,$loc='image'){
			//debugger($data,true);
			if ($data) {
				if (!$data['error']) {
					if ($data['size']<5000000) {
						$ext = pathinfo($data['name'],PATHINFO_EXTENSION);
						if(in_array(strtolower($ext), ALLOWED_EXTENSION)){
							$destination = UPLOAD_PATH.strtolower($loc).'/';
							if (!is_dir($destination)) {
								mkdir($destination,0777,true);
							}
							$filename = ucfirst(strtolower($loc)).'-'.date('Ymdhisa').rand(0,999).'.'.$ext;
							$success = move_uploaded_file($data['tmp_name'], $destination.$filename);
							if ($success) {
								return $filename;
							}else{
								return false;
							}
						}else{
							return false;
						}
					}else{
						return false;
					}
				}else{
					return false;
				}
			}else{
				return false;
			}
		}

		// function uploadImage($sata,$loc='image'){
		// 	$data = array_filter($sata['image']['name']);
		// 	if (!empty($data)) {
		// 		foreach ($sata['image']['name'] as $key => $val) {
		// 				$ext = pathinfo($sata['image']['name'],PATHINFO_EXTENSION);
		// 				if(in_array(strtolower($ext), ALLOWED_EXTENSION)){
		// 					$destination = UPLOAD_PATH.strtolower($loc).'/';
		// 					if (!is_dir($destination)) {
		// 						mkdir($destination,0777,true);
		// 					}
		// 					$filename = ucfirst(strtolower($loc)).'-'.date('Ymdhisa').rand(0,999).'.'.$ext;
		// 					$success = move_uploaded_file($data['tmp_name'], $destination.$filename);
		// 					if ($success) {
		// 						return $filename;
		// 					}else{
		// 						return false;
		// 					}
		// 				}else{
		// 					return false;
		// 				}
		// 		}
		// 	}else{
		// 		return false;
		// 	}
		// }



		function goBack() {
			$_SESSION['noKeyword'] = 1;
			header('Location: '.$_SERVER['HTTP_REFERER']);
		}

		function alertUser () {
			echo '
						<script>
								if(document.getElementById("searchPage").style.display == "block") {
									document.getElementById("searchPage").style.display = "none";
								}
								else {
									document.getElementById("searchPage").style.display = "block";
									document.getElementById("searchPage").getElementsByClassName("searchPageBox")[0].focus();
								}
						</script>
						<div id="noKeywordMessage"><div>Please enter some keywords to search</div></div>
					';
			$_SESSION['noKeyword'] = 0;
		}

		function search($data, $keyword, $arg) {
			$keywordLower = strtolower($keyword);
			$keywordLength = strlen($keyword);
			$rows = count($data);
			$count = 0;
			for($i = 0; $i < $rows; $i++) {
				$Data = (array)$data[$i];
				$keys = array_keys($Data);
				if ($arg == 0) {
					$link = 'category?id='.$Data[$keys[0]];
				}
				else {
					$link = 'blog?id='.$Data[$keys[0]];
				}
				
				$flag = 0;
				for($j = 1; $j < count($Data) - 1; $j++) {
					$searchIn = html_entity_decode($Data[$keys[$j]]);
					$searchInLower = strtolower($searchIn);
					if($flag) {
						$flag = 0;
						$j = count($Data) - 1;
					}
					else {
						if(strpos($searchInLower, $keywordLower) !== false) {
							$flag = 1;
							if(isset($Data[$keys[count($keys) - 1]])) {
								$imageArr = explode(' ', $Data[$keys[count($keys) - 1]]);
								// debugger($imageArr,true);
								echo '<div class="searchResults"><a href='.$link.'><div class="searchResultImage"><img src="'.UPLOAD_URL.'blog/'.$imageArr['0'].'"/></div><div>';
							}
							else {
								echo '<div class="searchResults"><a href='.$link.'><div>';
							}
							for($k = 1; $k < count($Data) - 1; $k++) {
								$searchIn = html_entity_decode($Data[$keys[$k]]);
								$searchInLower = strtolower($searchIn);
								if(strpos($searchInLower, $keywordLower) !== false) {
									$count += substr_count($searchInLower, $keywordLower);
									$lastPos = 0;
									$positions = array();
									while (($lastPos = strpos($searchInLower, $keywordLower, $lastPos)) !== false) {
										$positions[] = $lastPos;
										$lastPos += $keywordLength;
									}
									if(strlen($searchInLower) > 300) {
										if($positions[0] + $keywordLength < 300) {
											$searchInPart = substr($searchIn, 0, 300)."...";
										}
										else {
											if($positions[0] + 300 < strlen($searchInLower)) {
												$searchInPart = "...".substr($searchIn, $positions[0] - 300/2, 300)."...";
											}
											else {
												$searchInPart = "...".substr($searchIn, strlen($searchInLower) - 300, 300);
											}
										}
										$searchInPartLower = strtolower($searchInPart);
										$lastPos = 0;
										$positions = array();
										while (($lastPos = strpos($searchInPartLower, $keywordLower, $lastPos)) !== false) {
											$positions[] = $lastPos;
											$lastPos += $keywordLength;
										}
										echo '<p>'.substr($searchInPart, 0, $positions[0]);
										for ($x = 0; $x < count($positions); $x++) {
											echo '<font color="green" style="background-color: white;">'.substr($searchInPart, $positions[$x], $keywordLength).'</font>';
											if($x < count($positions) - 1) {
												echo substr($searchInPart, $positions[$x] + $keywordLength, $positions[$x + 1] - $positions[$x] - $keywordLength);
											}
										}
										echo substr($searchInPart, $positions[count($positions) - 1] + $keywordLength).'</p>';
									}
									else {
										echo '<p>'.substr($searchIn, 0, $positions[0]);
										for ($x = 0; $x < count($positions); $x++) {
											echo '<font color="green" style="background-color: white;">'.substr($searchIn, $positions[$x], $keywordLength).'</font>';
											if($x < count($positions) - 1) {
												echo substr($searchIn, $positions[$x] + $keywordLength, $positions[$x + 1] - $positions[$x] - $keywordLength);
											}
										}
										echo substr($searchIn, $positions[count($positions) - 1] + $keywordLength).'</p>';
									}
								}
								else {
									if(strlen($searchIn) > 300) {
										echo '<p>'.substr($searchIn, 0, 300).'</p>';
									}
									else {
										echo '<p>'.$searchIn.'</p>';
									}                                        
								}
							}
							echo '</a></div></div>';
						}
					}
				}
			}
			return $count;
		}

		function alertSignIn () {
			echo '
							<script>
								if(document.getElementById("signInAlert").style.display == "flex") {
									document.getElementById("signInAlert").style.display = "none";
								}
                                else {
									document.getElementById("signInAlert").style.display = "flex";
								}
                            </script>
                        ';
			unset($_SESSION['alert']);
		}

		function showCommentBox() {
			echo '
						<script>
							document.getElementById("replyBox").style.display = "flex";
							document.getElementById("replyBox").getElementsByTagName("textarea")[0].focus();
							document.getElementById("replyBox").getElementsByTagName("textarea")[0].value = "'.$_SESSION['commentMessage'].'";
						</script>
					';
			unset($_SESSION['commentMessage']);
		}

?>