<?php
$page_title = "Show Games";
error_reporting(E_ALL);
ini_set('display_error', 'on');

include "header.php";

?>
<section>
    <section>
        <form method="post">
            <fieldset>
                <legend>Search For Game</legend>
                <div>
                    <label for="search_title">Search Title:</label>
                    <input type="text" id="search_title" name="search_title">
                </div>
                <div>
                    <label for="vg_genre">Search Genre:</label>
                    <select id="vg_genre" name="search_genre">

                    </select>
                </div>
                <div>
                    <label for="vg_rating" class="text_label">Search Rating:</label>
                    <select id="vg_rating" name="search_rating" required>

                    </select>
                </div>
                <div>
                    <label for="vg_year" id="date">Search Release Year:</label>
                    <select id="vg_year" name="search_year">

                    </select>
                </div>
                <div>
                    <input type="submit" name="submit" value="submit">
                </div>
            </fieldset>
        </form>
    </section>



<?php
/*
 * Dynamic Search function. Filters out the unused data and build a query string. It doesnt work sadly..
 */
if(isset($_POST["submit"])) {
    if(isset($_POST["search_title"])){
        $search_title = $_POST["search_title"];
        $query = " AND g.title LIKE ' %$search_title%' ";
    }
    if(isset($_POST["search_genre"])){
        $search_genre = $_POST["search_genre"];
        $query .= " AND ge.genre LIKE ' %$search_genre%' ";
    }
    if(isset($_POST["search_rating"])){
        $search_rating = $_POST["search_genre"];
        $query .= " AND ra.rating LIKE ' %$search_rating%' ";
    }
    if(isset($_POST["search_year"])){
        $search_year = $_POST["search_rating"];
        $query .= " AND g.release_year LIKE ' %$search_year%' ";
    }
    $do = "SELECT g.title, g.developer, g.release_year, ra.rating, r.review_score, ge.genre, p.name FROM games g
                                            INNER JOIN rating ra ON g.rating_id = ra.rating_id 
                                            INNER JOIN genre ge ON ge.genre_id = g.game_id
                                            INNER JOIN review r ON r.review_id = g.game_id 
                                            INNER JOIN publisher p ON p.publisher_id = g.game_id
                                            WHERE 1=1 $query";

    /*
     * Builds the table for outputting the information.
     */

    if($game_results = $connection->query($do)){
        echo '<table id="game_table">';
        echo '<thead>';
        echo '<tr><th>Title:</th><th>Genre:</th><th>Rating:</th><th>Review:</th><th>Developer:</th><th>Publisher:</th><th>Release Year:</th></tr>';
        echo '</thead>';
        echo '<tbody id="table_body">';
        while($row = $game_results->fetch_assoc()) {
            echo '<td>' . $row["title"] . '</td>';
            echo '<td>' . $row["genre"] . '</td>';
            echo '<td>' . $row["rating"] . '</td>';
            echo '<td>' . $row["review_score"] . '</td>';
            echo '<td>' . $row["developer"] . '</td>';
            echo '<td>' . $row["name"] . '</td>';
            echo '<td>' . $row["release_year"] . '</td>';

        }
        echo    '</tbody>';
        echo    '</thead>';
    }
}
?>
        </section>
    </body>
</html>