<?php

namespace App\Observers;

use App\Models\Newsletters;

class NewsletterObserver
{
    /**
     * Handle the Newsletters "created" event.
     */
    public function creating(Newsletters $newsletter): void
    {
        $newsletter->next_send_at = $newsletter->calculateNextSendAt();
    }


    /**
     * Handle the Newsletters "updated" event.
     */
    public function saving(Newsletters $newsletter)
    {
        // فقط إذا تغيرت القيم المتعلقة بالجدولة
        if (
            $newsletter->isDirty('send_at') ||
            $newsletter->isDirty('repeat_type') ||
            $newsletter->isDirty('repeat_interval')
        ) {
            // التأكد من وجود الحد الأدنى من القيم لحساب التاريخ
            if (!is_null($newsletter->send_at) && !is_null($newsletter->repeat_type)) {
                // ضمان وجود interval (إذا كان null نضع 1)
                $newsletter->repeat_interval = $newsletter->repeat_interval ?? 1;

                $newsletter->next_send_at = $newsletter->calculateNextSendAt();
            } else {
                // في حال فقدان قيم أساسية، نمسح التاريخ القادم
                $newsletter->next_send_at = null;
            }
        }
    }



    /**
     * Handle the Newsletters "deleted" event.
     */
    public function deleted(Newsletters $newsletters): void
    {
        //
    }

    /**
     * Handle the Newsletters "restored" event.
     */
    public function restored(Newsletters $newsletters): void
    {
        //
    }

    /**
     * Handle the Newsletters "force deleted" event.
     */
    public function forceDeleted(Newsletters $newsletters): void
    {
        //
    }
}
