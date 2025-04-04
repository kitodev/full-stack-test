## Requirements
- Docker

## Setup

- git clone git@github.com:kitodev/full-stack-test.git
- cd taskmanager
- cp .env.example .env
- composer install
- sail up -d
- sail composer install 
- sail artisan migrate 
- sail artisan db:seed
- sail npm install
- sail npm build

visit: http://localhost
