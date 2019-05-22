<?php
  include 'incl/db.php';

  if($_SERVER["REQUEST_METHOD"] == "POST"){
    $klant = mysqli_real_escape_string($link, $_POST["autocomplete-input"]);
    $voertuig = mysqli_real_escape_string($link, $_POST["autocomplete-input-2"]);
    $Udatum = mysqli_real_escape_string($link, $_POST["uitleverdatum"]);
    $Idatum = mysqli_real_escape_string($link, $_POST["inleverdatum"]);
    $oudkm = mysqli_real_escape_string($link, $_POST["oudkm"]);
    $nieuwkm = mysqli_real_escape_string($link, $_POST["nieuwkm"]);
    $bedrag = mysqli_real_escape_string($link, $_POST["bedrag"]);

    $Udatum = date('y-m-d');
    $Idatum = date('y-m-d');

    $sql = "INSERT INTO verhuurd (klant_naam, voertuig, oudkm, nieuwkm, bedrag, uitgeef_datum, inlever_datum) VALUES ('$klant', '$voertuig', '$oudkm', '$nieuwkm', '$bedrag', '$Udatum', '$Idatum');";
    mysqli_query($link, $sql);
    header("Location: index.php");
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
        <link type="text/css" rel="stylesheet" href="materialize/css/materialize.css"  media="screen,projection"/>

        <!-- Import JavaScript -->
        <script type="text/javascript" src="materialize/js/materialize.min.js"></script>
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
        <script type="text/javascript" src="incl/autocomplete/klant/script.js"></script>
        <script type="text/javascript" src="incl/autocomplete/voertuig/script.js"></script>

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
      <h1 style="font-family: 'Anton', sans-serif; text-align: center;">Verhuurd</h1>

        <div class="row" style="padding-left: 50px; padding-right: 50px;">
            <div class="col s12" style="height: 25em; overflow: auto;">
                <?php
                    require_once "incl/db.php";

                    $sql = "SELECT * FROM verhuurd";
                    if($result = mysqli_query($link, $sql)){
                        if(mysqli_num_rows($result) > 0){
                            echo "<table class='highlight, striped'>";
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th>ID</th>";
                                        echo "<th>Klantnaam</th>";
                                        echo "<th>voertuig</th>";
                                        echo "<th> </th>";
                                        //echo "<th>Telefoonnummer</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while ($row = mysqli_fetch_array($result)) {
                                    echo "<tr>";
                                        echo "<td>" . $row['verhuur_id'] . "</td>";
                                        echo "<td>" . $row['klant_naam'] . "</td>";
                                        echo "<td>" . $row['voertuig'] . "</td>";
                                        echo "<td>";
                                          echo "<a href='incl/verhuurd/crud/update.php?id=". $row['verhuur_id'] ."' title='Printen' data-toggle='tooltip'><i class='small material-icons' style='color: #6a1b9a;'>print</i></a>";
                                          echo "<a href='incl/verhuurd/crud/delete.php?id=". $row['verhuur_id'] ."' title='Verwijderen' data-toggle='tooltip'><i class='small material-icons' style='color: #6a1b9a;'>delete</i></a>";
                                        echo "</td>";
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
      <a class="purple darken-4 waves-effect waves-light btn modal-trigger" href="#modal3">Verhuren</a>
    </div>

    <div id="modal3" class="modal">
      <div class="modal-content">
        <h3 style="font-family: 'Anton', sans-serif; text-align: center;">Registreren</h3>
        <br>
        <div>
          <div class="row">
            <form class="col s12" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
              <div class="row">
                <div class="input-field col s6">
                    <input type="text" name="autocomplete-input" id="autocomplete-input" class="autocomplete" required>
                    <label for="autocomplete-input">Klant</label>
                    <div id="result"></div>
                </div>
                <div class="input-field col s6">
                    <input type="text" name="autocomplete-input-2" id="autocomplete-input-2" class="autocomplete" required>
                    <label for="autocomplete-input-2">Voertuig</label>
                    <div id="result-2"></div>
                </div>
              </div>
              <div class="row">
                <div class="input-field col s6">
                  <input type="text" name="uitleverdatum" id="uitleverdatum" class="datepicker" required>
                  <label for="uitleverdatum">Uitgeefdatum</label>
                </div>
                <div class="input-field col s6">
                  <input type="text" name="inleverdatum" id="inleverdatum" class="datepicker" required>
                  <label for="inleverdatum">Inleverdatum</label>
                </div>
              </div>
              <div class="row">
                <div class="input-field col s4">
                  <input type="text" name="oudkm" id="oudkm" class="validate" required>
                  <label for="oudkm">Oud km stand</label>
                </div>
                <div class="input-field col s4">
                  <input type="text" name="nieuwkm" id="nieuwkm" class="validate" required>
                  <label for="nieuwkm">Nieuw km stand</label>
                </div>
                <div class="input-field col s4">
                  <input type="text" name="bedrag" id="bedrag" class="validate" required>
                  <label for="bedrag">Bedrag (SRD)</label>
                </div>
              </div>
              <button class="btn waves-effect waves-light, purple darken-4" type="submit" name="action">Opslaan</button>
            </form>
          </div>
        </div>
      </div>
    </div>
    <script type="text/javascript">
      M.AutoInit();
    </script>
    </body>
  </html>