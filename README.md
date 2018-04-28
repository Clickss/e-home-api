# e-home-api
Back e-home Symfony4

- Cloner le projet
- composer install
- Modifier .env : 
  - Modifier la ligne : DATABASE_URL=mysql://[user]:[mdp]@127.0.0.1:3306/[dbname]
- bin/console doctrine:database:create
- bin/console doctrine:schema:create
