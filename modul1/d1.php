<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>D1 - Image Watermark</title>
</head>

<body>
    <form action="" method="post" enctype="multipart/form-data">
        <input type="file" name="image" id="image">
        <input type="submit" value="Upload" name="submit">
    </form>
    <?php
    if (isset($_POST['submit'])) {
        if (!empty($_FILES['image']['name'])) {
            $fileName = basename($_FILES['image']['name']);
            $targetFilePath = 'uploads/' . $fileName;
            $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

            $allowTypes = array('jpg', 'png', 'jpeg');
            if (in_array($fileType, $allowTypes)) {
                if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFilePath)) {
                    $watermarkImg = imagecreatefrompng('wm.png');
                    switch ($fileType) {
                        case 'jpg':
                            $im = imagecreatefromjpeg($targetFilePath);
                            break;
                        case 'jpeg':
                            $im = imagecreatefromjpeg($targetFilePath);
                            break;
                        case 'png':
                            $im = imagecreatefrompng($targetFilePath);
                            break;
                        default:
                            $im = imagecreatefromjpeg($targetFilePath);
                    }

                    $marge_right = 10;
                    $marge_bottom = 10;

                    $sx = imagesx($watermarkImg);
                    $sy = imagesy($watermarkImg);

                    imagecopy($im, $watermarkImg, imagesx($im) - $sx - $marge_right, imagesy($im) - $sy - $marge_bottom, 0, 0, imagesx($watermarkImg), imagesy($watermarkImg));

                    if ($fileType == 'png') {
                        imagepng($im, $targetFilePath);
                    } else {
                        imagejpeg($im, $targetFilePath);
                    }
                    imagedestroy($im);
                } else {
                    echo "Sorry, there was an error uploading your file.";
                }
            } else {
                echo "Sorry, only JPG, JPEG, and PNG files are allowed to upload.";
            }
        } else {
            echo "Please select a file to upload.";
        }
        echo '<img src="' . $targetFilePath . '" alt="Uploaded Image">';
    }
    ?>



</body>

</html>