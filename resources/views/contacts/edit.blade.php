@extends('layouts.main')
@section('title', 'Phone book')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center">Update Contact</div>

                <div class="card-body">
                    <form id="contactForm" action="{{ route('contacts.update', $contact->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                                  
                        <div class="form-group">
                            <label for="contactFirstName" class="text-muted">First Name</label>
                            <input id="contactFirstName" name="first_name" value="{{ old('first_name', $contact->first_name) }}" class="form-control" type="text" />
                            @if ($errors->has('first_name'))
                                <div class="alert alert-danger">{{ $errors->first('first_name') }}</div>
                            @endif
                        </div>
                                  
                        <div class="form-group">
                            <label for="contactLastName" class="text-muted">Last Name</label>
                            <input id="contactLastName" name="last_name" value="{{ old('last_name', $contact->last_name) }}" class="form-control" type="text" />
                            @if ($errors->has('last_name'))
                                <div class="alert alert-danger">{{ $errors->first('last_name') }}</div>
                            @endif
                        </div>
                                  
                        <div class="form-group">
                            <label for="contactPhone" class="text-muted">Phone</label>
                            <input id="contactPhone" name="phone" value="{{ old('phone', $contact->phone) }}" class="form-control" type="text" />
                            @if ($errors->has('phone'))
                                <div class="alert alert-danger">{{ $errors->first('phone') }}</div>
                            @endif
                        </div>
                                  
                        <div class="form-group">
                            <label for="contactAddress" class="text-muted">Address</label>
                            <input id="contactAddress" name="address" value="{{ old('address', $contact->address) }}" class="form-control" type="text" />
                            @if ($errors->has('address'))
                                <div class="alert alert-danger">{{ $errors->first('address') }}</div>
                            @endif
                        </div>
                                  
                        <div class="form-group">
                            <label for="contactEmail" class="text-muted">Email</label>
                            <input id="contactEmail" name="email" value="{{ old('email', $contact->email) }}" class="form-control" type="text" />
                            @if ($errors->has('email'))
                                <div class="alert alert-danger">{{ $errors->first('email') }}</div>
                            @endif
                        </div>
                                  
                        <div class="form-group">
                            <label for="contactNotes" class="text-muted">Notes</label>
                            <input id="contactNotes" name="notes" value="{{ old('notes', $contact->notes) }}" class="form-control" type="text" />
                            @if ($errors->has('notes'))
                                <div class="alert alert-danger">{{ $errors->first('notes') }}</div>
                            @endif
                        </div>
                        <div class="text-center" >                                  
                        <button type="submit" class="btn btn-outline-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@if(isset($executionTime))
    <div class="text-center text-muted mt-4">Page rendered in {{ $executionTime }} milliseconds.</div>
@endif

@endsection
