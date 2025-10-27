# BudgetManager

## Aperçu
BudgetManager est une application Laravel destinée au pilotage budgétaire d'une organisation. Ce dépôt a été mis à jour pour fonctionner avec **Laravel 6 LTS** et nécessite désormais **PHP 7.4** ou supérieur.

## Configuration requise
- PHP ^7.4 avec les extensions `openssl`, `pdo`, `mbstring`, `tokenizer`, `xml`, `ctype`, `json`, `fileinfo`
- Composer 2
- Node.js 16+ et Yarn / NPM pour la partie front
- Base de données MySQL 5.7/8 ou PostgreSQL 11+

## Installation rapide
1. Cloner le dépôt puis installer les dépendances PHP (un nouveau `composer.lock` sera généré lors de cette étape) :
   ```bash
   composer install
   ```
2. Installer les dépendances front :
   ```bash
   yarn install # ou npm install
   ```
3. Dupliquer le fichier d'environnement et ajuster les valeurs :
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```
4. Configurer la base de données dans `.env`, puis appliquer les migrations :
   ```bash
   php artisan migrate
   ```
5. (Optionnel) Compiler les assets :
   ```bash
   yarn dev
   ```

## Audit rapide
- **Dépendances** : passage à Laravel 6 LTS, mise à jour de DomPDF, ajout des helpers Laravel et adoption des composants modernes (Ignition, PHPUnit 8, Collision 3).
- **Configuration** : harmonisation des fichiers de configuration (`cache`, `session`, `queue`, `database`, `mail`, `services`, etc.) avec les conventions récentes de Laravel et adoption des nouvelles variables d'environnement.
- **Code** : ajustements pour PHP 7.4 (`Throwable`, `Str::random`, casts Eloquent) et durcissement de la gestion d'erreurs JSON et d'authentification.
- **Qualité** : nouveau `phpunit.xml` configuré pour SQLite en mémoire, localisation par défaut en français et activation d'un niveau de logs configurable.

## Fonctionnalités suggérées
1. **Tableau de bord analytique** : visualisation dynamique (graphiques et KPIs) des réalisations versus prévisions pour chaque exercice.
2. **Workflow de validation** : système d'approbation multi-niveaux pour les prévisions et dépenses avec notifications par e-mail.
3. **API REST sécurisée** : exposition d'endpoints documentés (OpenAPI) pour l'intégration avec des outils tiers ou un futur front-end mobile.
4. **Automatisation des imports** : planification CRON pour importer automatiquement les feuilles Excel déposées dans un répertoire dédié.
5. **Suivi des anomalies** : module de reporting des écarts budgétaires avec génération automatique de rapports PDF et export Excel.

## Tests
L'exécution de la suite de tests nécessite que les dépendances Composer soient installées :
```bash
phpunit
```

Pensez à lancer `php artisan config:cache` et `php artisan optimize` après configuration pour de meilleures performances en production.
