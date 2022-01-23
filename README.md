# Простой FlashAlert который работает через сессии


## Подключение
```php 
require_once('FlashAlert.php');
```

## Использование
```php
session_start();
$flash_alert = new FlashAlert();
```
Компонент работает на базе стилей bootstrap, поэтому если вы его не используете, его нужно подключить

```php
echo $flash_alert->get_link_bootstrap5();
``` 
Можно использовать все знакомые классы alert из bootstrap
('primary', 'secondary', 'success', 'danger', 'warning', 'info', 'light', 'dark' ) 
Для сохранение сообщение можно использовать метод set, передавая ему параметры $type (тип ) и message(сообщение):
```php
$flash_alert->set('success','привет');
$flash_alert->set('danger','опасно');
$flash_alert->set('primary','primary');
$flash_alert->set('secondary','secondary');
$flash_alert->set('info','info');
$flash_alert->set('warning','warning');
$flash_alert->set('light','light');
```
или так:
```php
$flash_alert->success = 'привет';
```
Если передавать несколько раз одинаковый тип сообщения, все будут сохранятся и выводится в одном сообщении, 
если в этом нет необходимости, добавляем праметр rewrite = true

```php
$flash_alert->set('success','привет');
$flash_alert->set('success','пока' );
$flash_alert->set('success','Я перезаписал "привет" и "пока", потому-что добавил параметр rewrite true',true );
```
чтобы вывести сообщения одного типа, используем метод get
```php
echo $flash_alert->get('success');
```
или так
```php
echo $flash_alert->'success';
```
вывести несколько типов сообщении:
```php
echo $flash_alert->get(['success','danger', 'info']);
```
вывести все сообщения:
```php
echo $flash_alert->get();
```
Удалить все записанные в сессии сообщения можно по аналогии с get, только использовать нужно метод delete:
```php
$flash_alert->delete('success');//удалить один конкретный тип
$flash_alert->delete(['success','danger', 'info']);//удалить несколько типов
$flash_alert->delete();//удалить все
```
