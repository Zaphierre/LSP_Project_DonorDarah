$content = Get-Content -Path "d:\Zavier Project\example-app\resources\views\welcome.blade.php" -Raw

# 2. Fix Section titles & remove small tags
$content = $content -replace '<span class="section-tag".*?>.*?</span>\s*<h2 class="section-title"(.*?)>(.*?)</h2>', '<h2 class="text-3xl md:text-4xl font-black text-center mb-3" style="color:var(--pmi-red);"$1>$2</h2>'
$content = $content -replace '<p class="section-sub"(.*?)>(.*?)</p>', '<p class="text-base text-gray-500 max-w-2xl mx-auto text-center leading-relaxed mb-10"$1>$2</p>'

# 3. Background for section alt
$content = $content -replace '<section class="section section-alt"', '<section class="py-20 relative bg-gray-50 border-y border-gray-200"'
$content = $content -replace '<section class="section"', '<section class="py-20 relative bg-white"'

# 4. Fix Modals
# Add Tailwind classes to modal-overlay and modal-box
$content = $content -replace 'class="modal-overlay"', 'class="modal-overlay fixed inset-0 z-[2000] flex items-center justify-center bg-black/60 backdrop-blur-sm"'
$content = $content -replace 'class="modal-box"', 'class="modal-box bg-white rounded-2xl p-6 max-w-2xl w-full mx-4 shadow-2xl max-h-[90vh] overflow-y-auto"'
$content = $content -replace 'class="modal-header"', 'class="modal-header flex items-start justify-between border-b border-gray-100 pb-4 mb-4"'
$content = $content -replace 'class="modal-badge"', 'class="modal-badge inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-red-50 text-red-600 text-sm font-bold mb-2"'
$content = $content -replace '<button class="modal-close"', '<button class="modal-close w-8 h-8 flex items-center justify-center rounded-full bg-gray-100 text-gray-500 hover:bg-red-50 hover:text-red-500 transition-colors"'

Set-Content -Path "d:\Zavier Project\example-app\resources\views\welcome.blade.php" -Value $content -Encoding UTF8
