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

- Dans le dossier Controller, rajouter un dossier "Front"
- Créer dans le dossier "Front" le controller: FrontController
- Ajouter une route "/" correspondant à la page d'accueil
  de la pizzeria.
  Cette page d'accueil doit lister toutes les pizzas de la pizzeria
- Ajouter une page "contact" affichant le numéro de téléphone
  et l'emplacement (google map) de la pizzeria.
- Grace à une entité de votre choix, rendre éditable la numéro
  de téléphone et l'emplacement de la pizzeria
- Vous pouvez rajouter du style pour votre pizzeria :)

# Exo - Panier

- Ajouter la possibilité d'ajouter une pizza dans un panier
  (utiliser la session, et faire une route dédié à l'ajout
  dans le panier)
- Ajouter une route "/mon-panier" qui affiche toutes les pizzas
  de mon panier avec leurs totaux et le prix total de mon panier.
- Ajouter une route "/supprimer-panier/{id}" qui supprime totalement
  une pizza du panier
- Ajouter une route "/modifier-panier/{id}/{quantite}" ici on change
  la quantité de la pizza à l'id donnée

# Exo - Formulaires

- Créer un "form type" pour l'entité pizza (`symfony console make:form Pizza`).
- Personaliser ce form type pour contenir les bons champs et un bouton d'envoie
- Utiliser ce formulaire dans la page PizzaAdminController::create
- Utiliser ce formulaure dans la page PizzaAdminController::update
- Créer une page "/nous-contacter" dans le front controller
- Créé un formulaire de contact avec les champs suivant:
  - email (email)
  - message (textarea)
- Enregistré le message de contact dans la base de données :)

# Exo - Relation 1

- Créer une entité Ingredient avec les champs suivant:
  - name: string
  - price: float
- Attacher la pizza à l'ingredient en utilisant la commande
  `symfony console make:entity Pizza`
- Mettre à jour la base de données `symfony console doctrine:schema:update --force`
- Créer le controller suivant : IngredientAdminController
- Ajouter les méthodes suivantes:

  - list
  - create
  - update
  - remove
  - (Utiliser les formulaires symfony pour "create" et "update")

- Ajouter une entité "boisson" (traduire en anglais) ainsi que
  "entrée" et "dessert"
- ces entités doivent contenir les champs suivant:
  - name: string
  - price: float
  - image: string
- Créer 3 controllers dans le répertoire Admin et mettre
  en place les mêmes routes que pour les pizzas et ingrédients
  (create, update, list et remove)
  (Utiliser aussi les formulaires symfony !)
