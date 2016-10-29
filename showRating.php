<?php
$page_title = "Show Rating";
error_reporting(E_ALL);
ini_set('display_error', 'on');

include "header.php";

?>
</section>
<?php
/* =====================================================================================================================
 *                                          Select From ratings table
 *
 * =====================================================================================================================
 */
$c = $connection->query("SELECT * FROM rating");
$count = mysqli_num_rows($c);
$i = 0;
$t = 0;

if(isset($count)) {

    while ($row = $c->fetch_assoc()) {
        $rating_id = $row["rating_id"];

        $query = "SELECT g.title, g.developer, g.release_year, r.rating, re.review_score, ge.genre, p.name FROM games g
                    INNER JOIN review re ON re.review_id = g.game_id
                    INNER JOIN genre ge ON ge.genre_id = g.game_id
                    INNER JOIN rating r ON r.rating_id = g.game_id
                    INNER JOIN publisher p ON p.publisher_id = g.game_id
                    WHERE r.rating_id = '" .$i . "'";


        $game_rating = $connection->query($query);
        $num_rows = mysqli_num_rows($game_rating);
        if (isset($num_rows)) {
            echo '<table id="game_table">';
            echo '<thead>';
            echo '<tr>';
            echo '<th>System:</th><th>Title:</th><th>Genre:</th><th>Rating:</th><th>Review:</th><th>Developer:</th><th>Publisher:</th><th>Release Year:</th></tr>';
            echo '</thead>';
            while ($row = $game_rating->fetch_assoc()) {
                echo '<tbody id="table_body">';
                echo '<tr>';
                echo '<td>' . $row["title"] . '</td>';
                echo '<td>' . $row["genre"] . '</td>';
                echo '<td>' . $row["rating"] . '</td>';
                echo '<td>' . $row["review_score"] . '</td>';
                echo '<td>' . $row["developer"] . '</td>';
                echo '<td>' . $row["name"] . '</td>';
                echo '<td>' . $row["release_year"] . '</td>';
                echo '</tr>';
            }
            echo '</tbody>';
            echo '</table>';

        }
        $i++;
    }
}
else {
    echo "'<h1>'No Games Found'<h1>'";
}

?>
        </section>
    </body>
</html>

