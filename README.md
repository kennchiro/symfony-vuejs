# https://mdprog.com/
## Info perso
- mail: razafimaharolazaniainaelie@gmail.com
- tel: +261 34 75 023 91 

## Prerequises

- Install Docker
- Install `docker-compose`

## Installation project
```shell
composer install
npm install
mkdir -p config/jwt
openssl genpkey -out config/jwt/private.pem -aes256 -algorithm rsa -pkeyopt rsa_keygen_bits:4096
openssl pkey -in config/jwt/private.pem -out config/jwt/public.pem -pubout
```
## Launch project
```shell
docker-compose up or docker-compose up -d
yarn watch
```
## Data fixtures
```shell
docker-compose exec apache bash
php bin/console doctrine:fixtures:load
```
```
