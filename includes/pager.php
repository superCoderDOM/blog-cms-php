<!-- Pager -->
<ul class="pager">
    <?php 
        if($page > 1) {
            $prevPage = $page - 1;
            echo "<li class='previous'><a href='./index.php?page={$prevPage}'>&larr; Previous</a></li>";
        }

        for($i = 1; $i <= $pages; $i++) {
            if($i == $page || ($i == 1 && $page == "")) {
                echo "<li><a class='active_link' href='./index.php?page={$i}'> {$i} </a></li>";
            } else {
                echo "<li><a href='./index.php?page={$i}'> {$i} </a></li>";
            }
        }

        if($page < $pages) {
            $nextPage = $page + 1;
            echo "<li class='next'><a href='./index.php?page={$nextPage}'>Next &rarr;</a></li>";
        }
    ?>
</ul>