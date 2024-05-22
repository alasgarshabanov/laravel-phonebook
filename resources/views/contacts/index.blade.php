@extends('layouts.main')
@section('title', 'Phone Book')
@section('content')
<div class="container py-3">
   <div class="row">
      <!-- Left Side - Contact Creation -->
      <div class="col-lg-4">
         <!-- Flash Message -->
         @if(session()->has('success'))
         <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
         </div>
         @endif
         <div class="card">
            <h1 class="card-header h5 text-center text-muted">Create New Contact</h1>
            <div class="card-body">
               <form id="contactForm" method="POST" action="{{ route('contacts.store') }}">
                  @csrf
                  <div class="mb-3">
                     <label for="contactFirstName" class="form-label text-muted">First Name</label>
                     <input id="contactFirstName" name="first_name" class="form-control" type="text" value="{{ old('first_name') }}" />
                     @if ($errors->has('first_name'))
                     <div class="alert alert-danger mt-2">{{ $errors->first('first_name') }}</div>
                     @endif
                  </div>
                  <div class="mb-3">
                     <label for="contactLastName" class="form-label text-muted">Last Name</label>
                     <input id="contactLastName" name="last_name" class="form-control" type="text" value="{{ old('last_name') }}" />
                     @if ($errors->has('last_name'))
                     <div class="alert alert-danger mt-2">{{ $errors->first('last_name') }}</div>
                     @endif
                  </div>
                  <div class="mb-3">
                     <label for="contactPhone" class="form-label text-muted">Phone</label>
                     <input id="contactPhone" name="phone" class="form-control" type="text" value="{{ old('phone') }}" />
                     @if ($errors->has('phone'))
                     <div class="alert alert-danger mt-2">{{ $errors->first('phone') }}</div>
                     @endif
                  </div>
                  <div class="mb-3">
                     <label for="contactAddress" class="form-label text-muted">Address</label>
                     <input id="contactAddress" name="address" class="form-control" type="text" value="{{ old('address') }}" />
                     @if ($errors->has('address'))
                     <div class="alert alert-danger mt-2">{{ $errors->first('address') }}</div>
                     @endif
                  </div>
                  <div class="mb-3">
                     <label for="contactEmail" class="form-label text-muted">Email</label>
                     <input id="contactEmail" name="email" class="form-control" type="email" value="{{ old('email') }}" />
                     @if ($errors->has('email'))
                     <div class="alert alert-danger mt-2">{{ $errors->first('email') }}</div>
                     @endif
                  </div>
                  <div class="mb-3">
                     <label for="contactNotes" class="form-label text-muted">Notes</label>
                     <textarea id="contactNotes" name="notes" class="form-control">{{ old('notes') }}</textarea>
                     @if ($errors->has('notes'))
                     <div class="alert alert-danger mt-2">{{ $errors->first('notes') }}</div>
                     @endif
                  </div>
                  <button type="submit" class="btn btn-outline-primary w-100 mb-3">Add Contact</button>
               </form>
            </div>
         </div>
      </div>
      <!-- Right Side - List of Contacts -->
      <div class="col-lg-8">
         <div class="card">
            <h1 class="card-header h5 text-center text-muted">All Contacts</h1>
            <div class="card-body">
               <!-- Filter and Search -->
               <form method="GET" action="{{ route('contacts.index') }}" class="mb-3">
                  <div class="input-group">
                     <input id="search" name="search" class="form-control" type="text" placeholder="Search contact..." value="{{ request('search') }}" />
                     <button type="submit" class="btn btn-outline-primary">Search</button>
                  </div>
               </form>
               <!-- Contacts List -->
               <div class="table-responsive">
                  <table class="table table-hover">
                  
                     <thead>
                        <tr>
                           {!! sortableTableHeader('first_name', 'First Name') !!}
                           {!! sortableTableHeader('last_name', 'Last Name') !!}
                           {!! sortableTableHeader('phone', 'Phone') !!}
                           {!! sortableTableHeader('address', 'Address') !!}
                           {!! sortableTableHeader('email', 'Email') !!}
                           <th>Notes</th>
                           {!! sortableTableHeader('created_at', 'Created At') !!}
                           <th></th>
                           <th></th>
                        </tr>
                     </thead>
                     <tbody>
                        @foreach($contacts as $contact)
                        <tr>
                           <td>{{ $contact->first_name }}</td>
                           <td>{{ $contact->last_name }}</td>
                           <td>{{ $contact->phone }}</td>
                           <td>{{ $contact->address }}</td>
                           <td>{{ $contact->email }}</td>
                           <td>
                              @php
                              $notes = $contact->notes;
                              $words = explode(' ', $notes);
                              $limitedNotes = implode(' ', array_slice($words, 0, 3));
                              @endphp
                              {{ $limitedNotes }}
                              @if (str_word_count($notes) > 5)
                              <span class="read-more" onclick="showMore('{{ $notes }}')">Read More</span>
                              @endif
                           </td>
                           <td>{{ $contact->created_at }}</td>
                           <td>
                              <a href="{{ route('contacts.edit', $contact->id) }}" class="btn btn-success">Edit</a>
                           </td>
                           <td>
                              <form action="{{ route('contacts.destroy', $contact->id) }}" method="POST" style="display:inline;">
                                 @csrf
                                 @method('DELETE')
                                 <button type="submit" class="btn btn-danger">Delete</button>
                              </form>
                           </td>
                        </tr>
                        @endforeach
                     </tbody>
                  </table>
               </div>
               <!-- Pagination -->
               <div class="pagination-container mt-3">
                  @if ($contacts->hasPages())
                  <nav aria-label="Page navigation">
                     <ul class="pagination justify-content-center">
                        {{-- Previous Page Link --}}
                        @if ($contacts->onFirstPage())
                        <li class="page-item disabled" aria-disabled="true">
                           <span class="page-link" aria-hidden="true">&laquo;</span>
                        </li>
                        @else
                        <li class="page-item">
                           <a class="page-link" href="{{ $contacts->previousPageUrl() }}" rel="prev">&laquo;</a>
                        </li>
                        @endif
                        {{-- Pagination Elements --}}
                        @php
                        $start = max(1, $contacts->currentPage() - 2);
                        $end = min($contacts->lastPage(), $contacts->currentPage() + 2);
                        @endphp
                        @if($start > 1)
                        <li class="page-item disabled" aria-disabled="true"><span class="page-link">...</span></li>
                        @endif
                        @for ($i = $start; $i <= $end; $i++)
                        <li class="page-item {{ $i === $contacts->currentPage() ? 'active' : '' }}" aria-current="page">
                           <a class="page-link" href="{{ $contacts->url($i) }}">{{ $i }}</a>
                        </li>
                        @endfor
                        @if($end < $contacts->lastPage())
                        <li class="page-item disabled" aria-disabled="true"><span class="page-link">...</span></li>
                        @endif
                        {{-- Next Page Link --}}
                        @if ($contacts->hasMorePages())
                        <li class="page-item">
                           <a class="page-link" href="{{ $contacts->nextPageUrl() }}" rel="next" >&raquo;</a>
                        </li>
                        @else
                        <li class="page-item disabled" aria-disabled="true" >
                           <span class="page-link" aria-hidden="true">&raquo;</span>
                        </li>
                        @endif
                     </ul>
                  </nav>
                  @endif
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@if(isset($executionTime))
<div class="text-center text-muted mt-4">Page rendered in {{ $executionTime }} milliseconds.</div>
@endif
<!-- Modal -->
<div class="modal fade" id="notesModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Contact Notes</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
            <p id="notesText"></p>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
         </div>
      </div>
   </div>
</div>

@endsection