# Lighthouse Task

This project was built for **The Lighthouse Centre Laravel Developer Task**.

---

## Installation & Setup

Follow the steps below to run the project locally:

### 1. Clone the Repository

```bash
git clone https://github.com/your-username/lighthouse-task.git
cd lighthouse-task
```

### 2. Install PHP Dependencies

Make sure you have **Composer** installed, then run:

```bash
composer install
```

### 3. Install Node.js Dependencies

Make sure you have **Node.js** and **npm** installed, then run:

```bash
npm install
```

### 4. Create Environment File

Duplicate the example environment file:

```bash
cp .env.example .env
```

Then, open `.env` and update the following:

* Database credentials (`DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`)
* Mail credentials (Gmail SMTP or any other mail service)

### 5. Generate App Key

```bash
php artisan key:generate
```

### 6. Run Migrations

```bash
php artisan migrate
```

### 7. Start Laravel Development Server

```bash
php artisan serve
```

### 8. Run Frontend Assets

In another terminal, run:

```bash
npm run dev
```


