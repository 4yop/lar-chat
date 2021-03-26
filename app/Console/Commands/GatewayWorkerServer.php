<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use GatewayWorker\BusinessWorker;
use Workerman\Worker;
use GatewayWorker\Gateway;
use GatewayWorker\Register;

class GatewayWorkerServer extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'gateway-worker:server';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '开启gateway worker 服务';

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
     * @return int
     */
    public function handle()
    {
        $path = base_path()."/GatewayWorker/";
        $start_register_file = $path."start_register.php";
        $start_gateway_file = $path."start_gateway.php";
        $start_businessworker_file = $path."start_businessworker.php";
        exec("
        php
        {$start_register_file}
        {$start_gateway_file}
        {$start_businessworker_file}
        pause
        ");
    }
}
