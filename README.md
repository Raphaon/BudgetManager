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

## Fonctionnalités essentielles
1. **Visibilité en temps réel** : accès immédiat à l'état des budgets et des flux financiers afin d'éviter les retards ou mauvaises surprises.
2. **Comparaison réel/prévisionnel** : outil pour confronter dépenses et recettes réelles aux prévisions, analyser les écarts et ajuster la stratégie.
3. **Planification budgétaire** : création et gestion de budgets par catégorie, projet ou service, avec simulation de scénarios pour anticiper les évolutions.
4. **Rapports et analyses avancés** : génération de tableaux de bord, graphiques et rapports personnalisés pour interpréter les données financières et décider rapidement.
5. **Alertes et contrôle des dépassements** : signalement automatique en cas de risque ou de dépassement budgétaire, notamment lors des processus d'approbation.
6. **Sécurisation des données** : protection des informations personnelles et comptables grâce à des protocoles et outils robustes.
7. **Synchronisation bancaire** : intégration directe avec les comptes bancaires pour une mise à jour automatique et fiable des mouvements et soldes.
8. **Interface intuitive et personnalisable** : facilité d'utilisation, adaptation à la structure de l'organisation et compatibilité avec les outils existants.
9. **Gestion des factures et devis** : suivi des engagements, factures, impayés et relances pour maîtriser les dépenses et la trésorerie.
10. **Scénarios et prédictions** : anticipation des évolutions, prévision de trésorerie et révisions dynamiques du budget.
11. **Mobile et collaboration** : accès via application mobile ou web pour suivre et valider les demandes, collaborer avec les équipes et garantir la continuité opérationnelle.

## API d'analyse budgétaire

L'API REST fournit des points d'accès permettant d'exploiter ces fonctionnalités au travers d'intégrations tierces :

| Méthode | Route | Description |
| --- | --- | --- |
| `GET` | `/api/budget/snapshot?exercice=2024&as_of=2024-03-31` | Retourne un instantané temps réel (prévision, réalisé, reste à consommer, projection annuelle, ventilation mensuelle). |
| `GET` | `/api/budget/comparison?exercice=2024&start=2024-01-01&end=2024-03-31` | Compare réalisé vs prévision pour chaque poste et calcule écarts et taux de réalisation. |
| `POST` | `/api/budget/scenario` | Simule des ajustements (`adjustments` JSON) pour piloter la planification budgétaire et mesurer l'impact d'hypothèses. |
| `GET` | `/api/budget/alerts?exercice=2024&threshold=1.0` | Signale automatiquement les dépassements de prévision avec un niveau de sévérité. |
| `GET` | `/api/budget/report?exercice=2024` | Génère un rapport consolidé (snapshot, comparatif, alertes, top écarts) pour alimenter tableaux de bord et exports. |

Les dates (`start`, `end`, `as_of`) doivent être fournies au format ISO (`YYYY-MM-DD`). Les ajustements d'un scénario peuvent être transmis sous forme de tableau associatif (`{"601": 20000}`) ou de tableau d'objets (`[{"num_compte": "601", "delta": 20000}]`).

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
