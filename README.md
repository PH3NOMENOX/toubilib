# Toubilib - API de Prise de Rendez-vous Médicaux

Projet académique développé en **PHP 8** / **Slim Framework 4** suivant les principes de l'**Architecture Hexagonale (Clean Architecture)** et conteneurisé avec **Docker**.

---

## 🏗️ Architecture du Projet

Le projet adopte une séparation stricte des responsabilités :

```text
toubilib/
├── app/
│   ├── config/             # Configuration de l'application & conteneur d'injection de dépendances (PHP-DI)
│   ├── public/             # Point d'entrée de l'application (index.php)
│   ├── sql/                # Scripts SQL de structure et données initiales
│   ├── src/
│   │   ├── domain/         # Entités métiers pures & règles métier (RendezVous, Patient, Praticien)
│   │   ├── application/    # Cas d'utilisation (Use Cases), DTOs, interfaces (Ports API et SPI)
│   │   └── adapters/       # Implémentations concrètes (Actions Slim HTTP, Repositories PDO)
│   └── tests/              # Tests unitaires et fonctionnels (Pest / PHPUnit)
├── bruno/                  # Collection de requêtes API Bruno
├── build/                  # Configuration et Dockerfile pour PHP-CLI
├── sql/                    # Données et schémas SQL pour l'initialisation PostgreSQL
├── docker-compose.yml      # Orchestration des conteneurs Docker (API, PostgreSQL, Adminer)
└── toubilib.env.dist       # Modèle de variables d'environnement
```

---

## 🚀 Démarrage Rapide

### 1. Prérequis
- [Docker](https://www.docker.com/) & Docker Compose

### 2. Configuration de l'environnement
Copier le fichier modèle de configuration :
```bash
cp toubilib.env.dist toubilib.env
```

### 3. Lancement des conteneurs
Démarrer l'ensemble des services via Docker Compose :
```bash
docker compose up -d --build
```

Les services disponibles :
- **API Toubilib** : [http://localhost:7080](http://localhost:7080)
- **Base de données PostgreSQL** : port `5532`
- **Interface Adminer (BDD)** : [http://localhost:8880](http://localhost:8880)

---

## 🧪 Tests

Pour exécuter les tests avec Pest / PHPUnit :
```bash
docker compose exec api.toubilib vendor/bin/pest
```

---

## 🛠️ Technologies Utilisées
- **PHP 8.5**
- **Slim Framework 4**
- **PHP-DI** (Conteneur d'injection de dépendances)
- **PostgreSQL 18**
- **Pest PHP & PHPUnit**
- **Docker & Docker Compose**
