# Mockup Kredit - Laravel Backend API Documentation

## Overview
This is the Laravel backend API for the Mockup Kredit application, providing credit product management, application processing, and user management functionalities.

## Tech Stack
- **Framework**: Laravel 12.x
- **Authentication**: Laravel Sanctum
- **Database**: SQL Server
- **PHP Version**: 8.2+

## Installation & Setup

### Prerequisites
- PHP 8.2 or higher
- Composer
- SQL Server 2019 or higher
- SQL Server PHP drivers (pdo_sqlsrv, sqlsrv)

### Environment Configuration
1. Copy `.env.example` to `.env`:
   ```bash
   cp .env.example .env
   ```

2. Configure your SQL Server database in `.env`:
   ```
   DB_CONNECTION=sqlsrv
   DB_HOST=127.0.0.1
   DB_PORT=1433
   DB_DATABASE=mockup_kredit
   DB_USERNAME=sa
   DB_PASSWORD=your_password
   DB_TRUST_SERVER_CERTIFICATE=true
   ```

3. Generate application key:
   ```bash
   php artisan key:generate
   ```

4. Run migrations:
   ```bash
   php artisan migrate
   ```

5. Seed the database with sample data:
   ```bash
   php artisan db:seed
   ```

## Database Schema

### Tables

#### 1. Users
Manages user accounts with role-based access (user/admin).
- `id`: Primary key
- `name`: User full name
- `email`: Unique email address
- `password`: Hashed password
- `role`: User role (user, admin)
- `phone`: Contact number
- `address`: User address

#### 2. Product Categories
Credit product categories (KPR, KTA, Credit Cards, etc.).
- `id`: Primary key
- `name`: Category name
- `slug`: URL-friendly slug
- `description`: Category description
- `icon`: Icon identifier

#### 3. Products
Credit products from various financial institutions.
- `id`: Primary key
- `category_id`: Foreign key to product_categories
- `name`: Product name
- `slug`: URL-friendly slug
- `description`: Detailed description
- `interest_rate_min/max`: Interest rate range
- `tenor_min/max`: Tenor range in months
- `amount_min/max`: Loan amount range
- `requirements`: Application requirements
- `benefits`: Product benefits
- `provider`: Financial institution name
- `image`: Product image URL
- `is_active`: Product availability status

#### 4. Applications
Credit applications submitted by users.
- `id`: Primary key
- `user_id`: Foreign key to users
- `product_id`: Foreign key to products
- `application_number`: Unique application number
- `amount`: Requested loan amount
- `tenor`: Chosen tenor in months
- `interest_rate`: Applied interest rate
- `status`: Application status (pending, approved, rejected, processing)
- `notes`: Admin notes
- `applicant_data`: JSON data of applicant information
- `submitted_at`: Submission timestamp
- `processed_at`: Processing timestamp

#### 5. Articles
Blog articles and educational content.
- `id`: Primary key
- `author_id`: Foreign key to users
- `title`: Article title
- `slug`: URL-friendly slug
- `excerpt`: Short excerpt
- `content`: Full article content
- `featured_image`: Image URL
- `status`: Publication status (draft, published)
- `views`: View count
- `published_at`: Publication timestamp

#### 6. OJK Data
Financial institutions registered with OJK (Otoritas Jasa Keuangan).
- `id`: Primary key
- `institution_name`: Institution name
- `institution_type`: Type (Bank, Fintech, etc.)
- `registration_number`: OJK registration number
- `status`: Registration status (active, inactive, suspended)
- `address`: Institution address
- `phone`: Contact number
- `email`: Contact email
- `website`: Institution website
- `registration_date`: Registration date

#### 7. YouTube Videos
Educational video content from YouTube.
- `id`: Primary key
- `title`: Video title
- `description`: Video description
- `youtube_id`: YouTube video ID
- `thumbnail_url`: Thumbnail image URL
- `category`: Video category
- `duration`: Video duration in seconds
- `views`: View count
- `is_featured`: Featured status

#### 8. Credit Simulations
User credit simulation history.
- `id`: Primary key
- `user_id`: Foreign key to users (nullable for guest users)
- `product_id`: Foreign key to products
- `loan_amount`: Simulated loan amount
- `tenor`: Simulated tenor
- `interest_rate`: Applied interest rate
- `monthly_payment`: Calculated monthly payment
- `total_payment`: Total payment amount
- `total_interest`: Total interest amount
- `ip_address`: User IP address

## API Endpoints

### Authentication

#### Register
```
POST /api/register
```
**Body**:
```json
{
  "name": "John Doe",
  "email": "john@example.com",
  "password": "password123",
  "password_confirmation": "password123",
  "phone": "081234567890",
  "address": "Jakarta, Indonesia"
}
```

#### Login
```
POST /api/login
```
**Body**:
```json
{
  "email": "john@example.com",
  "password": "password123"
}
```

#### Logout (Protected)
```
POST /api/logout
```
**Headers**: `Authorization: Bearer {token}`

#### Get Current User (Protected)
```
GET /api/user
```
**Headers**: `Authorization: Bearer {token}`

### Product Categories

#### List All Categories
```
GET /api/product-categories
```

#### Get Category Details
```
GET /api/product-categories/{id}
```

#### Create Category (Protected, Admin)
```
POST /api/product-categories
```

#### Update Category (Protected, Admin)
```
PUT /api/product-categories/{id}
```

#### Delete Category (Protected, Admin)
```
DELETE /api/product-categories/{id}
```

### Products

#### List Products
```
GET /api/products?category_id={id}&search={query}&is_active=1&per_page=15
```

#### Get Product Details
```
GET /api/products/{id}
```

#### Create Product (Protected, Admin)
```
POST /api/products
```

#### Update Product (Protected, Admin)
```
PUT /api/products/{id}
```

#### Delete Product (Protected, Admin)
```
DELETE /api/products/{id}
```

### Applications

#### List Applications (Protected)
```
GET /api/applications?status=pending&per_page=15
```
*Note: Users see only their applications, admins see all*

#### Submit Application (Protected)
```
POST /api/applications
```

#### Get Application Details (Protected)
```
GET /api/applications/{id}
```

#### Update Application Status (Protected, Admin)
```
PUT /api/applications/{id}
```

#### Delete Application (Protected)
```
DELETE /api/applications/{id}
```

### Articles

#### List Articles
```
GET /api/articles?status=published&per_page=15
```

#### Get Article Details
```
GET /api/articles/{id}
```

#### Create Article (Protected, Admin)
```
POST /api/articles
```

#### Update Article (Protected, Admin)
```
PUT /api/articles/{id}
```

#### Delete Article (Protected, Admin)
```
DELETE /api/articles/{id}
```

### OJK Data

#### List OJK Institutions
```
GET /api/ojk-data?institution_type={type}&status=active&search={query}
```

#### Get Institution Details
```
GET /api/ojk-data/{id}
```

#### Create OJK Data (Protected, Admin)
```
POST /api/ojk-data
```

#### Update OJK Data (Protected, Admin)
```
PUT /api/ojk-data/{id}
```

#### Delete OJK Data (Protected, Admin)
```
DELETE /api/ojk-data/{id}
```

### YouTube Videos

#### List Videos
```
GET /api/youtube-videos?category={category}&is_featured=1
```

#### Get Video Details
```
GET /api/youtube-videos/{id}
```

#### Create Video (Protected, Admin)
```
POST /api/youtube-videos
```

#### Update Video (Protected, Admin)
```
PUT /api/youtube-videos/{id}
```

#### Delete Video (Protected, Admin)
```
DELETE /api/youtube-videos/{id}
```

### Credit Simulations

#### Calculate Credit Simulation
```
POST /api/credit-simulations/calculate
```
**Body**:
```json
{
  "loan_amount": 100000000,
  "tenor": 120,
  "interest_rate": 8.5
}
```

#### List User Simulations (Protected)
```
GET /api/credit-simulations
```

#### Save Simulation (Protected)
```
POST /api/credit-simulations
```

#### Get Simulation Details (Protected)
```
GET /api/credit-simulations/{id}
```

#### Delete Simulation (Protected)
```
DELETE /api/credit-simulations/{id}
```

## Seeded Data

The database seeders provide:
- **3 Users**: 1 admin, 2 regular users
  - Admin: `admin@mockupkredit.com` / `password`
  - User: `user@mockupkredit.com` / `password`
  - User: `jane@example.com` / `password`

- **5 Product Categories**: KPR, KTA, Kartu Kredit, Kredit Kendaraan, Kredit Multiguna

- **20 Products**: Various credit products across all categories from major banks

- **3 Articles**: Sample blog posts about credit management

- **5 OJK Institutions**: Major financial institutions registered with OJK

- **3 YouTube Videos**: Sample educational videos

## Models & Relationships

### User Model
- `hasMany` Applications
- `hasMany` Articles (as author)
- `hasMany` CreditSimulations

### ProductCategory Model
- `hasMany` Products

### Product Model
- `belongsTo` ProductCategory
- `hasMany` Applications
- `hasMany` CreditSimulations

### Application Model
- `belongsTo` User
- `belongsTo` Product

### Article Model
- `belongsTo` User (as author)

### CreditSimulation Model
- `belongsTo` User (nullable)
- `belongsTo` Product

## Business Logic

### Credit Calculation
The `CreditSimulation::calculate()` method uses the standard annuity formula to calculate:
- Monthly payment
- Total payment
- Total interest

Formula: `Monthly Payment = P × [r × (1 + r)^n] / [(1 + r)^n - 1]`
Where:
- P = Principal (loan amount)
- r = Monthly interest rate (annual rate / 12 / 100)
- n = Number of months

### Application Number Generation
Format: `APP-YYYYMMDD-XXXX`
- `APP`: Prefix
- `YYYYMMDD`: Date of submission
- `XXXX`: Sequential number for the day

## Security Notes

1. All passwords are hashed using bcrypt
2. API authentication uses Laravel Sanctum tokens
3. CORS should be configured for frontend domain
4. SQL Server connection uses trusted certificate by default
5. Implement proper authorization middleware for admin routes

## Development Commands

```bash
# Run migrations
php artisan migrate

# Rollback migrations
php artisan migrate:rollback

# Fresh migration with seeding
php artisan migrate:fresh --seed

# List all routes
php artisan route:list

# Clear cache
php artisan cache:clear
php artisan config:clear
php artisan route:clear

# Run tests
php artisan test
```

## Future Enhancements

- [ ] Implement admin middleware for protected routes
- [ ] Add file upload handling for product images
- [ ] Implement email notifications for applications
- [ ] Add pagination meta in API responses
- [ ] Implement rate limiting
- [ ] Add API versioning
- [ ] Create comprehensive API tests
- [ ] Add API documentation with Swagger/OpenAPI
