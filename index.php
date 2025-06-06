<?php
$sizeError = $typeError = $locationError = "";
$folder = "image/";
if(!(is_dir($folder))){
    $locationError = "Directory doesn't exit.<br>";
}
if(isset($_POST['btn'])){
    if(empty($_FILES['photo']['name'][0])){
    $fileError = "Selected Your Photo And Click Button <br> ";
}else{
    for($a=0;$a < count($_FILES['photo']['name']);$a++){
        $name = $_FILES['photo']['name'][$a]; 
        $size = $_FILES['photo']['size'][$a];
        $tmp  = $_FILES['photo']['tmp_name'][$a];
        $type = $_FILES['photo']['type'][$a];
        if($size > 2 * 1024 * 1024){
            $sizeError = "Files {$name} exceeds 2MB.<br>";
        }
        if($type!="image/jpeg" && $type!="image/jpg" && $type!="image/png"){
            $typeError = "File {$name} chaild format (JPEG,JPG,PNG) . <br> ";
        }
        if(!($sizeError) && !($typeError) && !($locationError)){
            $fileName = uniqid()."_".$name;
            $destination = $folder.$fileName;
            if(move_uploaded_file($tmp,$destination)){
                $success = "Fies {$name} successFully .<br>";
            }else{
                $successError = "File {$name} Failed Photo. <br> ";
            }
        }
    }
}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Move Photo</title>
</head>
<body>

<form action="" method="POST" enctype="multipart/form-data">

    <input type="file" name="photo[]" multiple>
    <input type="submit" name="btn" value="Click"> 

</form>

<?= empty($locationError) ?  ""  :  $locationError ?>
<?= empty($fileError)     ?  ""  :  $fileError     ?>
<?= empty($sizeError)     ?  ""  :  $sizeError     ?>
<?= empty($typeError)     ?  ""  :  $typeError     ?>
<?= empty($success)       ?  ""  :  $success       ?>
<?= empty($successError)  ?  ""  :  $successError  ?>


</body>
</html>