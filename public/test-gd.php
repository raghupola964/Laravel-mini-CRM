<?php
$image = imagecreatetruecolor(100, 100);
if ($image === false) {
    die('GD is not working');
}
imagefill($image, 0, 0, imagecolorallocate($image, 255, 0, 0)); // Red square
$filePath = __DIR__ . '/test.jpg';
$saved = imagejpeg($image, $filePath);
imagedestroy($image);

if ($saved) {
    if (file_exists($filePath)) {
        echo 'Image created and saved: <img src="/mini-crm/public/test.jpg">';
        echo '<br>File path: ' . $filePath;
        echo '<br>Writable: ' . (is_writable(__DIR__) ? 'Yes' : 'No');
    } else {
        echo 'Image created but not found on disk';
    }
} else {
    echo 'Failed to save image';
}