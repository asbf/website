# Actions Solidaires Brony Francophone

Site web de l'ASBF.
[![Build status](http://phpci.poni.fr/build-status/image/3)](http://phpci.poni.fr/build-status/view/3)

---

## Pour les développeurs

- Récupérez une copie du site avec git:
  ```bash
  git clone https://github.com/asbf/website
  ```
- Créez une base de donnée MySQL "asbf" et importez le schéma `asbf.sql`
- **Copiez** `admin/pages/config.dist.php` + `sang/logins.dist.php` vers `admin/pages/config.php` + `sang/logins.php`
- Remplissez les deux fichiers avec les bonnes informations de connexion, et obtenez une copie de la fonction `random()` chez un développeur actuel
- Accédez à `http://<SERVER_PROJET>/admin` et faites un reset du mot de passe de `tech@asbf.fr`. Le mot de passe sera envoyé sur l'email.
  + Créez-vous un utilisateur sous l'option "Nouveau utilisateur" en rôle "Admin". Vous recevrez un mail avec votre mot de passe random.
  + Dans "Gestion des utilisateurs", cliquez sur "Changer MDP" sur root. Ceci va *jetter* le mot de passe par défaut.
- Déconnectez-vous. C'est prêt.
