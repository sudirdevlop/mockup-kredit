# Deployment Checklist - Platform Perbandingan Kredit

## Pre-Deployment Checklist

### 🔧 Server Requirements

#### Production Server
- [ ] PHP 8.3+ installed
- [ ] Composer installed
- [ ] Node.js 20+ installed
- [ ] SQL Server 2019+ configured
- [ ] Web server (Apache/Nginx) configured
- [ ] SSL certificate installed
- [ ] Firewall configured
- [ ] Backup system in place

#### PHP Extensions Required
- [ ] php-sqlsrv
- [ ] php-pdo_sqlsrv
- [ ] php-mbstring
- [ ] php-xml
- [ ] php-bcmath
- [ ] php-json
- [ ] php-tokenizer
- [ ] php-gd

### 📦 Backend Deployment

1. **Clone Repository**
   ```bash
   cd /var/www
   git clone https://github.com/sudirdevlop/mockup-kredit.git
   cd mockup-kredit/backend
   ```

2. **Install Dependencies**
   ```bash
   composer install --no-dev --optimize-autoloader
   ```

3. **Environment Configuration**
   ```bash
   cp .env.example .env
   nano .env
   ```
   
   **Configure these values:**
   - [ ] `APP_NAME=Mockup Kredit`
   - [ ] `APP_ENV=production`
   - [ ] `APP_DEBUG=false`
   - [ ] `APP_URL=https://yourdomain.com`
   - [ ] `DB_CONNECTION=sqlsrv`
   - [ ] `DB_HOST=your-sqlserver-host`
   - [ ] `DB_PORT=1433`
   - [ ] `DB_DATABASE=mockup_kredit_prod`
   - [ ] `DB_USERNAME=your-db-user`
   - [ ] `DB_PASSWORD=your-secure-password`
   - [ ] `SANCTUM_STATEFUL_DOMAINS=yourdomain.com`

4. **Generate Application Key**
   ```bash
   php artisan key:generate
   ```

5. **Database Setup**
   ```bash
   php artisan migrate --force
   php artisan db:seed --class=UserSeeder  # Create admin user
   php artisan db:seed --class=ProductCategorySeeder
   php artisan db:seed --class=ProductSeeder
   # Add other seeders as needed
   ```

6. **Optimize Laravel**
   ```bash
   php artisan config:cache
   php artisan route:cache
   php artisan view:cache
   php artisan optimize
   ```

7. **Set Permissions**
   ```bash
   chown -R www-data:www-data storage bootstrap/cache
   chmod -R 775 storage bootstrap/cache
   ```

8. **Configure Web Server**
   
   **Nginx Example:**
   ```nginx
   server {
       listen 80;
       server_name api.yourdomain.com;
       root /var/www/mockup-kredit/backend/public;
       
       add_header X-Frame-Options "SAMEORIGIN";
       add_header X-Content-Type-Options "nosniff";
       
       index index.php;
       
       location / {
           try_files $uri $uri/ /index.php?$query_string;
       }
       
       location ~ \.php$ {
           fastcgi_pass unix:/var/run/php/php8.3-fpm.sock;
           fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
           include fastcgi_params;
       }
       
       location ~ /\.(?!well-known).* {
           deny all;
       }
   }
   ```

9. **Setup SSL**
   ```bash
   certbot --nginx -d api.yourdomain.com
   ```

10. **Test API**
    ```bash
    curl https://api.yourdomain.com/api/health
    ```

### 🎨 Frontend Deployment

1. **Navigate to Frontend**
   ```bash
   cd /var/www/mockup-kredit/frontend
   ```

2. **Install Dependencies**
   ```bash
   npm install
   ```

3. **Configure Environment**
   ```bash
   cp .env.example .env
   nano .env
   ```
   
   **Configure:**
   - [ ] `VITE_API_BASE_URL=https://api.yourdomain.com/api`

4. **Build for Production**
   ```bash
   npm run build
   ```

5. **Deploy Build**
   ```bash
   # Option 1: Static hosting (Netlify, Vercel)
   # Upload dist/ folder
   
   # Option 2: Own server
   cp -r dist/* /var/www/mockup-kredit-frontend/
   ```

6. **Configure Web Server**
   
   **Nginx Example:**
   ```nginx
   server {
       listen 80;
       server_name yourdomain.com www.yourdomain.com;
       root /var/www/mockup-kredit-frontend;
       
       index index.html;
       
       location / {
           try_files $uri $uri/ /index.html;
       }
       
       location ~* \.(js|css|png|jpg|jpeg|gif|ico|svg)$ {
           expires max;
           add_header Cache-Control "public, immutable";
       }
   }
   ```

7. **Setup SSL**
   ```bash
   certbot --nginx -d yourdomain.com -d www.yourdomain.com
   ```

### 🐳 Docker Deployment (Alternative)

1. **Update docker-compose.yml for production**
   - [ ] Change database password
   - [ ] Update environment variables
   - [ ] Configure volumes for persistence

2. **Deploy with Docker**
   ```bash
   cd /var/www/mockup-kredit
   docker-compose -f docker-compose.prod.yml up -d
   ```

3. **Run migrations**
   ```bash
   docker-compose exec backend php artisan migrate --force
   docker-compose exec backend php artisan db:seed
   ```

### 🔒 Security Checklist

#### Backend Security
- [ ] Change default admin password
- [ ] Disable debug mode (`APP_DEBUG=false`)
- [ ] Enable HTTPS only
- [ ] Configure CORS properly
- [ ] Set up rate limiting
- [ ] Configure CSRF protection
- [ ] Set secure session cookies
- [ ] Enable SQL Server encryption
- [ ] Set up database backups
- [ ] Configure firewall rules
- [ ] Disable directory listing
- [ ] Remove .git folder from public access
- [ ] Set proper file permissions
- [ ] Enable security headers

#### Frontend Security
- [ ] Configure Content Security Policy (CSP)
- [ ] Enable HTTPS
- [ ] Configure CORS
- [ ] Minify and obfuscate code
- [ ] Remove console.logs
- [ ] Enable XSS protection
- [ ] Set secure cookies
- [ ] Configure rate limiting

### 📊 Monitoring & Maintenance

#### Setup Monitoring
- [ ] Configure Laravel logs
- [ ] Set up error tracking (Sentry/Bugsnag)
- [ ] Configure uptime monitoring
- [ ] Set up performance monitoring
- [ ] Configure database monitoring
- [ ] Set up backup monitoring

#### Regular Maintenance
- [ ] Database backups (daily)
- [ ] Log rotation
- [ ] Security updates
- [ ] Performance optimization
- [ ] Cache clearing
- [ ] Database optimization

### 🧪 Post-Deployment Testing

#### Backend Tests
- [ ] Test API endpoints
  ```bash
  curl https://api.yourdomain.com/api/products
  ```
- [ ] Test authentication
  ```bash
  curl -X POST https://api.yourdomain.com/api/login \
    -H "Content-Type: application/json" \
    -d '{"email":"admin@mockupkredit.com","password":"password"}'
  ```
- [ ] Test database connections
- [ ] Check error logs
- [ ] Verify CORS settings
- [ ] Test rate limiting
- [ ] Verify SSL certificate

#### Frontend Tests
- [ ] Test landing page loads
- [ ] Test authentication flow
- [ ] Test product listing
- [ ] Test calculator
- [ ] Test application form
- [ ] Check console for errors
- [ ] Test on mobile devices
- [ ] Test on different browsers
- [ ] Verify SSL certificate
- [ ] Check loading times

### 📝 Documentation

- [ ] Update API base URL in documentation
- [ ] Document deployment process
- [ ] Create admin user guide
- [ ] Create user manual
- [ ] Document backup procedures
- [ ] Document rollback procedures
- [ ] Create troubleshooting guide

### 🚨 Emergency Contacts

**Development Team:**
- Lead Developer: [contact info]
- DevOps Engineer: [contact info]
- Database Admin: [contact info]

**Service Providers:**
- Hosting Provider: [contact info]
- Domain Registrar: [contact info]
- SSL Certificate Provider: [contact info]

### 🔄 Rollback Plan

If deployment fails:

1. **Backend Rollback**
   ```bash
   cd /var/www/mockup-kredit/backend
   git checkout [previous-commit-hash]
   composer install
   php artisan migrate:rollback
   php artisan cache:clear
   php artisan config:cache
   ```

2. **Frontend Rollback**
   ```bash
   cd /var/www/mockup-kredit/frontend
   git checkout [previous-commit-hash]
   npm install
   npm run build
   ```

3. **Database Rollback**
   ```sql
   -- Restore from backup
   RESTORE DATABASE mockup_kredit_prod 
   FROM DISK = 'path/to/backup.bak'
   ```

### ✅ Final Verification

- [ ] All API endpoints working
- [ ] Frontend loads correctly
- [ ] Authentication working
- [ ] Database queries performing well
- [ ] No console errors
- [ ] SSL certificate valid
- [ ] Backups running
- [ ] Monitoring active
- [ ] Documentation updated
- [ ] Team trained
- [ ] Admin credentials secured
- [ ] Deployment log created

---

## Post-Deployment

### Week 1 Tasks
- [ ] Monitor error logs daily
- [ ] Check performance metrics
- [ ] Verify backup completion
- [ ] Review security logs
- [ ] Gather user feedback

### Month 1 Tasks
- [ ] Performance optimization
- [ ] Security audit
- [ ] User feedback review
- [ ] Feature prioritization
- [ ] Update documentation

---

**Deployment Date:** _______________
**Deployed By:** _______________
**Version:** 1.0.0
**Status:** [ ] Success  [ ] Failed  [ ] Rollback
