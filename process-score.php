<?php
/**
 * Created by PhpStorm.
 * User: Robert
 * Date: 14/07/2014
 * Time: 10:22 AM
 *
 * Gets a POST of a username and a score to enter into the snake leaderboard.
 * Enters the score into the database then returns the HTML for displaying in the table
 */

// Get POST variables
$name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
$score = filter_input(INPUT_POST, 'score', FILTER_SANITIZE_NUMBER_INT);
$date = date('Y-m-d H:i:s');

// Enter score into database
$host = 'localhost';
$dbname = 'rk87_snake';
$user = 'rk87_snake';
$pass = 'WRevyZmsrBTTyQZn';

try {
    $dbh = new PDO('mysql:host=' . $host . ';dbname=' . $dbname, $user, $pass);
} catch (PDOException $e) {
    echo $e->getMessage();
}

$data = array(
    'name' => $name,
    'score' => $score,
    'created' => $date
);

$sth = $dbh->prepare('INSERT INTO snake_scores (name, score, created) VALUE (:name, :score, :created)');
$sth->execute($data);

// Get top scores and return HTML
$sth = $dbh->query('SELECT * FROM snake_scores ORDER BY score DESC, created DESC LIMIT 5');
$sth->setFetchMode(PDO::FETCH_ASSOC);

$result = '';

while ($row = $sth->fetch()) {
    $result .= "<tr>
                    <td>{$row['name']}</td>
                    <td>{$row['score']}</td>
                </tr>";
}

echo $result;