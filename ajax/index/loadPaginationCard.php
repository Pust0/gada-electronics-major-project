<?php
include("../../admin/config.php");
$product_category_id = $_GET['product_Category_Id'];
$pagination_page_no = $_GET['pagination_Number'];

$sql = "SELECT * FROM allcategory WHERE ID = $product_category_id";
$result = mysqli_query($conn, $sql) or die("First query is not running");

$product_category_name = "";
while($row = mysqli_fetch_assoc($result)){
    $product_category_name = $row['CATEGORYNAME'];
}

//Now we have all required information lets begin pagination code

$output = "";
$limit_per_page = 4;
$offset = ($pagination_page_no - 1) * $limit_per_page;
$sql1 = "SELECT * FROM $product_category_name LIMIT $limit_per_page OFFSET $offset";
$result1 = mysqli_query($conn, $sql1) or die("Second query is not running"); 

//for counting number of product in a particular category
$sql2 = "SELECT * FROM $product_category_name";
$result2 = mysqli_query($conn, $sql2) or die("Third query is not running"); 

if(mysqli_num_rows($result1) > 0){

    $output .= "<div id='{$product_category_id}-row' class='row'>";
    while($row1 = mysqli_fetch_assoc($result1)){
        $titleOfProduct = (strlen($row1["TITLE"]) > 20) ? (substr($row1["TITLE"],0,20)."...") : ($row1["TITLE"]);

        $output .= "<div class='col-lg-3 col-md-3 col-6'>
                        <div class='card mx-auto'>
                            <a href='card-details.php?CATEGORYNAME={$product_category_name}&ID={$row1["ID"]}'><img class='card-img-top product-image' src='admin/images/product/{$row1["IMAGE"]}'/></a> 
                            <div class='card-body bg-light'>
                                <p class='card-text'>{$titleOfProduct}</p>";
                                if($row1["DISCOUNT"] != "") {
                                    $output .= "<p class='card-title discount' style='text-decoration:line-through;'>{$row1["DISCOUNT"]} Rs</p>";
                                }
                                $output .= "<p class='card-title price text-info'><i>{$row1['PRICE']} Rs</i></p>
                            </div>
                        </div>
                    </div>";
    }
    $output .= "</div>";

    //adding row for pagination
    $totalCountOfProduct = mysqli_num_rows($result2);
    $loop = ceil($totalCountOfProduct / 4);
    $output .= "<div class='row'>";
    $output .= "<div class='col-lg-12 col-md-12 col-sm-12 pagination-btn-container' data-id='{$product_category_id}'>";

    $active = "";
    for($i=1; $i<=$loop; $i++){
        $active = ($i == $pagination_page_no) ? ("active") : ("");
        $output .= "<div class='pagination-btn {$active}' data-id='{$product_category_id}'>{$i}</div>";
    }
    $output .= "<a class='pagination-btn' data-id='{$product_category_id}' href='product-card.php?CATEGORYNAME={$product_category_name}&ID={$product_category_id}'>See All</a>
        </div>
    </div>";
    
}else{
    $output.= "No product found in ".$product_category_name." category";
}

echo $output;

?>