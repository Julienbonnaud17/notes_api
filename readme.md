# Symfony Notes API

Une API RESTful simple pour gérer des notes (CRUD) écrite avec **Symfony 7.3** et **Doctrine ORM**. Destinée à servir de backend pour une application front‑end (ex. Next.js).

## Sommaire

1. [Installation](#installation)
2. [Configuration](#configuration)
3. [Commandes utiles](#commandes-utiles)
4. [Routes de l’API](#routes-de-lapi)

---

## Installation

```bash
# 1. Cloner le repo
git clone https://github.com/Julienbonnaud17/symfony-notes-api.git
cd symfony-notes-api

# 2. Installer les dépendances PHP
composer install

# 3. Copier le fichier d’exemple d’environnement
cp .env .env.local

# 4. Créer la base de données + migrations
php bin/console doctrine:database:create
php bin/console doctrine:migrations:migrate
```

---

## Configuration

Dans `.env.local`, ajustez la chaîne de connexion :

```dotenv
###> doctrine/doctrine-bundle ###
DATABASE_URL="mysql://root:@127.0.0.1:3306/notes_api?"
###< doctrine/doctrine-bundle ###
```

> 💡 Placez vos variables sensibles (*passwords*, clés API…) **uniquement** dans `.env.local`.

---

## Commandes utiles

| Action                                | Commande                          |
| ------------------------------------- | --------------------------------- |
| Lancer le serveur local (Symfony CLI) | `symfony serve`                   |
| Lancer le serveur PHP intégré         | `php -S localhost:8000 -t public` |
| Générer une entité                    | `php bin/console make:entity`     |
| Générer un contrôleur                 | `php bin/console make:controller` |
| Exécuter les tests                    | `php bin/phpunit`                 |

---

## Routes de l’API

| Méthode | URL               | Description                   |
| ------- | ----------------- | ----------------------------- |
| GET     | `/api/notes`      | Récupère **toutes** les notes |
| GET     | `/api/notes/{id}` | Récupère une note par ID      |
| POST    | `/api/notes`      | Crée une nouvelle note        |
| PUT     | `/api/notes/{id}` | Met à jour une note existante |
| DELETE  | `/api/notes/{id}` | Supprime une note par ID      |

Structure JSON d’une note :

```json
{
  "id": 1,
  "title": "Titre de la note",
  "content": "Contenu riche…",
  "createdAt": "2025-05-29T12:34:56+00:00",
  "updatedAt": "2025-05-29T12:34:56+00:00"
}
```
