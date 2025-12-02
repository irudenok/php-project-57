# Менеджер задач

### Hexlet tests and linter status:
[![Actions Status](https://github.com/irudenok/php-project-57/actions/workflows/hexlet-check.yml/badge.svg)](https://github.com/irudenok/php-project-57/actions)

[![Quality Gate Status](https://sonarcloud.io/api/project_badges/measure?project=irudenok_php-project-57&metric=alert_status)](https://sonarcloud.io/summary/new_code?id=irudenok_php-project-57)
[![Bugs](https://sonarcloud.io/api/project_badges/measure?project=irudenok_php-project-57&metric=bugs)](https://sonarcloud.io/summary/new_code?id=irudenok_php-project-57)
[![Code Smells](https://sonarcloud.io/api/project_badges/measure?project=irudenok_php-project-57&metric=code_smells)](https://sonarcloud.io/summary/new_code?id=irudenok_php-project-57)
[![Coverage](https://sonarcloud.io/api/project_badges/measure?project=irudenok_php-project-57&metric=coverage)](https://sonarcloud.io/summary/new_code?id=irudenok_php-project-57)
[![Duplicated Lines (%)](https://sonarcloud.io/api/project_badges/measure?project=irudenok_php-project-57&metric=duplicated_lines_density)](https://sonarcloud.io/summary/new_code?id=irudenok_php-project-57)
[![Lines of Code](https://sonarcloud.io/api/project_badges/measure?project=irudenok_php-project-57&metric=ncloc)](https://sonarcloud.io/summary/new_code?id=irudenok_php-project-57)
[![Reliability Rating](https://sonarcloud.io/api/project_badges/measure?project=irudenok_php-project-57&metric=reliability_rating)](https://sonarcloud.io/summary/new_code?id=irudenok_php-project-57)
[![Security Rating](https://sonarcloud.io/api/project_badges/measure?project=irudenok_php-project-57&metric=security_rating)](https://sonarcloud.io/summary/new_code?id=irudenok_php-project-57)
[![Technical Debt](https://sonarcloud.io/api/project_badges/measure?project=irudenok_php-project-57&metric=sqale_index)](https://sonarcloud.io/summary/new_code?id=irudenok_php-project-57)
[![Maintainability Rating](https://sonarcloud.io/api/project_badges/measure?project=irudenok_php-project-57&metric=sqale_rating)](https://sonarcloud.io/summary/new_code?id=irudenok_php-project-57)
[![Vulnerabilities](https://sonarcloud.io/api/project_badges/measure?project=irudenok_php-project-57&metric=vulnerabilities)](https://sonarcloud.io/summary/new_code?id=irudenok_php-project-57)

Менеджер задач на Laravel - полнофункциональное веб-приложение для управления задачами, статусами и метками.

## Демо

[Ссылка на задеплоенное приложение](https://php-project-57-zdu8.onrender.com/)

## Функционал

- ✅ Аутентификация пользователей (Laravel Breeze)
- ✅ CRUD операций для статусов задач
- ✅ CRUD операций для задач
- ✅ CRUD операций для меток
- ✅ Фильтрация задач по статусу, автору и исполнителю
- ✅ Связь задач с метками (многие ко многим)
- ✅ Защита от удаления связанных ресурсов
- ✅ Flash сообщения для уведомлений пользователей
- ✅ Интеграция с Sentry для мониторинга ошибок

## Технологии

- Laravel 12
- PHP 8.4
- PostgreSQL
- TailwindCSS
- Docker

## Установка

1. Клонируйте репозиторий
2. Установите зависимости:
   ```bash
   composer install --ignore-platform-reqs
   npm install
   ```
3. Настройте `.env` файл
4. Запустите миграции и сиды:
   ```bash
   php artisan migrate
   php artisan db:seed
   ```
5. Соберите фронтенд:
   ```bash
   npm run build
   ```

## Запуск через Docker

```bash
docker-compose up -d
```

## Тестирование

```bash
php artisan test
```