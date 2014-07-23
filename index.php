<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0 maximum-scale=1, user-scalable=0"/>
        <title>Snake</title>
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.2.0/css/bootstrap.min.css"/>
        <link href='http://fonts.googleapis.com/css?family=Audiowide' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="style.css"/>
    </head>
    <body class="container">
        <div class="canvas-container">
            <p>Use the arrow keys to control the snake</p>

            <canvas id="jsSnake"></canvas>

            <div id="controls">
                <button class="control" id="up">Up</button>
                <button class="control" id="left">Left</button>
                <button class="control" id="right">Right</button>
                <button class="control" id="down">Down</button>
            </div>

            <div id="game-over">
                <h3>Game Over</h3>

                <div id="score-form">
                    <p>Enter your name to save your score</p>

                    <p>
                        <input type="text" name="name" id="name"/>
                    </p>

                    <p>
                        <button id="submit-score">Submit</button>
                    </p>
                </div>
                <p>Press space or tap the game to restart</p>
            </div>
        </div>

        <?php

        $host = 'localhost';
        $dbname = 'rk87_snake';
        $user = 'rk87_snake';
        $pass = 'WRevyZmsrBTTyQZn';

        try {
            $dbh = new PDO('mysql:host=' . $host . ';dbname=' . $dbname, $user, $pass);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }

        $sth = $dbh->query('SELECT * FROM snake_scores ORDER BY score DESC, created DESC LIMIT 5');
        $sth->setFetchMode(PDO::FETCH_ASSOC);
        ?>
        <div id="scores">
            <h2>High Scores</h2>
            <table class="table" id="scores">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Score</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $sth->fetch()) { ?>
                        <tr>
                            <td><?php echo $row['name'] ?></td>
                            <td><?php echo $row['score'] ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>


        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.1/jquery.js"></script>
        <script src="buzz.js"></script>
        <script src="game.js"></script>
        <script>
            $(window).on('load', function (){
                JS_SNAKE.game.init();
            });
        </script>
    </body>
</html>