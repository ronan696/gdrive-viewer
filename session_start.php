 <?php
   session_start();
   session_unset();
   $_SESSION['root_id'] = $_GET['ID'];
   //Check if the ID provided is valid or not.
   $check_404 = get_headers("https://drive.google.com/embeddedfolderview?id=".$_GET['ID'])[0];
   //Check if sharing is enabled
   $check_permission = file_get_contents("https://drive.google.com/embeddedfolderview?id=".$_GET['ID'],false,null,125,50);
   echo ( $check_404 == "HTTP/1.0 200 OK" && strpos($check_permission, 'ServiceLogin') === false)?'true' : 'false'; 
 ?> 