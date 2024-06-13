# ============= #
# Vérifications #
# ============= #
check: ## Vérification de la qualité et de la cohérence du code
	composer check

csfix: ## Correction (automatique) de la qualité du code
	composer fix

# ===================== #
# Mise à jour du projet #
# ===================== #
update: ## Met à jour le projet avec les informations de composer.lock (ne les met pas à jour)
	composer install

upgrade: ## Met à jour le projet avec les informations de composer.json (met à jour le composer.lock)
	composer update

entity: ## Création d'une entité ou modification d'une entité
	php bin/console make:entity

migration: ## Génération d'une migration avec les changements des entités
	php bin/console make:migration

migrate: ## Exécution des migrations
	php bin/console doctrine:migrations:migrate

db.recreate: db.drop db.create migrate

db.drop:
	php bin/console doctrine:database:drop -f

db.create:
	php bin/console doctrine:database:create

