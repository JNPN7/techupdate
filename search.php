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
        $Database = new database();
        
        $sqlForBlogCategories = "SELECT id, categoryname, created_date, description FROM blogcategories";
        $sqlForBlogs = "SELECT id, title, created_date, content, quote, bloggername FROM blogs";
        $count = 0;
        
        $data = $Database->getDataFromQuery($sqlForBlogCategories);
        if(count($data) > 0) {
            $count += search($data, $keyword, 0);
        }

        $data = $Database->getDataFromQuery($sqlForBlogs);
        if(count($data) > 0) {
            $count += search($data, $keyword, 1);
        }
        if(!$count) {
            echo '<div class="searchResults"><p>No results found!!</p></div>';
        }
    }
?>
<?php
	include 'includes/footer.php';
?>