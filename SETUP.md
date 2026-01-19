# LAKID - Setup & Development Guide

Panduan cepat untuk setup dan development LAKID (Layanan Kekayaan Intelektual Digital)

## 🚀 Quick Start

### Prerequisites
- PHP 8.3+
- MySQL 8.0+
- Node.js 18+ (untuk Vite asset compilation)
- Composer

### 1. Clone & Install
```bash
cd /var/www/html/lakid

# Install PHP dependencies
composer install

# Install Node dependencies
npm install

# Generate app key
php artisan key:generate
```

### 2. Database Setup
```bash
# Copy environment file
cp .env.example .env

# Configure database in .env
# DB_HOST=localhost
# DB_DATABASE=lakid
# DB_USERNAME=root
# DB_PASSWORD=

# Run migrations
php artisan migrate

# (Optional) Seed demo data
php artisan db:seed
```

### 3. Storage & Assets
```bash
# Create storage symlink
php artisan storage:link

# Build CSS/JS assets
npm run build

# For development with hot reload
npm run dev
```

### 4. Run Server
```bash
# Development server
php artisan serve

# Access: http://localhost:8000
```

## 📁 Project Structure

```
lakid/
├── app/
│   ├── Http/Controllers/
│   │   ├── PengajuanController.php     # User CRUD
│   │   └── AdminController.php          # Admin Management
│   ├── Http/Middleware/
│   │   └── IsAdmin.php                  # Authorization
│   ├── Models/
│   │   ├── User.php
│   │   └── Pengajuan.php
│   └── Providers/
├── resources/views/
│   ├── pengajuan/                       # User views
│   │   ├── create.blade.php
│   │   ├── index.blade.php
│   │   ├── show.blade.php
│   │   └── edit.blade.php
│   ├── admin/                           # Admin views
│   │   └── dashboard.blade.php
│   ├── layouts/                         # Layout components
│   └── components/                      # Blade components
├── routes/
│   ├── web.php                          # Web routes
│   └── auth.php                         # Auth routes
├── database/
│   ├── migrations/
│   ├── factories/
│   └── seeders/
└── public/uploads/                      # File uploads
```

## 🔧 Development Commands

### Laravel Artisan
```bash
# Clear all caches
php artisan cache:clear && php artisan config:clear

# Migrate database
php artisan migrate
php artisan migrate:fresh --seed        # Reset database

# Routes
php artisan route:list

# Tinker (PHP REPL)
php artisan tinker
```

### Node/NPM
```bash
# Development with hot reload
npm run dev

# Build for production
npm run build

# Watch for changes
npm run watch
```

## 📊 Test Accounts

```
Admin Account:
Email: admin@lakid.kepri.prov.go.id
Password: password123

Test User:
Email: user@test.com
Password: password123
```

## 🔑 Key Features

### User Features
- Register & Login with email verification
- Create pengajuan (HKI application)
- Upload files (logo, KTP) with validation
- Edit & delete draft pengajuan
- Submit pengajuan for admin review
- View application status & admin notes

### Admin Features
- View all pengajuan from all users
- Review & update status
- Add notes/comments
- Auto redirect from dashboard

## 🔐 Security

- Email-based admin authorization
- Ownership check on pengajuan
- File validation (type & size)
- CSRF protection
- Password hashing with bcrypt
- SQL injection prevention via ORM

## 📱 Responsive Design

- Mobile-first approach
- Tailwind CSS for styling
- Dark mode support
- Modal dialogs for actions

## 🚨 Common Issues

### Storage symlink doesn't exist
```bash
php artisan storage:link
```

### Assets not loading
```bash
npm run build
php artisan cache:clear
```

### Database errors
```bash
# Check database connection in .env
# Ensure database exists
php artisan migrate:fresh
```

### Permission issues
```bash
chmod -R 755 storage bootstrap/cache
```

## 📝 File Uploads

- Location: `public/uploads/`
- Allowed: PNG, JPG/JPEG
- Max size: 2MB per file
- Auto-cleanup: Deleted when pengajuan deleted

## 🌐 Routes Overview

**User Routes** (requires auth)
- `GET /pengajuan` - List user's pengajuans
- `POST /pengajuan` - Create new pengajuan
- `GET /pengajuan/create` - Show create form
- `GET /pengajuan/{id}` - View detail
- `GET /pengajuan/{id}/edit` - Edit form
- `PUT /pengajuan/{id}` - Update
- `DELETE /pengajuan/{id}` - Delete
- `POST /pengajuan/{id}/submit` - Submit for review

**Admin Routes** (requires auth + admin)
- `GET /admin/dashboard` - Admin dashboard
- `PATCH /admin/pengajuan/{id}/status` - Update status

**Auth Routes**
- `GET /login` - Login form
- `POST /login` - Process login
- `GET /register` - Register form
- `POST /register` - Process registration

## 📚 Additional Resources

- [Laravel 11 Docs](https://laravel.com/docs/11.x)
- [Tailwind CSS Docs](https://tailwindcss.com/docs)
- [Alpine.js Docs](https://alpinejs.dev)
- [Blade Template Docs](https://laravel.com/docs/11.x/blade)

## 🤝 Contributing

When making changes:
1. Follow PSR-12 coding standards
2. Test your changes locally
3. Update documentation
4. Commit with clear messages

## 📞 Support

For issues or questions:
- Check `DOKUMENTASI.md` for detailed documentation
- Review error logs in `storage/logs/`
- Use `php artisan tinker` for debugging

---

**Last Updated**: 15 Januari 2026  
**Version**: 1.0.0
