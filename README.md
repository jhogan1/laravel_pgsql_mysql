# Favorite Colors

- A color will have a color category
- A color category may have many colors
- A User may or may not have a favorite color


    - Laravel 9.52
    - PostgreSQL 15.2
    - PHP 8.1.16
    - xDebug 3.2.0
    - darkaonline/l5-swagger 8.5

## Directory Structure

### bin/ 

    Contains a bash script to use for running artisan commands

### src/

    Contains our application _(Composer installed Laravel 9.52)_

### etc/

    Contains Dockerfile/s defining container services

Local Requirements:

- Docker Desktop or equivalent
- Composer (within $PATH)
- /etc/hosts entry `127.0.0.1    local-favoritecolors.com`


From the root of your project 

`cp ./docker-compose.yml.dist ./docker-compose.yml`

`cp ./etc/fpm/conf/xdebug.ini.dist ./etc/fpm/conf/xdebug.ini`
 
`docker-compose up --build -d`

`cd src` 

Execute: 

`composer install`

`../bin/artisan migrate:fresh --seed`

`../bin/artisan l5-swagger:generate`

### Commands
_usage_
`-> src x ../bin/artisan [command]`

_example_
`-> src x ../bin/artisan l5-swagger:generate`

### Useful Aliases

    alias pr-artisan="../bin/artisan"
    alias dps="docker ps"
    alias dclog="docker-compose logs -f"
    alias dcup="docker-compose up --build -d"
    alias dcdown="docker-compose down"
