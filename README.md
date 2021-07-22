# Nesti - Site E-Commerce

[Lien du projet](https://projets.teillieraxel.com/nesti-site-e-commerce/public/)

## Index

- [Aperçu](https://github.com/Axel-Teillier/Nesti-Site-E-Commerce/blob/master/README.md#aperçu)
- [Contexte](https://github.com/Axel-Teillier/Nesti-Site-E-Commerce/blob/master/README.md#contexte)
- [Objectif](https://github.com/Axel-Teillier/Nesti-Site-E-Commerce/blob/master/README.md#objectif)
- [Éléments significatifs](https://github.com/Axel-Teillier/Nesti-Site-E-Commerce/blob/master/README.md#éléments-significatifs)
  - [Partie technique](https://github.com/Axel-Teillier/Nesti-Site-E-Commerce/blob/master/README.md#partie-technique)
  - [Partie graphique](https://github.com/Axel-Teillier/Nesti-Site-E-Commerce/blob/master/README.md#partie-graphique)
- [Description fonctionnelle](https://github.com/Axel-Teillier/Nesti-Site-E-Commerce/blob/master/README.md#description-fonctionnelle)
- [Outils et logiciels utilisés](https://github.com/Axel-Teillier/Nesti-Site-E-Commerce/blob/master/README.md#outils-et-logiciels-utilisés)

## Aperçu

![Image Projet](https://teillieraxel.com/static/media/Nesti%20-%20site%20e-commerce.971e46e6.png)


## Contexte

  L'entreprise Nesti est une entreprise fictive ayant comme objectif de se digitaliser et ainsi développer un environnement d’e-commerce afin d’agrandir son marché. Pour ce faire, l’entreprise a fait appel à mes services afin d’obtenir un site internet vitrine de type e-commerce permettant à ses clients d’accéder à de multiples recettes de desserts et pâtisseries et d’acheter directement des ingrédients et ustensiles qui sont en lien avec ces recettes.


## Objectif

  L’objectif du projet était de développer une application web simple d’utilisation avec un design attrayant permettant d’accéder à une multitude de recettes détaillées. Le site devait également permettre à la clientèle d’acheter directement et simplement les produits mentionnés dans les recettes via un système e-commerce de commandes sécurisées.


## Éléments significatifs

### *Partie technique* 

- Utilisation du framework *CodeIgniter* et du moteur de templates *Twig*,
- La validation du payement s'effectue que si les informations bancaires renseignées par le client respectent les conditions de l’algorithme de Luhn,
- Ce projet partage la même base de données (*MySQL*) qu'un autre projet nommé [*Nesti - Site Administratif*](https://github.com/Axel-Teillier/Nesti-Site-Administratif),
- Le site internet comporte un système de panier pour l'achat des articles ainsi qu'un historique de navigation. Les informations du panier et de l'historique de navigation sont enregistrées via le *local storage* du navigateur internet et non via des cookies,
- Un système de tags (catégories) ainsi qu'une barre de recherche ont été ajoutés afin de permettre au client de pouvoir trier les recettes ou de chercher directement une recette qu’il souhaiterait réaliser.

### *Partie graphique* 

- Chaque recette ou article sont affichés sous forme de carte avec l’essentiel des informations importantes mise en avant,
- Utilisation d'une palette de couleur que j'ai nommée *mangue-chocolat-menthe* ayant pour but de stimuler l'appétit du visiteur,
- Utilisation de la police *Caveat* afin de donner à l’utilisateur la sensation d’accéder à des recettes dites *fait maison* apportant un côté traditionnel au site.

## Description fonctionnelle

- Proposition de recettes avec la possibilité de les ranger par catégories (système de tags) afin de faciliter la recherche aux utilisateurs,

- L’utilisateur peut accéder aux détails d’une recette :
  - Accéder au nom de la recette,
  - Accéder à l’auteur de la recette,
  - Accéder à la note globale de la recette,
  - Accéder au temps de préparation de la recette,
  - Accéder au nombre de personnes pour lequel la recette est prévue,
  - Accéder aux ingrédients nécessaires à la réalisation de la recette,
  - Accéder aux étapes de préparations de la recette,
  - Accéder aux commentaires que les autres utilisateurs ont laissé sur la recette,

- Proposition d'un catalogue d’articles disponible à la vente,

- L’utilisateur peut accéder aux détails d’un article :
  - Accéder au prix de l’article,
  - Voir les recettes en lien avec cet article,
  - Ajouter une quantité de cet article dans son panier,
  
- Comporte une page *accueil* contenant une section des recettes les mieux notées mais aussi une section historique de navigation affichant les recettes que l’utilisateur a déjà visionnés,

- Comporte une barre de recherche afin de permettre à l’utilisateur de trouver rapidement une recette ou un article,

- Comporte une page *suggestions* permettant de proposer une recette à partir d’une liste d’ingrédients choisis par l’utilisateur,

- Comporte une page *panier* permettant à l’utilisateur d’avoir un récapitulatif des articles qu'il va acheter et de proposer le règlement sécurisé de la commande,

- Comporte une page *utilisateur* afin de :
  - Permettre à un utilisateur de s’inscrire et de créer un compte Nesti,
  - Permettre à un utilisateur de se connecter de manière sécurisée s’il possède déjà un compte Nesti.
  
  S’il est connecté, l’utilisateur peut :
    - Noter une recette,
    - Commenter une recette.

## Outils et logiciels utilisés

- IDE : [*Visual Studio Code*](https://code.visualstudio.com/)
- Librairies : 
  - [*CodeIgniter*](https://codeigniter.com/)
  - [*Twig*](https://twig.symfony.com/)
- Logiciel : [*FileZilla*](https://filezilla-project.org/)
- Base de données : [*PHPMyAdmin*](https://www.phpmyadmin.net/)
