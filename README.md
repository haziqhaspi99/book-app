# Multi-Branch Retail & Clinic Queue Planner

An enterprise-grade, lightweight Multi-Branch Queue Management Ecosystem engineered with the **Laravel TALL Stack**. This platform digitizes booking flows and waiting room tracking loops for multi-location healthcare clinics and retail outlets.

## 🚀 Architectural Highlights (Senior Specifications)
- **Isolated Domain Actions:** Core multi-table workflows are contained in standalone Action classes utilizing secure database transactions (`DB::transaction`) to guarantee data integrity.
- **Real-Time Synchronicity:** Employs Livewire background polling loops to synchronize counter operations and public displays under 3 seconds without full page refreshes.
- **Strict Data Types:** All primary classes execute under strict type enforcement constraints (`declare(strict_types=1);`) for predictable, bug-free operations.
- **Automated Code Standards:** Styled entirely to international structural regulations using **Laravel Pint** running the strict `PSR-12` preset configuration.
- **Robust Test Coverages:** Protected by an automated Feature and Unit testing suite running via the modern **Pest** framework.

## 🛠️ Tech Stack Ecosystem
- **Core Engine:** PHP 8.2+ / Laravel Framework 11
- **Reactive UI Layer:** Laravel Livewire / HTML5 / Tailwind CSS Framework
- **Database Engine:** MySQL Database Management via Eloquent ORM

## 📋 Core System Features
1. **Public Booking Form (`/`):** Features reactive dropdowns loaded dynamically from MySQL and real-time input verification using Livewire field blurs.
2. **Staff Command Deck (`/dashboard/staff`):** Private dashboard for counter employees to manage branch traffic, call the next ticket, mark tasks as completed, or skip absent patients.
3. **Lobby TV Monitor View (`/display`):** A high-contrast, public-facing monitor dashboard featuring automatic database synchronization and synchronized auditory chime cues to alert patients.

## ⚙️ Local Installation & Setup

1. **Clone the Repository:**
   ```bash
   git clone https://github.com
   cd book-app
   ```

2. **Install Dependencies:**
   ```bash
   composer install
   npm install && npm run dev
   ```

3. **Configure Environment:**
   - Duplicate `.env.example` and rename it to `.env`
   - Create a database in XAMPP phpMyAdmin named `book_app1`
   - Update your `.env` database parameters:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=book_app1
   DB_USERNAME=root
   DB_PASSWORD=
   ```

4. **Run Migrations and Seeders:**
   ```bash
   php artisan migrate:fresh --seed
   ```

5. **Boot local environment server:**
   ```bash
   php artisan serve
   ```
   Open `http://127.0.0.1:8000` inside your browser windows to test the system ecosystem loop.

## 🧪 Verification & Testing
Run the automated quality assurance suite to verify operational integrity:
```bash
php artisan test
```
 
