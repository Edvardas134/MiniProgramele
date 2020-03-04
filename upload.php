<?php
if(isset($_POST['upload'])) {
    $file = $_FILES['file'];

    $fileName = $_FILES['file']['name'];
    $fileTmpName = $_FILES['file']['tmp_name'];
    $fileSize = $_FILES['file']['size'];
    $fileError = $_FILES['file']['error'];
    $fileType = $_FILES['file']['type'];

    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));

    $allowed = array('csv', 'xml', 'json');

    if(in_array($fileActualExt, $allowed)){
        if ($fileError === 0){
            if ($fileSize < 20000){
                $fileDestination = 'Files/' . $fileName;
                move_uploaded_file($fileTmpName, $fileDestination);
                header("Location: index.php?uploadsuccess");
            } else {
                echo "The maximum file size is 20MB";
            }
        } else {
            echo "There was an error uploading your file";
        }
    } else {
        echo "Wrong file type!";
    }
}
?>