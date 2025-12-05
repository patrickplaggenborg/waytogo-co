# SQL Import Instructions for phpMyAdmin

Your database has been split into 3 smaller files for easier uploading through phpMyAdmin.

## Files Created:
- ✅ `APP-DATA-part1.sql` (3.76 MB)
- ✅ `APP-DATA-part2.sql` (3.74 MB)
- ✅ `APP-DATA-part3.sql` (0.83 MB)
- 📦 `APP-DATA.SQL` (Original - 8.3 MB - KEPT for reference)

## Import Order (IMPORTANT):

### Step 1: Access phpMyAdmin
1. Go to http://localhost:8081
2. Login with:
   - Username: `wordpress`
   - Password: `wordpress_password`

### Step 2: Select Database
1. Click on the `wordpress` database in the left sidebar

### Step 3: Import Files IN ORDER
Import the files **one at a time** in this exact order:

#### 1. First Import: `APP-DATA-part1.sql`
- Click "Import" tab
- Click "Choose File"
- Select `APP-DATA-part1.sql`
- Click "Go" at the bottom
- Wait for success message

#### 2. Second Import: `APP-DATA-part2.sql`
- Click "Import" tab again
- Click "Choose File"
- Select `APP-DATA-part2.sql`
- Click "Go" at the bottom
- Wait for success message

#### 3. Third Import: `APP-DATA-part3.sql`
- Click "Import" tab again
- Click "Choose File"
- Select `APP-DATA-part3.sql`
- Click "Go" at the bottom
- Wait for success message

### Step 4: Verify Import
After all imports are complete, you should see all WordPress tables in the database:
- wp_posts
- wp_users
- wp_options
- wp_postmeta
- And many more WooCommerce and plugin tables

## Troubleshooting:

### If upload still fails:
The default phpMyAdmin upload limit might still be too small. You can:

1. **Increase the limit** by editing `docker-compose.yml` and adding under phpmyadmin service:
```yaml
environment:
  UPLOAD_LIMIT: 300M
```

2. **Or use command line** (easier):
```bash
docker exec -i waytogo-mysql mysql -u wordpress -pwordpress_password wordpress < APP-DATA.SQL
```

## Need Help?
- Make sure you import in the correct order (1, 2, 3)
- Wait for each import to complete before starting the next
- Check for any error messages in phpMyAdmin

