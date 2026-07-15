$content = Get-Content -Path "d:\Zavier Project\example-app\resources\views\layouts\public.blade.php" -Raw

# Update footer background and borders
$content = $content -replace 'bg-gray-900 border-t border-gray-800', 'bg-white border-t border-gray-200'
$content = $content -replace 'border-gray-800', 'border-gray-200'

# Update text colors
$content = $content -replace 'text-gray-100', 'text-gray-900'
$content = $content -replace 'text-gray-400', 'text-gray-500'

# Update social icons background
$content = $content -replace 'bg-gray-800 border-gray-700', 'bg-gray-50 border-gray-200'

Set-Content -Path "d:\Zavier Project\example-app\resources\views\layouts\public.blade.php" -Value $content -Encoding UTF8
