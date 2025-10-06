# Lighthouse Task

This project was created as part of a technical task for **The Lighthouse Centre**.

---

## Installation & Setup

Follow the steps below to run the project locally:

### 1️⃣ Clone the repository

```bash
git clone https://github.com/MahmoudSalah53/Lighthous-task.git
```

### 2️⃣ Navigate to the project directory

```bash
cd Lighthous-task
```

### 3️⃣ Install dependencies

```bash
composer install
```

### 4️⃣ Copy the environment file

```bash
cp .env.example .env
```

### 5️⃣ Generate application key

```bash
php artisan key:generate
```

### 6️⃣ Set up your database

Open the `.env` file and configure your database credentials, for example:

```
DB_DATABASE=lighthouse-task
DB_USERNAME=root
DB_PASSWORD=
```

Then run:

```bash
php artisan migrate
```

### 7️⃣ Install frontend dependencies

```bash
npm install
npm run dev
```

### 8️⃣ Run the application

```bash
php artisan serve
```

---

## 🧠 Notes

* The first user to register will automatically be assigned the **admin** role.
* The admin can view all submissions in the “Submissions” page.

---

## ✅ Requirements

* PHP 8.2+
* Composer
* Node.js & NPM
* MySQL

---

**GitHub Repository:**
[https://github.com/MahmoudSalah53/Lighthous-task.git](https://github.com/MahmoudSalah53/Lighthous-task.git)
