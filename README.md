<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>


- pour creer un projet laravel, on tape la commande suivante : composer create-projet laravel/laravel nom du projet

- pour demarrer le serveur, on ecrit la commande suivante : php artisan serve

- pour generer une clé de l'application : php artisan key:generate
# les caches
- vider  tous les cache: php artisan optimize:clear
- vider le cache des  routes : php artisan route: clear
.
.
.
-pour recreer les caches : php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan optimize

# les migrations
- migration de la base de données user: php artisan make:migrate create_users_table
- migration de tous les bases de données : php artisan migrate

- annuler la derniere migration:  php artisan migrate:rollback
- Reiniatiliser toutes les migrations : php artisan migrate:reset
- supprimer et recreer la base de données: php artisan migrate:fresh

# les seeders
- supprimer, recreer et executer les seeders: php artisan migrate:fresh --seed

- creer un seeder utilisateur: php artisan make:seeder UserSeeder
- Executter tous les seeders: php artisan db:seed
- executer un seul seeder: php artisan db:seed --class=userUseeder

# Les factorys
- creer un factory: php artisan make:factory userFactory

# les Models
- pour creer le model : php artisan make:model utilisateur
- creer un model avec migration : php artisan make:model utilisateur -m
- creer un model avec migration et contrioller: php artisan make:model utilisateur -mc
- creer avec tout : php artisan make:model utilisateur -a

# les controllers
 - creer un controlleur : php artisan make:controller userController
 - creer un controller ressource : php artisan make:controller userController --resource
 - creer un controller API : php artisan make:controller userController --api

 # Modèles , vue et controleur
  - creer un MVC: php artisan make:model Produit -mcr

# Middlewares
  - php artisan make:middle AdminMiddleware

# Requests(Validation)
 - php artisan make:request StoreUserRequest

# Notifications
 -php artisan make:notification Nouvellecommande

# Evenement
  - php artisan make: event UserCreated

# Listeners
 - php artisan make:listener SendEmail

# Jobs
 - php artisan make:job EnvoyerEmailJob

# Mail
 - php artisan make:mail WelcomeMail

# Storage
 - creer le lien symbolique : php artisan storage:link

 # Routes
  - lister tous les routes: php artisan route:list
# Tinker
 -ouvrir le terminal laravel : php artisan tinker

# logs
 - afficher les logd en direct : php artisan pail

# installer les dependances
  - composer install
  - mettre a jour : composer update

# installer les dependances javascript : npm install
# compiler en developpement : npm run dev
# compiler pour la production: npm run build
# lancer le serveur vite : npm run dev



# site_ecole
# site_ecole
