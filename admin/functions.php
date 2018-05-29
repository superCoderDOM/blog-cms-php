<?php 

    // Query Confirmation and Error Handler
    function confirmQuery($result) {

        global $connection;

        if(!$result) {
            die('QUERY FAILED: ' . mysqli_error($connection));
        }
    }

    /*----------------------------------+
    |           CATEGORIES              |
    +----------------------------------*/

    // CREATE new category in database
    function insertCategory() {

        global $connection;

        if(isset($_POST['create_category'])) {

            $cat_title = $_POST['cat_title'];

            // Form input validation
            if($cat_title == '' || empty($cat_title)) {

                echo "The category field should not be empty";

            } else {

                $query = "INSERT INTO categories(cat_title) ";
                $query .= "VALUE('$cat_title') ";

                $createCategory = mysqli_query($connection, $query);
                confirmQuery($createCategory);
            }
        }
    }

    // RETRIEVE all categories from database
    function fetchAllCategories() {

        global $connection;

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

    // UPDATE existing category in database
    function updateCategory($cat_id) {

        global $connection;

        if(isset($_POST['update_category'])) {

            $cat_title = $_POST['cat_title'];
    
            $query = "UPDATE categories SET cat_title = '{$cat_title}' ";
            $query .= "WHERE cat_id = '{$cat_id}' ";
    
            $updateCategoryByID = mysqli_query($connection, $query);
            confirmQuery($updateCategoryByID);
            header("Location: ./categories.php");  // forces page reload
        }
    }

    // DELETE category from database
    function deleteCategory() {

        global $connection;

        if(isset($_GET['delete_cat_id'])) {

            $cat_id = $_GET['delete_cat_id'];
            $query = "DELETE FROM categories WHERE cat_id = {$cat_id}";
            $deleteCategoryByID = mysqli_query($connection, $query);
            confirmQuery($deleteCategoryByID);
            header("Location: ./categories.php");  // forces page reload
        }
    }

    /*--------------------------------+
    |           COMMENTS              |
    +--------------------------------*/


    // CREATE new comment in database
    function createComment() {

        global $connection;

        if(isset($_POST['submit_comment'])) {
            
            $comment_post_id = $_GET['comment_post_id'];
            $comment_author = $_POST['comment_author'];
            $comment_email = $_POST['comment_email'];
            $comment_content = $_POST['comment_content'];
            // $comment_status = 'Submitted';
            // $comment_date = date('d-m-y');

            $query = "INSERT INTO comments(comment_post_id, comment_author, comment_email, comment_content) ";
            $query .= "VALUES('{$comment_post_id}', '{$comment_author}', '{$comment_email}', '{$comment_content}')";

            $addComment = mysqli_query($connection, $query);
            confirmQuery($addcomment);
            header("Location: ./posts.php?post_id={$comment_post_id}");  // forces page reload
        }
    }

    // RETRIEVE all comments from database
    function fetchAllComments() {

        global $connection;

        $query = "SELECT * FROM comments";
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

    // UPDATE comment status in database
    function updateCommentStatus() {

        global $connection;

        if(isset($_GET['approve_comment_id']) || isset($_GET['reject_comment_id'])) {

            if(isset($_GET['approve_comment_id'])) {

                $comment_id = $_GET['approve_comment_id'];
                $comment_status = 'Approved';

            } elseif(isset($_GET['reject_comment_id'])) {

                $comment_id = $_GET['reject_comment_id'];
                $comment_status = 'Rejected';
            }

            $query = "UPDATE comments SET comment_status = '{$comment_status}' ";
            $query .= "WHERE comment_id = '{$comment_id}' ";

            $updateCommentStatusByID = mysqli_query($connection, $query);
            confirmQuery($updateCommentStatusByID);
            header("Location: ./comments.php");  // forces page reload
        }
    }

    // DELETE post from database
    function deleteComment() {

        global $connection;

        if(isset($_GET['delete_comment_id'])) {

            $comment_id = $_GET['delete_comment_id'];
            $query = "DELETE FROM comments WHERE comment_id = {$comment_id}";
            $deleteCommentByID = mysqli_query($connection, $query);
            confirmQuery($deleteCommentByID);
            header("Location: ./comments.php");  // forces page reload
        }
    }

    /*-----------------------------+
    |           POSTS              |
    +-----------------------------*/

    // CREATE new blog post in database
    function createPost() {

        global $connection;

        if(isset($_POST['create_post'])) {
            
            $post_title = $_POST['post_title'];
            $post_category_id = $_POST['post_category_id'];
            $post_author = $_POST['post_author'];
            $post_status = $_POST['post_status'];

            $post_image = $_FILES['post_image']['name'];
            $post_image_temp = $_FILES['post_image']['tmp_name'];

            $post_tags = $_POST['post_tags'];
            $post_content = $_POST['post_content'];
            // $post_date = date('d-m-y');
            // $post_comment_count = 0;

            move_uploaded_file($post_image_temp, "../images/$post_image");

            $query = "INSERT INTO posts(post_category_id, post_title, post_author, post_image, post_content, post_tags, post_status) ";
            $query .= "VALUES('{$post_category_id}', '{$post_title}', '{$post_author}', '{$post_image}', '{$post_content}', '{$post_tags}', '{$post_status}')";

            $addPost = mysqli_query($connection, $query);
            confirmQuery($addPost);

            // echo "<p class='bg-success'>Post Created. <a href='../post.php?post_id={$post_id}'> View Post </a> or <a href='./posts.php'> View All Posts </a></p>";
            header("Location: ./posts.php");  // forces page reload
        }
    }

    // RETRIEVE all blog posts from database
    function fetchAllPosts() {

        global $connection;

        $query = "SELECT * FROM posts ORDER BY post_id DESC";
        $allPosts = mysqli_query($connection, $query);

        while($row = mysqli_fetch_assoc($allPosts)) {

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

            // Fecth category title
            $query = "SELECT * FROM categories WHERE cat_id = {$post_category_id}";
            $selectCategoryByID = mysqli_query($connection, $query);
        
            while($row = mysqli_fetch_assoc($selectCategoryByID)) {

                $post_category_title = $row['cat_title'];
            }

            // Display results as table row
            echo "<tr>";
                echo "<td><input type='checkbox' class='checkBoxes' name='checkBoxArray[]' value='{$post_id}'></td>";
                echo "<td> {$post_id} </td>";
                echo "<td> {$post_author} </td>";
                echo "<td><a href='../post.php?post_id={$post_id}'> {$post_title} </a></td>";
                echo "<td> {$post_category_title} </td>";
                echo "<td> {$post_status} </td>";
                echo "<td><img src='../images/{$post_image}' alt='{$post_title}' width='50px'></td>";
                echo "<td> {$post_tags} </td>";
                echo "<td> {$post_comment_count} </td>";
                echo "<td> {$post_date} </td>";
                echo "<td><a href='./posts.php?source=edit_post&edit_post_id={$post_id}'>Edit</a></td>";
                echo "<td><a href='./posts.php?delete_post_id={$post_id}'>Delete</a></td>";
            echo "</tr>";
        }
    }

    // UPDATE existing post in database
    function updatePost($post_id) {

        global $connection;

        if(isset($_POST['update_post'])) {

            $post_title = $_POST['post_title'];
            $post_category_id = $_POST['post_category_id'];
            $post_author = $_POST['post_author'];
            $post_status = $_POST['post_status'];
            $post_image = $_FILES['post_image']['name'];
            $post_image_temp = $_FILES['post_image']['tmp_name'];
            $post_tags = $_POST['post_tags'];
            $post_content = $_POST['post_content'];

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
            $query .= "post_author = '{$post_author}', ";
            $query .= "post_status = '{$post_status}', ";
            $query .= "post_image = '{$post_image}', ";
            $query .= "post_tags = '{$post_tags}', ";
            $query .= "post_content = '{$post_content}' ";
            $query .= "WHERE post_id = '{$post_id}' ";

            $updatePostByID = mysqli_query($connection, $query);
            confirmQuery($updatePostByID);

            echo "<p class='bg-success'>Post Updated. <a href='../post.php?post_id={$post_id}'> View Post </a> or <a href='./posts.php'> Edit More Posts </a></p>";
            // header("Location: ./posts.php");  // forces page reload
        }
    }

    // UPDATE post status in database
    function updatePostStatus($post_id, $post_status) {

        global $connection;

            $query = "UPDATE posts SET post_status = '{$post_status}' ";
            $query .= "WHERE post_id = '{$post_id}' ";

            $updatePostStatusByID = mysqli_query($connection, $query);
            confirmQuery($updatePostStatusByID);
            header("Location: ./posts.php");  // forces page reload
    }

    // DELETE post from database
    function deletePost() {

        global $connection;

        if(isset($_GET['delete_post_id'])) {

            $post_id = $_GET['delete_post_id'];
            $query = "DELETE FROM posts WHERE post_id = {$post_id}";
            $deletePostByID = mysqli_query($connection, $query);
            confirmQuery($deletePostByID);
            header("Location: ./posts.php");  // forces page reload
        }
    }

    // DELETE post with ID argument
    function deletePostWithID($post_id) {

        global $connection;

        $query = "DELETE FROM posts WHERE post_id = {$post_id}";
        $deletePostByID = mysqli_query($connection, $query);
        confirmQuery($deletePostByID);
        header("Location: ./posts.php");  // forces page reload
    }

    /*-----------------------------+
    |           USERS              |
    +-----------------------------*/

    // CREATE new user in database
    function createUser() {

        global $connection;

        if(isset($_POST['create_user'])) {

            $username = $_POST['username'];
            $user_firstname = $_POST['user_firstname'];
            $user_lastname = $_POST['user_lastname'];
            $user_email = $_POST['user_email'];

            $user_password = $_POST['user_password'];
            $user_role = $_POST['user_role'];

            $query = "INSERT INTO users(username, user_firstname, user_lastname, user_email, user_password, user_role) ";
            $query .= "VALUES('{$username}', '{$user_firstname}', '{$user_lastname}', '{$user_email}', '{$user_password}', '{$user_role}')";

            $addUser = mysqli_query($connection, $query);
            confirmQuery($addUser);
            echo "<h2>New user created: {$username} </h3>";
            echo "<a href='./users.php' role='button' class='btn btn-outline-primary'> View All Users </a>";
            // header("Location: ./users.php");  // forces page reload
        }
    }

    // RETRIEVE all users from database
    function fetchAllUsers() {

        global $connection;

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

    // UPDATE existing user in database
    function updateUser($user_id) {

        global $connection;

        if(isset($_POST['update_user'])) {

            $username = $_POST['username'];
            $user_firstname = $_POST['user_firstname'];
            $user_lastname = $_POST['user_lastname'];
            $user_email = $_POST['user_email'];
            $user_password = $_POST['user_password'];
            $user_role = $_POST['user_role'];

            $query = "UPDATE users SET ";
            $query .= "username = '{$username}', ";
            $query .= "user_firstname = '{$user_firstname}', ";
            $query .= "user_lastname = '{$user_lastname}', ";
            $query .= "user_email = '{$user_email}', ";
            $query .= "user_password = '{$user_password}', ";
            $query .= "user_role = '{$user_role}' ";
            $query .= "WHERE user_id = {$user_id} ";

            $updateUserByID = mysqli_query($connection, $query);
            confirmQuery($updateUserByID);
            header("Location: ./users.php");  // forces page reload
        }
    }

    // UPDATE user role in database
    function updateUserRole() {

        global $connection;

        if(isset($_GET['change_to_admin']) || isset($_GET['change_to_subscriber'])) {

            if(isset($_GET['change_to_admin'])) {

                $user_id = $_GET['change_to_admin'];
                $user_role = 'Admin';

            } elseif(isset($_GET['change_to_subscriber'])) {

                $user_id = $_GET['change_to_subscriber'];
                $user_role = 'Subscriber';
            }

            $query = "UPDATE users SET user_role = '{$user_role}' WHERE user_id = {$user_id}";
            $updateUserByID = mysqli_query($connection, $query);
            confirmQuery($updateUserByID);
            header("Location: ./users.php");  // forces page reload
        }
    }

    // DELETE user from database
    function deleteUser() {

        global $connection;

        if(isset($_GET['delete_user_id'])) {

            $user_id = $_GET['delete_user_id'];
            $query = "DELETE FROM users WHERE user_id = {$user_id}";
            $deleteUserByID = mysqli_query($connection, $query);
            confirmQuery($deleteUserByID);
            header("Location: ./users.php");  // forces page reload
        }
    }

?>