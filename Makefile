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
