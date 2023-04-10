@extends('layout')

@section('title', "Tourism App | " . ucfirst($action) . " Destination Categories")

@section('content')
    <section class="item-edit py-3">
        <div class="container">
            <div class="card">
                <div class="card-body">
                    <form action="{{ $action == 'update' ? route('item-categories.update', $category) : route('item-categories.store') }}" method="POST">
                        @csrf

                        @if ($action == 'update')
                            @method('PATCH')
                        @endif

                        <div class="mb-3">
                            <label for="category" class="form-label">Parent Category</label>
                            <select
                                class="form-select @error('category') is-invalid @enderror"
                                id="category"
                                name="category"
                            >
                                @if (($action == 'create' && !old('category')) || ($action == 'update' && !$category->parent_category_id && !old('category')))
                                    <option value="" selected>None</option>
                                @else
                                    <option value="">None</option>
                                @endif
                                @foreach ($categoryList as $item)
                                    @if ($action == 'update' && $category->parent_category_id && $item->id != $category->id)
                                        <option value="{{ $item->id }}" @if($item->id == $category->parent_category_id) selected @endif>{{ $item->name }}</option>
                                    @else
                                        @if (isset($category))
                                            @if ($item->id != $category->id)
                                                <option value="{{ $item->id }}" @if($item->id == old('category')) selected @endif>{{ $item->name }}</option>
                                            @endif
                                        @else
                                            <option value="{{ $item->id }}" @if($item->id == old('category')) selected @endif>{{ $item->name }}</option>
                                        @endif
                                    @endif
                                @endforeach
                            </select>
                            @error('category')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input
                                type="text"
                                class="form-control @error('name') is-invalid @enderror"
                                id="name"
                                name="name"
                                placeholder="Enter destination category"
                                value="{{ $category->name ?? old('name') }}"
                            >
                            @error('price')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-success me-2">
                                {{ $action == 'update' ? 'Update' : 'Submit' }}
                            </button>
                            <a
                                type="button"
                                class="btn btn-secondary"
                                role="button"
                                href="{{ route('item-categories.index') }}"
                            >
                                Cancel
                            </a>
                        </div>
                    </form>
                    @if ($action == 'update')
                        <form id="form_delete" method="POST" action="{{ route('item-categories.destroy', $category) }}">
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
    <script src="{{ asset('js/item-category/form.js') }}"></script>
@endsection
