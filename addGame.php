<?php
$page_title = "Add a Game";
error_reporting(E_ALL);
ini_set('display_error', 'on');

include "db_connect.php";
?>
    </section>
<?php
/* =====================================================================================================================
 *                                          Insert Into publisher table
 *
 * =====================================================================================================================
 */
$game_publisher = $_POST["publisher"];

if(!($stmt = $connection->prepare("INSERT INTO publisher (name) VALUES (?);"))){
    echo "Prepare failed: "  . $connection->errno . " " . $stmt->error;
}

if(!($stmt->bind_param("s", $game_publisher))){
    echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
}

if(!$stmt->execute()){
    echo "Execute failed: "  . $connection->connect_errno . " " . $connection->connect_error;
}

$game_publisher_id = $connection->insert_id;

/* =====================================================================================================================
 *                                          Insert Into genre table
 *
 * =====================================================================================================================
 */
$game_genre = $_POST["genre"];

if(!($stmt = $connection->prepare("INSERT INTO genre (genre) VALUES (?);"))){
    echo "Prepare failed: "  . $connection->errno . " " . $stmt->error;
}

if(!($stmt->bind_param("s", $game_genre))){
    echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
}

if(!$stmt->execute()){
    echo "Execute failed: "  . $connection->connect_errno . " " . $connection->connect_error;
}

$game_genre_id = $connection->insert_id;

/* =====================================================================================================================
 *                                          Insert Into ratings table
 *
 * =====================================================================================================================
 */
$game_rating = $_POST["rating"];

if(!($stmt = $connection->prepare("INSERT INTO rating (rating) VALUES (?);"))){
    echo "Prepare failed: "  . $connection->errno . " " . $stmt->error;
}

if(!($stmt->bind_param("s", $game_rating))){
    echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
}

if(!$stmt->execute()){
    echo "Execute failed: "  . $connection->connect_errno . " " . $connection->connect_error;
}

$game_rating_id = $connection->insert_id;

/* =====================================================================================================================
 *                                          Insert Into games table
 *
 * =====================================================================================================================
 */
$game_name = $_POST["title"];
$game_dev = $_POST["developer"];
$game_year = $_POST["year"];

if(!($stmt = $connection->prepare("INSERT INTO games (title, developer, release_year, rating_id, publisher_id, genre_id) VALUES (?,?,?,?,?,?);"))){
    echo "Prepare failed: "  . $connection->errno . " " . $stmt->error;
}

if(!($stmt->bind_param("ssiiii", $game_name, $game_dev, $game_year, $game_rating_id, $game_publisher_id, $game_genre_id))){
    echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
}

if(!$stmt->execute()){
    echo "Execute failed: "  . $connection->connect_errno . " " . $connection->connect_error;
}

$game_game_id = $connection->insert_id;

/* =====================================================================================================================
 *                                          Insert Into review table
 *
 * =====================================================================================================================
 */

$game_reviewScore = $_POST["review"];
$game_reviewer = $_POST["reviewer"];

if(!($stmt = $connection->prepare("INSERT INTO review (review_score, reviewer, game_id) VALUES (?,?,?);"))){
    echo "Prepare failed: "  . $connection->errno . " " . $stmt->error;
}

if(!($stmt->bind_param("dsi", $game_reviewScore, $game_reviewer, $game_game_id))){
    echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
}

if(!$stmt->execute()){
    echo "Execute failed: "  . $connection->connect_errno . " " . $connection->connect_error;
}

$game_review_id = $connection->insert_id;

/* =====================================================================================================================
 *                                          Insert Into systems_games table
 *
 * =====================================================================================================================
 */

if(isset($_POST["system"])){
    foreach ($_POST['system'] as $game_system_id){
        if(!($stmt = $connection->prepare("INSERT INTO system_games (system_id, game_id) VALUES (?,?);"))){
            echo "Prepare failed: "  . $connection->errno . " " . $stmt->error;
        }

        if(!($stmt->bind_param("ii", $game_system_id, $game_game_id))){
            echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
        }

        if(!$stmt->execute()){
            echo "Execute failed: "  . $connection->connect_errno . " " . $connection->connect_error;
        }
    }
}

$stmt->close();

header('Location: index.php');
?>