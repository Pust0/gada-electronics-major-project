<?php
    include("../../admin/config.php");
    $productCategory = $_POST['tableName'];
    $searchedProduct = trim($_POST['searchedText']);

    $output = "";

    $sql = empty($searchedProduct) == true ? "SELECT * FROM {$productCategory}" : "SELECT * FROM {$productCategory} WHERE TITLE LIKE '%{$searchedProduct}%'";
    //echo $sql;
    $result = mysqli_query($conn, $sql) or die("Query not running");

    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_assoc($result)){
            $output .= "<div class='col-lg-3 col-md-3 col-6'>
                            <div class='card mx-auto'>
                                <a href='card-details.php?CATEGORYNAME={$productCategory}&ID={$row["ID"]}'><img class='card-img-top product-image' src='admin/images/product/{$row["IMAGE"]}'></a> 
                                <div class='card-body bg-light'>
                                    <p class='card-text'>{$row['TITLE']}</p>
                                    <p class='card-title discount' style='text-decoration:line-through;'>{$row["DISCOUNT"]} Rs.</p>
                                    <p class='card-title price text-info'><i>{$row['PRICE']} Rs.</i></p>
                                </div>
                            </div>
                        </div>";
        }
    }else{
        $output .= "<p>No Product found with name ".$searchedProduct." </p>";
    }

    echo $output;
?>