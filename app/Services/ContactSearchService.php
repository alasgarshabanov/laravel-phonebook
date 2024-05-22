<?php

namespace App\Services;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactSearchService
{
    public function searchContacts(Request $request)
    {
        $query = Contact::query();

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where(function($q) use ($search) {
                $q->where('first_name', 'like', "%{$search}%")
                    ->orWhere('last_name', 'like', "%{$search}%")
                    ->orWhere('phone', 'like', "%{$search}%")
                    ->orWhere('address', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('notes', 'like', "%{$search}%")
                    ->orWhere('created_at', 'like', "%{$search}%");
            });
        }

        return $query;
    }

    public function sortContacts($query, $sortBy, $sortOrder)
    {
        return $query->orderBy($sortBy, $sortOrder);
    }
}
