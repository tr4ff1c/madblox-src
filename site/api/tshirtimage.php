<?php

require_once($_SERVER['DOCUMENT_ROOT'].'/core/database.php');
error_reporting(E_ALL);

$ID = isset($_GET['id']) ? intval($_GET['id']) : 0;

$stmt = $db->prepare("SELECT * FROM catalog WHERE id = :id");
$stmt->bindParam(':id', $ID, PDO::PARAM_INT);
$stmt->execute();
$gI = $stmt->fetch(PDO::FETCH_OBJ);

$Image = str_replace("http://mlgblox.xyz/ast/tshirts/", "", $gI->filename) ?? "thingTransparent.png";

class StackImage
{
    private $image;
    private $width;
    private $height;

    public function __construct($path)
    {
        if (!isset($path) || !file_exists($path)) {
            return;
        }
        $this->image = imagecreatefrompng($path);
        imagesavealpha($this->image, true);
        imagealphablending($this->image, true);
        $this->width = imagesx($this->image);
        $this->height = imagesy($this->image);
    }

    public function addLayer($path)
    {
        if (!isset($path) || !file_exists($path)) {
            return;
        }
        $new = imagecreatefrompng($path);
        imagesavealpha($new, true);
        imagealphablending($new, true);
        imagecopyresampled($this->image, $new, 0, 0, 0, 0, $this->width, $this->height, imagesx($new), imagesy($new));
    }

    public function output($type = "image/png")
    {
        header("Content-Type: {$type}");
        imagepng($this->image);
        imagedestroy($this->image);
    }

    public function getWidth()
    {
        return $this->width;
    }

    public function getHeight()
    {
        return $this->height;
    }
}

$ImageObj = new StackImage("images/tshirt.png");
// $ImageObj->addLayer("ast/tshirts/" . $Image);

$ImageObj->output();
?>
