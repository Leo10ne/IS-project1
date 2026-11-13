# CAT 2 - PHP Web Application (CNS 3205 Server Administration)

Signup, login and course-feedback form hosted on a LAMP stack (Kali Linux, Apache, MariaDB, PHP).

- `register.php` - signup page (inserts into `users`)
- `login.php` - login page (verifies hashed passwords)
- `dashboard.php` - landing page after login
- `feedback.php` - extra form (POSTs to and reads from `feedback`)
- `database.sql` - creates the CAT2 database, tables and app user
