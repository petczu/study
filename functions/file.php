<?php
/**
 * User: PETCZU
 * Date: 05.08.17
 * Time: 18:15
 */
function createThumbnail($filepath, $thumbpath, $thumbnail_width, $thumbnail_height, $background) {
    list($original_width, $original_height, $original_type) = getimagesize($filepath);
    if ($original_width > $original_height) {
        $new_width = $thumbnail_width;
        $new_height = intval($original_height * $new_width / $original_width);
    } else {
        $new_height = $thumbnail_height;
        $new_width = intval($original_width * $new_height / $original_height);
    }
    $dest_x = intval(($thumbnail_width - $new_width) / 2);
    $dest_y = intval(($thumbnail_height - $new_height) / 2);
    if ($original_type === 1) {
        $imgt = "ImageGIF";
        $imgcreatefrom = "ImageCreateFromGIF";
    } else if ($original_type === 2) {
        $imgt = "ImageJPEG";
        $imgcreatefrom = "ImageCreateFromJPEG";
    } else if ($original_type === 3) {
        $imgt = "ImagePNG";
        $imgcreatefrom = "ImageCreateFromPNG";
    } else {
        return false;
    }
    $old_image = $imgcreatefrom($filepath);
    $new_image = imagecreatetruecolor($thumbnail_width, $thumbnail_height); // creates new image, but with a black background
    // figuring out the color for the background
    if(is_array($background) && count($background) === 3) {
        list($red, $green, $blue) = $background;
        $color = imagecolorallocate($new_image, $red, $green, $blue);
        imagefill($new_image, 0, 0, $color);
        // apply transparent background only if is a png image
    } else if($background === 'transparent' && $original_type === 3) {
        imagesavealpha($new_image, TRUE);
        $color = imagecolorallocatealpha($new_image, 0, 0, 0, 127);
        imagefill($new_image, 0, 0, $color);
    }
    imagecopyresampled($new_image, $old_image, $dest_x, $dest_y, 0, 0, $new_width, $new_height, $original_width, $original_height);
    $imgt($new_image, $thumbpath);
    return file_exists($thumbpath);
}
//функция проверки загрузки и вывода сообщения со статусом
function checkUpload(){
    $upload_message = $_FILES['userfile']['error'];
    switch ($upload_message) {
        case 0:
            $message = 'OK';
            break;
        case 1:
            $message = "Размер принятого файла превысил максимально допустимый размер, который задан директивой upload_max_filesize конфигурационного файла php.ini.";
            break;
        case 2:
            $message = "Размер загружаемого файла превысил значение MAX_FILE_SIZE, указанное в HTML-форме.";
            break;
        case 3:
            $message = "Загружаемый файл был получен только частично.";
            break;
        case 4:
            $message = "Файл не был загружен.";
            break;
        case 6:
            $message = "Отсутствует временная папка.";
            break;
        case 7:
            $message = "Не удалось записать файл на диск.";
            break;
        case 8:
            $message = "PHP-расширение остановило загрузку файла. PHP не предоставляет способа определить какое расширение остановило загрузку файла; в этом может помочь просмотр списка загруженных расширений из phpinfo().";
            break;
        default:
            $message = "Unknown upload error";
            break;
    }
    return $message;
}