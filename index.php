<?php
//require_once('config.php');
/*(PHP 4, PHP 5, PHP 7)

strpos — Encuentra la posición de la primera ocurrencia de un substring en un string
Encuentra la posición numérica de la primera ocurrencia del needle (aguja) en el string haystack (pajar).
*/

if (isset($_POST['submit']) && !empty($_FILES['file']['name'])) {

    $file = $_FILES['file']['name'];

    if (isset($file) && $file != "") {

        $tipo = $_FILES['file']['type'];    //type file
        $tamano = $_FILES['file']['size'];  //size file
        $temp = $_FILES['file']['tmp_name'];//tmp file

        if (!((strpos($tipo, "gif") || strpos($tipo, "jpeg") || strpos($tipo, "jpg") || strpos($tipo, "png")) && ($tamano < 2000000))) {
            
            $error[] = '<b>Error. The file extension or size is not correct.<br/>
                  - .Gif, .jpg, .png files are allowed. and 200 kb maximum.</b>';
        
        } else {

            $rute = "intranet/uploads/";
            if (move_uploaded_file($temp, $rute .$file)) {
                chmod($rute.$file, 0777);

                $show[] = '<img src="intranet/'.$file.'" class="img_uploads"><br>Image has been verified successfully.';
            }
            else {
                $error[] = '<b>An error occurred while loading the file. It could not be saved.</b>';
            }
        }
    }
}

?>
<!DOCTYPE html>
<html>
<head>
	<title> Imagen Server</title>
	<meta charset="utf-8">
	<style type="text/css">
		table {
			margin: auto;
			width: 450px;
			border: 2px ;
            border: 2px dotted #FF0000;
		}
        img {
            vertical-align: middle;
            width: 50px;
            height: 50px;
            border-radius: 50%;
        }

        .container {
            padding: 20px;
        }
        #uploadForm {
            float: left;
            width: 100%;
        }
        img, embeb {
            margin-top: 20px;
        }
	</style>
</head>
<body style="background-color: #000; color: #fff;">
<div class="container">
    <form method="post" action="index.php" enctype="multipart/form-data" id="uploadForm">
        <input type="file" name="file" id="file" />
        <input type="submit" name="submit" value="Upload"/>
    </form>
</div>
<script src="jquery.min.js"></script>
<script type="text/javascript">
    function filePreview(input) {
        if (input.files && input.files[0]) {
        
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#uploadForm + img').remove();
            $('#uploadForm').after('<img src="'+e.target.result+'" width="450" height="300"/>');
        }
        reader.readAsDataURL(input.files[0]);
        }
    }

    $("#file").change(function () {
        filePreview(this);
    });
    </script>
</body>
</html>
