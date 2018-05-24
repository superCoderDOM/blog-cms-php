<?php 

    // Update Post Form Handler
    if(isset($_GET['edit_post_id'])) {

        $post_id = $_GET['edit_post_id'];

        updatePost($post_id);

        $query = "SELECT * FROM posts WHERE post_id = {$post_id}";
        $selectPostByID = mysqli_query($connection, $query);

        while($row = mysqli_fetch_assoc($selectPostByID)) {

            $post_id = $row['post_id'];
            $post_category_id = $row['post_category_id'];
            $post_title = $row['post_title'];
            $post_author = $row['post_author'];
            $post_date = $row['post_date'];
            $post_image = $row['post_image'];
            $post_content = $row['post_content'];
            $post_tags = $row['post_tags'];
            $post_comment_count = $row['post_comment_count'];
            $post_status = $row['post_status'];

            ?>

            <!-- Edit Post Form -->
            <form action="" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="post_title">Post Title</label>
                    <input type="text" class="form-control" name="post_title" value="<?php echo $post_title; ?>">
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

                                if($cat_id === $post_category_id) {
                                    $cat_selected = 'selected';
                                } else {
                                    $cat_selected = '';
                                }

                                echo "<option value='{$cat_id}' {$cat_selected}>{$cat_title}<?option>";
                            }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="post_author">Post Author</label>
                    <input type="text" class="form-control" name="post_author" value="<?php echo $post_author; ?>">
                </div>
                <div class="form-group">
                    <label for="post_status">Post Status</label>
                    <select name="post_status" id="post_status" class="form-control">
                        <option value='Draft' <?php echo ($post_status === 'Draft' ? 'selected' : '') ?> >Draft</option>
                        <option value='Published' <?php echo ($post_status === 'Published' ? 'selected' : ''); ?> >Published</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="post_image">Post Image</label>
                    <input type="file" name="post_image">
                    <img src="../images/<?php echo $post_image; ?>" alt="featured blog post image" width="100px">
                </div>
                <div class="form-group">
                    <label for="post_content">Post Content</label>
                    <textarea class="form-control" name="post_content" id="editor" rows="10"><?php echo $post_content; ?></textarea>
                </div>
                <div class="form-group">
                    <label for="post_tags">Post Tags</label>
                    <input type="text" class="form-control" name="post_tags" value="<?php echo $post_tags; ?>">
                </div>
                <div class="form-group">
                    <input type="submit" name="update_post" class="btn btn-primary" value="Update Post">
                </div>
            </form>

            <?php
        }
    }
?>
