<?php

namespace App\Http\Controllers;
use App\Http\Requests\ContactRequest;
use App\Services\ContactSearchService;
use App\Models\Contact;
    
use Illuminate\Http\Request;


class ContactController extends Controller
{

    public function index(Request $request, ContactSearchService $contactSearchService)
    {
        $query = $contactSearchService->searchContacts($request);

        if ($request->has('sort_by')) {
            $sortBy = $request->input('sort_by');
            $sortOrder = $request->input('sort_order', 'asc');
            $contactSearchService->sortContacts($query, $sortBy, $sortOrder);
        } else {
            // Default sorting by created_at
            $query->orderBy('created_at');
        }

        $contacts = $query->paginate(15);

        return view('contacts.index', compact('contacts'));
    }
    
    public function create()
    {
        return view('contacts.create');
    }
    public function store(ContactRequest $request)
    {
        $validated_data = $request->all();
        Contact::create($validated_data);
    
        session()->flash('success', 'Contact created successfully!');
    
        return redirect()->route('contacts.index');
    }
    
    public function edit(Contact $contact)
    {
        return view('contacts.edit', compact('contact'));
    }

    public function update(ContactRequest $request, Contact $contact)
    {
        $validated_data = $request->validated();
        $contact->update($validated_data);
        session()->flash('success', 'Contact updated successfully!');
        return redirect()->route('contacts.index');
    }               

    public function destroy(Contact $contact)
    {
        $contact->delete();
        session()->flash('success', 'Contact deleted successfully!');
        return redirect()->route('contacts.index');
    }
}