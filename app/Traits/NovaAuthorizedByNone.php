<?php

namespace App\Traits;

use Illuminate\Http\Request;

/**
 * Set authorize to Nova resources as an MD
 *
 * @see https://nova.laravel.com/docs/4.0/resources/authorization.html
 *
 * @author Samgu Lee<cable8mm@gmail.com>
 *
 * @since 2025. 01. 17.
 */
trait NovaAuthorizedByNone
{
    public function authorizedToReplicate(Request $request)
    {
        return false;
    }

    public function authorizedToView(Request $request)
    {
        return false;
    }

    public static function authorizedToCreate(Request $request)
    {
        return false;
    }

    public function authorizedToDelete(Request $request)
    {
        return false;
    }

    public function authorizedToUpdate(Request $request)
    {
        return false;
    }
}
