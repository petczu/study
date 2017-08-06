<?php
/**
 * User: PETCZU
 * Date: 04.08.17
 * Time: 15:13
 */
require __DIR__ . '/models/photo.php';
require __DIR__ . '/functions/file.php';

session_start();

define("UPLOAD_DIR", __DIR__ . '/img/');
if ($_FILES['userfile']['error'] == 0) {
    $allowed_file_ext = ['image/gif', 'image/jpeg', 'image/png'];
    if (in_array(mime_content_type($_FILES['userfile']['tmp_name']), $allowed_file_ext) && in_array($_FILES['userfile']['type'], $allowed_file_ext)) {
        //тут скрипт
        $name = preg_replace("/[^A-Z0-9._-]/i", "_", $_FILES['userfile']['name']);
        $i = 0;
        $file_pathinfo = pathinfo($name);
        while (file_exists(UPLOAD_DIR . $name)) {
            $i++;
            $name = $file_pathinfo['filename'] . "-" . $i . "." . $file_pathinfo['extension'];
        }
        $title = $_POST['title'];
//отправляем файл на сервер
        $upload = move_uploaded_file($_FILES['userfile']['tmp_name'], UPLOAD_DIR . $name);
//ошибка перемещения файла
        if (!$upload) {
            $_SESSION['movefile_message'] = 'Ошибка. Не возможно сохранить файл';
//            header('Location: index.php');
//            exit;
        }
//устанавливаем права на файл
        chmod(UPLOAD_DIR . $name, 0644);
//записываем в базу
        Photo_Upload($name, $title);
        createThumbnail(UPLOAD_DIR . $name, UPLOAD_DIR . 'small/' . $name, 100, 100, [255,255,255]);
        $_SESSION['movefile_message'] = 'Файл успешно загружен';
//        header('Location: index.php');
//        exit;
    } else {
        //ошибка - не верный формат файла
        $_SESSION['movefile_message'] = 'Ошибка. Файл должен быть с расширением JPG, JPEG, PNG, GIF';
//        header('Location: index.php');
//        exit;
    }
} else {
    //ошибка из формы
    $_SESSION['movefile_message'] = checkUpload();
//    header('Location: index.php');
//    exit;
}