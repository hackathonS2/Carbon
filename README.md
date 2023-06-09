### Getting started

```bash
docker compose build --pull --no-cache
docker compose up -d
docker compose exec php yarn install
docker compose exec php yarn run build
docker compose exec php bin/console make:mig
docker compose exec php bin/console d:m:m
docker compose exec php bin/console d:f:l --no-interaction
docker compose exec php bin/console d:s:u --dump-sql
```

# URL

<http://127.0.0.1:80>

# COMPTE D'ACCES PAR ROLES

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

# Listing des Fonctionnalités 

Cornelius:

- Consultant Evaluation
- Consultant Formation
- Consultant Mission
- Administration Gestion Utilisateur
- Consultant Homepage
- Administration Acces Missions Consultant
- Feedback Client Sur Mission
- Front-End
- Fixtures
- Sécurité 
- Debug 
- Conception BDD 

Mustapha:

- Administration Homepage
- Administration Gestion Utilisateur
- Administration Gestion Profil
- Front-End 
- Consultant Homepage
- Search Bar DQL
- Video
- Conception BDD 

Chaochao:

- Administration Gestion Utilisateur 
- Administration Gestion Technologie
- Administration Gestion Test et Les Tests Passé
- Front-End
- Consultant Liste User
- Consultant Liste des test
- Consultant Passé un test
- Sécurité 
- Conception BDD 

Ronan:

- Docker 
- Front-End 
- Search Bar
- Admin Liste User
- Admin Liste Consultant
- Gestion de Tâche
- Gestion d'Equipe
- Debug
- README
- Planning
- CI/CD not working

## Contributors

* **Chaochao ZHOU** - [Chaochao-z](https://github.com/Chaochao-z)
* **Mustapha BOUKHATEM** - [Mousse57](https://github.com/Mousse57)
* **Cornelius Jugal MBOUOPDA NDEFFO** - [corneliusthefirst](https://github.com/corneliusthefirst)
* **Ronan TROUILLARD** - [ronantr](https://github.com/ronantr)