### Getting started

```bash
docker compose build --pull --no-cache
docker compose up -d
docker compose exec php bin/console make:mig
docker compose exec php bin/console d:m:m
docker compose exec php bin/console d:f:l --no-interaction
docker compose exec php bin/console d:s:u --dump-sql
docker compose exec php bin/console doctrine:fixtures:load
```

# URL
http://127.0.0.1

# Env DB
DATABASE_URL="postgresql://postgres:password@db:5432/db?serverVersion=13&charset=utf8"
