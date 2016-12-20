<?php

namespace App\Policies;

use App\User;
use App\Purchase;
use Illuminate\Auth\Access\HandlesAuthorization;

class PurchasePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the purchase.
     *
     * @param  \App\User  $user
     * @param  \App\Purchase  $purchase
     * @return mixed
     */
    public function view(User $user, Purchase $purchase)
    {
        return $user->id == $purchase->user_id;
    }
}
