<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EventResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'name' => $this->name,
            'image' => $this->image,
            'day' => date('j', strtotime($this->start_date)),
            'month' => date('n', strtotime($this->start_date)),
            'year' => date('Y', strtotime($this->start_date)),
            'duration' => $this->calculateDuration(),
            'time' => $this->end_time ? $this->start_time . ' - ' . $this->end_time : $this->start_time,
            'color' => $this->color,
            'location' => $this->location,
            'issuer' => $this->issuer,
            'description' => $this->description,
            'series' => $this->series,
            'amount' => $this->amount,
            'issue_date' => $this->issue_date,
            'coupon' => $this->coupon,
            'url' => $this->url,
            'issue_description' => $this->issue_description,
        ];
    }

    private function calculateDuration()
    {
        if (!$this->end_date || $this->end_date == '0000-00-00') {
            return 1;
        } elseif (date('Ymd', strtotime($this->start_date)) == date('Ymd', strtotime($this->end_date))) {
            return 1;
        } else {
            $start_day = date('Y-m-d', strtotime($this->start_date));
            $end_day = date('Y-m-d', strtotime($this->end_date));
            return ceil(abs(strtotime($end_day) - strtotime($start_day)) / 86400) + 1;
        }
    }
}
