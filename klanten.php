<?php

    //INCLUDE DATABASE CONNECTION
    include 'incl/db.php';

    //WHEN FORM IS SUBMITTED
    if($_SERVER["REQUEST_METHOD"] == "POST"){

        $naam = mysqli_real_escape_string($link, $_POST['lname']);
        $voornaam = mysqli_real_escape_string($link, $_POST['fname']);
        $adres = mysqli_real_escape_string($link, $_POST['adres']);
        $Tnummer = mysqli_real_escape_string($link, $_POST['Tnummer']);

        $sql = "INSERT INTO klanten (naam, voornaam, adres, telefoonnummer) VALUES ('$naam', '$voornaam', '$adres', '$Tnummer');";
        mysqli_query($link, $sql);
        header("Location: klanten.php");
    }
?>

<!DOCTYPE html>
  <html>
    <head>
        <title>RS Verhuurbedrijf</title>

        <!--Import Google Icon Font-->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Anton|Merriweather|Open+Sans+Condensed:300|Roboto+Condensed" rel="stylesheet">        

        <!--Import materialize.css-->
        <link type="text/css" rel="stylesheet" href="materialize/css/materialize.min.css"  media="screen,projection"/>

        <!--Let browser know website is optimized for mobile-->
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    </head>

    <header>
      <nav class="purple darken-4">
            <div class="nav-wrapper">
              <a href="index.php" style="font-family: 'Merriweather', serif; font-size: 55px;">RS</a>
              <ul id="nav-mobile" class="right hide-on-med-and-down">
                <li><a href="klanten.php" style="font-family: 'Roboto Condensed', sans-serif; font-size: 20px;">Klanten</a></li>
                <li><a href="voertuigen.php" style="font-family: 'Roboto Condensed', sans-serif; font-size: 20px;">Voertuigen</a></li>
              </ul>
            </div>
        </nav>
    </header>


    <body>

        <h1 style="font-family: 'Anton', sans-serif; text-align: center;">Klanten</h1>

        <div class="row" style="padding-left: 50px; padding-right: 50px;">
            <div class="col s12" style="height: 25em; overflow: auto;">
                <?php
                    require_once "incl/db.php";

                    $sql = "SELECT * FROM klanten";
                    if($result = mysqli_query($link, $sql)){
                        if(mysqli_num_rows($result) > 0){
                            echo "<table class='highlight, striped'>";
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th>ID</th>";
                                        echo "<th>Naam</th>";
                                        echo "<th>Voornaam</th>";
                                        echo "<th>Adres</th>";
                                        echo "<th>Telefoonnummer</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while ($row = mysqli_fetch_array($result)) {
                                    echo "<tr>";
                                        echo "<td>" . $row['klantenid'] . "</td>";
                                        echo "<td>" . $row['naam'] . "</td>";
                                        echo "<td>" . $row['voornaam'] . "</td>";
                                        echo "<td>" . $row['adres'] . "</td>";
                                        echo "<td>" . $row['telefoonnummer'] . "</td>";
                                }
                                echo "</tbody>";
                            echo "</table>";
                            mysqli_free_result($result);
                        } else {
                            echo "<p class='lead'><em>No records were found.</em></p>";
                        }
                    } else {
                        echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
                    }
                    mysqli_close($link);
                ?>
            </div>
        </div>

        <br>
        <br>

        <div class="row, container, right" style="padding-right: 50px; ">
            <a class="purple darken-4 waves-effect waves-light btn modal-trigger" href="#modal2">Klant Registreren</a>
        </div>

        <div id="modal2" class="modal">
            <div class="modal-content">
                <h3 style="font-family: 'Anton', sans-serif; text-align: center;">Registreren</h3>
                <br>
                    <div>
                        <div class="row">
                            <form class="col s12" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                                <div class="row">
                                    <div class="input-field col s6">
                                        <input id="last_name" type="text" class="validate" name="lname" required>
                                        <label for="last_name">Naam/Bedrijf</label>
                                    </div>
                                    <div class="input-field col s6">
                                        <input id="first_name" type="text" class="validate" name="fname">
                                        <label for="first_name">Voornaam(en)</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s8">
                                        <input id="adress" type="text" class="validate" name="adres" required>
                                        <label for="adress">Adres</label>
                                    </div>
                                    <div class="input-field col s4">
                                        <input id="tnummer" type="text" class="validate" name="Tnummer" required>
                                        <label for="tnummer">Telefoonnummer</label>
                                    </div>
                                </div>
                                <button class="btn waves-effect waves-light, purple darken-4" type="submit" name="action">Registreren
                                </button>
                            </form>
                        </div>
                    </div>
            </div>
        </div>
    </body>

        <!--JavaScript at end of body for optimized loading-->
        <script type="text/javascript" src="materialize/js/materialize.min.js"></script>

        <script type="text/javascript">
            M.AutoInit();
            $(document).ready(function(){
                $('[data-toggle="tooltip"]').tooltip();   
            });
        </script>
  </html>