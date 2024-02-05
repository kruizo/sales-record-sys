<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class MigrateInOrder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'migrate_in_order';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Execute the migrations in the order specified in the file app/Console/Comands/MigrateInOrder.php \n Drop all the table in db before execute the command.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
       /** Specify the names of the migrations files in the order you want to 
        * loaded
        * $migrations =[ 
        *               'xxxx_xx_xx_000000_create_nameTable_table.php',
        *    ];
        */
        $migrations = [ 
                        '5_create_failed_jobs_table.php',
                        '6_create_personal_access_tokens_table.php',
                        '13_create_password_resets_table.php',
                        '2024_02_03_1_create_addresses_table.php',
                        '2024_02_03_2_create_customers_table.php',
                        '2024_02_03_3_create_users_table.php',
                        '2024_02_03_4_create_registered_customers_table.php',
                        '2024_02_03_6_create_orders_table.php',
                        '2024_02_03_7_create_deliveries_table.php',
                        '2024_02_03_8_create_orderlines_table.php',
                        '2024_02_03_9_create_employees_table.php',
                        '2024_02_03_10_create_delivery_employees_table.php',
        ];

        foreach($migrations as $migration)
        {
           $basePath = 'database/migrations/';          
           $migrationName = trim($migration);
           $path = $basePath.$migrationName;
           $this->call('migrate:refresh', [
            '--path' => $path ,            
           ]);
        }
    }
} 