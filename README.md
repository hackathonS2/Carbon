### Getting started

```bash
docker compose build --pull --no-cache
docker compose up -d
docker compose exec php yarn install
docker compose exec php yarn run dev
docker compose exec php bin/console make:mig
docker compose exec php bin/console d:m:m
docker compose exec php bin/console d:f:l --no-interaction
docker compose exec php bin/console d:s:u --dump-sql
```

# URL

<http://127.0.0.1:8080>

# COMPTE D'ACCES

admin :
- admin@admin.fr
- admin


operationnel :
- operationnel@operationnel.fr
- operationnel

consultant :
- consultant@consultant.fr
- consultant

# Env DB

DATABASE_URL="postgresql://postgres:password@db:5432/db?serverVersion=13&charset=utf8"

## Contributors

* **Chaochao ZHOU** - [Chaochao-z](https://github.com/Chaochao-z)
* **Mustapha BOUKHATEM** - [Mousse57](https://github.com/Mousse57)
* **Cornelius Jugal MBOUOPDA NDEFFO** - [corneliusthefirst](https://github.com/corneliusthefirst)
* **Ronan Trouillard** - [ronantr](https://github.com/ronantr)