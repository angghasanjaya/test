<?php
// I haven’t tested this class because I forgot install certain required libraries on my local machine. I assume it will work.
class ImageResize {
    private $image;
    private $imageType;
    public function __construct($filename) {
        $this->image = imagecreatefromjpeg($filename);
    }
    private function imgHeight() {
        return imagesy($this->image);
    }
    private function imgWidth() {
        return imagesx($this->image);
    }
    public function resizeToHeight($height) {
        $ratio = $height / $this->imgHeight();
        $width = $this->imgWidth() * $ratio;
        return $this->resize($width,$height);
    }
    public function resizeToWidth($width) {
        $ratio = $width / $this->imgWidth();
        $height = $this->imgHeight() * $ratio;
        return $this->resize($width,$height);
    }
    private function resize($width,$height) {
        $new_image = imagecreatetruecolor($width, $height);
        imagecopyresampled($new_image, $this->image, 0, 0, 0, 0, $width, $height, $this->imgWidth(), $this->imgHeight());
        $this->image = $new_image;
        return imagejpeg($this->image);
    }
}


// tes
//$image = new ImageResize($targetfile);
//$resized= $image->resizeToWidth(300);
//imagejpeg($resized,$destination);