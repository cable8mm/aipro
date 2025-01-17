<?php

namespace App\Traits;

use App\Enums\UserType;
use Illuminate\Http\Request;

/**
 * Set authorize to Nova resources as an developer
 *
 * @see https://nova.laravel.com/docs/4.0/resources/authorization.html
 *
 * @author Samgu Lee<cable8mm@gmail.com>
 *
 * @since 2025. 01. 17.
 */
trait NovaAuthorizedByManager
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
        return $request->user()?->type == UserType::ADMINISTRATOR->name
            || $request->user()?->type == UserType::DEVELOPER->name
            || $request->user()?->type == UserType::MANAGER->name;
    }

    public function authorizedToDelete(Request $request)
    {
        return $request->user()?->type == UserType::ADMINISTRATOR->name
            || $request->user()?->type == UserType::DEVELOPER->name;
    }

    public function authorizedToUpdate(Request $request)
    {
        return $request->user()?->type == UserType::ADMINISTRATOR->name
            || $request->user()?->type == UserType::DEVELOPER->name
            || $request->user()?->type == UserType::MANAGER->name;
    }
}
