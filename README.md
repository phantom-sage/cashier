# Cashier System

A modern Laravel-based Point of Sale (POS) and inventory management system built with Livewire and Tailwind CSS. This system provides comprehensive product management and order processing capabilities for retail businesses.

## 🚀 Features

### 📦 Product Management
- **Product Listing**: Browse all products with search and pagination
- **Product Creation**: Add new products with name, description, price, and image
- **Product Editing**: Update existing product information
- **Product Details**: View detailed product information
- **Price Management**: Decimal precision pricing with formatted display
- **Image Support**: Upload and display product images
- **Search & Filter**: Real-time search across product names and descriptions

### 🛒 Orders & Cashier System
- **Order Creation**: Interactive cashier interface for creating new orders
- **Cart Management**: Add/remove products with quantity controls
- **Live Calculations**: Real-time total and subtotal calculations
- **Order Processing**: Secure checkout with database transactions
- **Order History**: Complete list of all processed orders
- **Order Management**: Full CRUD operations for orders

#### Order Operations
- ✅ **Create Orders**: Interactive cashier screen with product selection
- ✏️ **Edit Orders**: Modify existing orders (add/remove items, update quantities)
- 🗑️ **Delete Orders**: Remove orders with confirmation dialog
- 🧾 **Receipt Generation**: Print-friendly receipts for all orders
- 📋 **Order Listing**: Paginated order history with search functionality

### 🧾 Receipt System
- **Print-Friendly Layout**: Optimized for thermal and standard printers
- **Detailed Information**: Order number, items, quantities, prices, totals
- **Re-print Capability**: Access and print receipts for any historical order
- **Professional Design**: Clean, organized receipt format

### 🎨 User Interface
- **Modern Design**: Built with Tailwind CSS for responsive, mobile-friendly interface
- **Dark Mode Support**: Automatic theme switching based on user preference
- **Gradient Themes**: Color-coded sections (Green for cashier, Purple for orders, Orange for editing)
- **Loading States**: Visual feedback during operations
- **Error Handling**: User-friendly error messages and validation
- **Responsive Layout**: Works seamlessly on desktop, tablet, and mobile devices

### 🔐 Authentication & Security
- **Laravel Fortify**: Secure user authentication
- **Laravel Jetstream**: User profile management
- **Two-Factor Authentication**: Optional 2FA for enhanced security
- **Password Management**: Secure password reset and updates
- **Session Management**: Secure session handling

## 🛠️ Technical Stack

- **Framework**: Laravel 11.x
- **Frontend**: Livewire 3.x + Tailwind CSS
- **Database**: MySQL/PostgreSQL/SQLite
- **Authentication**: Laravel Fortify + Jetstream
- **UI Components**: Custom Livewire components
- **Styling**: Tailwind CSS with custom gradients and animations

## 📋 Requirements

- PHP 8.2 or higher
- Composer
- Node.js & NPM
- MySQL/PostgreSQL/SQLite database

## 🚀 Installation

### Quick Setup (Windows with XAMPP)

1. **Install XAMPP**
   - Download and install XAMPP from [https://www.apachefriends.org/](https://www.apachefriends.org/)
   - Start Apache and MySQL services

2. **Clone the repository**
   ```bash
   git clone https://github.com/phantom-sage/cashier
   cd cashier
   ```

3. **Generate application key**
   ```bash
   php artisan key:generate
   ```

4. **Run database migrations**
   ```bash
   php artisan migrate
   ```

5. **Start the development server**
   ```bash
   php artisan serve
   ```

### Full Installation (All Platforms)

1. **Clone the repository**
   ```bash
   git clone https://github.com/phantom-sage/cashier
   cd cashier
   ```

2. **Install PHP dependencies**
   ```bash
   composer install
   ```

3. **Install Node.js dependencies**
   ```bash
   npm install
   ```

4. **Environment setup**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

5. **Database configuration**
   - Update `.env` with your database credentials
   - Run migrations:
   ```bash
   php artisan migrate
   ```

6. **Build assets**
   ```bash
   npm run build
   ```

7. **Start the development server**
   ```bash
   php artisan serve
   ```

## 📊 Database Schema

### Products Table
- `id` - Primary key
- `name` - Product name
- `description` - Product description
- `price` - Decimal(10,2) for precise pricing
- `image` - Product image path
- `created_at` / `updated_at` - Timestamps

### Orders Table
- `id` - Primary key
- `total_amount` - Decimal(10,2) order total
- `cashier_name` - Name of cashier who created the order
- `user_id` - Foreign key to users table
- `created_at` / `updated_at` - Timestamps

### Order Items Table
- `id` - Primary key
- `order_id` - Foreign key to orders table
- `product_id` - Foreign key to products table
- `quantity` - Integer quantity
- `unit_price` - Decimal(10,2) price at time of order
- `subtotal` - Decimal(10,2) calculated subtotal
- `created_at` / `updated_at` - Timestamps

## 🎯 Usage

### Creating Products
1. Navigate to **Products** section
2. Click **"Add New Product"**
3. Fill in product details (name, description, price)
4. Upload product image (optional)
5. Save the product

### Processing Orders
1. Go to **Cashier System**
2. Search and select products to add to cart
3. Adjust quantities using +/- buttons
4. Review total amount
5. Click **"Checkout"** to complete the order
6. Print receipt if needed

### Managing Orders
1. View all orders in **Order History**
2. **Edit**: Click edit button to modify existing orders
3. **Delete**: Click delete button with confirmation
4. **Re-print**: Click view receipt to access printable version

## 🔧 Configuration

### Currency Settings
The system uses USD ($) by default. To change currency:
1. Update the currency symbol in model accessors
2. Modify the `formatted_price` and `formatted_total` methods

### Pagination
- Products: 12 items per page
- Orders: 15 items per page

### Image Storage
Product images are stored in the `public` directory. Configure storage settings in `config/filesystems.php`.

## 🎨 Customization

### Themes
The system uses gradient themes:
- **Green to Blue**: Cashier/Create operations
- **Purple to Blue**: Order viewing/listing
- **Orange to Red**: Edit operations

### Styling
All styles use Tailwind CSS utilities. Customize colors and spacing by modifying the Tailwind configuration.

## 🔒 Security Features

- **CSRF Protection**: All forms protected against CSRF attacks
- **SQL Injection Prevention**: Eloquent ORM prevents SQL injection
- **XSS Protection**: Blade templating escapes output by default
- **Database Transactions**: Ensures data integrity during order operations
- **Input Validation**: Server-side validation for all user inputs

## 📱 Mobile Support

The system is fully responsive and optimized for:
- **Desktop**: Full feature access with optimal layout
- **Tablet**: Touch-friendly interface for cashier operations
- **Mobile**: Compact layout with essential functionality

## 🚀 Performance

- **Lazy Loading**: Images loaded on demand
- **Pagination**: Efficient data loading with pagination
- **Database Indexing**: Optimized queries with proper indexes
- **Caching**: Laravel's built-in caching for improved performance

## 🤝 Contributing

1. Fork the repository
2. Create a feature branch
3. Make your changes
4. Add tests if applicable
5. Submit a pull request

## 📄 License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## 🆘 Support

For support and questions:
- Create an issue in the repository
- Check the documentation
- Review the code comments for implementation details

---

**Built with ❤️ using Laravel, Livewire, and Tailwind CSS**