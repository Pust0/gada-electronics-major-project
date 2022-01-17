<?php
include("../../admin/config.php");
//echo "i am here";
$output = "";
$heading = "";
$totalCountOfProduct = 0;

$sql = "SELECT * FROM allcategory";
$result = mysqli_query($conn, $sql) or die("First query not running");
if(mysqli_num_rows($result) > 0){
    while($row = mysqli_fetch_assoc($result)){
        $product_category = $row['CATEGORYNAME'];
        $heading = str_replace("_"," ", $row["CATEGORYNAME"]);
        $output .= "<div class='heading'>
                        <p class='text'>{$heading}</p>
                   </div>";

        $product_category = strtolower($row["CATEGORYNAME"]);

        $sql1 = "SELECT * FROM $product_category";
        $result1 = mysqli_query($conn, $sql1) or die("Second query not running");
        $totalCountOfProduct = mysqli_num_rows($result1);

        $sql1 = "SELECT * FROM $product_category limit 4";
        $result1 = mysqli_query($conn, $sql1) or die("Third query not running");

        $output .= "<div id='{$row["ID"]}-OneProductRow'>";
        if(mysqli_num_rows($result1) > 0){
            $output .= "<div id='{$row["ID"]}-row' class='row'>";
            while($row1 = mysqli_fetch_assoc($result1)){
                $titleOfProduct = (strlen($row1["TITLE"]) > 20) ? (substr($row1["TITLE"],0,20)."...") : ($row1["TITLE"]);

                $output .= "<div class='col-lg-3 col-md-3 col-6'>
                                <div class='card mx-auto'>
                                    <a href='card-details.php?CATEGORYNAME={$product_category}&ID={$row1["ID"]}'><img class='card-img-top product-image' src='admin/images/product/{$row1["IMAGE"]}'/></a> 
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
            
            $loop = ceil($totalCountOfProduct / 4);
            $output .= "<div class='row'>";
            $output .= "<div class='col-lg-12 col-md-12 col-sm-12 pagination-btn-container' data-id='{$row["ID"]}'>";

            $active = "";
            for($i=1; $i<=$loop; $i++){
                $active = ($i == 1) ? ("active") : ("");
                $output .= "<div class='pagination-btn {$active}' data-id='{$row["ID"]}'>{$i}</div>";
            }
            $output .= "<a class='pagination-btn' data-id='{$row["ID"]}' href='product-card.php?CATEGORYNAME={$product_category}&ID={$row["ID"]}'>See All</a>
                </div>
            </div>";
            
        }else{
            $output.= "No product found in".$category_name."category";
        }

       
        
        $output .= "</div>"; //closing one-product-div
    }

    echo $output;
}else{
    echo "<h2>No Product Category Found</h2>";
}
?>