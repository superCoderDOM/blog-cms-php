<?php 

    updateCategory($cat_id);

    // Select category to update
    $query = "SELECT * FROM categories WHERE cat_id = {$cat_id}";
    $selectCategoryByID = mysqli_query($connection, $query);

    while($row = mysqli_fetch_assoc($selectCategoryByID)) {

        $cat_id = $row['cat_id'];
        $cat_title = $row['cat_title'];

        ?>

        <!-- Edit Category Form -->
        <form action="" method="post">
            <div class="form-group">
                <label for="cat_title"> Edit Category </label>
                <input type="text" name="cat_title" id="cat_title" class="form-control" value="<?php echo $cat_title; ?>">
            </div>
            <div class="form-group">
                <input type="submit" name="update_category" value="Update" class="btn btn-primary">
            </div>
        </form>

        <?php
    }
?>