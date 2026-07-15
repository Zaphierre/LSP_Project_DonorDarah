$content = Get-Content -Path "d:\Zavier Project\example-app\resources\views\welcome.blade.php" -Raw

# Remove data-aos from modal-box
$content = $content -replace '<div class="modal-box([^"]*)" data-aos="zoom-in">', '<div class="modal-box$1">'

# Remove pointer-events:none from Pelajari buttons
$content = $content -replace 'style="pointer-events:none;"', ''

Set-Content -Path "d:\Zavier Project\example-app\resources\views\welcome.blade.php" -Value $content -Encoding UTF8
