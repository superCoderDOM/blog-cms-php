<?php 

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

                if(!$createCategory) {
                    die('QUERY FAILED: ' . mysqli_error($connection));
                }
            }
        }
    }

    // RETRIEVE all categories from database
    function fetchAllCategories() {

        global $connection;

        // Find and display all categories
        $query = "SELECT * FROM categories";
        $allCategories = mysqli_query($connection, $query);

        while($row = mysqli_fetch_assoc($allCategories)) {

            $cat_id = $row['cat_id'];
            $cat_title = $row['cat_title'];

            echo "<tr>";
                echo "<td> {$cat_id} </td>";
                echo "<td> {$cat_title} </td>";
                echo "<td><a href='categories.php?delete_cat_id={$cat_id}'>Delete</a></td>";
                echo "<td><a href='categories.php?update_cat_id={$cat_id}'>Edit</a></td>";
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
            header("Location: categories.php");  // forces page reload after update

            if(!$updateCategoryByID) {
                die('QUERY FAILED: ' . mysqli_error($connection));
            }
        }
    }

    // DELETE category from database
    function deleteCategory() {

        global $connection;

        // Delete a category and refresh page
        if(isset($_GET['delete_cat_id'])) {

            $cat_id = $_GET['delete_cat_id'];
            $query = "DELETE FROM categories WHERE cat_id = {$cat_id}";
            $deleteCategoryByID = mysqli_query($connection, $query);
            header("Location: categories.php");  // forces page reload after deletion

        }
    }

?>