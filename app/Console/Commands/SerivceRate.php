<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class SerivceRate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'service:rate {itemId} {rate} {oldRate} {newRate}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        //
         $data = (array) $this->model->findByItemID($this->argument("itemId"));
        if (empty($data["num_of_rate"])) {
            $data["num_of_rate"] = 0;
        }
        if (empty($data["total_rate"])) {
            $data["total_rate"] = 0;
        }
        if ($this->argument("newRate")) {
            $data["num_of_rate"] = (int) $data["num_of_rate"] + 1;
            $data["total_rate"] = (float) $data["total_rate"] + $this->argument("rate");
        } else {
            $data["total_rate"] = (float) $data["total_rate"] + $this->argument("rate") - $this->argument("oldRate");
        }
        $data['rate'] = (float) $data["total_rate"] / $data["num_of_rate"];
        \App\Models\Elquent\Review::where('service_id', $this->argument("itemId"))->update([
            "service_id" => $data['id'],
            "provider_id" => $data["provider_id"],
            "rate" => $data["rate"],
            "total_rate" => $data["total_rate"],
            "num_of_rate" => $data["num_of_rate"],
        ]);
        $this->model->updateItemDoc($this->argument("itemId"), $data);
        dd( $data);
    }
}
