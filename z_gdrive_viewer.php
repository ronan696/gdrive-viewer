<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="/css/style.css">
<?php
	session_start();
	include_once 'simple_html_dom.php';
	function zfunc($ID)
	{
			$html = file_get_html("https://drive.google.com/embeddedfolderview?id=".$ID);
			$entries = array();	//stores the ID of each file/folder
			$imgurls = array();	//stores the URLs of image for each file
			$names = array();	//stores the name of each file/folder 
			$flag=1;
			$title = $html->find('title',0)->plaintext;
			echo "<head><meta charset='UTF-8'><title>".$title."</title></head><body>"; //set apge title
			//Do not show the back button for root folder
			if($_SESSION['root_id'] != $_GET['ID'])
				echo "<button onclick='window.history.back();'>Back</button>";
			echo '<div id="container">';
			//retreive the ID of each file/folder
			foreach($html->find('div[class=flip-entry]') as $entry)
			{
				$entries[] = substr($entry->id,6);
			}
			//retreive the name of each file/folder
			foreach($html->find('div[class=flip-entry-title]') as $name)
			{
				$names[] = $name->plaintext;
			}
			//retreive URL of only large image thumbnail of each file
			foreach($html->find('img') as $image) 
			{
				if($flag>0)	
					$imgurls[] = $image->src;
				$flag*=-1;
			}
			// Find all links of file/folder 
			$links = $html->find('a');
			$c = count($links);
			$y = 0;
			for($x=0;$x<$c;$x++)
			{
				//Create link for file
				if (strpos($links[$x]->href,'file'))
				{	
					$urls[] = "https://drive.google.com/uc?export=download&id=".$entries[$x];
				}
				//Create link for folder
				else if (strpos($links[$x]->href,'folder'))
				{
					$urls[] = $_SERVER['PHP_SELF']."?ID=".$entries[$x];
				}
				//Create link for Google Document
				else if(strpos($links[$x]->href,'document'))
				{
					$urls[] = "https://docs.google.com/document/d/".$entries[$x]."/export?format=doc";
				}
				//Create link for Google Spreadsheet
				else if(strpos($links[$x]->href,'spreadsheet'))
				{
					$urls[] = "https://docs.google.com/spreadsheets/d/".$entries[$x]."/export?format=xlsx";
				}
				//Create link for Google Presentation
				else if(strpos($links[$x]->href,'presentation'))
				{
					$urls[] = "https://docs.google.com/presentation/d/".$entries[$x]."/export/pptx";
				}
				//Default Link
				else 
				{
					$urls[] = $links[$x]->href;
				}
			}
			$arrlength = count($names);
			//Pad the array with URL of folder image
			$i = array_pad($imgurls,-$arrlength,"/img/folder.png");
		
			for($x = 0; $x < $arrlength; $x++) 
			{
				echo "<a href='".$urls[$x]."'><figure><img src='".$i[$x]."'/><figcaption>" .$names[$x]. "</figcaption></figure></a>";
			}
			echo "</div>";
	}
	$ID = $_GET["ID"];
	zfunc($ID);

?>
</body>
</html>