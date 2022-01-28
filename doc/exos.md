# Exercices

## 1. Le controller

### Exo 1. Creer la class CalculatriceController

- Dans le répertoire controller, ajouter un dossier "Exo1"
- Dans le répertoire Exo1, créer un controller "Calculatrice"

### Exo 2. Ajouter la route additionner

- Ajouter une méthode "additionner" qui accépte 2 paramètres
  de route : $x, $y et qui retourne une réponse avec le
  resultat de l'addition

### Exo 3. Ajouter la route soustraire

- Ajouter une méthode "soustraire" qui accépte 2 paramètres
  de route : $x, $y et qui retourne une réponse avec le
  resultat de la soustraction

### Exo 4. Ajouter la route multiplier

- Ajouter une méthode "multiplier" qui accépte 2 paramètres
  de route : $x, $y et qui retourne une réponse avec le
  resultat de la multiplication

### Exo 5. Ajouter la route diviser

- Ajouter une méthode "diviser" qui accépte 2 paramètres
  de route : $x, $y et qui retourne une réponse avec le
  resultat de la division

# Pizza - CRUD

- Créer une entité Pizza avec les champs suivant:

  - name: string
  - description: text
  - price: float
  - image: string

- Synchronizer votre entité avec la base de données
  (`symfony console doctrine:schema:update --force`)

- Créer un répertoire "Admin" dans le répertoire
  controller et ajouter un controller : "PizzaAdminController"

- Ajouter une route et une méthode "/admin/pizza/list". Cette
  route récupére toutes les pizzas et les affiches dans une
  page HTML (suivez au maximum les conventions de nommage, faite
  une page html simple)

- Ajouter une route et une méthode "/admin/pizza/nouvelle". Qui
  affiche un formulaire (en méthode POST) avec les champs suivants:

  - nom, description, prix et image

  créer une nouvelle pizza à partir de la Request:

  - `$request->getMethod()` : retourne la méthode (GET ou POST)
  - `$request->request->get('name')` récupére la valeur du champ
    de formulaire "name"

  Enregistrer la pizza dans la base de données en utilisant
  le manager

- Ajouter une route "/admin/pizza/{id}" qui affiche une pizza
  via une page html twig

- Ajouter une route et une méthode "/admin/pizza/{id}/modifier". Qui
  affiche un formulaire (en méthode POST) avec la possibilité de modifier
  une pizza

- Ajouter une route "/admin/pizza/{id}/delete" qui supprime
  une pizza

# Ingredient - CRUD

- Créer une entité Ingredient avec les champs suivant:

  - name: string
  - price: float
  - image: string

- Faire la même chose que les pizzas mais pour les ingrédients.
  Essayer de ne pas faire de copier/coller !

# Exo - Admin

- Utiliser l'héritage twig dans **TOUTES** les pages
  html créé précédement (pizza list, pizza show etc ...)
- Attacher et mettre en place une feuille de style
  pour l'espace d'administration :)

# Exo - Frontend

- Dans le dossier, rajouter un dossier "Front"
- Créer dans le dossier "Front" le controller: FrontController
- Ajouter une route "/" correspondant à la page d'accueil
  de la pizzeria.
  Cette page d'accueil doit lister toutes les pizzas de la pizzeria
- Ajouter une page "contact" affichant le numéro de téléphone
  et l'emplacement (google map) de la pizzeria.
- Grace à une entité de votre choix, rendre éditable la numéro
  de téléphone et l'emplacement de la pizzeria
- Vous pouvez rajouter du style pour votre pizzeria :)
- Grace à la [**session**](https://symfony.com/doc/current/session.html),
  ajouter un bouton "Ajouter au panier" sur chaque pizza
  de la page d'accueil. Lors du clique sur le bouton,
  l'identifiant de la pizza doit être enregistré en session
- Ajouter une page "mon panier" permettant de consulter toutes
  les pizzas ajouter dans votre panier
- Ajouter un bouton "commander" sur la page "mon panier" qui
  créer une commande en base de données avec les champs suivants:
  - les ids des pizzas commandé
  - l'email de la personne qui commande
  - son numéro de téléphone
  - son address postale
