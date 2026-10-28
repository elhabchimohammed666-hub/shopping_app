## License
   © 2026 Elhabchi Mohammed. All Rights Reserved.

# 🛒 E-Commerce PHP

Un site e-commerce développé en **PHP** et **MySQL**, permettant aux utilisateurs de parcourir des produits, de les ajouter au panier et de passer commande. Un espace administrateur permet de gérer le catalogue.

![PHP](https://img.shields.io/badge/PHP-777BB4?style=flat-square&logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-4479A1?style=flat-square&logo=mysql&logoColor=white)
![HTML5](https://img.shields.io/badge/HTML5-E34F26?style=flat-square&logo=html5&logoColor=white)
![CSS3](https://img.shields.io/badge/CSS3-1572B6?style=flat-square&logo=css3&logoColor=white)

---

---

## ✨ Fonctionnalités

### 👤 Côté utilisateur
- Inscription et connexion
- Parcourir les produits par catégorie
- Recherche de produits
- Page de détails d'un produit
- Gestion du panier
- Validation de la commande (checkout)

### 🔧 Côté administrateur
- Ajout, modification et suppression de produits
- Gestion des catégories
- Gestion des utilisateurs et des commandes
- Upload d'images de produits

---

## 📁 Structure du projet

```
├── admin/          # Espace administrateur
├── file/           # Fichiers divers (base de données, documents)
├── image/          # Images du site (logo, bannières)
├── include/        # Fichiers inclus (connexion BDD, header, footer)
├── uploads/img/    # Images des produits téléversées
├── user/           # Espace utilisateur (profil, commandes)
├── cart.php        # Panier
├── checkout.php    # Validation de la commande
├── details.php     # Détails d'un produit
├── index.php       # Page d'accueil
├── search.php      # Recherche de produits
├── section.php     # Affichage par catégorie
└── style.css       # Feuille de style principale
```

---

## ⚙️ Installation

### Prérequis
- PHP 7.4 ou supérieur
- MySQL / MariaDB
- Un serveur local : [XAMPP](https://www.apachefriends.org/), WAMP ou Laragon

### Étapes

1. **Cloner le dépôt**
```bash
   git clone https://github.com/elhabchimohammed666-hub/nom-du-depot.git
```

2. **Placer le projet** dans le dossier de ton serveur local (`htdocs` pour XAMPP, `www` pour WAMP).

3. **Créer la base de données**
   - Ouvre phpMyAdmin
   - Crée une base nommée `nom_de_la_base`
   - Importe le fichier SQL situé dans le dossier `file/`

4. **Configurer la connexion** dans `include/` (par exemple `connect.php`) :
```php
   $host = "localhost";
   $user = "root";
   $password = "";
   $database = "nom_de_la_base";
```

5. **Lancer le projet** dans ton navigateur :
```
   http://localhost/nom-du-depot/
```

---



---

## 🗺️ Améliorations prévues

- [ ] Paiement en ligne (Stripe / PayPal)
- [ ] Système d'avis et de notes
- [ ] Liste de souhaits
- [ ] Version responsive mobile
- [ ] Migration vers Laravel

---

## 🤝 Contribution

Les contributions sont les bienvenues :
1. Fork le projet
2. Crée une branche (`git checkout -b feature/ma-fonctionnalite`)
3. Commit tes changements (`git commit -m "Ajout de ma fonctionnalité"`)
4. Push la branche (`git push origin feature/ma-fonctionnalite`)
5. Ouvre une Pull Request

---

## 👨‍💻 Auteur

**Mohammed Elhabchi**
📫 elhabchimohammed666@gmail.com
🐙 [GitHub](https://github.com/elhabchimohammed666-hub)
