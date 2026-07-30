# MagicAI Deployment Guide

## Server Requirements

- PHP 8.1+
- MySQL 5.7+ / MariaDB 10.3+
- Node.js 18+ (for building assets)
- Composer 2+
- Nginx / Apache

## Initial Deployment

```bash
# 1. Clone repository
cd /home/youruser/public_html
git clone git@github.com:linducip2208/magic.git .

# 2. Install dependencies
composer install --no-dev --optimize-autoloader
npm install
npm run build

# 3. Setup environment
cp .env.example .env
nano .env  # Edit DB credentials, APP_URL, etc.

# 4. Generate key + migrate
php artisan key:generate
php artisan migrate --seed

# 5. Storage setup
php artisan storage:link
mkdir -p storage/framework/cache/data storage/framework/views storage/framework/sessions storage/logs
chmod -R 775 storage bootstrap/cache

# 6. Optimize
php artisan optimize
```

## Update Deployment

```bash
cd /home/youruser/public_html/magic
git pull origin master
composer install --no-dev --optimize-autoloader
npm install
npm run build
php artisan optimize:clear
php artisan optimize
```

## Queue Worker (Supervisor)

`/etc/supervisor/conf.d/magic-worker.conf`:
```ini
[program:magic-worker]
process_name=%(program_name)s_%(process_num)02d
command=php /home/youruser/public_html/magic/artisan queue:work --sleep=3 --tries=3 --max-time=3600
autostart=true
autorestart=true
stopasgroup=true
killasgroup=true
user=youruser
numprocs=2
redirect_stderr=true
stdout_logfile=/home/youruser/public_html/magic/storage/logs/worker.log
stopwaitsecs=3600
```

```bash
sudo supervisorctl reread
sudo supervisorctl update
sudo supervisorctl start magic-worker:*
```

## Scheduler (Cron)

```
* * * * * cd /home/youruser/public_html/magic && php artisan schedule:run >> /dev/null 2>&1
```

## Nginx Config

```nginx
server {
    listen 80;
    server_name magicai.test;
    root /home/youruser/public_html/magic/public;

    add_header X-Frame-Options "SAMEORIGIN";
    add_header X-Content-Type-Options "nosniff";

    index index.php;

    charset utf-8;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location = /favicon.ico { access_log off; log_not_found off; }
    location = /robots.txt  { access_log off; log_not_found off; }

    # Disallow direct access to sensitive paths
    location ~ /\.(?!well-known).* {
        deny all;
    }

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.1-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }

    location ~ /\.(?!well-known).* {
        deny all;
    }
}
```

## iPaymu Payment Gateway Setup

1. Register at https://ipaymu.com
2. Get VA Number + API Key from dashboard
3. Admin panel: `/dashboard/admin/finance/paymentGatewaysadd/settings/ipaymu`
4. Fill in VA Number + API Key, set mode to Live, activate

## SEO Setup

```bash
# IndexNow - auto-submit URLs to search engines
php artisan seo:indexnow --all

# Sitemap - cached 24h
curl https://yourdomain.com/sitemap.xml

# Verify IndexNow key
curl https://yourdomain.com/indexnow-key.txt
```

## Role & Permission Management

Admin panel: `/dashboard/admin/users/permissions`

- Select **Admin** role → 24 admin permissions
- Select **User** role → 66 user menu permissions
- Uncheck any permission → menu hidden + route blocked for that role

## Post-Deploy Checklist

- [ ] `php artisan optimize:clear` run
- [ ] Storage directories exist (`storage/framework/cache/data`, `views`, `sessions`, `logs`)
- [ ] Queue worker running (`supervisorctl status`)
- [ ] Cron job active (`crontab -l`)
- [ ] iPaymu gateway configured
- [ ] Sitemap accessible at `/sitemap.xml`
- [ ] robots.txt has sitemap reference
- [ ] Frontpage loads (`/`)
- [ ] Login works (`/login`)
- [ ] Blog RSS works (`/blog/feed.xml`)
