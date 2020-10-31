<!-- search.php -->
<?php
	include $_SERVER['DOCUMENT_ROOT'].'config/init.php';
	include 'includes/header.php';
?>

<?php
    $keyword = $_GET['keyword'];
    if($keyword == "") {
        goBack();
    }
    else {
        // echo $keyword;
        $keyword = strtolower($keyword);
        $keywordLength = strlen($keyword);
        // echo $keywordLength;




        // Search Operation here.

        $servername = "localhost";
        $username = "root";
        $password = '';
        $dbname = "techupd";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sqlForBlogCategories = "SELECT id, categoryname, description FROM blogcategories";
        $sqlForBlogs = "SELECT id, title, content, quote, bloggername FROM blogs";
        
        $count = 0;

        
        // Get BlogCategories Data
        $data = $conn->query($sqlForBlogCategories);




        // echo $data->num_rows;
        if ($data->num_rows > 0) {
            while($row = $data->fetch_assoc()) {
                $flag = 0;
                $link = 'category?id='.$row['id'];
                $categoryName = html_entity_decode($row["categoryname"]);
                $categoryNameLower = strtolower($categoryName);
                $description = html_entity_decode($row["description"]);
                $descriptionLower = strtolower($description);

                if(strpos($categoryNameLower, $keyword) !== false) {
                    $flag = 1;
                    $count += substr_count($categoryNameLower, $keyword);
                    $lastPos = 0;
                    $positions = array();
                    while (($lastPos = strpos($categoryNameLower, $keyword, $lastPos)) !== false) {
                        $positions[] = $lastPos;
                        $lastPos += $keywordLength;
                    }
                    // print_r($positions);
                    echo '<div class="searchResults"><a href='.$link.'><h1>'.substr($categoryName, 0, $positions[0]);
                    for ($x = 0; $x < count($positions); $x++) {
                        echo '<font color="green">'.substr($categoryName, $positions[$x], $keywordLength).'</font>';
                        if($x < count($positions) - 1) {
                            echo substr($categoryName, $positions[$x] + $keywordLength, $positions[$x + 1] - $positions[$x] - $keywordLength);
                        }
                    }
                    echo substr($categoryName, $positions[count($positions) - 1] + $keywordLength).'</h1><h3><p>';

                    if(strpos($descriptionLower, $keyword) !== false) {
                        $count += substr_count($descriptionLower, $keyword);
                        $lastPos = 0;
                        $positions = array();
                        while (($lastPos = strpos($descriptionLower, $keyword, $lastPos)) !== false) {
                            $positions[] = $lastPos;
                            $lastPos += $keywordLength;
                        }


                        if(strlen($descriptionLower) > 300) {
                            if($positions[0] + $keywordLength < 300) {
                                $descriptionPart = substr($description, 0, 300)."...";
                            }
                            else {
                                if($positions[0] + 300 < strlen($descriptionLower)) {
                                    $descriptionPart = "...".substr($description, $positions[0] - 300/2, 300)."...";
                                }
                                else {
                                    $descriptionPart = "...".substr($description, strlen($descriptionLower) - 300, 300);
                                }
                            }
                            $descriptionPartLower = strtolower($descriptionPart);
                            $lastPos = 0;
                            $positions = array();
                            while (($lastPos = strpos($descriptionPartLower, $keyword, $lastPos)) !== false) {
                                $positions[] = $lastPos;
                                $lastPos += $keywordLength;
                            }
                            echo substr($descriptionPart, 0, $positions[0]);
                            for ($x = 0; $x < count($positions); $x++) {
                                echo '<font color="green">'.substr($descriptionPart, $positions[$x], $keywordLength).'</font>';
                                if($x < count($positions) - 1) {
                                    echo substr($descriptionPart, $positions[$x] + $keywordLength, $positions[$x + 1] - $positions[$x] - $keywordLength);
                                }
                            }
                            echo substr($descriptionPart, $positions[count($positions) - 1] + $keywordLength).'</p></h3></a></div>'; 
                        }
                        else {
                            echo substr($description, 0, $positions[0]);
                            for ($x = 0; $x < count($positions); $x++) {
                                echo '<font color="green">'.substr($description, $positions[$x], $keywordLength).'</font>';
                                if($x < count($positions) - 1) {
                                    echo substr($description, $positions[$x] + $keywordLength, $positions[$x + 1] - $positions[$x] - $keywordLength);
                                }
                            }
                            echo substr($description, $positions[count($positions) - 1] + $keywordLength).'</p></h3></a></div>'; 
                        }

                        // print_r($positions);
                        
                    }
                    else {
                        if(strlen($description) > 300) {
                            echo substr($description, 0, 300)."...".'</p></h3></a></div>';
                        }
                        else {
                            echo $description.'</p></h3></a></div>';
                        }
                        
                    }
                    
                }
                // echo $flag;
                if($flag) {
                    $flag = 0;
                }
                else {
                    if(strpos($descriptionLower, $keyword) !== false) {
                        $count += substr_count($descriptionLower, $keyword);
                        $lastPos = 0;
                        $positions = array();
                        while (($lastPos = strpos($descriptionLower, $keyword, $lastPos)) !== false) {
                            $positions[] = $lastPos;
                            $lastPos += $keywordLength;
                        }

                        echo '<div class="searchResults"><a href='.$link.'><h1>'.$categoryName.'</h1><h3><p>';

                        if(strlen($descriptionLower) > 300) {
                            if($positions[0] + $keywordLength < 300) {
                                $descriptionPart = substr($description, 0, 300)."...";
                            }
                            else {
                                if($positions[0] + 300 < strlen($descriptionLower)) {
                                    $descriptionPart = "...".substr($description, $positions[0] - 300/2, 300)."...";
                                }
                                else {
                                    $descriptionPart = "...".substr($description, strlen($descriptionLower) - 300, 300);
                                }
                            }
                            $descriptionPartLower = strtolower($descriptionPart);
                            $lastPos = 0;
                            $positions = array();
                            while (($lastPos = strpos($descriptionPartLower, $keyword, $lastPos)) !== false) {
                                $positions[] = $lastPos;
                                $lastPos += $keywordLength;
                            }
                            echo substr($descriptionPart, 0, $positions[0]);
                            for ($x = 0; $x < count($positions); $x++) {
                                echo '<font color="green">'.substr($descriptionPart, $positions[$x], $keywordLength).'</font>';
                                if($x < count($positions) - 1) {
                                    echo substr($descriptionPart, $positions[$x] + $keywordLength, $positions[$x + 1] - $positions[$x] - $keywordLength);
                                }
                            }
                            echo substr($descriptionPart, $positions[count($positions) - 1] + $keywordLength).'</p></h3></a></div>'; 
                        }
                        else {
                            echo substr($description, 0, $positions[0]);
                            for ($x = 0; $x < count($positions); $x++) {
                                echo '<font color="green">'.substr($description, $positions[$x], $keywordLength).'</font>';
                                if($x < count($positions) - 1) {
                                    echo substr($description, $positions[$x] + $keywordLength, $positions[$x + 1] - $positions[$x] - $keywordLength);
                                }
                            }
                            echo substr($description, $positions[count($positions) - 1] + $keywordLength).'</p></h3></a></div>'; 
                        }
                    }
                }
            }
        }




        // Get Blog data


        $data = $conn->query($sqlForBlogs);
        if ($data->num_rows > 0) {
            while($row = $data->fetch_assoc()) {
                $flag = 0;
                $link = 'blog?id='.$row['id'];
                $title = html_entity_decode($row["title"]);
                $titleLower = strtolower($title);
                $content = html_entity_decode($row["content"]);
                $contentLower = strtolower($content);
                $quote = html_entity_decode($row["quote"]);
                $quoteLower = strtolower($quote);
                $bloggername = html_entity_decode($row["bloggername"]);
                $bloggernameLower = strtolower($bloggername);

                // echo $title;


                if(strpos($titleLower, $keyword) !== false) {
                    $flag = 1;
                    $count += substr_count($titleLower, $keyword);
                    $lastPos = 0;
                    $positions = array();
                    while (($lastPos = strpos($titleLower, $keyword, $lastPos)) !== false) {
                        $positions[] = $lastPos;
                        $lastPos += $keywordLength;
                    }
                    // print_r($positions);
                    echo '<div class="searchResults"><a href='.$link.'><h1>'.substr($title, 0, $positions[0]);
                    for ($x = 0; $x < count($positions); $x++) {
                        echo '<font color="green">'.substr($title, $positions[$x], $keywordLength).'</font>';
                        if($x < count($positions) - 1) {
                            echo substr($title, $positions[$x] + $keywordLength, $positions[$x + 1] - $positions[$x] - $keywordLength);
                        }
                    }
                    echo substr($title, $positions[count($positions) - 1] + $keywordLength).'</h1><h3><p>';

                    if(strpos($contentLower, $keyword) !== false) {
                        $count += substr_count($contentLower, $keyword);
                        $lastPos = 0;
                        $positions = array();
                        while (($lastPos = strpos($contentLower, $keyword, $lastPos)) !== false) {
                            $positions[] = $lastPos;
                            $lastPos += $keywordLength;
                        }
                        // print_r($positions);

                        if(strlen($contentLower) > 300) {
                            if($positions[0] + $keywordLength < 300) {
                                $contentPart = substr($content, 0, 300)."...";
                            }
                            else {
                                if($positions[0] + 300 < strlen($contentLower)) {
                                    $contentPart = "...".substr($content, $positions[0] - 300/2, 300)."...";
                                }
                                else {
                                    $contentPart = "...".substr($content, strlen($contentLower) - 300, 300);
                                }
                            }
                            $contentPartLower = strtolower($contentPart);
                            $lastPos = 0;
                            $positions = array();
                            while (($lastPos = strpos($contentPartLower, $keyword, $lastPos)) !== false) {
                                $positions[] = $lastPos;
                                $lastPos += $keywordLength;
                            }
                            echo substr($contentPart, 0, $positions[0]);
                            for ($x = 0; $x < count($positions); $x++) {
                                echo '<font color="green">'.substr($contentPart, $positions[$x], $keywordLength).'</font>';
                                if($x < count($positions) - 1) {
                                    echo substr($contentPart, $positions[$x] + $keywordLength, $positions[$x + 1] - $positions[$x] - $keywordLength);
                                }
                            }
                            echo substr($contentPart, $positions[count($positions) - 1] + $keywordLength).'</p></h3><h4><p>'; 
                        }
                        else {
                            echo substr($content, 0, $positions[0]);
                            for ($x = 0; $x < count($positions); $x++) {
                                echo '<font color="green">'.substr($content, $positions[$x], $keywordLength).'</font>';
                                if($x < count($positions) - 1) {
                                    echo substr($content, $positions[$x] + $keywordLength, $positions[$x + 1] - $positions[$x] - $keywordLength);
                                }
                            }
                            echo substr($content, $positions[count($positions) - 1] + $keywordLength).'</p></h3><h4><p>'; 
                        } 
                    }
                    else {
                        if(strlen($content) > 300) {
                            echo substr($content, 0, 300)."...".'</p></h3><h4><p>';
                        }
                        else {
                            echo $content.'</p></h3><h4><p>';
                        }
                    }


                    if(strpos($quoteLower, $keyword) !== false) {
                        $count += substr_count($quoteLower, $keyword);
                        $lastPos = 0;
                        $positions = array();
                        while (($lastPos = strpos($quoteLower, $keyword, $lastPos)) !== false) {
                            $positions[] = $lastPos;
                            $lastPos += $keywordLength;
                        }
                        // print_r($positions);
                        echo substr($quote, 0, $positions[0]);
                        for ($x = 0; $x < count($positions); $x++) {
                            echo '<font color="green">'.substr($quote, $positions[$x], $keywordLength).'</font>';
                            if($x < count($positions) - 1) {
                                echo substr($quote, $positions[$x] + $keywordLength, $positions[$x + 1] - $positions[$x] - $keywordLength);
                            }
                        }
                        echo substr($quote, $positions[count($positions) - 1] + $keywordLength).'</p></h4><h4><p>'; 
                    }
                    else {
                        echo $quote.'</p></h4><h4><p>';
                    }

                    if(strpos($bloggernameLower, $keyword) !== false) {
                        $count += substr_count($bloggernameLower, $keyword);
                        $lastPos = 0;
                        $positions = array();
                        while (($lastPos = strpos($bloggernameLower, $keyword, $lastPos)) !== false) {
                            $positions[] = $lastPos;
                            $lastPos += $keywordLength;
                        }
                        // print_r($positions);
                        echo substr($bloggername, 0, $positions[0]);
                        for ($x = 0; $x < count($positions); $x++) {
                            echo '<font color="green">'.substr($bloggername, $positions[$x], $keywordLength).'</font>';
                            if($x < count($positions) - 1) {
                                echo substr($bloggername, $positions[$x] + $keywordLength, $positions[$x + 1] - $positions[$x] - $keywordLength);
                            }
                        }
                        echo substr($bloggername, $positions[count($positions) - 1] + $keywordLength).'</p></h4></a></div>'; 
                    }
                    else {
                        echo $bloggername.'</p></h4></a></div>';
                    }                    
                }


                // echo $flag;
                
                
                if($flag) {
                    $flag = 0;
                }
                else {
                    if(strpos($contentLower, $keyword) !== false) {
                        $flag =1;
                        $count += substr_count($contentLower, $keyword);
                        $lastPos = 0;
                        $positions = array();
                        
                        echo '<div class="searchResults"><a href='.$link.'><h1>'.$title.'</h1><h3><p>';
                        
                        while (($lastPos = strpos($contentLower, $keyword, $lastPos)) !== false) {
                            $positions[] = $lastPos;
                            $lastPos += $keywordLength;
                        }
                        // print_r($positions);


                        if(strlen($contentLower) > 300) {
                            if($positions[0] + $keywordLength < 300) {
                                $contentPart = substr($content, 0, 300)."...";
                            }
                            else {
                                if($positions[0] + 300 < strlen($contentLower)) {
                                    $contentPart = "...".substr($content, $positions[0] - 300/2, 300)."...";
                                }
                                else {
                                    $contentPart = "...".substr($content, strlen($contentLower) - 300, 300);
                                }
                            }
                            
                            $contentPartLower = strtolower($contentPart);
                            $lastPos = 0;
                            $positions = array();
                            while (($lastPos = strpos($contentPartLower, $keyword, $lastPos)) !== false) {
                                $positions[] = $lastPos;
                                $lastPos += $keywordLength;
                                // print_r($positions);
                            }
                            // print_r($positions);
                            echo substr($contentPart, 0, $positions[0]);
                            for ($x = 0; $x < count($positions); $x++) {
                                echo '<font color="green">'.substr($contentPart, $positions[$x], $keywordLength).'</font>';
                                if($x < count($positions) - 1) {
                                    echo substr($contentPart, $positions[$x] + $keywordLength, $positions[$x + 1] - $positions[$x] - $keywordLength);
                                }
                            }
                            echo substr($contentPart, $positions[count($positions) - 1] + $keywordLength).'</p></h3><h4><p>'; 
                        }
                        else {
                            echo substr($content, 0, $positions[0]);
                            for ($x = 0; $x < count($positions); $x++) {
                                echo '<font color="green">'.substr($content, $positions[$x], $keywordLength).'</font>';
                                if($x < count($positions) - 1) {
                                    echo substr($content, $positions[$x] + $keywordLength, $positions[$x + 1] - $positions[$x] - $keywordLength);
                                }
                            }
                            echo substr($content, $positions[count($positions) - 1] + $keywordLength).'</p></h3><h4><p>';
                        }


                        if(strpos($quoteLower, $keyword) !== false) {
                            $count += substr_count($quoteLower, $keyword);
                            $lastPos = 0;
                            $positions = array();
                            while (($lastPos = strpos($quoteLower, $keyword, $lastPos)) !== false) {
                                $positions[] = $lastPos;
                                $lastPos += $keywordLength;
                            }
                            // print_r($positions);
                            echo substr($quote, 0, $positions[0]);
                            for ($x = 0; $x < count($positions); $x++) {
                                echo '<font color="green">'.substr($quote, $positions[$x], $keywordLength).'</font>';
                                if($x < count($positions) - 1) {
                                    echo substr($quote, $positions[$x] + $keywordLength, $positions[$x + 1] - $positions[$x] - $keywordLength);
                                }
                            }
                            echo substr($quote, $positions[count($positions) - 1] + $keywordLength).'</p></h4><h4><p>'; 
                        }
                        else {
                            echo $quote.'</p></h4><h4><p>';
                        }

                        if(strpos($bloggernameLower, $keyword) !== false) {
                            $count += substr_count($bloggernameLower, $keyword);
                            $lastPos = 0;
                            $positions = array();
                            while (($lastPos = strpos($bloggernameLower, $keyword, $lastPos)) !== false) {
                                $positions[] = $lastPos;
                                $lastPos += $keywordLength;
                            }
                            // print_r($positions);
                            echo substr($bloggername, 0, $positions[0]);
                            for ($x = 0; $x < count($positions); $x++) {
                                echo '<font color="green">'.substr($bloggername, $positions[$x], $keywordLength).'</font>';
                                if($x < count($positions) - 1) {
                                    echo substr($bloggername, $positions[$x] + $keywordLength, $positions[$x + 1] - $positions[$x] - $keywordLength);
                                }
                            }
                            echo substr($bloggername, $positions[count($positions) - 1] + $keywordLength).'</p></h4></a></div>'; 
                        }
                        else {
                            echo $bloggername.'</p></h4></a></div>';
                        }
                    }


                    if($flag) {
                        $flag = 0;
                    }
                    else {
                        if(strpos($quoteLower, $keyword) !== false) {
                            $count += substr_count($quoteLower, $keyword);
                            $flag = 1;
                            $lastPos = 0;
                            $positions = array();
                            
                            if(strlen($content) > 300) {
                                echo '<div class="searchResults"><a href='.$link.'><h1>'.$title.'</h1><h3><p>'.substr($content, 0, 300)."...".'</p></h3><h4><p>';
                            }
                            else {
                                echo '<div class="searchResults"><a href='.$link.'><h1>'.$title.'</h1><h3><p>'.$content.'</p></h3><h4><p>';
                            }

                            while (($lastPos = strpos($quoteLower, $keyword, $lastPos)) !== false) {
                                $positions[] = $lastPos;
                                $lastPos += $keywordLength;
                            }
                            // print_r($positions);
                            echo substr($quote, 0, $positions[0]);
                            for ($x = 0; $x < count($positions); $x++) {
                                echo '<font color="green">'.substr($quote, $positions[$x], $keywordLength).'</font>';
                                if($x < count($positions) - 1) {
                                    echo substr($quote, $positions[$x] + $keywordLength, $positions[$x + 1] - $positions[$x] - $keywordLength);
                                }
                            }
                            echo substr($quote, $positions[count($positions) - 1] + $keywordLength).'</p></h4><h4><p>'; 

                            if(strpos($bloggernameLower, $keyword) !== false) {
                                $count += substr_count($bloggernameLower, $keyword);
                                $lastPos = 0;
                                $positions = array();
                                while (($lastPos = strpos($bloggernameLower, $keyword, $lastPos)) !== false) {
                                    $positions[] = $lastPos;
                                    $lastPos += $keywordLength;
                                }
                                // print_r($positions);
                                echo substr($bloggername, 0, $positions[0]);
                                for ($x = 0; $x < count($positions); $x++) {
                                    echo '<font color="green">'.substr($bloggername, $positions[$x], $keywordLength).'</font>';
                                    if($x < count($positions) - 1) {
                                        echo substr($bloggername, $positions[$x] + $keywordLength, $positions[$x + 1] - $positions[$x] - $keywordLength);
                                    }
                                }
                                echo substr($bloggername, $positions[count($positions) - 1] + $keywordLength).'</p></h4></a></div>'; 
                            }
                            else {
                                echo $bloggername.'</p></h4></a></div>';
                            }
                            
                        }

                        if($flag) {
                            $flag = 0;
                        }
                        else {
                            if(strpos($bloggernameLower, $keyword) !== false) {
                                $count += substr_count($bloggernameLower, $keyword);
                                $lastPos = 0;
                                $positions = array();
                                while (($lastPos = strpos($bloggernameLower, $keyword, $lastPos)) !== false) {
                                    $positions[] = $lastPos;
                                    $lastPos += $keywordLength;
                                }
                                // print_r($positions);
    

                                if(strlen($content) > 300) {
                                    echo '<div class="searchResults"><a href='.$link.'><h1>'.$title.'</h1><h3><p>'.substr($content, 0, 300)."...".'</p></h3><h4><p>'.$quote.'</p></h4><h4><p>';
                                }
                                else {
                                    echo '<div class="searchResults"><a href='.$link.'><h1>'.$title.'</h1><h3><p>'.$content.'</p></h3><h4><p>'.$quote.'</p></h4><h4><p>';
                                }

                                echo substr($bloggername, 0, $positions[0]);
                                for ($x = 0; $x < count($positions); $x++) {
                                    echo '<font color="green">'.substr($bloggername, $positions[$x], $keywordLength).'</font>';
                                    if($x < count($positions) - 1) {
                                        echo substr($bloggername, $positions[$x] + $keywordLength, $positions[$x + 1] - $positions[$x] - $keywordLength);
                                    }
                                }
                                echo substr($bloggername, $positions[count($positions) - 1] + $keywordLength).'</p></h4></a></div>'; 
                            }
                            
                        }



                    }

                    

                }
            }
            // echo $wordCount;
        }

        $conn->close();

        if(!$count) {
            echo '<div class="searchResults"><p>No results found!!</p></div>';
        }

    }
?>



<div id="searchResults"></div>

<?php
	include 'includes/footer.php';
?>