@extends('layout')

@section('title', 'Tourism App | Items')

@section('content')
    <section class="item-list py-3">
        <div class="d-flex justify-content-start">
            <a href="{{ route('items.create') }}" type="button" class="btn btn-success" type="button" role="button">Create Item</a>
        </div>
        <div class="table-responsive mt-2">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Destination Object</th>
                        <th scope="col">Destination Category</th>
                        <th scope="col">Location</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($items as $key => $item)
                        <tr>
                            <th scope="row">{{ $key + 1 }}</th>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->category->name ?? '' }}</td>
                            <td>{{ $item->loc }}</td>
                            <td>
                                <div class="d-flex">
                                    <div>
                                        <a
                                            type="button"
                                            class="btn btn-warning btn-sm me-2"
                                            style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;"
                                            role="button"
                                            href="{{ route('items.edit', $item) }}"
                                        >
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                    </div>
                                    <form method="POST" action="{{ route('items.destroy', $item) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button
                                            type="submit"
                                            class="btn btn-danger btn-sm"
                                        >
                                            <i class="bi bi-trash3"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>
@endsection
