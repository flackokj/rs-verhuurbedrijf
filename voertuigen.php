<?php
  //INCLUDE DATABASE CONNECTION
  include 'incl/db.php';

  //WHEN FORM IS SUBMITTED
  if($_SERVER["REQUEST_METHOD"] == "POST"){

    $merk = mysqli_real_escape_string($link, $_POST["merk"]);
    $model = mysqli_real_escape_string($link, $_POST["model"]);
    $plaatnummer = mysqli_real_escape_string($link, $_POST["plaatnummer"]);
    $chassisnummer = mysqli_real_escape_string($link, $_POST["chassisnummer"]);
    $status = mysqli_real_escape_string($link, $_POST["status"]);
    $kmstand = mysqli_real_escape_string($link, $_POST["kmstand"]);
    $categorie = mysqli_real_escape_string($link, $_POST["categorie"]);

    $sql = "INSERT INTO voertuigen (merk, model, plaatnummer, categorie, status, kmstand, chassisnummer) VALUES ('$merk', '$model', '$plaatnummer', '$categorie', '$status', '$kmstand', '$chassisnummer');";
    mysqli_query($link, $sql);
    header("Location: voertuigen.php");
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
      <div class="center-align">
        <h1 style="font-family: 'Anton', sans-serif;">Voertuigen</h1>
      </div>

      <div class="row" style="padding-left: 50px; padding-right: 50px;">
        <div class="col s12" style="height: 25em; overflow: auto;">
          <?php
            require_once "incl/db.php";

            $sql = "SELECT * FROM voertuigen";
              if($result = mysqli_query($link, $sql)){
                if(mysqli_num_rows($result) > 0){
                  echo "<table class='highlight, striped' id='myTable'>";
                    echo "<thead>";
                      echo "<tr>";
                        echo "<th>ID</th>";
                        echo "<th>Merk</th>";
                        echo "<th>Model</th>";
                        echo "<th>Kentekennummer</th>";
                        echo "<th>Chassisnummer</th>";
                        echo "<th>Categorie</th>";
                        echo "<th>Status</th>";
                        echo "<th>Km stand</th>";
                        echo "<th> </th>";
                      echo "</tr>";
                    echo "</thead>";
                    echo "<tbody>";
                    while ($row = mysqli_fetch_array($result)) {
                    echo "<tr>";
                      echo "<td>" . $row['voertuigid'] . "</td>";
                      echo "<td>" . $row['merk'] . "</td>";
                      echo "<td>" . $row['model'] . "</td>";
                      echo "<td>" . $row['plaatnummer'] . "</td>";
                      echo "<td>" . $row['chassisnummer'] . "</td>";
                      echo "<td>" . $row['categorie'] . "</td>";
                      echo "<td>" . $row['status'] . "</td>";
                      echo "<td>" . $row['kmstand'] . "</td>";
                      echo "<td>";
                        echo "<a href='incl/voertuigen/crud/update.php?id=". $row['voertuigid'] ."' title='Wijzigen' data-toggle='tooltip'><i class='small material-icons' style='color: #6a1b9a;'>edit</i></a>";
                        echo "<a href='incl/voertuigen/crud/delete.php?id=". $row['voertuigid'] ."' title='Verwijderen' data-toggle='tooltip'><i class='small material-icons' style='color: #6a1b9a;'>delete</i></a>";
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
        <a class="purple darken-4 waves-effect waves-light btn modal-trigger" href="#modal1">Voertuig Registreren</a>
      </div>

      <div id="modal1" class="modal">
        <div class="modal-content">
          <h3 style="font-family: 'Anton', sans-serif; text-align: center;">Registreren</h3>
          <br>
            <div>
              <div class="row">
                <form class="col s12" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                  <div class="row">
                    <div class="input-field col s4">
                      <input id="merk" type="text" class="validate" name="merk" required>
                      <label for="merk">Merk</label>
                    </div>
                    <div class="input-field col s4">
                      <input id="model" type="text" class="validate" name="model" required>
                      <label for="model">Model</label>
                    </div>
                    <div class="input-field col s4">
                      <input id="plaatnummer" type="text" class="validate" name="plaatnummer" required>
                      <label for="plaatnummer">Kentekennummer</label>
                    </div>
                  </div>
                  <div class="row">
                    <div class="input-field col s8">
                      <input id="chassisnummer" type="text" class="validate" name="chassisnummer" required>
                      <label for="chassisnummer">Chassisnummer</label>
                    </div>
                    <div class="input-field col s4">
                      <input id="kmstand" type="text" class="validate" name="kmstand" required>
                      <label for="kmstand">Km stand</label>
                    </div>
                    <div class="input-field col s4">
                      <label for="status">Status</label>
                      <br><br>
                      <select name="status" required>
                        <option value="binnen">Binnen</option>
                        <option value="verhuurd">Verhuurd</option>
                      </select>
                    </div>
                    <div class="input-field col s4">
                      <label for="categorie">Categorie</label>
                      <br><br>
                      <select name="categorie" required>
                        <option value="P1">P1</option>
                        <option value="P2">P2</option>
                        <option value="P3" selected>P3</option>
                        <option value="P4">P4</option>
                      </select>
                    </div>              
                  </div>
                  <button class="btn waves-effect waves-light, purple darken-4" type="submit" name="action">Registreren</button>
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