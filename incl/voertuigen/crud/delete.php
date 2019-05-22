<?php
	// Process delete operation after confirmation
	if(isset($_POST["id"]) && !empty($_POST["id"])){
	    // Include config file
	    require_once "../../db.php";
	    
	    // Prepare a delete statement
	    $sql = "DELETE FROM voertuigen WHERE voertuigid = ?";
	    
	    if($stmt = mysqli_prepare($link, $sql)){
	        // Bind variables to the prepared statement as parameters
	        mysqli_stmt_bind_param($stmt, "i", $param_id);
	        
	        // Set parameters
	        $param_id = trim($_POST["id"]);
	        
	        // Attempt to execute the prepared statement
	        if(mysqli_stmt_execute($stmt)){
	            // Records deleted successfully. Redirect to landing page
	            header("location: ../../../voertuigen.php");
	            exit();
	        } else{
	            echo "Oops! Something went wrong. Please try again later.";
	        }
	    }
	     
	    // Close statement
	    mysqli_stmt_close($stmt);
	    
	    // Close connection
	    mysqli_close($link);
	} else{
	    // Check existence of id parameter
	    if(empty(trim($_GET["id"]))){
	        // URL doesn't contain id parameter. Redirect to error page
	        header("location: error.php");
	        exit();
	    }
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Verwijderen</title>
	<!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Anton|Merriweather|Open+Sans+Condensed:300|Roboto+Condensed" rel="stylesheet"> 

    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="../../../materialize/css/materialize.min.css"  media="screen,projection"/>

    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>
<body>
	<div class="center-align">
    	<h1 style="font-family: 'Anton', sans-serif;">Bent u zeker?</h1>
    	<br><br>
    	<div class="row, container">
	    	<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post"> 
	    		<div class="row">
		    		<h5 style="color: #b71c1c;">Bent u zeker dit record te verwijderen? Dit kan niet ongedaan worden.</h5>
	    		</div>
	    		<div class="row">
	    			<button style="width: 100px;" class="btn waves-effect waves-light, red darken-3" type="submit" name="action">Ja</button>
	    			<span style="padding-left: 50px;"></span>
	    			<a href="../../../voertuigen.php">
		    			<button style="width: 100px; color: black;" class="btn waves-effect waves-light, purple lighten-5" type="button">Nee</button>
		    		</a>
		    		<input type="hidden" name="id" value="<?php echo trim($_GET["id"]); ?>"/>
	    		</div>
	    	</form>
    	</div>
    </div>
</body>
<script type="text/javascript" src="materialize/js/materialize.min.js"></script>
<script type="text/javascript">
    M.AutoInit();
</script>
</html>