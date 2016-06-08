<?php
  /*
  * paste v2
	 */

	include("Parsedown.php");
	$directory = "pastes";
	$lastPFile = "last_paste.txt";
	$tcolor = "#000";
	$bcolor = "#EEE";
	
	/*
	 * Ignore following code (installer)
	*/
	if(!file_exists($lastPFile)){ 
		$debugFile = file_put_contents($lastPFile,"0");
	}
	if(!is_dir($directory)){
		$debugDir = mkdir($directory); 
	}
	$link_back = ""; $posted = false;
	/* Installer finished */
	
	function tab2space($text, $spaces = 4) {
	    // Explode the text into an array of single lines
	    $lines = explode("\n", $text);
	    // Loop through each line
	    
	    foreach ($lines as $line) {
	      // Break out of the loop when there are no more tabs to replace
		
	      while (false !== $tab_pos = strpos($line, "\t")) {
		// Break the string apart, insert spaces then concatenate
		$start = substr($line, 0, $tab_pos);
		$tab = str_repeat(' ', $spaces - $tab_pos % $spaces);
		$end = substr($line, $tab_pos + 1);
		$line = $start . $tab . $end;
	      }
	      $result[] = $line;
	    }
	    return implode("\n", $result);
	  }
	
	$goodToWrite = (isset($_POST["paste"]) && !empty($_POST["paste"]));  

	if($goodToWrite){
		$posted = true;
		$id = intval(file_get_contents($lastPFile));
		$id = $id + 1;
		file_put_contents($lastPFile,$id);
		if($_POST['markdown'] == "yes"){
			$Parsedown = new Parsedown();
			$paste = $Parsedown->text(stripslashes(htmlspecialchars($_POST["paste"])));
		} else {
			$paste = stripslashes(htmlspecialchars($_POST["paste"]));
		}
	
		$html = <<<HTML
		<html>
			<head>
				<style type="text/css">
					body{
						font-family:Calibri;
						color:$tcolor;
						background:$bcolor;
					}
				</style>
				<title>paste $id</title>
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.4.0/styles/default.min.css">
<script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.4.0/highlight.min.js"></script>
<script>hljs.initHighlightingOnLoad();</script>
			</head>
			<pre><code>$paste</code></pre>
		</html>
HTML;
		mkdir("$directory/$id"); 
		file_put_contents("$directory/$id/index.html",$html);
		$link_back = "$directory/$id";
	} else { 
		$link_back = "Failed to upload"; 
	}
?>
<!DOCTYPE html>
<html lang="en">

<head>


    <title>Paste - v2</title>

    <!-- Bootstrap Core CSS -->
    <link href="script/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="script/css/full-width-pics.css" rel="stylesheet">



<style type="text/css">
	textarea {
        background:#eee; color:black; text-shadow:none;
        font-family:'Lucida Console', Monaco, monospace;
        width:100%;
        height: 500px;
    }
	input.button{
		color:#EEE; background:#6495ED; text-shadow:1px 1px 5px grey;
	}
	input.button:hover{
		color:#EEE; background:Blue; text-shadow:1px 1px 5px grey;
	}
</style>

</head>

<body>

    <!-- Full Width Image Header with Logo -->
    <!-- Image backgrounds are set within the full-width-pics.css file. -->
    <header class="image-bg-fluid-height">
        <img class="img-responsive img-center" src="script/css/logo.png" alt=""><h1>Paste</h1>
    </header>
		<?php
			if(!$posted){ echo <<<FORM
    <section>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
					<form action="#" method="post">
						<textarea type="text" name="paste"></textarea>
						<hr style="width:67%" />
					<center><h3><input type="checkbox" name="markdown" value="yes"> &nbsp;Post as markdown</h3></center>
						<input style="width:100%; height:75px;font-size:30px;" class="button" type="submit" value="Click to paste!" />


					</form>
                </div>
            </div>
        </div>
    </section>
FORM;
}
			else{ echo <<<RESULT
			<center>
				<h3>Your paste is uploaded!</h3>
				<a href="$link_back">$link_back</a>
			</center>
RESULT;
}

			
		?>
	</body>
</html>
