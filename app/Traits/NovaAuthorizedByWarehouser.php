<?php

namespace App\Traits;

use App\Enums\UserType;
use Illuminate\Http\Request;

/**
 * Set authorize to Nova resources as an warehouser
 *
 * @see https://nova.laravel.com/docs/4.0/resources/authorization.html
 *
 * @author Samgu Lee<cable8mm@gmail.com>
 *
 * @since 2025. 01. 17.
 */
trait NovaAuthorizedByWarehouser
{
    public function authorizedToReplicate(Request $request)
    {
        return false;
    }

    public function authorizedToView(Request $request)
    {
        return true;
    }

    public static function authorizedToCreate(Request $request)
    {
        return $request->user()?->type == UserType::ADMINISTRATOR->value
            || $request->user()?->type == UserType::DEVELOPER->value
            || $request->user()?->type == UserType::MANAGER->value
            || $request->user()?->type == UserType::WAREHOUSER->value;
    }

    public function authorizedToDelete(Request $request)
    {
        return false;
    }

    public function authorizedToUpdate(Request $request)
    {
        return $request->user()?->type == UserType::ADMINISTRATOR->value
            || $request->user()?->type == UserType::DEVELOPER->value
            || $request->user()?->type == UserType::MANAGER->value
            || $request->user()?->type == UserType::WAREHOUSER->value;
    }
}
