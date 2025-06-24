<?php

namespace Mizanchan22\Im14Ol\Hooks;

class InstallHook
{
    public static function run()
    {
        $basePath = dirname(__DIR__, 3); // Your CI4 project root
        file_put_contents($basePath . '/install-hook-debug.log', 'HOOK EXECUTED at ' . date('Y-m-d H:i:s') . "\n", FILE_APPEND);

        $basePath = getcwd();

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
}