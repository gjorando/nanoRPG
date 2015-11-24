# ηRPG
ηRPG (nanoRPG) est un projet de **DUT Info AS**.

## Description

Il s'agit d'un système en ligne pour créer et jouer à des RPG texte simplistes. Pour la partie jeu : gestion des tableaux, des quêtes, des PNJs, système d'invite de commande pour saisir les actions. Pour la partie création : créer des tableaux, des quêtes, des PNjs, partager sa création, etc.

## Cahier des charges

- Espace membre en deux parties.
  - Partie joueur, qui donne accès à une bibliothèque de jeux, qu'on peut enrichir en saisisaant l'id du jeu d'un autre joueur.
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

## Arborescence du projet

./
- img/
  - \*.png
- Les contrôleurs (appelle les modèles et traite les résultats avant de les envoyer à la vue)
- model/
  - les modèles (fonctions faisant appel à la base de données, entres autres)
- view
  - les vues (partie HTML avec inclusion des données traitées par le contrôleur)
  - css/
    - \*.css
    - font/
      - \*.ttf
    - img/
      - \*.png
