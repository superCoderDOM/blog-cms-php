<?php 

    // Query Confirmation and Error Handler
    function confirmQuery($result) {

        global $connection;

        if(!$result) {

            die('QUERY FAILED: ' . mysqli_error($connection));
            return false;

        } else {

            return true;
        }
    }

    // URL and SQL Injection Protection
    function escape($string) {

        global $connection;

        return mysqli_real_escape_string($connection, trim($string));
    }

    // Fetch Current Number of Online Users
    function onlineUserCount() {

        if(isset($_GET['onlineUsers'])) {

            global $connection;

            if(!$connection) {

                require '../vendor/autoload.php';
                $dotenv = new Dotenv\Dotenv('../');
                $dotenv->load();
                $dotenv->required(['DB_HOST', 'DB_DATABASE', 'DB_USERNAME', 'DB_PASSWORD']);

                session_start();
                include "../includes/db.php";
            }
    
            $session = escape(session_id());
            $time = time();
            $time_out_in_seconds = 5;
            $time_out = $time - $time_out_in_seconds;
    
            $query = "SELECT * FROM users_online WHERE session_code = '$session'";
            $findUserSession = mysqli_query($connection, $query);
            if(confirmQuery($findUserSession)) {
    
                $count = mysqli_num_rows($findUserSession);
    
                if($count == NULL) {
    
                    mysqli_query($connection, "INSERT INTO users_online(session_code, session_start_time) VALUES('{$session}', '{$time}')");
    
                } else {
    
                    mysqli_query($connection, "UPDATE users_online SET session_start_time = '{$time}' WHERE session_code = '{$session}'");
                }
    
                $findOnlineUsers = mysqli_query($connection, "SELECT * FROM users_online WHERE session_start_time > '{$time_out}'");
                if(confirmQuery($findOnlineUsers)) {
    
                    echo mysqli_num_rows($findOnlineUsers);
    
                } else {
    
                    echo 0;
                }
    
            } else {
    
                echo 0;
            }
        }
    }
    onlineUserCount();

    function allRecordsCount($table) {

        global $connection;

        $query = "SELECT * FROM $table";
        $selectAllRecords = mysqli_query($connection, $query);
        confirmQuery($selectAllRecords);
        return mysqli_num_rows($selectAllRecords);
    }

    function selectRecordsCount($table, $column, $value) {

        global $connection;

        $query = "SELECT * FROM $table WHERE $column = '{$value}'";
        $selectAllRecords = mysqli_query($connection, $query);
        confirmQuery($selectAllRecords);
        return mysqli_num_rows($selectAllRecords);
    }

    /*----------------------------------+
    |           CATEGORIES              |
    +----------------------------------*/

    // CREATE
    function insertCategory() {

        global $connection;

        if(isset($_POST['create_category'])) {

            if(isset($_SESSION['user_role']) && ($_SESSION['user_role'] == 'Admin' || $_SESSION['user_role'] == 'Contributor')) {

                $cat_title = escape($_POST['cat_title']);

                // Form input validation
                if($cat_title == '' || empty($cat_title)) {

                    echo "The category field should not be empty";

                } else {

                    // Clean potential malicious SQL injections
                    $cat_title = mysqli_real_escape_string($connection, $cat_title);

                    $query = "INSERT INTO categories(cat_title) VALUE('$cat_title') ";

                    $createCategory = mysqli_query($connection, $query);
                    confirmQuery($createCategory);
                }
            }
        }
    }

    // RETRIEVE
    function fetchAllCategories() {

        global $connection;

        if(isset($_SESSION['user_role']) && ($_SESSION['user_role'] == 'Admin' || $_SESSION['user_role'] == 'Contributor')) {

            $query = "SELECT * FROM categories";
            $allCategories = mysqli_query($connection, $query);
            confirmQuery($allCategories);

            while($row = mysqli_fetch_assoc($allCategories)) {

                $cat_id = $row['cat_id'];
                $cat_title = $row['cat_title'];

                echo "<tr>";
                    echo "<td> {$cat_id} </td>";
                    echo "<td> {$cat_title} </td>";
                    echo "<td><a href='./categories.php?delete_cat_id={$cat_id}'>Delete</a></td>";
                    echo "<td><a href='./categories.php?update_cat_id={$cat_id}'>Edit</a></td>";
                echo "</tr>";
            }
        }
    }

    // UPDATE
    function updateCategory($cat_id) {

        global $connection;

        if(isset($_POST['update_category'])) {

            if(isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'Admin') {

                $cat_id = escape($cat_id);
                $cat_title = escape($_POST['cat_title']);

                $query = "UPDATE categories SET cat_title = '{$cat_title}' ";
                $query .= "WHERE cat_id = '{$cat_id}' ";
        
                $updateCategoryByID = mysqli_query($connection, $query);
                confirmQuery($updateCategoryByID);
                header("Location: ./categories.php");
            }
        }
    }

    // DELETE
    function deleteCategory() {

        global $connection;

        if(isset($_GET['delete_cat_id'])) {

            if(isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'Admin') {

                $cat_id = escape($_GET['delete_cat_id']);

                $query = "DELETE FROM categories WHERE cat_id = {$cat_id}";
                $deleteCategoryByID = mysqli_query($connection, $query);
                confirmQuery($deleteCategoryByID);
                header("Location: ./categories.php");
            }
        }
    }

    /*--------------------------------+
    |           COMMENTS              |
    +--------------------------------*/


    // CREATE
    function createComment() {

        global $connection;

        if(isset($_POST['submit_comment'])) {

            if(isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'Admin') {

                $comment_post_id = escape($_GET['comment_post_id']);
                $comment_author = escape($_POST['comment_author']);
                $comment_email = escape($_POST['comment_email']);
                $comment_content = escape($_POST['comment_content']);

                if(!empty($comment_author) && !empty($comment_email) && !empty($comment_content)) {

                    $query = "INSERT INTO comments(comment_post_id, comment_author, comment_email, comment_content) ";
                    $query .= "VALUES('{$comment_post_id}', '{$comment_author}', '{$comment_email}', '{$comment_content}')";

                    $addComment = mysqli_query($connection, $query);
                    confirmQuery($addcomment);
                    header("Location: ./posts.php?post_id={$comment_post_id}");

                } else {

                    echo "<script>alert('Fields cannot be empty')</script>";
                }
            }
        }
    }

    // RETRIEVE
    function fetchAllComments() {

        global $connection;

        if(isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'Admin') {

            $query = "SELECT * FROM comments ORDER BY comment_id DESC";
            $selectAllComments = mysqli_query($connection, $query);

            while($row = mysqli_fetch_assoc($selectAllComments)) {

                $comment_id = $row['comment_id'];
                $comment_post_id = $row['comment_post_id'];
                $comment_author = $row['comment_author'];
                $comment_email = $row['comment_email'];
                $comment_content = $row['comment_content'];
                $comment_status = $row['comment_status'];
                $comment_date = $row['comment_date'];

                // Fecth post title
                $query = "SELECT * FROM posts WHERE post_id = {$comment_post_id}";
                $selectPostByID = mysqli_query($connection, $query);
            
                while($row = mysqli_fetch_assoc($selectPostByID)) {
            
                    $comment_post_title = $row['post_title'];

                    // Display results as table row
                    echo "<tr>";
                        echo "<td> {$comment_id} </td>";
                        echo "<td><a href='../post.php?post_id={$comment_post_id}'> {$comment_post_title} </a></td>";
                        echo "<td> {$comment_author} </td>";
                        echo "<td> {$comment_email} </td>";
                        echo "<td> {$comment_content} </td>";
                        echo "<td> {$comment_status} </td>";
                        echo "<td> {$comment_date} </td>";
                        echo "<td><a href='./comments.php?approve_comment_id={$comment_id}'>Approve</a></td>";
                        echo "<td><a href='./comments.php?reject_comment_id={$comment_id}'>Reject</a></td>";
                        echo "<td><a href='./comments.php?delete_comment_id={$comment_id}'>Delete</a></td>";
                    echo "</tr>";
                }
            }
        }
    }

    function fetchCommentsByPostID($post_id) {

        global $connection;

        if(isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'Admin') {

            $post_id = escape($post_id);

            $query = "SELECT * FROM comments WHERE comment_post_id = '{$post_id}' ORDER BY comment_id DESC";
            $selectCommentsByPostID = mysqli_query($connection, $query);
            confirmQuery($selectCommentsByPostID);

            while($row = mysqli_fetch_assoc($selectCommentsByPostID)) {

                $comment_id = $row['comment_id'];
                $comment_post_id = $row['comment_post_id'];
                $comment_author = $row['comment_author'];
                $comment_email = $row['comment_email'];
                $comment_content = $row['comment_content'];
                $comment_status = $row['comment_status'];
                $comment_date = $row['comment_date'];

                // Fecth post title
                $query = "SELECT * FROM posts WHERE post_id = {$comment_post_id}";
                $selectPostByID = mysqli_query($connection, $query);
                confirmQuery($selectPostByID);
            
                while($row = mysqli_fetch_assoc($selectPostByID)) {
            
                    $comment_post_title = $row['post_title'];

                    // Display results as table row
                    echo "<tr>";
                        echo "<td> {$comment_id} </td>";
                        echo "<td><a href='../post.php?post_id={$comment_post_id}'> {$comment_post_title} </a></td>";
                        echo "<td> {$comment_author} </td>";
                        echo "<td> {$comment_email} </td>";
                        echo "<td> {$comment_content} </td>";
                        echo "<td> {$comment_status} </td>";
                        echo "<td> {$comment_date} </td>";
                        echo "<td><a href='./comments.php?post_id={$post_id}&approve_comment_id={$comment_id}'>Approve</a></td>";
                        echo "<td><a href='./comments.php?post_id={$post_id}&reject_comment_id={$comment_id}'>Reject</a></td>";
                        echo "<td><a href='./comments.php?post_id={$post_id}&delete_comment_id={$comment_id}'>Delete</a></td>";
                    echo "</tr>";
                }
            }
        }
    }

    // UPDATE
    function updateCommentStatus() {

        global $connection;

        if(isset($_GET['approve_comment_id']) || isset($_GET['reject_comment_id'])) {

            if(isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'Admin') {

                if(isset($_GET['approve_comment_id'])) {

                    $comment_id = escape($_GET['approve_comment_id']);
                    $comment_status = 'Approved';

                } elseif(isset($_GET['reject_comment_id'])) {

                    $comment_id = escape($_GET['reject_comment_id']);
                    $comment_status = 'Rejected';
                }

                $query = "UPDATE comments SET comment_status = '{$comment_status}' ";
                $query .= "WHERE comment_id = '{$comment_id}' ";

                $updateCommentStatusByID = mysqli_query($connection, $query);
                confirmQuery($updateCommentStatusByID);

                if(isset($_GET['post_id'])) {

                    $post_id = escape($_GET['post_id']);
                    header("Location: ./comments.php?post_id={$post_id}");

                } else {

                    header("Location: ./comments.php");
                }
            }
        }
    }

    // DELETE
    function deleteComment() {

        global $connection;

        if(isset($_GET['delete_comment_id'])) {

            if(isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'Admin') {

                $comment_id = escape($_GET['delete_comment_id']);
                $query = "DELETE FROM comments WHERE comment_id = {$comment_id}";
                $deleteCommentByID = mysqli_query($connection, $query);
                confirmQuery($deleteCommentByID);

                if(isset($_GET['post_id'])) {

                    $post_id = escape($_GET['post_id']);
                    header("Location: ./comments.php?post_id={$post_id}");

                } else {

                    header("Location: ./comments.php");
                }
            }
        }
    }

    /*-----------------------------+
    |           POSTS              |
    +-----------------------------*/

    // CREATE
    function createPost() {

        global $connection;

        if(isset($_POST['create_post'])) {

            if(isset($_SESSION['user_role']) && ($_SESSION['user_role'] == 'Admin' || $_SESSION['user_role'] == 'Contributor')) {
            
                $post_title = escape($_POST['post_title']);
                $post_category_id = escape($_POST['post_category_id']);
                $post_author_id = escape($_POST['post_author_id']);
                $post_status = escape($_POST['post_status']);

                $post_image = escape($_FILES['post_image']['name']);
                $post_image_temp = escape($_FILES['post_image']['tmp_name']);

                $post_tags = escape($_POST['post_tags']);
                $post_content = escape($_POST['post_content']);

                move_uploaded_file($post_image_temp, "../images/$post_image");

                $query = "INSERT INTO posts(post_category_id, post_title, post_author_id, post_image, post_content, post_tags, post_status) ";
                $query .= "VALUES('{$post_category_id}', '{$post_title}', '{$post_author_id}', '{$post_image}', '{$post_content}', '{$post_tags}', '{$post_status}')";

                $addPost = mysqli_query($connection, $query);
                confirmQuery($addPost);

                // echo "<p class='bg-success'>Post Created. <a href='../post.php?post_id={$post_id}'> View Post </a> or <a href='./posts.php'> View All Posts </a></p>";
                header("Location: ./posts.php");
            }
        }
    }

    function clonePostWithID($post_id) {

        global $connection;

        if(isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'Admin') {

            $post_id = escape($post_id);

            $query = "SELECT * FROM posts WHERE post_id = '{$post_id}'";
            $selectPostByID = mysqli_query($connection, $query);
            if(confirmQuery($selectPostByID)) {

                while($row = mysqli_fetch_assoc($selectPostByID)) {
        
                    $post_category_id = $row['post_category_id'];
                    $post_title = $row['post_title'];
                    $post_author_id = $row['post_author_id'];
                    $post_date = $row['post_date'];
                    $post_image = $row['post_image'];
                    $post_content = $row['post_content'];
                    $post_tags = $row['post_tags'];
                    $post_status = $row['post_status'];

                    $post_title = mysqli_real_escape_string($connection, $post_title);
                    $post_author_id = mysqli_real_escape_string($connection, $post_author_id);
                    $post_tags = mysqli_real_escape_string($connection, $post_tags);
                    $post_content = mysqli_real_escape_string($connection, $post_content);
                }
        
                $query = "INSERT INTO posts(post_category_id, post_title, post_author_id, post_image, post_content, post_tags, post_status) ";
                $query .= "VALUES('{$post_category_id}', '{$post_title}', '{$post_author_id}', '{$post_image}', '{$post_content}', '{$post_tags}', '{$post_status}')";
        
                $addPost = mysqli_query($connection, $query);
                confirmQuery($addPost);
                if(isset($_GET['author_id'])) {

                    $author_id = escape($_GET['author_id']);
                    header("Location: ./posts.php?author_id={$author_id}");
        
                } else {
        
                    header("Location: ./posts.php");
                }
            }
        }
    }

    // RETRIEVE
    function fetchAllPosts() {

        global $connection;

        if(isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'Admin') {

            $query = "SELECT * FROM posts ORDER BY post_id DESC";
            $allPosts = mysqli_query($connection, $query);
            confirmQuery($allPosts);

            while($row = mysqli_fetch_assoc($allPosts)) {

                $post_id = $row['post_id'];
                $post_category_id = $row['post_category_id'];
                $post_title = $row['post_title'];
                $post_author_id = $row['post_author_id'];
                $post_date = $row['post_date'];
                $post_image = $row['post_image'];
                $post_content = $row['post_content'];
                $post_tags = $row['post_tags'];
                $post_view_count = $row['post_view_count'];
                $post_status = $row['post_status'];

                // Fetch author name
                $query = "SELECT * FROM users WHERE user_id = $post_author_id";
                $findUserAuthor = mysqli_query($connection, $query);
                confirmQuery($findUserAuthor);
                $row = mysqli_fetch_assoc($findUserAuthor);
                $post_author_name = $row['user_firstname'] . " " . $row['user_lastname'];

                // Fecth category title
                $query = "SELECT * FROM categories WHERE cat_id = {$post_category_id}";
                $selectCategoryByID = mysqli_query($connection, $query);
                confirmQuery($selectCategoryByID);
                $row = mysqli_fetch_assoc($selectCategoryByID);
                $post_category_title = $row['cat_title'];

                // Fetch comment count
                $query = "SELECT * FROM comments WHERE comment_post_id = '{$post_id}'";
                $findCommentsByPostID = mysqli_query($connection, $query);
                confirmQuery($findCommentsByPostID);
                $commentCount = mysqli_num_rows($findCommentsByPostID);

                // Display results as table row
                echo "<tr>";
                    echo "<td><input type='checkbox' class='checkBoxes' name='checkBoxArray[]' value='{$post_id}'></td>";
                    echo "<td> {$post_id} </td>";
                    echo "<td><a href='./posts.php?author_id={$post_author_id}'> {$post_author_name} </a></td>";
                    echo "<td><a href='../post.php?post_id={$post_id}'> {$post_title} </a></td>";
                    echo "<td> {$post_category_title} </td>";
                    echo "<td> {$post_status} </td>";
                    echo "<td><img src='../images/{$post_image}' alt='{$post_title}' width='50px'></td>";
                    echo "<td> {$post_tags} </td>";
                    echo "<td> {$post_view_count} </td>";
                    echo "<td><a href='./comments.php?post_id={$post_id}'> {$commentCount} </a></td>";
                    echo "<td> {$post_date} </td>";
                    echo "<td><a href='../post.php?post_id={$post_id}'> View </a></td>";
                    echo "<td><a href='./posts.php?source=edit_post&edit_post_id={$post_id}'> Edit </a></td>";
                    echo "<td><a post_id='{$post_id}' href='javascript:void(0)' class='delete_link'> Delete </a></td>";
                    // echo "<td><a href='./posts.php?delete_post_id={$post_id}' onClick=\"javascript: return confirm('Are you sure you want to DELETE this post?');\"> Delete </a></td>";
                    echo "<td><a href='./posts.php?reset_post_id={$post_id}'> Reset </a></td>";
                echo "</tr>";
            }
        }
    }

    function fetchPostsByAuthorID($post_author_id) {

        global $connection;

        if(isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'Admin') {

            $post_author_id = escape($post_author_id);

            $query = "SELECT * FROM posts WHERE post_author_id = $post_author_id ORDER BY post_id DESC";
            $fetchPostsByAuthorID = mysqli_query($connection, $query);
            confirmQuery($fetchPostsByAuthorID);

            while($row = mysqli_fetch_assoc($fetchPostsByAuthorID)) {

                $post_id = $row['post_id'];
                $post_category_id = $row['post_category_id'];
                $post_title = $row['post_title'];
                $post_author_id = $row['post_author_id'];
                $post_date = $row['post_date'];
                $post_image = $row['post_image'];
                $post_content = $row['post_content'];
                $post_tags = $row['post_tags'];
                $post_view_count = $row['post_view_count'];
                $post_status = $row['post_status'];

                // Fetch author name
                $query = "SELECT * FROM users WHERE user_id = $post_author_id";
                $findUserAuthor = mysqli_query($connection, $query);
                confirmQuery($findUserAuthor);
                $row = mysqli_fetch_assoc($findUserAuthor);
                $post_author_name = $row['user_firstname'] . " " . $row['user_lastname'];

                // Fecth category title
                $query = "SELECT * FROM categories WHERE cat_id = {$post_category_id}";
                $selectCategoryByID = mysqli_query($connection, $query);
                confirmQuery($selectCategoryByID);
                $row = mysqli_fetch_assoc($selectCategoryByID);
                $post_category_title = $row['cat_title'];

                // Fetch comment count
                $query = "SELECT * FROM comments WHERE comment_post_id = '{$post_id}'";
                $findCommentsByPostID = mysqli_query($connection, $query);
                confirmQuery($findCommentsByPostID);
                $commentCount = mysqli_num_rows($findCommentsByPostID);

                // Display results as table row
                echo "<tr>";
                    echo "<td><input type='checkbox' class='checkBoxes' name='checkBoxArray[]' value='{$post_id}'></td>";
                    echo "<td> {$post_id} </td>";
                    echo "<td><a href='./posts.php?author_id={$post_author_id}'> {$post_author_name} </a></td>";
                    echo "<td><a href='../post.php?post_id={$post_id}'> {$post_title} </a></td>";
                    echo "<td> {$post_category_title} </td>";
                    echo "<td> {$post_status} </td>";
                    echo "<td><img src='../images/{$post_image}' alt='{$post_title}' width='50px'></td>";
                    echo "<td> {$post_tags} </td>";
                    echo "<td> {$post_view_count} </td>";
                    echo "<td><a href='./comments.php?post_id={$post_id}'> {$commentCount} </a></td>";
                    echo "<td> {$post_date} </td>";
                    echo "<td><a href='../post.php?post_id={$post_id}'> View </a></td>";
                    echo "<td><a href='./posts.php?source=edit_post&edit_post_id={$post_id}'> Edit </a></td>";
                    echo "<td><a post_id='{$post_id}' author_id={$post_author_id} href='javascript:void(0)' class='delete_link'> Delete </a></td>";
                    // echo "<td><a href='./posts.php?delete_post_id={$post_id}&author_id={$post_author_id}' onClick=\"javascript: return confirm('Are you sure you want to DELETE this post?');\"> Delete </a></td>";
                    echo "<td><a href='./posts.php?reset_post_id={$post_id}&author_id={$post_author_id}'> Reset </a></td>";
                echo "</tr>";
            }
        }
    }

    // UPDATE
    function updatePost($post_id) {

        global $connection;

        $post_id = escape($post_id);

        if(isset($_POST['update_post'])) {

            if(isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'Admin') {

                $post_title = escape($_POST['post_title']);
                $post_category_id = escape($_POST['post_category_id']);
                $post_author_id = escape($_POST['post_author_id']);
                $post_status = escape($_POST['post_status']);
                $post_image = escape($_FILES['post_image']['name']);
                $post_image_temp = escape($_FILES['post_image']['tmp_name']);
                $post_tags = escape($_POST['post_tags']);
                $post_content = escape($_POST['post_content']);

                move_uploaded_file($post_image_temp, "../images/$post_image");

                if(empty($post_image)) {
                    $query = "SELECT * FROM posts WHERE post_id = {$post_id}";
                    $selectImageByID = mysqli_query($connection, $query);

                    while($row = mysqli_fetch_assoc($selectImageByID)) {

                        $post_image = $row['post_image'];
                    }
                }

                $query = "UPDATE posts SET ";
                $query .= "post_title = '{$post_title}', ";
                $query .= "post_category_id = '{$post_category_id}', ";
                $query .= "post_author_id = '{$post_author_id}', ";
                $query .= "post_status = '{$post_status}', ";
                $query .= "post_image = '{$post_image}', ";
                $query .= "post_tags = '{$post_tags}', ";
                $query .= "post_content = '{$post_content}' ";
                $query .= "WHERE post_id = '{$post_id}' ";

                $updatePostByID = mysqli_query($connection, $query);
                confirmQuery($updatePostByID);

                echo "<p class='bg-success'>Post Updated. <a href='../post.php?post_id={$post_id}'> View Post </a> or <a href='./posts.php'> Edit More Posts </a></p>";
                // header("Location: ./posts.php");
            }
        }
    }

    function updatePostStatus($post_id, $post_status) {

        global $connection;

        if(isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'Admin') {

            $post_id = escape($post_id);
            $post_status = escape($post_status);

            $query = "UPDATE posts SET post_status = '{$post_status}' WHERE post_id = '{$post_id}'";
            $updatePostStatusByID = mysqli_query($connection, $query);
            confirmQuery($updatePostStatusByID);
            if(isset($_GET['author_id'])) {

                $author_id = escape($_GET['author_id']);
                header("Location: ./posts.php?author_id={$author_id}");

            } else {

                header("Location: ./posts.php");
            }
        }
    }

    function resetPostViews() {

        global $connection;

        if(isset($_GET['reset_post_id'])) {

            if(isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'Admin') {

                $post_id = escape($_GET['reset_post_id']);

                $query = "UPDATE posts SET post_view_count = 0 WHERE post_id = '{$post_id}'";
                $resetPostViewsByID = mysqli_query($connection, $query);
                confirmQuery($resetPostViewsByID);
                if(isset($_GET['author_id'])) {

                    $author_id = escape($_GET['author_id']);
                    header("Location: ./posts.php?author_id={$author_id}");
        
                } else {
        
                    header("Location: ./posts.php");
                }
            }
        }
    }

    // DELETE
    function deletePost() {

        global $connection;

        if(isset($_GET['delete_post_id'])) {

            if(isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'Admin') {

                $post_id = escape($_GET['delete_post_id']);

                $query = "DELETE FROM posts WHERE post_id = {$post_id}";
                $deletePostByID = mysqli_query($connection, $query);
                confirmQuery($deletePostByID);
                if(isset($_GET['author_id'])) {

                    $author_id = escape($_GET['author_id']);
                    header("Location: ./posts.php?author_id={$author_id}");
        
                } else {
        
                    header("Location: ./posts.php");
                }
            }
        }
    }

    function deletePostWithID($post_id) {

        global $connection;

        if(isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'Admin') {

            $post_id = escape($post_id);

            $query = "DELETE FROM posts WHERE post_id = {$post_id}";
            $deletePostByID = mysqli_query($connection, $query);
            confirmQuery($deletePostByID);
            if(isset($_GET['author_id'])) {

                $author_id = escape($_GET['author_id']);
                header("Location: ./posts.php?author_id={$author_id}");

            } else {

                header("Location: ./posts.php");
            }
        }
    }

    /*-----------------------------+
    |           USERS              |
    +-----------------------------*/

    // CREATE
    function createUser() {

        global $connection;

        if(isset($_POST['create_user'])) {

            if(isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'Admin') {

                $username = escape($_POST['username']);
                $user_firstname = escape($_POST['user_firstname']);
                $user_lastname = escape($_POST['user_lastname']);
                $user_email = escape($_POST['user_email']);
                $user_password = escape($_POST['user_password']);
                $user_role = escape($_POST['user_role']);

                $hashed_password = password_hash($user_password, PASSWORD_BCRYPT, array('cost' => 12));

                $query = "INSERT INTO users(username, user_firstname, user_lastname, user_email, user_password, user_role) ";
                $query .= "VALUES('{$username}', '{$user_firstname}', '{$user_lastname}', '{$user_email}', '{$hashed_password}', '{$user_role}')";

                $addUser = mysqli_query($connection, $query);
                confirmQuery($addUser);
                echo "<h2>New user created: {$username} </h3>";
                echo "<a href='./users.php' role='button' class='btn btn-default'> View All Users </a>";
                // header("Location: ./users.php");
            }
        }
    }

    // RETRIEVE
    function fetchAllUsers() {

        global $connection;

        if(isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'Admin') {

            $query = "SELECT * FROM users";
            $selectAllUsers = mysqli_query($connection, $query);

            while($row = mysqli_fetch_assoc($selectAllUsers)) {

                $user_id = $row['user_id'];
                $username = $row['username'];
                $user_firstname = $row['user_firstname'];
                $user_lastname = $row['user_lastname'];
                $user_email = $row['user_email'];
                $user_role = $row['user_role'];

                // Display results as table row
                echo "<tr>";
                    echo "<td> {$user_id} </td>";
                    echo "<td> {$username} </td>";
                    echo "<td> {$user_firstname} </td>";
                    echo "<td> {$user_lastname} </td>";
                    echo "<td> {$user_email} </td>";
                    echo "<td> {$user_role} </td>";
                    echo "<td><a href='./users.php?change_to_admin={$user_id}'> Admin </a></td>";
                    echo "<td><a href='./users.php?change_to_subscriber={$user_id}'> Subscriber </a></td>";
                    echo "<td><a href='./users.php?source=edit_user&edit_user_id={$user_id}'> Edit </a></td>";
                echo "<td><a href='./users.php?delete_user_id={$user_id}'> Delete </a></td>";
                echo "</tr>";
            }
        }
    }

    // UPDATE
    function updateUser($user_id) {

        global $connection;

        if(isset($_POST['update_user'])) {

            if(isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'Admin') {

                $username = escape($_POST['username']);
                $user_firstname = escape($_POST['user_firstname']);
                $user_lastname = escape($_POST['user_lastname']);
                $user_email = escape($_POST['user_email']);
                $user_password = escape($_POST['user_password']);
                $user_role = isset($_POST['user_role']) ? escape($_POST['user_role']) : "";

                $query = "UPDATE users SET ";
                $query .= "username = '{$username}', ";
                $query .= "user_firstname = '{$user_firstname}', ";
                $query .= "user_lastname = '{$user_lastname}', ";

                if(!empty($user_password)) {

                    $hashed_password = password_hash($user_password, PASSWORD_BCRYPT, array('cost' => 12));
                    $query .= "user_password = '{$hashed_password}', ";
                }

                if(!empty($user_role)) {

                    $query .= "user_role = '{$user_role}', ";
                }

                $query .= "user_email = '{$user_email}' ";
                $query .= "WHERE user_id = {$user_id} ";

                $updateUserByID = mysqli_query($connection, $query);
                if(confirmQuery($updateUserByID)) {

                    if($user_id == $_SESSION['user_id']) {

                        $query = "SELECT * FROM users WHERE user_id = '{$user_id}'";
                        $selectUserByID = mysqli_query($connection, $query);
                        if(confirmQuery($selectUserByID)) {

                            while($row = mysqli_fetch_assoc($selectUserByID)) {

                                $_SESSION['user_id'] = $row['user_id'];
                                $_SESSION['user_firstname'] = $row['user_firstname'];
                                $_SESSION['user_lastname'] = $row['user_lastname'];
                                $_SESSION['user_role'] = $row['user_role'];
                            }
                        }
                    }
                    echo "<p class='bg-success'>User <em>{$username}</em> updated. ";
                    echo "<a href='./users.php'> View All Users </a></p>";
                    // header("Location: ./users.php");
                }
            }
        }
    }

    function updateUserRole() {

        global $connection;

        if(isset($_GET['change_to_admin']) || isset($_GET['change_to_subscriber'])) {

            if(isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'Admin') {


                if(isset($_GET['change_to_admin'])) {

                    $user_id = escape($_GET['change_to_admin']);
                    $user_role = 'Admin';

                } elseif(isset($_GET['change_to_subscriber'])) {

                    $user_id = escape($_GET['change_to_subscriber']);
                    $user_role = 'Subscriber';
                }

                $query = "UPDATE users SET user_role = '{$user_role}' WHERE user_id = {$user_id}";
                $updateUserByID = mysqli_query($connection, $query);
                confirmQuery($updateUserByID);
                header("Location: ./users.php");
            }
        }
    }

    // DELETE
    function deleteUser() {

        global $connection;

        if(isset($_GET['delete_user_id'])) {

            if(isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'Admin') {

                $user_id = escape($_GET['delete_user_id']);
                $query = "DELETE FROM users WHERE user_id = {$user_id}";
                $deleteUserByID = mysqli_query($connection, $query);
                confirmQuery($deleteUserByID);
                header("Location: ./users.php");
            }
        }
    }

?>