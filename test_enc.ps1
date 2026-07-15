$text = "🩸"
$bytes = [System.Text.Encoding]::GetEncoding(1252).GetBytes($text)
$fixed = [System.Text.Encoding]::UTF8.GetString($bytes)
Write-Host "Fixed: $fixed"

$fileText = [System.IO.File]::ReadAllText("d:\Zavier Project\example-app\resources\views\welcome.blade.php")
$bytes = [System.Text.Encoding]::GetEncoding(1252).GetBytes($fileText)
$fixedText = [System.Text.Encoding]::UTF8.GetString($bytes)
[System.IO.File]::WriteAllText("d:\Zavier Project\example-app\resources\views\welcome.blade.php", $fixedText)
