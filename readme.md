[![Laravel](https://img.shields.io/badge/Laravel-10.x-red.svg)](https://laravel.com/)

[![Blade](https://img.shields.io/badge/Blade-TailwindCSS-blueviolet.svg)](https://laravel.com/docs/blade)
[![MySQL](https://img.shields.io/badge/Database-MySQL-4479A1.svg)](https://www.mysql.com/)[![SQLite](https://img.shields.io/badge/Database-SQLite-003B57.svg)](https://www.sqlite.org/)
[![Eloquent](https://img.shields.io/badge/ORM-Eloquent-FF2D20.svg)](https://laravel.com/docs/eloquent)

[![Google Maps](https://img.shields.io/badge/API-Google%20Maps-blue.svg)](https://developers.google.com/maps/documentation)[![Open-Meteo](https://img.shields.io/badge/API-Open%20Meteo-0A84FF.svg)](https://open-meteo.com/)[![SimplePie](https://img.shields.io/badge/RSS-SimplePie-00BFFF.svg)](https://simplepie.org/)
![Status](https://img.shields.io/badge/Status-Work%20in%20Progress-yellow.svg)

🌍 Available languages: [English](readme.md) | [Français](/docs/readme_fr.md)



<p align="center">
  <img src="docs/images/logo.png" alt="Logo Trek Organizer" width="420" />
</p>

<h1 align="center">⛰️ Trek Organizer ⛰️</h1>

<p align="center">
  Manage your outdoor activities trekking, climbing, cycling, trail running in a single application.  
</p>


---

## ✨ Features

### 🖥️ Dashboard

- Central home page giving access to all modules.  
- Synthetic view to track the preparation status of an outing.  

![](/docs/images/dashboard.png)

---

### 🧰 Gear & backpacks

- Create a **personal gear catalog**.

![](/docs/images/backpack1.png)

- Add your equipment item by item: brand, model, weight, volume, price, place of purchase, category.  
- Easily find your items thanks to the search bar and filters (sleep, eat, clothes, hygiene, equipment).  

![](docs/images/backpackNewItem.png)

- Compose several **types of backpacks** from these items:  
  - e.g. backpack for a **long GR**,  
  - backpack for a **winter weekend**,  
  - backpack for a **climbing outing**,  
  - backpack for a **cycling trip**.  

![](/docs/images/backpackNewBackpack.png)

- Each backpack automatically calculates the **total weight** and the **volume**, which makes preparation easier depending on the planned outing.  

![](/docs/images/backpackDetails.png)

Filters allow you to display **the backpack best suited to the planned outing**. For example: a two-day trip with a night in a hut in summer or a five-day trip with bivouac and climbing.  

---

### 🗺️ Itineraries & GPX

- Create **itineraries** (name, dates, location, image, description).  
- Attach **GPX files** to display tracks.  
- Manage your own GPX files.  
- View itineraries on an **interactive map** (fullscreen, ability to enable/disable GPX track).  

![](/docs/images/map.png)

![](/docs/images/mapCommun.png)

Access a library of **GPX files shared** by the community.  

---

### 🌤️ Weather

- Save your **favorite places**.  
- Geocoding via **Google Maps**.  
- Reliable forecasts via **Open-Meteo** (daily & real time).  

![](/docs/images/meteo.png)

![](/docs/images/meteoDetails.png)

---

### 📰 News

- Outdoor news feed.  

![](/docs/images/news.png)

---

### 💬 Forum

- A simple space to keep notes, share ideas or prepare an outing with others.  

![](/docs/images/forum.png)

![](/docs/images/forumDetail.png)

---

### 💸 Budgets

- Create **budgets per outing/project**.  
- Add **participants**.  
- Record **transactions** (amount, type, user, budget).  
- Share **expenses** among participants.  

![](/docs/images/Budget.png)

![](/docs/images/budgetDetail.png)

---

## ⚙️ Back-end

- **Framework**: [Laravel 10](https://laravel.com/)  
- **Database**: SQL.  
- **Data management**: Eloquent.  
- **Auth**: Laravel Breeze (login, registration, profile).  
- **Front-end**: Blade.  

---

## 🗺️ Roadmap

- **Exports PDF/CSV (gear list, itinerary plan)**  
- **Multi-GPX visualization with elevation profiles**  
- **Develop the social part** (friends, sharing, comments, public profiles)  
- **Front-end redesign: Livewire / Vue**  
- **Multilingual**  
- **Real-time collaboration on budgets/itineraries**  
- **Assistant**: propose a backpack according to location/season/weather + owned gear  
- **PWA for offline consultation**
