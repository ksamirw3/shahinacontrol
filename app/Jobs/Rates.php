<?php

namespace App\Jobs;

use App\Models\Couch\Provider;
use App\Jobs\Job;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class Rates extends Job implements ShouldQueue {
    use InteractsWithQueue,
        SerializesModels;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    protected $service_id;
    protected $currentRate;
    protected $previousRate;

    public function __construct($service_id = '', $currentRate = '',
        $previousRate = '') {
        $this->service_id = ($service_id != '') ? $service_id : "";
        $this->currentRate = ($currentRate != '') ? $currentRate : 0;
        $this->previousRate = ($previousRate != '') ? $previousRate : 0;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function updateServiceRate() {
        $service = new \App\Models\Couch\Service();
        $data = (array) $service->find($this->service_id);
        if (empty($data["num_of_rate"])) {
            $data["num_of_rate"] = 0;
        }
        if (empty($data["total_rate"])) {
            $data["total_rate"] = 0;
        }
        if ($this->previousRate == 0) {
            $data["num_of_rate"] = (int) $data["num_of_rate"] + 1;
            $data["total_rate"] = (float) $data["total_rate"] + $this->currentRate;
        }
        else {
            $data["total_rate"] = (float) $data["total_rate"] + $this->currentRate
                - $this->previousRate;
        }

        $data['rate'] = (float) $data["total_rate"] / $data["num_of_rate"];
        if (!empty(\App\Models\Elquent\Review::where('service_id',
                    $this->service_id)->get()->toArray())) {
            \App\Models\Elquent\Review::where('service_id', $this->service_id)->update([
                "rate" => $data["rate"],
                "total_rate" => $data["total_rate"],
                "num_of_rate" => $data["num_of_rate"],
            ]);
        }
        else {
            \App\Models\Elquent\Review::create([
                "service_id" => $data['id'],
                "provider_id" => $data["provider_id"],
                "category_id" => $data["category_id"],
                "rate" => $data["rate"],
                "total_rate" => $data["total_rate"],
                "num_of_rate" => $data["num_of_rate"],
            ]);
        }
        $service->update($this->service_id, $data);
        return TRUE;
    }

    public function handle() {
        //
        $this->updateServiceRate();
        $provider = new Provider();
        if ($this->service_id == '') {
            $data = \DB::table("reviews")->select('provider_id',
                    \DB::raw('SUM(total_rate) /COUNT(total_rate) as rate'))->groupBy('provider_id')->get();
        }
        else {
            $data = \DB::table("reviews")->select('provider_id',
                    \DB::raw('SUM(total_rate) /COUNT(total_rate) as rate'))->where('service_id',
                    $this->service_id)->groupBy('provider_id')->get();
        }
        foreach ($data as $value) {
            $provider->update($value->provider_id,
                ["provider_rate" => $value->rate]);
        }
    }
}