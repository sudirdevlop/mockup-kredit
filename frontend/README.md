# KreditHub Frontend

Modern Vue.js 3 application for credit comparison and application platform.

## Tech Stack

- **Vue.js 3** - Progressive JavaScript framework
- **Tailwind CSS v4** - Utility-first CSS framework
- **Vue Router 4** - Official router for Vue.js
- **Pinia** - State management for Vue
- **Axios** - HTTP client
- **Vite** - Next generation frontend tooling

## Project Structure

```
src/
├── components/          # Reusable UI components
│   ├── BaseButton.vue
│   ├── BaseCard.vue
│   ├── BaseInput.vue
│   ├── BaseModal.vue
│   └── landing/        # Landing page components
├── layouts/            # Layout components
│   ├── AdminLayout.vue
│   ├── AuthLayout.vue
│   ├── DefaultLayout.vue
│   ├── UserLayout.vue
│   ├── AppHeader.vue
│   └── AppFooter.vue
├── pages/              # Page components
│   ├── auth/          # Authentication pages
│   ├── products/      # Product pages
│   ├── blog/          # Blog pages
│   ├── application/   # Application form
│   ├── user/          # User dashboard
│   └── admin/         # Admin dashboard
├── router/            # Vue Router configuration
├── stores/            # Pinia stores
│   ├── auth.js       # Authentication state
│   ├── products.js   # Product management
│   ├── comparison.js # Product comparison
│   └── preferences.js # User preferences
├── services/          # API services
│   └── api.js        # Axios instance
├── utils/             # Utility functions
│   ├── formatters.js # Format functions
│   ├── calculations.js # Credit calculations
│   └── validators.js # Validation functions
├── App.vue            # Root component
├── main.js            # Application entry point
└── style.css          # Global styles with Tailwind v4
```

## Features

### Routes
- **Public Routes:**
  - `/` - Landing page
  - `/login` - Login page
  - `/register` - Registration page
  - `/products` - Product listing
  - `/products/:id` - Product detail
  - `/comparison` - Product comparison
  - `/calculator` - Credit calculator
  - `/ojk-check` - OJK verification
  - `/blog` - Blog listing
  - `/blog/:id` - Blog detail
  - `/videos` - YouTube videos

- **Protected Routes (User):**
  - `/dashboard` - User dashboard
  - `/apply` - Application form

- **Protected Routes (Admin):**
  - `/admin` - Admin dashboard
  - `/admin/products` - Product management
  - `/admin/applications` - Application management

### State Management (Pinia)
- **Auth Store:** User authentication and authorization
- **Product Store:** Product listing and filtering
- **Comparison Store:** Product comparison with localStorage
- **Preferences Store:** User preferences and theme

### Components
- **Base Components:** Button, Card, Input, Modal
- **Layout Components:** Header, Footer, Admin/User layouts
- **Landing Components:** Hero, Featured Products, How It Works, Testimonials

### Utilities
- **Formatters:** Currency, date, number formatting
- **Calculations:** Monthly payment, amortization schedule
- **Validators:** Email, phone, NIK validation

## Setup Instructions

### Prerequisites
- Node.js 18+ 
- npm or yarn

### Installation

1. Clone the repository and navigate to frontend directory:
```bash
cd frontend
```

2. Install dependencies:
```bash
npm install
```

3. Create environment file:
```bash
cp .env.example .env
```

4. Update environment variables in `.env`:
```
VITE_API_URL=http://localhost:3000/api
```

### Development

Run development server:
```bash
npm run dev
```

The application will be available at `http://localhost:5173`

### Build for Production

```bash
npm run build
```

Build output will be in the `dist/` directory.

### Preview Production Build

```bash
npm run preview
```

## Tailwind CSS v4 Configuration

This project uses Tailwind CSS v4 with the new `@import` directive syntax. The configuration is in `src/style.css`:

```css
@import "tailwindcss";

@theme {
  --color-primary-*: /* Custom primary colors */
  --color-secondary-*: /* Custom secondary colors */
}
```

## API Integration

The frontend connects to the backend API using Axios. Configure the base URL in `.env`:

```
VITE_API_URL=http://localhost:3000/api
```

The API client includes:
- Request interceptor for authentication tokens
- Response interceptor for error handling
- Automatic redirect to login on 401 errors

## Authentication Flow

1. User logs in via `/login`
2. Token is stored in localStorage
3. Auth store manages authentication state
4. Router guards protect routes requiring authentication
5. API client includes token in all requests

## Development Guidelines

### Component Naming
- Base components: `BaseComponentName.vue`
- Page components: `PageName.vue`
- Layout components: `LayoutName.vue`

### Styling
- Use Tailwind utility classes
- Custom colors: `primary-*`, `secondary-*`
- Responsive design: Mobile-first approach

### State Management
- Use Pinia stores for shared state
- Composition API with `setup()`
- TypeScript support ready

## License

MIT
