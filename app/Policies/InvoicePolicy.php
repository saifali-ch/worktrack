<?php

namespace App\Policies;

use App\Models\Invoice;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class InvoicePolicy
{
    use HandlesAuthorization;

    public function download(User $user, Invoice $invoice): bool {
        return $invoice->user_id === $user->id;
    }
}
