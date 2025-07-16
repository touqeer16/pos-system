# POS System (Laravel + ReactJS)

A modern Point of Sale (POS) system designed to streamline sales, inventory, and customer management. Built with Laravel (RESTful API) and ReactJS (SPA frontend), this system provides a responsive, fast, and user-friendly experience for retail businesses.

---

## 🚀 Features

### ✅ Sales & Billing
- Product search and barcode scanning
- Real-time cart updates
- Tax and discount calculation
- Printable invoices and receipts

### 🛒 Inventory Management
- Product CRUD (create, read, update, delete)
- Stock level tracking
- Category and supplier management
- Stock alerts and reordering

### 👥 User & Role Management
- Admin, Cashier, Manager roles
- Secure authentication with JWT
- User activity logging

### 📊 Reports & Analytics
- Sales reports (daily, monthly, custom range)
- Inventory valuation and movement reports
- Export to PDF/Excel

### 🖥️ Frontend (ReactJS)
- Responsive single-page application (SPA)
- Axios for API communication
- TailwindCSS or Bootstrap for styling
- React Router DOM for navigation
- Toast alerts and modals

### 🛠 Backend (Laravel)
- RESTful API with Laravel Sanctum or Passport
- Eloquent ORM for database management
- Request validation and resource transformers
- API versioning and rate limiting
- PHPUnit & Laravel Dusk for testing

---

## 🧰 Tech Stack

| Layer        | Technology             |
|--------------|------------------------|
| Frontend     | ReactJS, Axios, TailwindCSS/Bootstrap |
| Backend      | Laravel 10+, PHP 8.x, MySQL |
| Authentication | JWT / Laravel Sanctum |
| Deployment   | Docker / Nginx / Apache |
| Testing      | Jest (React), PHPUnit (Laravel) |

---

## ⚙️ Setup Instructions

### 1. Backend (Laravel)
```bash
git clone https://github.com/touqeer16/pos-system-backend.git
cd pos-system-backend
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
php artisan serve
```

### 2. Frontend (React)
```bash
git clone https://github.com/touqeer16/pos-system-frontend.git
cd pos-system-frontend
npm install
npm run dev
```

---

## 🔐 Environment Variables

Update `.env` in Laravel with:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=pos_db
DB_USERNAME=root
DB_PASSWORD=your_password
```

And in React:
```js
REACT_APP_API_URL=http://localhost:8000/api
```

---

## 📦 Sample Admin Credentials

```text
Email: admin@example.com
Password: password123
```

---

## 📌 Project Status

✅ In Development  
🔜 Planned Features:
- Multi-store support  
- Offline sync  
- QR code support for receipts

---

## 🤝 Contributing

Pull requests are welcome! For major changes, open an issue first to discuss what you would like to change.

---

## 📄 License

This project is open-source and available under the [MIT License](LICENSE).

---

## 🙌 Acknowledgements

- Laravel Docs
- ReactJS Docs
- TailwindCSS

📬 Contact
Author: Touqeer fazal
Email: touqeerfazal1992@gmail.com
GitHub: github.com/touqeer16
