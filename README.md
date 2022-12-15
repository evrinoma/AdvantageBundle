# Configuration

преопределение штатного класса сущности

    contractor:
        db_driver: orm модель данных
        factory: App\Advantage\Factory\AdvantageFactory фабрика для создания объектов,
                 недостающие значения можно разрешить только на уровне Mediator
        entity: App\Advantage\Entity\Advantage сущность
        constraints: Вкл/выкл проверки полей сущности по умолчанию 
        dto_class: App\Advantage\Dto\AdvantageDto класс dto с которым работает сущность
        decorates:
          command - декоратор mediator команд соц сетей 
          query - декоратор mediator запросов соц сетей
        services:
          pre_validator - переопределение сервиса валидатора соц сетей
          handler - переопределение сервиса обработчика сущностей
          file_system - переопределение сервиса сохранения файла

# CQRS model

Actions в контроллере разбиты на две группы
создание, редактирование, удаление данных

        1. putAction(PUT), postAction(POST), deleteAction(DELETE)
получение данных

        2. getAction(GET), criteriaAction(GET)

каждый метод работает со своим менеджером

        1. CommandManagerInterface
        2. QueryManagerInterface

При переопределении штатного класса сущности, дополнение данными осуществляется декорированием, с помощью MediatorInterface


группы  сериализации

    1. API_GET_ADVANTAGE, API_CRITERIA_ADVANTAGE - получение соц сети
    2. API_POST_ADVANTAGE - создание соц сети
    3. API_PUT_ADVANTAGE -  редактирование соц сети

# Статусы:

    создание:
        описание создано HTTP_CREATED 201
    обновление:
        описание обновлено HTTP_OK 200
    удаление:
        описание удалено HTTP_ACCEPTED 202
    получение:
        описание(я) найдены HTTP_OK 200
    ошибки:
        если описание не найдено AdvantageNotFoundException возвращает HTTP_NOT_FOUND 404
        если описание не уникально UniqueConstraintViolationException возвращает HTTP_CONFLICT 409
        если описание не прошло валидацию AdvantageInvalidException возвращает HTTP_UNPROCESSABLE_ENTITY 422
        если описание не может быть сохранено AdvantageCannotBeSavedException возвращает HTTP_NOT_IMPLEMENTED 501
        все остальные ошибки возвращаются как HTTP_BAD_REQUEST 400

# Constraint

Для добавления проверки поля сущности advantage нужно описать логику проверки реализующую интерфейс Evrinoma\UtilsBundle\Constraint\Property\ConstraintInterface и зарегистрировать сервис с этикеткой evrinoma.advantage.constraint.property

    evrinoma.advantage.constraint.property.custom:
        class: App\Advantage\Constraint\Property\Custom
        tags: [ 'evrinoma.advantage.constraint.property' ]

## Description
Формат ответа от сервера содержит статус код и имеет следующий стандартный формат
```text
    [
        TypeModel::TYPE => string,
        PayloadModel::PAYLOAD => array,
        MessageModel::MESSAGE => string,
    ];
```
где
TYPE - типа ответа

    ERROR - ошибка
    NOTICE - уведомление
    INFO - информация
    DEBUG - отладка

MESSAGE - от кого пришло сообщение
PAYLOAD - массив данных

## Notice

показать проблемы кода

```bash
vendor/bin/php-cs-fixer fix --config=.php-cs-fixer.dist.php --verbose --diff --dry-run
```

применить исправления

```bash
vendor/bin/php-cs-fixer fix --config=.php-cs-fixer.dist.php
```

# Тесты:

    composer install --dev

### run all tests

    /usr/bin/php vendor/phpunit/phpunit/phpunit --bootstrap src/Tests/bootstrap.php --configuration phpunit.xml.dist src/Tests --teamcity

### run personal test for example testPost

    /usr/bin/php vendor/phpunit/phpunit/phpunit --bootstrap src/Tests/bootstrap.php --configuration phpunit.xml.dist src/Tests/Functional/Controller/ApiControllerTest.php --filter "/::testPost( .*)?$/" 

## Thanks

## Done

## License

   