<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\CouchModel;
use Illuminate\Support\Facades\DB;

class ProviderRate extends Command {

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'provider:rating {--queue=high}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Re-Calculate provider rating';
    protected $model;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(\App\Models\Couch\ProviderProfile $model) {
        parent::__construct();
        $this->model = $model;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle() {
        //
        $data = \Illuminate\Support\Facades\DB::table("reviews")->select('provider_id', DB::raw('SUM(total_rate) /COUNT(total_rate) as rate'))->groupBy('provider_id')->get();
        foreach ($data as $provider) {
            $this->model->update($provider->provider_id, ["provider_rate"=>(float)$provider->rate]);
        }
    }

}
