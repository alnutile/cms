<?php namespace CMS\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class SetupCommand extends Command {

	protected $name = 'cms:setup';


	protected $description = 'Create the DB and run initial migration if needed';


	public function __construct()
	{
		parent::__construct();
	}

	public function fire()
	{
        if ($this->getLaravel()->environment() != 'production')
        {
            return false;
        }

        try
        {
            $path = base_path();
            if(!\File::exists($path . '/app/database/production.sqlite')) {
                //This is a first run so only here do we trigger a follow up
                // 1. migrate
                // 2. seed
                \File::put($path . '/app/database/production.sqlite', '');
                $this->migrateDb();
                $this->seedDb();
            }
        }
        catch(\Exception $e) {
            throw new \Exception("Could not make db file");
        }

        return "You are here";
	}

    protected function migrateDb()
    {
        $this->call('migrate', array());
    }

    protected function seedDb()
    {
        $this->call('db:seed', array());
    }

}
