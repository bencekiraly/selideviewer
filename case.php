<?php
    session_start();
    if(isset($_GET['file'])){
            $handle = fopen($_SESSION['filepath'].$_GET['file'], "r");
        if ($handle) {
            while (($line = fgets($handle)) !== false) {
                if(strpos($line, '<!--') !== false){
                    $felirat = explode("--", htmlspecialchars($line));
                    echo "<tr><td colspan=\"3\" style=\"color: white; background-color: #00a386\">".$felirat[1]."</td></tr>";
                }else{
                    echo $line;
                }
            }
            fclose($handle);
        }
    }  
?>