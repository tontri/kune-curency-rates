# Kuna exchange rates

Проект предоставляет RESTfull Api для отображения котировок биржи Kuna.


### Prerequisites

Для установки и запуска проекта понадобиться Docker

```
Give examples
```

### Installing

Клонируем (или скачиваем) репозиторий:
```
git clone https://github.com/tontri/kune-curency-rates.git
```

Подтягиваем образы:
```
docker-compose pull
```

Билдим:
```
docker-compose build
```

Запускаем контейнеры:
```
docker-compose up -d
```
Дання команда запускает 3-и контейнера: php, api, maria-db 

## Run and use
После запуска всех контейнеров контейнеров, можно воспользоваться web интерфейсом для тестирования:
```
http://localhost:8888/
```
По умолчанию, котировки подтягиваются каждую минуту. 
Для того, что бы просмотреть котировки, нужно выбрать первый в списке метод:

```
GET ​/ohlc_tracks
```
И передаеть ему параметры:
* symbol - валютная пара. Возможные значения: btcusd, btcuah, btcrub 
* startDate - начало периода. Пример: 2020-04-12 
* endDate - окончание периода. Пример: 2020-04-15


## Built With

* [Symfony](http://symfony.com/) - The web framework used
* [API-Platform](http://api-platform.com/) - The web framework used

