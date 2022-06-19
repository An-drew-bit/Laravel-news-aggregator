@extends('front.layouts.layout')

@section('content')
    <div class="container py-4">
        <div class="p-5 mb-4 bg-light rounded-3">
            <div class="container-fluid py-5">
                <h1 class="display-5 fw-bold">{{ $news->title }}</h1>
                <p class="col-md-8 fs-4">{{ $news->description }}</p>
            </div>
        </div>

        <div class="row align-items-md-stretch">
            <div class="col-md-6">
                @if($news->image)
                    <div class="h-100 p-5 text-white bg-dark rounded-3">
                        <img src="{{ Storage::url($news->image) }}" alt="image">
                    </div>
                @else
                    <div class="h-100 p-5 text-white bg-dark rounded-3">
                        <h2>Change the background</h2>
                        <p>Swap the background-color utility and add a `.text-*` color utility to mix up the jumbotron look. Then, mix and match with additional component themes and more.</p>
                    </div>
                @endif
            </div>
            <div class="col-md-6">
                <div class="h-100 p-5 bg-light border rounded-3">
                    <h2>{{ $news->category->title }}</h2>
                    <p>Or, keep it light and add a border for some added definition to the boundaries of your content. Be sure to look under the hood at the source HTML here as we've adjusted the alignment and sizing of both column's content for equal-height.</p>
                    <a class="btn btn-outline-secondary" href="{{ route('categories.view', ['slug' => $news->category->slug]) }}">Перейти</a>
                </div>
            </div>
        </div>
    </div>
@endsection
