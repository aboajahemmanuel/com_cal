# Database Migrations & Seeders Summary

## Migrations Created (24 new migration files)

### Core Tables
1. **2024_12_09_000001_create_groups_table.php** - Groups table
2. **2024_12_09_000002_update_users_table.php** - Adds `usertype` and `group_id` to users table with foreign key

### Reference Tables
3. **2024_12_09_000003_create_denominations_table.php** - Denominations table
4. **2024_12_09_000004_create_market_copy_table.php** - Market Copy table
5. **2024_12_09_000024_create_market_table.php** - Market table
6. **2024_12_09_000011_create_issuers_table.php** - Issuers table

### Category & Entity Management
7. **2024_12_09_000005_update_categories_table.php** - Adds `market_id` foreign key to categories
8. **2024_12_09_000007_update_sub_categories_table.php** - Adds `category_id` foreign key to sub_categories
9. **2024_12_09_000006_create_contracts_table.php** - Contracts table with category_id foreign key

### Events & Calendar
10. **2024_12_09_000008_create_events_table.php** - Events table with all fields (title, description, dates, times, category)
11. **2024_12_09_000019_create_events_pending_table.php** - Events Pending table
12. **2024_12_09_000020_create_categories_pending_table.php** - Categories Pending table

### Security/Financial
13. **2024_12_09_000009_create_security_types_table.php** - Security Types table
14. **2024_12_09_000010_create_securities_table.php** - Securities table with security_type_id foreign key
15. **2024_12_09_000013_create_cash_im_table.php** - Cash IM Collateral table
16. **2024_12_09_000014_create_n_cash_im_table.php** - Non-Cash IM Collateral table
17. **2024_12_09_000023_create_market_union_table.php** - Market Union table

### User Management
18. **2024_12_09_000012_create_transactions_table.php** - Transactions table
19. **2024_12_09_000015_create_password_histories_table.php** - Password Histories with user_id foreign key
20. **2024_12_09_000016_create_logs_table.php** - Activity Logs with user_id foreign key
21. **2024_12_09_000017_create_login_logs_table.php** - Login Logs with user_id foreign key
22. **2024_12_09_000018_create_login_counts_table.php** - Login Counts table
23. **2024_12_09_000021_create_users_pending_table.php** - Users Pending table
24. **2024_12_09_000022_create_im_report_table.php** - IM Report table

## Seeders Created/Updated

### New Seeder
**AdminTableSeeder.php** - Creates an admin user with all permissions
- Email: `admin@com-cal.com`
- Password: `admin123`
- Name: `Administrator`
- Type: `admin`
- Assigns all permissions to the admin role

### Updated Seeder
**DatabaseSeeder.php** - Updated to call all seeders in order:
```php
$this->call([
    PermissionTableSeeder::class,
    RoleTableSeeder::class,
    AdminTableSeeder::class,
    UserTableSeeder::class,
]);
```

## Running Migrations

To run all migrations:
```bash
php artisan migrate
```

To run a specific migration:
```bash
php artisan migrate --path=database/migrations/2024_12_09_000001_create_groups_table.php
```

## Running Seeders

To seed the database with all seeders:
```bash
php artisan db:seed
```

To seed with a specific seeder:
```bash
php artisan db:seed --class=AdminTableSeeder
```

## Migration Features

All migrations follow Laravel best practices:
- ✅ Proper timestamps (created_at, updated_at)
- ✅ Foreign key constraints with cascade/set null rules
- ✅ Nullable fields where appropriate
- ✅ Down methods for rollback support
- ✅ Proper data types (id, string, text, date, time, decimal, json, etc.)

## Notes

- All migrations check for existing columns before adding to prevent errors
- Foreign keys are properly configured with appropriate delete behavior
- The admin seeder creates an admin role if it doesn't exist
- All seeders should be run in the order specified in DatabaseSeeder
