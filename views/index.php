<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>MVC: Photo gallery (PHP & MySQL)</title>
</head>
<body>
<?php if (!isset($_GET['id'])): ?>
<h1>Фото галлерея</h1>
<hr>
<form enctype="multipart/form-data" action="/upload.php" method="post">
    Введите название: <input type="text" name="title"> и
    <input name="userfile" id="userfile" type="file" /><br/><br/>
    <input type="submit" value="Добавить изображение" />
</form>
<br>
<font color="#ff7f50"><?php echo $_SESSION['movefile_message']; ?></font>
<hr>
Всего изображений: <?php echo count($items); ?>
<br><br>
<table border="1">
    <th>Название</th><th>Изображение</th>
<?php foreach ($items as $item): ?>
    <tr><td><?php echo $item['title']; ?></td>
    <td><a href="/?id=<?php echo $item['id']; ?>"><img src="/img/<?php echo $item['name']; ?>" width="200"></a></td></tr>
<?php endforeach; ?>
    <?php else: ?>
        <h1>Просмотр большого фото</h1>
        <?php foreach ($items as $item): ?>
            Заголовок: <b><?php echo $item['title']; ?></b><br/><br/>
            <img src="/img/<?php echo $item['name']; ?>" width="500"><br/>
            Кол-во просмотров: <?php echo $item['views']; ?><br/>
        <?php endforeach; ?>
        <a href="javascript:history.back()">Назад</a>
    <?php endif; ?>
</table>
</body>
</html>