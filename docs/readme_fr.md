[![Laravel](https://img.shields.io/badge/Laravel-10.x-red.svg)](https://laravel.com/)

[![Blade](https://img.shields.io/badge/Blade-TailwindCSS-blueviolet.svg)](https://laravel.com/docs/blade)
[![MySQL](https://img.shields.io/badge/Database-MySQL-4479A1.svg)](https://www.mysql.com/)[![SQLite](https://img.shields.io/badge/Database-SQLite-003B57.svg)](https://www.sqlite.org/)
[![Eloquent](https://img.shields.io/badge/ORM-Eloquent-FF2D20.svg)](https://laravel.com/docs/eloquent)

[![Google Maps](https://img.shields.io/badge/API-Google%20Maps-blue.svg)](https://developers.google.com/maps/documentation)[![Open-Meteo](https://img.shields.io/badge/API-Open%20Meteo-0A84FF.svg)](https://open-meteo.com/)[![SimplePie](https://img.shields.io/badge/RSS-SimplePie-00BFFF.svg)](https://simplepie.org/)
![Status](https://img.shields.io/badge/Status-Work%20in%20Progress-yellow.svg)

🌍 Langues disponibles : [Français](readme_fr.md) | [English](../readme.md)


<h1 align="center">⛰️ Trek Organizer ⛰️</h1>

<p align="center">
  Gérez vos sorties outdoor trekking, escalade, vélo, trail dans une seule application.  
</p>


---

>  **Note sur la migration technique**
>
> Ce projet subit actuellement une migration architecturale majeure pour s'aligner sur les standards modernes de l'industrie et les exigences d'intégration de l'IA.
>
> - **Stack actuelle :** Laravel 10 (Blade, Eloquent, MySQL).
> - **Future Stack (En cours) :** **Next.js 15** (App Router), **TypeScript**, **Tailwind CSS**, et **Prisma ORM**. Ce changement vise à améliorer les capacités en temps réel, la sécurité du typage et l'intégration fluide avec les SDK d'IA.

🌍 Langues disponibles : [English](https://www.google.com/search?q=/readme.md) | [Français](https://www.google.com/search?q=docs/readme_fr.md)

<p align="center"> <img src="/docs/images/logo.png" alt="Logo Trek Organizer" width="420" /> </p>

<h1 align="center">⛰️ Trek Organizer ⛰️</h1>

<p align="center"> Gérez vos activités de plein air (trekking, escalade, cyclisme, trail) au sein d'une seule application. </p>

## ✨ Fonctionnalités

### 🖥️ Tableau de bord

- Page d'accueil centrale donnant accès à tous les modules.
- Vue synthétique pour suivre l'état de préparation d'une sortie.

------

### 🧰 Équipement & Sacs à dos

- Créez un **catalogue d'équipement personnel**.
- Ajoutez votre matériel article par article : marque, modèle, poids, volume, prix, lieu d'achat, catégorie.
- Trouvez facilement vos articles grâce à la barre de recherche et aux filtres (dormir, manger, vêtements, hygiène, équipement).
- Composez plusieurs **types de sacs à dos** à partir de ces articles :
  - ex : sac à dos pour un **long GR**,
  - sac à dos pour un **week-end hivernal**,
  - sac à dos pour une **sortie escalade**,
  - sac à dos pour un **voyage à vélo**.
- Chaque sac à dos calcule automatiquement le **poids total** et le **volume**, ce qui facilite la préparation en fonction de la sortie prévue.
- Des filtres vous permettent d'afficher **le sac à dos le mieux adapté à la sortie prévue**. Par exemple : un voyage de deux jours avec une nuit en refuge en été ou un voyage de cinq jours avec bivouac et escalade.

------

### 🗺️ Itinéraires & GPX

- Créez des **itinéraires** (nom, dates, lieu, image, description).
- Joignez des **fichiers GPX** pour afficher les tracés.
- Gérez vos propres fichiers GPX.
- Visualisez les itinéraires sur une **carte interactive** (plein écran, possibilité d'activer/désactiver le tracé GPX).
- Accédez à une bibliothèque de **fichiers GPX partagés** par la communauté.

------

### 🌤️ Météo

- Enregistrez vos **lieux favoris**.
- Géocodage via **Google Maps**.
- Prévisions fiables via **Open-Meteo** (quotidien et temps réel).

------

### 📰 Actualités

- Flux d'actualités sur les sports de plein air.

------

### 💬 Forum

- Un espace simple pour prendre des notes, partager des idées ou préparer une sortie à plusieurs.

------

### 💸 Budgets

- Créez des **budgets par sortie/projet**.
- Ajoutez des **participants**.
- Enregistrez les **transactions** (montant, type, utilisateur, budget).
- Partagez les **dépenses** entre les participants.

------

## 🛰️ Intégration Hardware : Réseau Mesh LoRa

Trek Organizer s'étend au-delà du web avec des balises matérielles personnalisées basées sur l'**ESP32** et le protocole **LoRa (Long Range)**.

Ces balises sont conçues pour les "zones blanches" (zones sans couverture cellulaire), créant un réseau mesh local entre les randonneurs pour assurer sécurité et connectivité.

<table align="center"> <tr> <td align="center"><img src="/docs/images/esp32Open.jpg" alt="Intérieur balise LoRa" width="250" height="250"/></td> <td align="center"><img src="/docs/images/esp32On.jpg" alt="Écran balise LoRa" width="250" height="250"/></td> <td align="center"><img src="/docs/images/esp32.jpg" alt="Balise LoRa boîtier" width="250" height="250"/></td> </tr> <tr> <td align="center"><em>Fig 1. Intérieur du prototype montrant la carte ESP32 LoRa et la batterie LiPo 1200mAh dans un boîtier personnalisé imprimé en 3D.</em></td> <td align="center"><em>Fig 2. Gros plan sur l'écran OLED montrant l'état de l'appareil lors des tests initiaux.</em></td> <td align="center"><em>Fig 3. Prototype final assemblé prêt pour les tests sur le terrain.</em></td> </tr> </table>

### Caractéristiques principales du matériel :

- **Connectivité hors ligne :** Permet la communication (chat) et le partage de position entre appareils sans dépendre des infrastructures télécoms.
- **Sécurité avant tout :** Comprend un système d'alerte SOS décentralisé.
- **Architecture "Data Mule" :** Les balises collectent des données environnementales hors ligne. Ces données sont mises en mémoire tampon et synchronisées avec la plateforme principale Trek Organizer via la passerelle du smartphone une fois qu'une connexion (Wi-Fi/4G) est rétablie.

------

## 🧠 Vision IA & Data Science

Le projet vise à évoluer d'un simple outil de gestion vers un assistant intelligent et un fournisseur de données scientifiques.

> [!NOTE] **Phase d'étude IA :** Les concepts décrits ci-dessous représentent la vision à long terme du projet. Je suis actuellement en phase d'étude concernant les technologies d'Intelligence Artificielle. Ces fonctionnalités et leurs détails d'implémentation évolueront probablement de manière significative à mesure que j'approfondirai mes connaissances dans ce domaine lors de ma formation.

### 1. Edge AI (TinyML)

- **Détection de chute :** Exécution de réseaux neuronaux légers directement sur le microcontrôleur ESP32 pour distinguer les mouvements de marche normaux des chutes accidentelles, déclenchant des alertes automatiques.
- **Gestion intelligente de l'énergie :** Utilisation de modèles prédictifs pour optimiser la durée de vie de la batterie en fonction des modes d'utilisation et des conditions environnementales.

### 2. Science citoyenne et données environnementales

En transformant chaque randonneur en station de détection mobile, nous visons à combler le manque de données dans les zones reculées.

- **Cartographie des micro-climats :** Collecte de données de température, d'humidité et de pression à partir de milliers de points sur les sentiers afin de fournir des données haute résolution aux chercheurs climatologues.
- **Détection d'anomalies :** Utilisation du machine learning (ex: Isolation Forests) pour nettoyer les données de capteurs bruitées et identifier les anomalies environnementales comme les départs de feux de forêt.

### 3. Analyse prédictive

- **ETA personnalisé :** Un moteur d'IA qui apprend du rythme réel d'un utilisateur sur différents terrains pour prédire les heures d'arrivée plus précisément que les calculateurs standards.

------

## ⚙️ Back-end (Stack Actuelle)

- **Framework** : [Laravel 10](https://laravel.com/)
- **Base de données** : SQL.
- **Gestion des données** : Eloquent.
- **Authentification** : Laravel Breeze (connexion, inscription, profil).
- **Front-end** : Blade.

------

## 🗺️ Feuille de route & Évolution

Le projet est structuré en trois phases principales, passant d'un outil de gestion à un écosystème intelligent axé sur les données.

### Phase 1 : Fondations techniques & Migration (Actuel)

- [ ] **Migration complète vers Next.js 15 :** Transition de Laravel vers une stack moderne basée sur React pour de meilleures performances et l'intégration des SDK d'IA.
- [ ] **Amélioration des modules de base :** Finalisation des systèmes de gestion d'équipement, de budget et de GPX avec TypeScript pour une fiabilité maximale.
- [ ] **Implémentation PWA :** Permettre la consultation hors ligne et la mise en cache des données pour une utilisation en zone reculée.

### Phase 2 : Matériel & Connectivité (Moyen terme)

- [ ] **Intégration du Mesh LoRa :** Finalisation de la passerelle entre les balises ESP32 et la plateforme web via Bluetooth/WebSerial.
- [ ] **Protocole Data Mule :** Mise en œuvre de la synchronisation en arrière-plan des données environnementales des balises vers le cloud.
- [ ] **Cartes interactives :** Visualisation multi-GPX avec profils d'élévation dynamiques et positionnement en temps réel des nœuds du réseau mesh.

### Phase 3 : Intelligence & Science (Long terme / Étude IA)

- [ ] **Assistant IA v1 :** Moteur de recommandation d'équipement intelligent basé sur les prévisions météo, la difficulté du sentier et l'inventaire de l'utilisateur.
- [ ] **Déploiement Edge AI :** Implémentation de modèles TinyML sur l'ESP32 pour la détection autonome de chute et le déclenchement de SOS.
- [ ] **Moteur d'ETA prédictif :** Modèle de Machine Learning pour calculer des temps d'arrivée personnalisés basés sur l'historique de l'utilisateur.
- [ ] **API Open Science :** Lancement d'un portail public permettant aux chercheurs d'accéder aux données micro-climatiques anonymisées collectées par la communauté.
- [ ] **Support multilingue :** Extension de la plateforme pour les communautés internationales de trekking.