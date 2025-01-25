<?php if (isset($_GET['error'])): ?>
	    <p><?php echo $_GET['error']; ?></p>
<?php endif ?>

<?php

if (!isset($_GET['category'])) {
    $sql = "SELECT * FROM categories ORDER BY `cat_order` LIMIT 1";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $category_slug = $row['cat_name'];
        header("Location: index?category=" . urlencode($category_slug));
        ob_end_flush();
        exit();
    } else {
        echo "No categories found.";
    }
}
else{
    $category_slug = $_GET["category"];
}
?>

<div class="text-black">
    <div class="row">
        <div class="table-wrapper-scroll-y my-custom-scrollbar swiper-wrapper" style="overflow-x:auto;">
            <table class="table  table-striped mb-0 "> 
                <tbody>
                    <tr>
                    <?php
                        $sql = "SELECT * FROM categories ORDER BY `cat_order`";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                                ?>
                                    <td class="td_cat" style="text-align:center; width: 100px; background-color:#fff;border: none;height:auto;position: relative;">
                                        <a href="index?category=<?= $row['cat_name']; ?>" style="text-decoration: none">
                                            <div class="nav" style="color:#000000;">
                                                <div style="width: 100%;">
                                                        <img src="uploads/<?= $row['cat_picture']; ?>" style="width: 90px; height: 70px;border-radius: 12px;">
                                                        <p style="padding:0px 5px;width:100%;white-space: normal;"></p><p style="text-align:center"><h4 class="text-center"><?= $row['cat_name']; ?></h4></p>
                                                </div>
                                            </div>
                                        </a>
                                    </td> 
                                <?php
                            }

                            if($_SERVER["REQUEST_METHOD"] == "POST"){
                                echo '<script>window.location.assign("item")</script>';
                            }

                        } else {
                            echo "0 results";
                        }
                    ?>
                    </tr>
                </tbody>
            </table>
        </div>   
    </div>
</div>

<div class="container">
    <ul class="list-group" style="list-style-type: none">
    <?php
        $sql = "SELECT * FROM items WHERE item_category = '$category_slug' ORDER BY `Order`";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    ?>
                        <li>
                            <a href='ingredients?item=<?php echo $row["item_id"] ?>' style="text-decoration: none; color: black">
                                <div class="border-bottom pb-3 text-left">
                                    <h4 class="text-start"><b><?= $row['item_name']; ?></b></h4>
                                    <?php 
                                        if($row['item_price'] > 0){
                                            ?>
                                                <h5 class="text-start"><?= $row['item_price']; ?> $ </h5>
                                            <?php
                                        }
                                    ?>
                                </div>
                            </a>
                        </li>
                    <?php
            }


            } else {
                echo '<div class="container text-white">No items in this category</div>';
            }
            $conn->close();
    ?>
    </ul>
</div>