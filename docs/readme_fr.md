[![Laravel](https://img.shields.io/badge/Laravel-10.x-red.svg)](https://laravel.com/)

[![Blade](https://img.shields.io/badge/Blade-TailwindCSS-blueviolet.svg)](https://laravel.com/docs/blade)
[![MySQL](https://img.shields.io/badge/Database-MySQL-4479A1.svg)](https://www.mysql.com/)[![SQLite](https://img.shields.io/badge/Database-SQLite-003B57.svg)](https://www.sqlite.org/)
[![Eloquent](https://img.shields.io/badge/ORM-Eloquent-FF2D20.svg)](https://laravel.com/docs/eloquent)

[![Google Maps](https://img.shields.io/badge/API-Google%20Maps-blue.svg)](https://developers.google.com/maps/documentation)[![Open-Meteo](https://img.shields.io/badge/API-Open%20Meteo-0A84FF.svg)](https://open-meteo.com/)[![SimplePie](https://img.shields.io/badge/RSS-SimplePie-00BFFF.svg)](https://simplepie.org/)
![Status](https://img.shields.io/badge/Status-Work%20in%20Progress-yellow.svg)

🌍 Langues disponibles : [Français](readme_fr.md) | [English](readme.md)


<h1 align="center">⛰️ Trek Organizer ⛰️</h1>

<p align="center">
  Gérez vos sorties outdoor trekking, escalade, vélo, trail dans une seule application.  
</p>


---

## ✨ Fonctionnalités

### 🖥️ Dashboard
- Page d’accueil centrale donnant accès à tous les modules.  
- Vue synthétique pour suivre l’état de préparation d’une sortie.  

![](/docs/images/dashboard.png)

---

### 🧰 Matériel & sacs à dos
- Créez un **catalogue de matériel personnel**.

![](/docs/images/backpack1.png)

- Ajoutez votre équipent pièce par pièce : marque, modèle, poids, volume, prix, lieu d'achat, catégorie.
- Retrouvez facilement vos articles grace à la barre de recherche et aux filtres (dormir, manger, vêtements, hygiène, équipement).  

![](/docs/images/backpackNewItem.png)

- Composez plusieurs **sacs à dos types** à partir de ces objets :  
  - ex. sac pour un **long GR**,  
  - sac pour un **weekend hivernal**,  
  - sac pour une **sortie escalade**,  
  - sac pour une **itinérance vélo**. 

![](/docs/images/backpackNewBackpack.png)

- Chaque sac calcule automatiquement le **poids total** et le **volume**, ce qui facilite la préparation en fonction du type de sortie prévu.

![](/docs/images/backpackDetails.png)

Les filtres permettents d'affciher **le sac le plus adapté à la sortie prévue**. Par exemple: sortie de deux jours avec nuit en refuge en été ou sortie de cinq jours avec bivouac et escalade.

---

### 🗺️ Itinéraires & GPX
- Créez des **itinéraires** (nom, dates, lieu, image, description).  
- Associez des **fichiers GPX** pour visualiser les traces.  
- Gérez vos propres fichiers GPX.  
- Visualisez les itinéraires sur une **carte interactive** (fullscreen, possibilité d'ativer, désactiver la trace GPX)

![](/docs/images/map.png)

![](/docs/images/mapCommun.png)

Accédez à une bibliothèque de fichiers **GPX partagés** par la communauté.

---

### 🌤️ Météo
- Sauvegardez vos **lieux favoris**.  
- Géocodage via **Google Maps**.  
- Prévisions fiables via **Open-Meteo** (quotidiennes & temps réel).

![](/docs/images/meteo.png)

![](/docs/images/meteoDetails.png)

---

### 📰 Actualités
- Flux d’actus outdoor.  

![](/docs/images/news.png)

---

### 💬 Forum
- Un espace simple pour garder des notes, partager des idées ou préparer une sortie avec d’autres.

![](/docs/images/forum.png)

![](/docs/images/forumDetail.png)

---

### 💸 Budgets
- Créez des **budgets par sortie/projet**.  
- Ajoutez des **participants**.  
- Enregistrez des **transactions** (montant, type, utilisateur, budget).  
- Partage des **frais** entre participants.

![](/docs/images/Budget.png)

![](/docs/images/budgetDetail.png)

---

## ⚙️ Back-end

- **Framework** : [Laravel 10](https://laravel.com/)  
- **Base de données** : SQL.  
- **Gestion des données** : Eloquent.  
- **Auth** : Laravel Breeze (login, inscription, profil).  
- **Front-end** : Blade.  

---

## 🗺️ Feuille de route

-  **Exports PDF/CSV (liste matériel, plan itinéraire)**
-  **Visualisation multi-GPX avec profils d’altitude**
-  **Développer la partie sociale** (amis, partages, commentaires, profils publics)
-  **Refonte du front-end : Livewire / Vue**
- **Multilingue**
-  **Collaboration temps réel sur budgets/itinéraires**
-  **Assistant** : proposer un sac selon lieu/saison/météo + matériel possédé
-  **PWA pour consultation offline**

