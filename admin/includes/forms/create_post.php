<?php createPost(); ?>

<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="post_title">Post Title</label>
        <input type="text" class="form-control" name="post_title">
    </div>
    <div class="form-group">
        <label for="post_category_id">Post Category</label>
        <select name="post_category_id" id="post_category_id" class="form-control">
            <?php 
            
                // Find and display all categories
                $query = "SELECT * FROM categories";
                $allCategories = mysqli_query($connection, $query);
                confirmQuery($allCategories);

                while($row = mysqli_fetch_assoc($allCategories)) {

                    $cat_id = $row['cat_id'];
                    $cat_title = $row['cat_title'];

                    echo "<option value='{$cat_id}'>{$cat_title}<?option>";
                }
            ?>
        </select>
    </div>
    <div class="form-group">
        <label for="post_author">Post Author</label>
        <input type="text" class="form-control" name="post_author">
    </div>
    <div class="form-group">
        <label for="post_author">Post Status</label>
        <input type="text" class="form-control" name="post_status">
    </div>
    <div class="form-group">
        <label for="post_image">Post Image</label>
        <input type="file" name="post_image">
    </div>
    <div class="form-group">
        <label for="post_content">Post Content</label>
        <textarea class="form-control" name="post_content" rows="10"></textarea>
    </div>
    <div class="form-group">
        <label for="post_tags">Post Tags</label>
        <input type="text" class="form-control" name="post_tags">
    </div>
    <div class="form-group">
        <label for=""></label>
        <input type="submit" name="create_post" class="btn btn-primary" value="Publish Post">
    </div>
</form>