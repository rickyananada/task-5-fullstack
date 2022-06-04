@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Articles') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Title</th>
                                    <th scope="col">Content</th>
                                    <th scope="col">Image</th>
                                    <th scope="col">Category</th>
                                    <th scope="col">Make by</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($articles as $article)
                                    <tr>
                                        <th scope="row">{{ $article->id }}</th>
                                        <td>{{ $article->title }}</td>
                                        <td>{{ $article->content }}</td>
                                        <td>
                                            <img src="{{ asset('images/' . $article->image) }}"
                                                alt="{{ $article->title }}" width="100">
                                        </td>
                                        <td>{{ $article->category->name }}</td>
                                        <td>{{ $article->user->name }}</td>
                                        @if ($article->user_id == Auth::user()->id)
                                            <td>
                                                <a href="{{ route('articles.edit', $article->id) }}"
                                                    class="btn btn-primary">Edit</a>
                                                <form action="{{ route('articles.destroy', $article->id) }}"
                                                    method="POST">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button type="submit" class="btn btn-danger">Delete</button>
                                                </form>
                                            </td>
                                        @endif
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
