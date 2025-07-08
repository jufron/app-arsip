<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

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
        //
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
