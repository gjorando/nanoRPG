# ηRPG
ηRPG (nanoRPG) est un projet de **DUT Info AS**.

## Description

Il s'agit d'un système en ligne pour créer et jouer à des RPG texte simplistes. Pour la partie jeu : gestion des tableaux, des quêtes, des PNJs, système d'invite de commande pour saisir les actions. Pour la partie création : créer des tableaux, des quêtes, des PNjs, partager sa création, etc.

## Cahier des charges

- Espace membre en deux parties.
  - Partie joueur, qui donne accès à une bibliothèque de jeux, qu'on peut enrichir en saisissant l'id du jeu d'un autre joueur.
  - Partie créateur, qui donne accès à la liste de projets, qui permet de les éditer, les supprimer, ou d'en ajouter.
  - Parties communes : pseudo, avatar, genre, description courte de l'utilisateur, mail et mot de passe.
- Fonctionnalités de base d'un RPG textuel.
  - Navigation entre les différents tableaux
  - Gestion des PNJs
  - Gestion des quêtes
  - Gestion de l'inventaire
  - Gestion simplifiée du levelling.
  - Système basé sur des jets de dé.
  - Gestion de sauvegarde (une sauvegarde par jeu et par joueur).
  - Toutes ces fonctionnalités seront gérées dans la partie création et dans la partie jeu.
- Interface.
  - Edition avec un système de listes montrant les relations entre les tableaux, les parties d'une quête, etc.
  - Interface de jeu constituée d'un invite de commande.

## Base de données TODO

#### Données d'un jeu

- maps : stocke les informations sur un tableau
  - #id
  - *id_game* : réfère à un games.id
- map\_descriptions : stocke les descriptions d'une map à différents états
  - #id
  - *id_map* : réfère à un maps.id
  - state : 0 pour définir l'état par défaut, une autre valeur pour un autre état
  - content : contenu de la description
- map\_directions : stocke les directions que l'on peut prendre quand on est sur une map (directions dans un seul sens, permet ainsi de faire des passages à sens unique)
  - #id
  - *id_map* : réfère à un maps.id (origine de la direction)
  - direction\_name : nom de la direction
  - direction\_description : une courte description de la direction
  - *id_destination* : réfère à un maps.id (destination de la direction)
  - *id_double_sens* : réfère à un map\_directions.id (stocke l'id de la direction inverse si elle existe, vaut null sinon)

#### Données d'une sauvegarde

- libraries : stocke les informations sur la bibliothèque d'un joueur
  - #id
  - *id_user* : réfère à un users.id
  - *id_game* : réfère à un games.id
  - last\_played : date de dernière exécution
- game\_saves : stocke les informations sur une sauvegarde
  - #id
  - *id_library* : réfère à un libraries.id
- save\_players : stocke les informations sur le joueur
  - *id_save* : réfère à un game\_saves.id
  - *id_pos* : réfère à un maps.id
  - name : nom du joueur
- save\_map  : stocke les informations sur l'état d'une map dans une sauvegarde
  - *id_save* : réfère à un game\_saves.id
  - *id_map* : réfère à un maps.id
  - *id_state* : réfère à un map\_descriptions.id

TODO
