<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;

class MakeService extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:service {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate Service, Service Contract';

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $name = $this->argument('name');

        // Paths
        $servicePath = app_path("Services/{$name}/{$name}Service.php");
        $serviceContractPath = app_path("Services/{$name}/{$name}ServiceInterface.php");

        $filesystem = new Filesystem();

        // Create directories if not exist
        $filesystem->ensureDirectoryExists(dirname($servicePath));
        $filesystem->ensureDirectoryExists(dirname($serviceContractPath));

        $filesystem->put($servicePath, $this->getServiceTemplate($name));
        $this->info("Service created: {$servicePath}");

        $filesystem->put($serviceContractPath, $this->getServiceContractTemplate($name));
        $this->info("Service Contract created: {$serviceContractPath}");

        $this->info("✅ {$name}Service and {$name}Repository successfully created and registered!");
    }

    protected function getServiceTemplate($name)
    {
        return "<?php

namespace App\Services\\{$name};

use App\Services\\{$name}\\{$name}ServiceInterface;

class {$name}Service implements {$name}ServiceInterface
{

}";
    }

    protected function getServiceContractTemplate($name)
    {
        return "<?php

namespace App\Services\\{$name};

interface {$name}ServiceInterface
{
    //
}";
    }
}
