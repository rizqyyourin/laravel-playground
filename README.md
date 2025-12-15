# Laravel Playground

Interactive Laravel learning platform with live code execution, comprehensive tutorials, and modern UI.

## 🚀 Features

- **Modern Landing Page**: Clean, SEO-optimized design with Laravel red theme
- **100% Tutorial Coverage**: 9 packages, 19 tutorials, 43 interactive code examples
- **Interactive Code Editor**: Monaco Editor integration with syntax highlighting
- **Authentication**: Protected routes with Laravel Breeze
- **Responsive Design**: Mobile-friendly with Tailwind CSS
- **Organized Seeders**: Modular seeder structure for easy maintenance

## 📦 Tech Stack

- **Backend**: Laravel 11, PHP 8.2+
- **Frontend**: React 18, TypeScript, Inertia.js
- **Styling**: Tailwind CSS v4
- **Database**: MySQL 8.0
- **Development**: Laravel Sail (Docker)

## 🛠️ VPS Deployment

### Prerequisites

- Ubuntu 20.04+ VPS
- Docker & Docker Compose installed
- Git installed
- Domain name (optional)

### Step 1: Clone Repository

```bash
cd /var/www
git clone https://github.com/rizqyyourin/laravel-playground.git
cd laravel-playground
```

### Step 2: Environment Setup

```bash
# Copy environment file
cp .env.example .env

# Edit .env file
nano .env
```

Update these values in `.env`:
```env
APP_NAME="Laravel Playground"
APP_ENV=production
APP_DEBUG=false
APP_URL=http://your-domain.com

DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=laravel_playground
DB_USERNAME=sail
DB_PASSWORD=password

SESSION_DRIVER=database
QUEUE_CONNECTION=database
```

### Step 3: Install Dependencies & Start Sail

```bash
# Install Composer dependencies (without Sail first)
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v "$(pwd):/var/www/html" \
    -w /var/www/html \
    laravelsail/php83-composer:latest \
    composer install --ignore-platform-reqs

# Start Laravel Sail
./vendor/bin/sail up -d

# Generate application key
./vendor/bin/sail artisan key:generate

# Install NPM dependencies
./vendor/bin/sail npm install

# Build frontend assets
./vendor/bin/sail npm run build
```

### Step 4: Database Setup

```bash
# Run migrations
./vendor/bin/sail artisan migrate

# Seed database
./vendor/bin/sail artisan db:seed
```

### Step 5: Storage & Permissions

```bash
# Create storage link
./vendor/bin/sail artisan storage:link

# Set permissions
sudo chown -R $USER:$USER storage bootstrap/cache
sudo chmod -R 775 storage bootstrap/cache
```

### Step 6: Configure Nginx (Optional)

If using Nginx as reverse proxy:

```nginx
server {
    listen 80;
    server_name your-domain.com;

    location / {
        proxy_pass http://localhost:8081;
        proxy_set_header Host $host;
        proxy_set_header X-Real-IP $remote_addr;
        proxy_set_header X-Forwarded-For $proxy_add_x_forwarded_for;
        proxy_set_header X-Forwarded-Proto $scheme;
    }
}
```

### Step 7: Access Application

Visit: `http://your-server-ip:8081` or `http://your-domain.com`

## 🔧 Local Development

```bash
# Clone repository
git clone https://github.com/rizqyyourin/laravel-playground.git
cd laravel-playground

# Copy environment
cp .env.example .env

# Start Sail
./vendor/bin/sail up -d

# Install dependencies
./vendor/bin/sail composer install
./vendor/bin/sail npm install

# Generate key
./vendor/bin/sail artisan key:generate

# Run migrations & seeders
./vendor/bin/sail artisan migrate
./vendor/bin/sail artisan db:seed

# Start dev server
./vendor/bin/sail npm run dev
```

Visit: `http://localhost:8081`

## 📝 Database Seeding

The project includes organized seeders:

```bash
# Seed all data
./vendor/bin/sail artisan db:seed

# Seed specific seeders
./vendor/bin/sail artisan db:seed --class=CategorySeeder
./vendor/bin/sail artisan db:seed --class=PackageSeeder
./vendor/bin/sail artisan db:seed --class=TutorialSeeder
./vendor/bin/sail artisan db:seed --class=CodeExampleSeeder
```

## 🎯 Package Coverage

1. **Laravel Sanctum** - API Authentication
2. **Eloquent ORM** - Database Relationships
3. **API Resources** - JSON Transformations
4. **Database Migrations** - Schema Management
5. **Laravel Telescope** - Debugging & Monitoring
6. **Pest PHP** - Testing Framework
7. **Laravel Passport** - OAuth2 Server
8. **Laravel Fortify** - Authentication Backend
9. **Laravel Pail** - Log Monitoring

## 🔐 Default Credentials

After seeding, you can register a new account or use test credentials if created.

## 📚 Documentation

- Landing Page: `/`
- Packages: `/packages` (requires login)
- Tutorials: `/tutorials/{slug}` (requires login)
- Dashboard: `/dashboard` (requires login)

## 🤝 Contributing

Pull requests are welcome. For major changes, please open an issue first.

## 📄 License

This project is open-sourced software licensed under the MIT license.

## 👨‍💻 Author

**Rizqy Yourin**
- GitHub: [@rizqyyourin](https://github.com/rizqyyourin)
- Email: rizqyyourin6@gmail.com
