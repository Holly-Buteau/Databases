<?php
$page_title = "Show Systems";
error_reporting(E_ALL);
ini_set('display_error', 'on');

include "header.php";

/* =====================================================================================================================
 *                                          Select From system_games table
 *
 * =====================================================================================================================
 */
?>
</section>
<?php
$c = $connection->query("SELECT * FROM system");
$count = mysqli_num_rows($c);
$t = 0;

if($count > 0) {
    while ($row = $c->fetch_assoc()) {
        $system_id = $row["system_id"];

        /*
         * selects all data from all tables where the systems ids match.
         */
        $query = "SELECT g.title, g.developer, g.release_year, r.rating, re.review_score, ge.genre, s.name AS system, p.name AS pub, s.company FROM games g
                    INNER JOIN review re ON re.review_id = g.game_id
                    INNER JOIN rating r ON r.rating_id = g.game_id
                    INNER JOIN genre ge ON ge.genre_id = g.game_id
                    INNER JOIN publisher p ON p.publisher_id = g.game_id
                    INNER JOIN system_games sg ON sg.game_id = g.game_id
                    INNER JOIN system s ON s.system_id = sg.system_id
                    WHERE s.system_id = " . $row["system_id"] . ";";

        $game_system = $connection->query($query);
        $num_rows = mysqli_num_rows($game_system);

        /*
         * builds the table
        */
        if (isset($num_rows)) {
            echo '<table id="game_table">';
            echo '<thead>';
            echo '<tr>';
            echo '<th>System:</th><th>Title:</th><th>Genre:</th><th>Rating:</th><th>Review:</th><th>Developer:</th><th>Publisher:</th><th>Release Year:</th></tr>';
            echo '</thead>';
            while ($row = $game_system->fetch_assoc()) {
                echo '<tbody id="table_body">';
                echo '<tr>';
                echo '<td>' . $row["system"] . '</td>';
                echo '<td>' . $row["title"] . '</td>';
                echo '<td>' . $row["genre"] . '</td>';
                echo '<td>' . $row["rating"] . '</td>';
                echo '<td>' . $row["review_score"] . '</td>';
                echo '<td>' . $row["developer"] . '</td>';
                echo '<td>' . $row["pub"] . '</td>';
                echo '<td>' . $row["release_year"] . '</td>';
                echo '</tr>';
            }
            echo '</tbody>';
            echo '</table>';
            $t++;
        }
    }
}
else {
    echo "'<h1>'No Games Found'<h1>'";
}

?>

    </body>
</html>