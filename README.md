<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

# Laravel Docker Starter Kit
- Laravel v11.x
- PHP v8.3.x
- PostgreSQL v16.x

# Requirements
- Stable version of [Docker](https://docs.docker.com/engine/install/)
- Compatible version of [Docker Compose](https://docs.docker.com/compose/install/#install-compose)

# How To Deploy

### For first time only !
- `git clone [PROJECT_REPOSITORY]`
- `cd laravel-docker`
- `docker compose up -d --build`
- `docker compose exec php bash`
- `chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache /var/www/storage/logs`
- `chmod -R 775 /var/www/storage /var/www/bootstrap/cache /var/www/storage/logs`
- `composer setup`

### From the second time onwards
- `docker compose up -d`

# Notes

### Laravel App
- URL: http://localhost
