<?php

namespace App\Nova\Metrics;

use App\Enums\PaymentMethod;
use App\Models\RetailPurchase;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Metrics\Partition;
use Laravel\Nova\Metrics\PartitionResult;

class RetailPurchaseSumPaymentMethod extends Partition
{
    /**
     * Calculate the value of the metric.
     *
     * @return mixed
     */
    public function calculate(NovaRequest $request): PartitionResult
    {
        return $this->count($request, RetailPurchase::class, 'payment_method')
            ->label(fn ($value) => PaymentMethod::tryFrom($value)?->value());
    }

    /**
     * Determine the amount of time the results of the metric should be cached.
     *
     * @return \DateTimeInterface|\DateInterval|float|int|null
     */
    public function cacheFor()
    {
        // return now()->addMinutes(5);
    }

    /**
     * Get the URI key for the metric.
     *
     * @return string
     */
    public function uriKey()
    {
        return 'retail-purchase-sum-payment-method';
    }

    public function name()
    {
        return __('Retail Purchase Sum Payment Method');
    }
}
