@extends('layout')

@section('title', "Tourism App | " . ucfirst($action) . " Destinations")

@section('content')
    <section class="item-edit py-3">
        <div class="container">
            <div class="card">
                <div class="card-body">
                    <form action="{{ $action == 'update' ? route('items.update', $item) : route('items.store') }}" method="POST">
                        @csrf

                        @if ($action == 'update')
                            @method('PATCH')
                        @endif

                        <div class="mb-3">
                            <label for="name" class="form-label">Destination Object</label>
                            <input
                                type="text"
                                class="form-control @error('name') is-invalid @enderror"
                                id="name"
                                name="name"
                                placeholder="Enter destination name"
                                value="{{ $item->name ?? old('name') }}"
                            >
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="category" class="form-label">Destination Category</label>
                            <select
                                class="form-select @error('category') is-invalid @enderror"
                                aria-label="Default select example"
                                id="category"
                                name="category"
                            >
                                @if ($action == 'create' || !old('category'))
                                    <option value="" selected disabled>Select an option...</option>
                                @endif
                                @foreach ($categories as $category)
                                    @if ($action == 'update')
                                        <option value="{{ $category->id }}" @if($category->id == $item->category->id) selected @endif>{{ $category->name }}</option>
                                    @else
                                        <option value="{{ $category->id }}" @if($category->id == old('category')) selected @endif>{{ $category->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                            @error('category')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="price" class="form-label">Location</label>
                            <input
                                type="text"
                                class="form-control @error('loc') is-invalid @enderror"
                                id="loc"
                                name="loc"
                                placeholder="Enter destination location"
                                value="{{ $item->loc ?? old('loc') }}"
                            >
`
                            @error('price')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-success me-2">
                                @if ($action == 'update')
                                    Update
                                @else
                                    Submit
                                @endif
                            </button>
                            <a
                                type="button"
                                class="btn btn-secondary"
                                role="button"
                                href="{{ route('items.index', $item) }}"
                            >
                                Cancel
                            </a>
                        </div>
                    </form>
                    @if ($action == 'update')
                        <form id="form_delete" method="POST" action="{{ route('items.destroy', $item) }}">
                            @csrf
                            @method('DELETE')
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection

@section('custom-js')
    <script src="{{ asset('js/item/form.js') }}"></script>
@endsection
