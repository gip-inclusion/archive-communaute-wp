# itou-communaute dockerized

## Lancer docker-compose
`docker-compose up`
- WordPress tourne sur `localhost:8000`.
- PMA tourne sur `localhost:8887`
- Mailhog tourne sur `localhost:8025` (UI) et `localhost:1025` (SMTP)

## Environnement
- PHP : 7.4
- Apache
- MariaDB (local) / MySQL (CC)

## Update db, si besoin
`docker exec -i $(docker-compose ps -q db) mysql -umysql -ppassword wordpress < ./docker/sql/dump.sql`. Vous pouvez aussi utiliser PHPMyAdmin pour importer le dump.
 
## Deploy
Pour mettre à jour les environnements CC à partir du dépot :
- les envs CC ne récupèrent pas automatiquement à partir des branches correspondantes
- il faut pousser directement sur les machines souhaitées
- `origin` devrait continuer de pointer sur Github

### Exemple
- pour le staging : `git push {staging} staging:master`, où `{staging}` correspond au nom du dépôt distant du staging CC tel que défini sur votre machine (exemple : `git remote add clever-cloud-staging git@git.services.clever-cloud.com/projet-staging.git`), et `staging:master` indique de pousser la branche locale `staging` sur la branche distante `master`
- pour la prod : `git push {prod}`, où `{prod}` correspond au nom du dépôt distant du staging CC tel que défini sur votre machine (exemple : `git remote add clever-cloud-prod git@git.services.clever-cloud.com/projet-prod.git`)

## Mise à jour du projet
1. récupérer un dump de la prod (=> Scaleway)
2. passer le projet local sur la branche `staging`
3. mettre à jour WP + plugins en local
4. vérifier que tout tourne (vraisemblablement) en local
5. pousser sur staging
6. pousser en prod

## Thème Buddyboss child
- le C3 utilise un thème enfant, pour surcharger le thème Buddyboss en toute sécurité : https://codex.wordpress.org/fr:Th%C3%A8mes_Enfant
- ce thème :
  - surcharge des templates (wp-content/themes/buddyboss-theme-child)
  - ajoute des assets CSS/JS (wp-content/themes/buddyboss-theme-child/assets)
  - ajoute des filtres et actions (wp-content/themes/buddyboss-theme-child/includes) appelées via `functions.php`

## Debuggage
En local, avec Docker, `WP_Debug` est activé :
- une fonction `logger()` existe et écrit dans `wp-content/debug.log`, ignoré du dépot

## ⚠️ Attention ⚠️
- l'envoi de mails / l'ajout de mail à la file gérée par buddyboss est très instable, et peut donner lieu à des milliers de requêtes extrêmement lentes faisant planter le serveur (timeout). En particulier, l'envoi de messages entre membres d'un même groupe a été désactivé et ne devrait pas être activé à nouveau
- en local, via Docker, nous utilisons une base MariaDB (pour des raisons de compatibilité / performance avec les processeurs Apple M1 
😥) alors que les envs CC utilisent des bases MySQL (il n'y a pas de MariaDB chez CC). A priori, il ne devrait pas y avoir de différences de comportement entre les deux, mais...
- en cas de MAJ du projet, et notamment du thème Buddyboss et des plugins Elementor : 
  - la MAJ de DB proposée par Elementor suite à une mise à jour n'est généralement pas compatible avec la version précédente du plugin (et des contenus qu'il a créé) : si la MAJ de la DB demandée par Elementor est faite, il ne sera pas possible de revenir à la version précédente du plugin sans remettre la DB dans son état initial
  - en cas de MAJ, les pages à tester en priorités sont les pages de formulaire de contact support : `/aide/emplois`, `/aide/communaute`, `/aide/marche`, `/aide/pilotage`
