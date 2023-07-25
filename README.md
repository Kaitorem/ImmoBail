# immobail

Créer la BDD

```php bin/console doctrine:database:create```

Lancer les migrations

```php bin/console doctrine:migrations:migrate```

Installer les dépendances back-end

```composer install```

Installer les dépendances front-end

```yarn install```

Compiler les dépendances front-end

```yarn encore dev```

Si les pages ne s'affichent pas dans le navigateur

```composer require symfony/apache-pack```
installe le pack apach et crée un fichier .htaccess dans le dossier public/
