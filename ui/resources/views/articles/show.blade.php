@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        {{ $article->title }}
                        <img src="{{ asset('images/' . $article->image) }}" alt="{{ $article->title }}" width="100">
                    </div>

                    <div class="card-body">
                        <div class="form-group">
                            <label for="content">Content</label>
                            <textarea class="form-control" id="content" name="content" rows="3" disabled>{{ $article->content }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="category">Category</label>
                            <input type="text" class="form-control" id="category" name="category" placeholder="Category"
                                value="{{ $article->category->name }}" disabled>
                        </div>
                        <div class="form-group">
                            <label for="user">Make By</label>
                            <input type="text" class="form-control" id="user" name="user" placeholder="User"
                                value="{{ $article->user->name }}" disabled>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
