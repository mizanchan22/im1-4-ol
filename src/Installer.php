<?php

namespace Mizanchan22\Im14Ol;

class Installer
{
    public function run()
    {
        echo "\n\033[1;34m🔧 Heylo, nak try install R&D IM1?\033[0m\n";
        echo "===========================\n";
        echo "[1]  Nak guna template apa? Boleh switch theme jugak. (AdminLTE etc)\n";
        echo "[2]  Nak buat CRUD? (Complete Model, View, Controller + Update Route *Sekali cth standard security yg dh implement*)\n";
        echo "[3]  Nak publish semua reusable component (CELL)? (Modal, SweetAlert etc)\n";
        echo "[4]  Install CI4 Shield (Complete role permission etc)\n";
        echo "[5]  Tutorial ada dalam  <<README.md>>\n";
        echo "[6]  Login (LDAP/public/mix)\n";
        echo "[7]  Nak template surat-surat rasmi/tak rasmi? \n";
        echo "[8]  Nak install aliran kerja?\n";
        echo "[9]  Nak buat option dwibahasa (dropdown)? (BM,EN)\n";
        echo "[0]  Exit\n";
        echo "Choose an option: ";

        $choice = trim(fgets(STDIN));
        match($choice) {
            '1' => $this->genTemplate(),
            '2' => $this->genCRUD(),
            '3' => $this->genComponent(),
            '4' => $this->installShield(),
            '5' => $this->showTutorial(),
            '6' => $this->genLogin(),
            '7' => $this->genSurat(),
            '8' => $this->genAliranKerja(),
            '9' => $this->genLanguage(),
            default => exit("Bye! Nak isntall balik boleh run command ni --> \n")
        };
    }

    // contoh nak auto install projek
    // echo "✅ Generating Template...\n";
    // system("composer create-project codeigniter4/appstarter my-ci4-app");
private function genTemplate()
{
    echo "\nPilih template:\n";
    echo "[1] AdminLTE\n";
    echo "[2] SBAdmin\n";
    echo "[3] NiceAdmin\n";
    echo "Pilihan anda: ";

    $template = trim(fgets(STDIN));
    $themes = [
        '1' => 'AdminLTE',
        '2' => 'SBAdmin',
        '3' => 'NiceAdmin',
    ];

    if (!array_key_exists($template, $themes)) {
        echo "❌ Pilihan tidak sah.\n";
        return;
    }

    $selected = $themes[$template];
    echo "✅ Anda pilih: $selected\n";

    $projectRoot = $this->getProjectRoot(); // Guna yang stabil
    $basePath = __DIR__ . '/Templates/' . $selected;
    $viewTarget  = $projectRoot . '/app/Views/themes/' . $selected;
    $assetTarget = $projectRoot . '/public/assets/themes/' . $selected;

    if (!is_dir($basePath)) {
        echo "📂 Template $selected belum ada. Auto generate kosong + layout...\n";

        // Auto create folder layout
        $layoutPath = $viewTarget . '/layout';
        @mkdir($layoutPath, 0777, true);

        // Layout file names
        $layoutFiles = [
            'top_layout.php' => "<!-- Top Layout -->\n<!DOCTYPE html>\n<html>\n<head>\n\t<title><?= \$title ?? 'Dashboard' ?>
</title>\n</head>\n<body>\n",
    'main_layout.php' => "
    <!-- Main Layout -->\n<?= \$this->renderSection('content') ?>\n",
    'bottom_layout.php' => "
    <!-- Bottom Layout -->\n
</body>\n</html>",
'sidebar_layout.php' => "
<!-- Sidebar Layout -->\n<div class=\"sidebar\">Sidebar content here</div>",
'login_layout.php' => "
<!-- Login Layout -->\n<h2>Login Page</h2>\n<?= \$this->renderSection('content') ?>\n",
];

foreach ($layoutFiles as $file => $content) {
file_put_contents($layoutPath . '/' . $file, $content);
echo "📝 Created: themes/$selected/layout/$file\n";
}

echo "✅ Empty layout structure generated.\n";
}

// ✅ Pastikan ni sentiasa jalan (walau template folder dah ada)
if (is_dir($basePath . '/Views')) {
$this->copyFolder($basePath . '/Views', $viewTarget);
} else {
echo "❗ Sumber tak wujud: $basePath/Views\n";
}

if (is_dir($basePath . '/Assets')) {
$this->copyFolder($basePath . '/Assets', $assetTarget);
} else {
echo "❗ Sumber tak wujud: $basePath/Assets\n";
}

echo "🎉 Siap! Template $selected dipasang.\n";
echo "📁 Views: app/Views/themes/$selected\n";
echo "🖼️ Assets: public/assets/themes/$selected\n";

echo "📁 Detected CI4 Project Root: $projectRoot\n";
$this->updateEnvTheme($selected);
}


private function copyFolder($src, $dst)
{
if (!is_dir($src)) {
echo "❗ Sumber tak wujud: $src\n";
return;
}

@mkdir($dst, 0777, true);
$dir = opendir($src);
while (false !== ($file = readdir($dir))) {
if ($file != '.' && $file != '..') {
$srcPath = $src . '/' . $file;
$dstPath = $dst . '/' . $file;

if (is_dir($srcPath)) {
$this->copyFolder($srcPath, $dstPath);
} else {
copy($srcPath, $dstPath);
echo "📄 Copied: " . str_replace(realpath(__DIR__ . '/../../../../../'), '', $dstPath) . "\n";
}
}
}
closedir($dir);
}

private function updateEnvTheme($theme)
{
$projectRoot = $this->getProjectRoot();
$envPath = $projectRoot . '/.env';

if (!file_exists($envPath)) {
echo "❌ .env file not found!\n";
return;
}

$lines = file($envPath);
$updated = false;

foreach ($lines as &$line) {
if (str_starts_with(trim($line), 'CI_THEME=')) {
$line = "CI_THEME=$theme\n";
$updated = true;
break;
}
}

if (!$updated) {
// If not found, add it at the end
$lines[] = "\nCI_THEME=$theme\n";
}

file_put_contents($envPath, implode('', $lines));
echo "🔧 CI_THEME updated in .env: $theme\n";
}

protected static function getProjectRoot(): string
{
$dir = __DIR__;
while (!file_exists($dir . '/vendor') && dirname($dir) !== $dir) {
$dir = dirname($dir);
}
if (basename($dir) === 'vendor') {
return dirname($dir);
}
return $dir;
}


private function genCRUD()
{
echo "🎨 Genrating CRUD...\n";
}

private function genComponent()
{
echo "🎨 Generating Component...\n";
}

private function installShield()
{
echo "🛡️ Installing Shield...\n";
}

private function showTutorial()
{
echo "📖 Showing Tutorial...\n";
}

private function genLogin()
{
echo "🔑 Generating Login...\n";
}

private function genSurat()
{
echo "📝 Generating Surat...\n";
}

private function genAliranKerja()
{
echo "📝 Generating Aliran Kerja...\n";
}

private function genLanguage()
{
echo "📝 Generating Language...\n";
}
}