<?php

namespace Mizanchan22\Im14Ol\Hooks;

class InstallHook
{
    public static function run()
    {
        $basePath = self::getProjectRoot();
        file_put_contents($basePath . '/install-hook-debug.log', "✅ Running from: $basePath\n", FILE_APPEND);

        $commandsConfigPath = $basePath . '/app/Config/Commands.php';
        $im1CommandPath     = $basePath . '/app/Commands/Im1Install.php';

        if (!is_dir(dirname($commandsConfigPath))) {
            mkdir(dirname($commandsConfigPath), 0755, true);
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
            echo "✅ Created: app/Config/Commands.php\n";
        }

        if (!is_dir(dirname($im1CommandPath))) {
            mkdir(dirname($im1CommandPath), 0755, true);
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
            echo "✅ Created: app/Commands/Im1Install.php\n";
        }
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
}