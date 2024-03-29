# Worktrack

### Empowering Workforce Efficiency - One Invoice at a Time

Worktrack is an advanced project management and invoicing tool built specifically for businesses that manage a workforce
across various site locations. Designed with the latest version of Laravel and a modern tech stack, Worktrack
facilitates seamless worker interactions, from updating personal details to submitting invoices for payment. Its
standout features include real-time invoice generation in PDF format, automated email notifications, and meticulous
administrative control over worker details and site management.

![alt text](https://oaidalleapiprodscus.blob.core.windows.net/private/org-Jg8AgBfmQp7s77i4kRelqx2G/user-1fQ52eScLgiU9eI8JyP21TSe/img-kltzympToIJW1xIsVJXul26R.png?st=2024-03-29T00%3A22%3A23Z&se=2024-03-29T02%3A22%3A23Z&sp=r&sv=2021-08-06&sr=b&rscd=inline&rsct=image/png&skoid=6aaadede-4fb3-4698-a8f6-684d7786b067&sktid=a48cca56-e6da-484e-a814-9c849652bcb3&skt=2024-03-28T20%3A57%3A48Z&ske=2024-03-29T20%3A57%3A48Z&sks=b&skv=2021-08-06&sig=AlnjFHHFDilFNWzGs66hcpT1OXDWu/07EoLfFq18Yhc%3D)

### Key Features:

- Secure Master Login: Robust backend security to ensure safe access.
- Worker Management: Add, edit, deactivate, and reactivate worker profiles.
- Email Automation: Trigger emails automatically when adding workers or for password-less logins.
- Site Location Management: Add, edit, and delete site locations.
- Invoice Management: View, submit, and mark invoices as paid or unpaid.
- PDF Invoicing: Auto-calculate and generate professional PDF invoices with unique identification.
- Data Privacy: Workers can update their personal and banking details easily and securely.

### Project Requirements:

#### Before installation, ensure your system meets the following requirements:

- PHP: Version 8.3 or higher.
- Laravel Framework: Version 11.x is required for backend functionality. Ensure Composer is installed for managing the
  backend dependencies.
- Livewire: Version 3.x for building dynamic interfaces efficiently within Laravel.
- Node.js & NPM: Required for managing front-end packages and running build tools.
- DaisyUI: Latest compatible version for TailwindCSS, offering a vast collection of pre-styled beautiful UI components.
- A Database Engine: MySQL, PostgreSQL, SQLite, or SQL Server—Laravel supports these out-of-the-box. Ensure the selected
  database is running before attempting to migrate the database.
- A Web Server: Such as Apache or Nginx, if not using Laravel's built-in server.
- A Mail Server: To handle outgoing emails (or Mailhog for local development testing).

### Installation

Clone the repository

```shell script
git clone https://github.com/saifali-ch/worktrack.git
cd worktrack
```

Install the project dependencies

```shell script
composer install
npm install
```

Configure your environment settings including your database and mail server

```shell script
cp .env.example .env
```

Generate your app key

```shell script
php artisan key:generate
```

Run the migrations

```shell script
php artisan migrate
```

Start the development server

```shell script
php artisan serve
```

In a new terminal, launch Vite for asset compilation

```shell script
npm run dev
```

Access the application through the browser with the local server address provided, typically http://localhost:8000.

Note: These instructions assume you have PHP, Composer, and NPM installed on your local development environment.
