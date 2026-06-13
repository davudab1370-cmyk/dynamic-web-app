# 📝 Dynamic PHP Web Application

A fully dynamic web application built from scratch using **PHP**, **MySQL**, and **PDO** — featuring secure user authentication, CRUD operations, and a clean responsive interface.

---

## ✨ Features

- 🔐 **User Authentication** — Register, Login, and Password Recovery
- 📄 **Dynamic Routing** — 3-page architecture with clean URL handling
- 🔍 **Search Functionality** — Real-time post search
- 💬 **Comment System** — Users can comment on posts
- 📰 **Latest Posts Section** — Dynamic content loading
- 📖 **Read More** — Expandable post previews
- 🛡️ **SQL Injection Prevention** — PDO Prepared Statements
- 📱 **Responsive Design** — HTML5 & CSS3

---

## 🛠️ Tech Stack

| Technology | Usage |
|------------|-------|
| PHP | Backend logic |
| MySQL | Database |
| PDO | Secure database connection |
| HTML5 | Structure |
| CSS3 | Styling |
| ORM Concepts | Data relationship management |

---

## 🚀 Getting Started

### Requirements
- PHP 7.4+
- MySQL 5.7+
- Apache / XAMPP / WAMP

### Installation

1. Clone the repository:
```bash
git clone https://github.com/davudab1370-cmyk/dynamic-web-app.git
```

2. Import the database:
   - Open phpMyAdmin
   - Create a new database (e.g. `myproject`)
   - Import `cms.sql` file

3. Configure the database connection:
   - Open `includes/config.php`
   - Update your database credentials:
```php
define('DB_HOST', 'localhost');
define('DB_USER', 'your_username');
define('DB_PASS', 'your_password');
define('DB_NAME', 'myproject');
```

4. Run the project in your local server (e.g. `http://localhost/myproject`)

---

## 📁 Project Structure

```
myproject/
├── includes/
│   ├── classes/        # OOP Classes (Post, Category, Comments...)
│   ├── config.php      # Database configuration
│   └── includes.php    # Global includes
├── images/             # Static assets
├── fonts/              # Custom fonts
├── index.php           # Main page
├── login.html          # Login page
├── signup.html         # Registration page
├── post.html           # Single post page
└── styles.css          # Stylesheet
```

---

## 👨‍💻 Author

**Davoud Abdollahi** — Junior Web Developer (PHP / Laravel)

- 🌐 GitHub: [davudab1370-cmyk](https://github.com/davudab1370-cmyk)
- 💼 LinkedIn: [Davoud Abdollahi](https://www.linkedin.com/in/davoud-abdollahi-194a14152)

---

## 📌 Status

🚧 Project is actively being improved — Bootstrap UI upgrade and Laravel migration coming soon.
