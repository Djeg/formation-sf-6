# Formation Symfony

## Instruction d'installation

1. [Télécharger le projet](https://github.com/Djeg/formation-sf-6/archive/refs/heads/session/31.01.22-04.02.22.zip)
   (Vous pouvez aussi cloner le projet en utilisant git)
2. Ouvrir le projet avec vscode
3. Configurer votre base de données le ficher `.env` à la section `DATABASE_URL`
4. Installer symfony avec la commande : `composer install`
5. Créé la base de donnée avec la commande : `symfony console doctrine:database:create`
6. Créé les tables : `symfony console doctrine:schema:update --force`
7. Lancer le server symfony : `symfony serve --port=4444`

## Exercices

Vous trouverez la liste des exos [ici](./doc/exos.md)
