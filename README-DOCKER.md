# Docker Setup for WayToGo WordPress Site

This WordPress site is configured to run with Docker using PHP 7.4.

## Prerequisites

- Docker Desktop installed
- Docker Compose installed

## Getting Started

### 1. Configure Environment Variables

A `.env` file has been created with default values. You can customize it:

```bash
# Edit .env file with your preferred settings
nano .env
```

**Available Variables:**
- `WORDPRESS_PORT` - Port for WordPress (default: 8080)
- `PHPMYADMIN_PORT` - Port for phpMyAdmin (default: 8081)
- `DB_HOST` - Database host (default: db:3306)
- `DB_NAME` - Database name (default: wordpress)
- `DB_USER` - Database user (default: wordpress)
- `DB_PASSWORD` - Database password (default: wordpress_password)
- `DB_ROOT_PASSWORD` - MySQL root password (default: root_password)

> **Security Note:** Never commit your `.env` file to version control! It's already in `.gitignore`.

### 2. Build and Start Containers

```bash
docker-compose up -d --build
```

This will start three containers:
- **WordPress** (PHP 7.4 + Apache) - accessible at `http://localhost:8080`
- **MySQL 5.7** - database server
- **phpMyAdmin** - accessible at `http://localhost:8081`

### 3. Access the Site

- **WordPress Site**: http://localhost:8080 (or your custom `WORDPRESS_PORT`)
- **phpMyAdmin**: http://localhost:8081 (or your custom `PHPMYADMIN_PORT`)
  - Username: Value from `DB_USER` (default: `wordpress`)
  - Password: Value from `DB_PASSWORD` (default: `wordpress_password`)

### 4. Database Configuration

The database will be automatically imported from `APP-DATA.SQL` on first run.

**Database Credentials** (from `.env` file):
- Host: Value from `DB_HOST` (default: `db:3306`)
- Database: Value from `DB_NAME` (default: `wordpress`)
- User: Value from `DB_USER` (default: `wordpress`)
- Password: Value from `DB_PASSWORD` (default: `wordpress_password`)

> **Note:** Make sure your `wp-config.php` file uses these credentials, or update the credentials in `.env` to match your `wp-config.php`.

## Useful Commands

### Stop Containers
```bash
docker-compose down
```

### Stop and Remove Volumes (Full Reset)
```bash
docker-compose down -v
```

### View Logs
```bash
docker-compose logs -f
```

### View WordPress Logs Only
```bash
docker-compose logs -f wordpress
```

### Restart Containers
```bash
docker-compose restart
```

### Rebuild Containers
```bash
docker-compose up -d --build
```

### Access WordPress Container Shell
```bash
docker exec -it waytogo-wordpress bash
```

### Access MySQL Container Shell
```bash
docker exec -it waytogo-mysql mysql -u wordpress -p
```

## Customization

### Change Ports

Edit `.env` file and update the port variables:

```bash
WORDPRESS_PORT=8080      # Change to your preferred port
PHPMYADMIN_PORT=8081     # Change to your preferred port
```

### Change Database Credentials

Update the database variables in `.env` file:

```bash
DB_NAME=wordpress
DB_USER=wordpress
DB_PASSWORD=your_secure_password
DB_ROOT_PASSWORD=your_secure_root_password
```

### PHP Configuration

Modify the `Dockerfile` to adjust PHP settings like upload limits, memory limits, etc.

## Troubleshooting

### Database Connection Issues

Make sure the database credentials in your `wp-config.php` match those in your `.env` file:

```php
define('DB_HOST', 'db:3306');
define('DB_NAME', 'wordpress');
define('DB_USER', 'wordpress');
define('DB_PASSWORD', 'wordpress_password');
```

Or better yet, update your `.env` file to match your existing `wp-config.php` credentials.

### Permission Issues

If you encounter permission errors, run:

```bash
docker exec -it waytogo-wordpress chown -R www-data:www-data /var/www/html
docker exec -it waytogo-wordpress chmod -R 755 /var/www/html
```

### Port Already in Use

If port 8080 or 8081 is already in use, change the ports in your `.env` file:

```bash
WORDPRESS_PORT=9000      # Use a different port
PHPMYADMIN_PORT=9001     # Use a different port
```

## Production Considerations

For production deployment:
1. Change all default passwords
2. Use environment variables for sensitive data
3. Configure proper SSL/TLS certificates
4. Set up proper backup strategy
5. Configure WordPress for production (WP_DEBUG = false)
6. Use a proper secrets management solution

