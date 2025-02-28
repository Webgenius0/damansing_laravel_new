<?php
namespace App\Traits;

use App\Models\BlockUser;
use App\Models\User;

trait blockusercheck
{
    /**
     * Check user blocked or not
     * @param $user
     * @return bool
     */
    public function checkUserBlocked($user_id)
    {
        $block = BlockUser::where('user_id', auth()->id())->where('blocked_user_id', $user_id)->first();
        return $block ? true : false;
    }

    /**
     * Check user blocked me or not
     * @param $user
     * @return bool
     */
    public function checkBlockedMe($user_id)
    {
        $block = BlockUser::where('user_id', $user_id)->where('blocked_user_id', auth()->id())->first();
        return $block ? true : false;
    }
}
