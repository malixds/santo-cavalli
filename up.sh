docker-compose up -d --build
docker-compose run --rm composer i
docker-compose run --rm npm install

docker-compose run --rm npm run build
docker-compose run --rm artisan migrate:fresh --seed
docker-compose run --rm artisan optimize

#docker compose exec php php artisan config:clear
#docker compose exec php php artisan cache:clear
#docker compose exec php php artisan optimize:clear

#docker exec -it postgres psql -U postgres -d postgres

#docker compose down -v


