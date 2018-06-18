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
                $query = "SELECT * FROM categories";
                $allCategories = mysqli_query($connection, $query);
                confirmQuery($allCategories);

                while($row = mysqli_fetch_assoc($allCategories)) {

                    $cat_id = $row['cat_id'];
                    $cat_title = $row['cat_title'];

                    echo "<option value='{$cat_id}'>{$cat_title}</option>";
                }
            ?>
        </select>
    </div>
    <div class="form-group">
        <label for="post_author_id">Post Author</label>
        <select name="post_author_id" id="post_author_id" class="form-control">
            <?php 
                $query = "SELECT * FROM users";
                $allUsers = mysqli_query($connection, $query);
                confirmQuery($allUsers);

                while($row = mysqli_fetch_assoc($allUsers)) {

                    $user_id = $row['user_id'];
                    $user_firstname = $row['user_firstname'];
                    $user_lastname = $row['user_lastname'];

                    if($user_id == $_SESSION['user_id']) {
                        $user_selected = 'selected';
                    } else {
                        $user_selected = '';
                    }

                    echo "<option value='{$user_id}' {$user_selected}>{$user_firstname} {$user_lastname}</option>";
                }
            ?>
        </select>
    </div>
    <div class="form-group">
        <label for="post_author_id">Post Status</label>
        <select class="form-control" name="post_status">
            <option value="Draft">Draft</option>
            <option value="Published">Published</option>
        </select>
    </div>
    <div class="form-group">
        <label for="post_image">Post Image</label>
        <input type="file" name="post_image">
    </div>
    <div class="form-group">
        <label for="post_content">Post Content</label>
        <textarea class="form-control" name="post_content" id="editor" rows="10"></textarea>
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