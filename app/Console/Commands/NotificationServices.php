<?php

namespace App\Console\Commands;

use App\Models\Subscriptions;
use Illuminate\Console\Command;

class NotificationServices extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notification:services {user = 1}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Recorrido de todos los servicios, para enviar mail de aviso';

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
        $notificationsFunction = Subscriptions::notificationEndsubscription();

        $this->info($notificationsFunction ? 'Se han mandado correos' : 'No se ha mandado ningun correo');
    }
}
