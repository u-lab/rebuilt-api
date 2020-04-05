<?php

namespace App\Console\Commands;

use App\Events\MaintainModeDetectionEvent;
use Illuminate\Console\Command;

class UpN extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'up:n';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'メンテナンスモードをやめ、Slack通知する';

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
        if (!app()->isDownForMaintenance()) {
            $this->info('現在、メンテナンスモードではありません。');
            return;
        }

        $this->call('up'); // php artisan up
        event(new MaintainModeDetectionEvent("メンテナンスモードが解除されました"));
    }
}
