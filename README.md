# e-home-api
Back e-home Symfony4

- Cloner le projet
- Aller dans le projet et faire un : composer install
- Modifier .env : 
  - Modifier la ligne : DATABASE_URL=mysql://[user]:[mdp]@127.0.0.1:3306/[dbname]
- bin/console doctrine:database:create
- bin/console doctrine:schema:create

https://drupalize.me/videos/symfony-4-routes-controllers-pages-oh-my?p=3209 (nice explenations!)