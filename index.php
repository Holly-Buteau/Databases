<?php
$page_title = "Home Page";
error_reporting(E_ALL);
ini_set('display_error', 'on');

include "header.php"
/* =====================================================================================================================
 *                                          Select From games table
 *
 * =====================================================================================================================
 */

/*
$query_game_all = "SELECT * FROM games";
$query_review_all = "SELECT * FROM review INNER JOIN game ON (game.review_id = review.review_id)";
$query_rating_all = "SELECT * FROM rating INNER JOIN game ON (game.rating_id = rating.rating_id)";
$query_genre_all = "SELECT * FROM genre";
$query_system_all = "SELECT * FROM system";

$game_results =  $connection->query($query_game_all);
$review_results = $connection->query($query_review_all);
$rating_results = $connection->query($query_rating_all);
$genre_results = $connection->query($query_genre_all);
$system_results = $connection->query($query_system_all);
*/

/*
$query_game = "SELECT g.game_id, g.title, g.developer, g.release_year
                FROM game g
                INNER JOIN ratings r ON r.rating_id = g.rating_id
                ORDER BY game_id ASC";
*/

?>
<section id="main_index">

    <section>
        <form method="post" action="addGame.php">
            <fieldset>
                <legend>Add Video Game:</legend>
                <section id="input_section">
                    <div id="text">
                        <p><label for="vg_title" class="text_label">Title:</label>
                            <input  id="vg_title" type="text" name="title" required></p>
                        <p><label for="vg_dev" class="text_label">Developer:</label>
                            <input  id="vg_dev" type="text" name="developer"></p>
                        <p><label for="vg_publisher" class="text_label">Publisher:</label>
                            <input id="vg_publisher" type="text" name="publisher"></p>
                        <p><label for="reviewer">Reviewer:</label>
                            <input id="reviewer" type="text" name="reviewer"></p>
                    </div>
                    <div id="drops">
                        <p><label for="vg_review">Review:
                            <input type="number" id="vg_review" name="review" min="0" max="10" step="0.1"></label></p>
                        <p><label for="vg_genre">Genre:
                            <select id="vg_genre" name="genre">
                            </select></label></p>
                        <p><label for="vg_rating" class="text_label">Rating:
                            <select id="vg_rating" name="rating" required>
                            </select></label></p>
                        <p><label for="vg_year" id="date">Release Year:
                            <select id="vg_year" name="year">
                            </select></label></p>
                    </div>
                </section>

                <section>
                    <div id="vg_system">
                        <input type="checkbox" name="system[]" value="1">Playstation
                        <input type="checkbox" name="system[]" value="2">Playstation 2
                        <input type="checkbox" name="system[]" value="3">Playstation 3
                        <input type="checkbox" name="system[]" value="4">Playstation 4
                        <input type="checkbox" name="system[]" value="5">Xbox
                        <input type="checkbox" name="system[]" value="6">Xbox 360
                        <input type="checkbox" name="system[]" value="7">Xbox One
                        <input type="checkbox" name="system[]" value="8">NES
                        <input type="checkbox" name="system[]" value="9">SNES
                        <input type="checkbox" name="system[]" value="10">N64
                        <input type="checkbox" name="system[]" value="11">GameCude
                        <input type="checkbox" name="system[]" value="12">Wii
                        <input type="checkbox" name="system[]" value="13">Wii U
                    </div>
                </section>
            </fieldset>
            <div id="submit">
                <input type="submit" id="vg_form_submit">
            </div>
        </form>
    </section>
</section>

</body>
</html>
<?php

/*
 * Out puts all information in the database
 */
$game_results_all = "SELECT g.title, ge.genre, r.rating, re.review_score, g.developer, p.name, g.release_year FROM games g
INNER JOIN rating r ON (r.rating_id = g.game_id)
INNER JOIN review re ON (re.review_id = g.game_id)
INNER JOIN publisher p ON (p.publisher_id = g.game_id)
INNER JOIN genre ge ON (ge.genre_id = g.game_id)
ORDER BY g.title ASC";

if($game_results = $connection->query($game_results_all)){
echo '<table id="game_table">';
    echo '<thead>';
    echo '<tr>';
        echo '<th>Title:</th>';
        echo '<th>Genre:</th>';
        echo '<th>Rating:</th>';
        echo '<th>Review:</th>';
        echo '<th>Developer:</th>';
        echo '<th>Publisher:</th>';
        echo '<th>Release Year:</th>';
        echo '</tr>';
    echo '</thead>';
    echo '<tbody id="table_body">';

    while ($row = $game_results->fetch_assoc()) {
    echo '<div><tr>';
            echo '<td>' . $row["title"] . '</td>';
            echo '<td>' . $row["genre"] . '</td>';
            echo '<td>' . $row["rating"] . '</td>';
            echo '<td>' . $row["review_score"] . '</td>';
            echo '<td>' . $row["developer"] . '</td>';
            echo '<td>' . $row["name"] . '</td>';
            echo '<td>' . $row["release_year"] . '</td>';
            echo '</tr></div>';
    }
    echo    '</tbody>';
    echo    '</thead>';
    }

