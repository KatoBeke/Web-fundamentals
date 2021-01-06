<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Resultaat</title>
        <link rel="stylesheet" href="./css/style.css" type="text/css">
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=PT+Serif&display=swap" rel="stylesheet">
    </head>
    <body class="result">
        <?php
            include_once "./includes/database.php";

            $likedPersons = $_GET["likedPersons"];
            $dislikedPersons = $_GET["dislikedPersons"];
            $personId = $_GET["personId"];

            $likedPersons = str_replace(",", "", $likedPersons);
            $dislikedPersons = str_replace(",", "", $dislikedPersons);

            for ($i = 0; $i <= $likedPersons; $i++)
            {
                createQuery("INSERT INTO `likes` (`person_id`, `personLikedId`, `geliked`) VALUES ('$personId', '$likedPersons[$i]', true); ");
                // createQuery("DELETE FROM `likes` WHERE `personLikedId` = 0");
            }

            for ($i = 0; $i <= $dislikedPersons; $i++) 
            { 
                createQuery("INSERT INTO `likes` (`person_id`, `personLikedId`, `geliked`) VALUES ('$personId', '$dislikedPersons[$i]', false); ");
                // createQuery("DELETE FROM `likes` WHERE `personLikedId` = 0");
            }
            $laatste = getQuery("SELECT * FROM `person` INNER JOIN  `likes` ON `person`.`person_id` = `likes`.`person_id` ORDER BY `likes`.`like_id` DESC LIMIT 1");

            $likes = getQuery("SELECT DISTINCT firstName FROM person INNER JOIN likes ON person.person_id = likes.personLikedId WHERE likes.geliked = true && likes.person_id = $personId");
            $didntlikes = getQuery("SELECT DISTINCT firstName FROM person INNER JOIN likes ON person.person_id = likes.personLikedId WHERE likes.geliked = false && likes.person_id = $personId");
            
            ?>
            <div class="finale">
                <?php
                    foreach($laatste as $last)
                    {
                        $naam = $last['firstName'];
                        
                        echo "That is it, " . $naam  . "." . "</br>" . "You rated them all!" . "</br>";
                        echo "</br>";
                    }
                    echo "You like: ";
                    foreach($likes as $like) 
                    { 
                        echo "<ul><li>" . $like['firstName'] . "</ul></li>";
                        echo "</br>";
                    }
                    echo "</br>";
                    echo "You didn't like: ";
                    foreach($didntlikes as $didntlike) 
                    { 
                        echo "<ul><li>" . $didntlike['firstName'] . "</ul></li>";
                        echo "</br>";
                    }
                ?>
            </div>

        <div id="footer">
            <?php
                include "./components/footer.php";
            ?>
        </div>
        <script src="./js/match.js">
        </script>
    </body>
</html>