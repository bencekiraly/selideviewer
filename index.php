<?php
session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="assets/css/style.css">
        <script type="text/javascript" src="assets/js/loader.js"></script>
        <title>Selenium IDE Suite viewer</title>
    </head>
    <body>
        <div id="top">
            <div id="formdiv">
                <form action="index.php" method="post" enctype="multipart/form-data" id="opensuite" >
                    <label>Suite path(with root, ex.: C:/suite/)</label>
                    <input type="text" name="filepath" id="filepath"><br/>
                    <label>Suite name(with extension, ex.: suite.html)</label>
                    <input type="text" name="filename" id="filename"><br/>
                    <input type="submit" value="Select Suite" name="submit">
                </form>
            </div>
        </div>
        <?php 
            if(isset($_POST['filepath']) && isset($_POST['filename'])){
                $_SESSION['filepath'] = $_POST['filepath'];
                $_SESSION['suitename'] = $_POST['filename'];
            }
        ?>
        <div id="content">

            <div id="suite">
            
                <?php
                    $handle = fopen($_SESSION['filepath'].$_SESSION['suitename'], "r");
                    if ($handle) {
                        while (($line = fgets($handle)) !== false) {
                            if(strpos($line, 'href=') !== false){
                                $cases = explode("\"", $line);
                                $casename = explode(">", $cases[2]);
                                echo "<tr><td><p onclick=\"cases('".$cases[1]."')\">".$casename[1]."</p></td></tr>";
                            }else{
                                echo $line;
                            }
                        }
                        fclose($handle);
                    }
                ?>
            
            </div>
            
            <div id="selenium">

                <table id="cname">
                    <tr>
                        <td>
                            <p id="cnamesuite"><?php if(isset($_SESSION['suitename'])){echo $_SESSION['suitename'];}?></p>
                        </td>
                        <td>
                            <p>Command</p>
                        </td>
                        <td>
                            <p>Target</p>
                        </td>
                        <td>
                            <p>Value</p>
                        </td>
                    </tr>
                </table>

                <div id="casesdiv">

                </div>
            </div>
            
        </div>

    </body>
</html>