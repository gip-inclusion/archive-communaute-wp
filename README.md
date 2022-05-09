# itou-communaute dockerized

## Run docker-compose
`docker-compose up`
- WordPress is running on `localhost:8000`.
- PMA is running on `localhost:8887`
- Mailhog is running on `localhost:8025` (UI) and `localhost:1025` (SMTP)

## Update db
`docker exec -i $(docker-compose ps -q db) mysql -umysql -ppassword wordpress < ./docker/sql/dump.sql` or import your dump using PMA (localhost:8887)

## Update uploads
@todo


