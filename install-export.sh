#!/bin/bash
# Quick Install Script untuk Export Excel Feature
# Jalankan: bash install-export.sh

echo "================================"
echo "📥 Installing Export Excel Feature"
echo "================================"
echo ""

# 1. Install Package
echo "1. Installing maatwebsite/excel package..."
composer require maatwebsite/excel

# 2. Clear Cache
echo ""
echo "2. Clearing cache..."
php artisan config:clear
php artisan cache:clear

# 3. Vendor Publish (optional)
echo ""
echo "3. Publishing vendor files..."
php artisan vendor:publish --provider="Maatwebsite\Excel\ExcelServiceProvider" --force

# 4. Dump Autoload
echo ""
echo "4. Dumping autoload..."
composer dump-autoload

# 5. Verify Installation
echo ""
echo "5. Verifying installation..."
php artisan tinker --execute="echo 'Export feature ready!'"

echo ""
echo "================================"
echo "✅ Installation Complete!"
echo "================================"
echo ""
echo "Next steps:"
echo "1. Restart your server: php artisan serve"
echo "2. Create a meeting and add attendees"
echo "3. Go to meeting details"
echo "4. Click '📥 Export to Excel' button"
echo ""
