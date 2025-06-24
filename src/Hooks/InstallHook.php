<?php

namespace Mizanchan22\Im14Ol\Hooks;

class InstallHook
{
    public static function run()
    {
        $basePath = getcwd(); // CI4 root project

        // ===== 1. Create app/Config/Commands.php =====
        $configDir = $basePath . '/app/Config';
        $commandsConfigPath = $configDir . '/Commands.php';

        if (!is_dir($configDir)) {
            mkdir($configDir, 0755, true);
            echo "📁 Created directory: app/Config\n";
        }

        if (!file_exists($commandsConfigPath)) {
            file_put_contents($commandsConfigPath, <<<PHP
<?php
namespace Config;

use CodeIgniter\Config\BaseCommand;

class Commands extends BaseCommand
{
    public \$commands = [
        'im1:install' => \\App\\Commands\\Im1Install::class,
    ];
}
PHP);
            echo "✅ Created file: app/Config/Commands.php\n";
        }

        // ===== 2. Create app/Commands/Im1Install.php =====
        $commandsDir = $basePath . '/app/Commands';
        $im1CommandPath = $commandsDir . '/Im1Install.php';

        if (!is_dir($commandsDir)) {
            mkdir($commandsDir, 0755, true);
            echo "📁 Created directory: app/Commands\n";
        }

        if (!file_exists($im1CommandPath)) {
            file_put_contents($im1CommandPath, <<<PHP
<?php

namespace App\\Commands;

use CodeIgniter\\CLI\\BaseCommand;
use CodeIgniter\\CLI\\CLI;
use Mizanchan22\\Im14Ol\\Installer;

class Im1Install extends BaseCommand
{
    protected \$group       = 'im1';
    protected \$name        = 'im1:install';
    protected \$description = 'Run the IM1 Installer from spark command';

    public function run(array \$params)
    {
        \$installer = new Installer();
        \$installer->run();
    }
}
PHP);
            echo "✅ Created file: app/Commands/Im1Install.php\n";
        }
    }
}