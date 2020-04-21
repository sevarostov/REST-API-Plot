# REST-API-Plot
REST API Plot to server http://pkk.bigland.ru/api/test/plots
Project is on Symfony 3.4 framework

# Данные по земельным участкам
Поиск данных по одному или нескольким земельным участкам, реализованный в виде обращения к  
REST API сервиса http://pkk.bigland.ru/api/test/plots

## Установка
git clone ...

UBUNTU:
    Для установки необходимы:
        php7.2-xml php7.2-zip php-mysql

    В mysql:
        GRANT ALL PRIVILEGES ON plot.* To 'plot'@'localhost' IDENTIFIED BY 'plot';

    Сделать владелцем директории с проектом пользователя www-data:
        sudo chown -R www-data plot/

php -d memory_limit=-1 `which composer` -vvv update
php bin/console doctrine:schem:upd --dump-sql --force
mysql -pXXX plot < plot.sql

Скопировать файлы из vendor.custom/* в vendor/*
