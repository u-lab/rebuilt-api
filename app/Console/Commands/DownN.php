<?php

namespace App\Console\Commands;

use App\Events\MaintainModeDetectionEvent;
use Illuminate\Console\Command;

class DownN extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'down:n';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'メンテナンスモードに入れ、Slack通知する';

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
        if (app()->isDownForMaintenance()) {
            $this->info('現在、メンテナンス中です');
            return;
        }

        $this->call('down'); // php artisan down
        event(new MaintainModeDetectionEvent("メンテナンスモードに入りました"));
    }
}
