<?php
$uploadPressed = filter_input(INPUT_POST,'btnUpload');
if(isset($uploadPressed)){
    $fileName = filter_input(INPUT_POST,'txtfilename');
    $targetDirectory ="uploads/";
    $fileExtension = pathinfo($_FILES['txtFile']['name'], PATHINFO_EXTENSION);
    $fileUploadPath = $targetDirectory . $fileName . '.' . $fileExtension;
    if($_FILES['txtFile']['size'] > 1024 * 2048){
        echo '<div>Upload File exceed 2Mb</div>';
    } else{
        move_uploaded_file($_FILES['txtFile']['tmp_name'],$fileUploadPath);
    }
}   
?>
<!doctype html>
<html lang="en">
<head>
   <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<form method = "post" action="" enctype = "multipart/form-data">
    <fieldset>
        <input type = "text" name="txtfilename" placeholder="Upload File Name">
        <input type = "file" name="txtFile" accept = "image/*">
        <input type = "submit" name = "btnUpload" value = "Upload to Server">
    </fieldset>
</form>
</body>
</html>
