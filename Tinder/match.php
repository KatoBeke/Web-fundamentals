<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Swipe</title>
        <link rel="stylesheet" href="./css/style.css" type="text/css">
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=PT+Serif&display=swap" rel="stylesheet">
    </head>

    <body class="rating">
        <?php
            include_once "./includes/database.php";
            
            
        ?>

        <div class="afbeelding">
            <img src="./afbeeldingen/love.jpeg" width="400px" height="400px" id="hartjes"/>
        </div>
     
        <?php

            // Als alle velden van de form zijn ingevuld, wordt er per persoon een overzicht getoont van zijn gegevens, een knop like en een knop dislike
            if (isset($_POST["firstname"]) && isset($_POST["gender"]) && isset($_POST["preferred_gender"])) 
            {
                $voornaam = $_POST["firstname"];
                $geslacht = $_POST["gender"];
                $gewenst_geslacht = $_POST["preferred_gender"];

                // Persoon dit gaat liken
                $personId = getQuery("SELECT person_id FROM person WHERE firstName = '$voornaam'");
                $personId = $personId[0]["person_id"];

                // Alle personen die de parameters voldoen 
                $persons = getQuery("SELECT * FROM person WHERE firstName != '$voornaam' && gender = '$gewenst_geslacht' && preferred_gender = '$geslacht'");

                foreach($persons as $person) 
                {
                    $personLikedId = $person['person_id']; // De id's van de personen die geliked of gedisliked worden
                    ?>
                        <div class="person js-person" data-id="<?php echo $personLikedId?>" data-person="<?php echo $personId?>">
                            <h1>
                                <?php
                                    echo $person['firstName'];
                                ?>
                            </h1>

                            <blockquote>
                                <?php
                                    echo $person['firstName'] . " " . $person['lastName'];
                                    echo "</br>";
                                    echo $person['gender'];
                                    echo "</br>";
                                    echo $person['age'] . " years old";
                                    echo "</br>";
                                    echo $person['interests'];
                                ?>
                            </blockquote>
                            </br>
                        </div>
                        <?php 
                }

                ?> 
                    <!-- Melding iedereen gerated -->
                    <div class="eind">
                        <p>That is it, <?php echo $voornaam . "." . "</br>" ?>You rated them all!</p>
                        <p>You like:
                            <ul>
                                <li>

                                </li>
                            </ul>
                        </p>
                        </br>
                        <p>You didn't like:
                            <ul>
                                <li>
                                </li>
                            </ul>
                        </p>
                    </div>
                <?php 
            }
                ?>
                    <button class="button" name="dislike" id="dislike">X</button>
                    <button class="button" name="like" id="like">✓</button>

        <div id="footer">
            <?php
                include "./components/footer.php";
            ?>
        </div>
        <script src="./js/match.js">
        </script>
    </body>
</html>