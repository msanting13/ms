<?php

namespace App\Traits;
use Illuminate\Http\Request;

trait PublisherTrait
{
    
    public function publisher($object)
    {
        if (!$object->is_published) {
            $object->is_published = TRUE;
            $message = 'Posted';
        }
        else
        {
            $object->is_published = FALSE;
            $message = 'Unpost';
        }
        $object->save();
        return response()->json(['done' => TRUE, 'message' => $message]);
    }
}