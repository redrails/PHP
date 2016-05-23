<?php

/*

Pastebin similar script (PHP).
ihtasham.com

*/

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
	
	
	$goodToWrite = (isset($_POST["paste"]));  

	if($goodToWrite){
		$posted = true;
		$id = intval(file_get_contents($lastPFile));
		$id = $id + 1;
		file_put_contents($lastPFile,$id);
		
		$paste = stripslashes(htmlspecialchars($_POST["paste"]));
	
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
			</head>
			<pre>$paste</pre>
		</html>
HTML;
		mkdir("$directory/$id"); 
		file_put_contents("$directory/$id/index.html",$html);
		$link_back = "$directory/$id";
	} else { 
		$link_back = "Failed to upload"; 
	}
?>
<html>
	<head>
		<title>Paste by Toby</title>
		<style type="text/css">
			body{
				background:#EEE;
				color:black; text-shadow:1px 1px 5px grey; font-family:Calibri;
				margin-top:10%; text-align:center;
			}
			
			#box{
				width:100%; border:1px dashed Grey;
				padding: 20px; text-align:center;
				height:300px;
			}
			
			textarea{
				background:#eee; color:black; text-shadow:none;
				font-family:lucida console;
			}
			
			input.button{
				color:#EEE; background:Grey; text-shadow:1px 1px 5px grey; font-family:Calibri;
			}
			input.button:hover{
				color:#EEE; background:LightGrey; text-shadow:1px 1px 5px grey; font-family:Calibri;
			}
		</style>
	</head>
	<body>
		<?php 
			if(!$posted){ echo <<<FORM
				<h2><b> Paste </b></h2>
				<div id="box">
					<form action="#" method="post">
						<textarea type="text" name="paste" style="width:100%;height:90%"></textarea>
						<hr style="width:67%" />
						<input class="button" type="submit" value="Click to paste!" />
					</form>
				</div>
FORM;
}
			else{ echo <<<RESULT
			<div id="box">
				<h3>Your paste is uploaded!</h3>
				<a href="$link_back">$link_back</a>
			</div>
RESULT;
}

			
		?>
	</body>
</html>
