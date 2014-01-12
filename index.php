<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
    </head>
    <body>

<?php

    $imageLocation = "test.png";
    
    $imageArrayValues = createArrayValue($imageLocation);
    $imageArrayRGBA = createArrayRGBA($imageLocation);
    
    $createImage = createImageFromArrayValues($imageArrayValues);
    
//    var_dump($imageArrayValues);
//    exit();

?>


<?php

    /**Get parameter string location of image
     * @return type array of pixel values
     */
    function createArrayValue($imageLocation = "test.png")
    {
        $imageData = imagecreatefrompng($imageLocation);

        $imageWidth = imagesx($imageData);
        $imageHeight = imagesy($imageData);

        $imageArrayValue = array();
        for($x = 0; $x < $imageWidth; $x++) {
            for($y = 0; $y < $imageHeight; $y++) {
                $imageArrayValue[$x.','.$y] = imagecolorat($imageData, $x, $y);
            }
        }

        return $imageArrayValue;
    }

    /**Get parameter string location of image
     * @return type array of pixels in RGBA
     */
    function createArrayRGBA($imageLocation = "test.png")
    {
        $imageData = imagecreatefrompng($imageLocation);

        $imageWidth = imagesx($imageData);
        $imageHeight = imagesy($imageData);

        $imageArrayRGBA = array();
        for($x = 0; $x < $imageWidth; $x++) {
            for($y = 0; $y < $imageHeight; $y++) {
                $pixelValue = imagecolorat($imageData, $x, $y);
                $imageArrayRGBA[$x.','.$y] = imagecolorsforindex($imageData, $pixelValue);
            }
        }
        
        return $imageArrayRGBA;
    }
    
    /**
     * Create image from array values
     * @param type $imageArray
     */
    function createImageFromArrayValues($imageArray)
    {
        $img = imagecreatetruecolor(256, 256);
        
        for($x = 0; $x < 256; $x++) {
            for($y = 0; $y < 256; $y++) {
                imagesetpixel($img, $x, $y, $imageArray[$x.','.$y]);
            }
        }
        
        //Save image in disk
        $imageSaved = imagepng($img, 'result.png');
        
        //Print image in browser
//        header('Content-Type: image/png');
//        imagepng($img);
        return $imageSaved;
    }
    
?>

    </body>
</html>
