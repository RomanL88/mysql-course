<?php
/*Для создания подключения нужно создать новый объект класса PDO. 

В качестве аргументов в конструктор нужно передать DSN - это строка с указанием драйвера 
(в нашем случае - mysql), адресом хоста и именем базы данных. 

Второй аргумент - имя пользователя (в нашем случае - root). 

Третий - пароль (в нашем случае пустой).
 */

//ПОДКЛЮЧЕНИЕ
$dbh = new \PDO(
    'mysql:host=localhost;dbname=my_db;',
    'root',
    ''
);

//КОДИРОВКА

$dbh->exec('SET NAMES UTF8');

//ЗАПРОСЫ
/*
$stm = $dbh->prepare('INSERT INTO users (`email`, `name`) VALUES (:email, :name)');
$stm->bindValue('email', 'x100@php.zone');
$stm->bindValue('name', 'Вячеслав');
$stm->execute();
*/

//Выборка из базы с помощью PHP

//прочитаем данные, которые мы записали
$dbh = new \PDO('mysql:host=localhost;dbname=my_db;', 'root', '');
$dbh->exec('SET NAMES UTF8');
//$stm = $dbh->prepare('SELECT * FROM `users`');
$stm = $dbh->prepare('SELECT * FROM `users` WHERE name=:name');
$stm->bindValue('name', 'Иван');

$stm->execute();
//получить результат

$allUsers = $stm->fetchAll();
?>
<table border="1">
    <tr>
        <td>id</td>
        <td>Имя</td>
        <td>Email</td>
    </tr>
    <?php foreach ($allUsers as $user) : ?>
        <tr>
            <td><?= $user['id'] ?></td>
            <td><?= $user['name'] ?></td>
            <td><?= $user['email'] ?></td>
        </tr>
    <?php endforeach; ?>
</table>