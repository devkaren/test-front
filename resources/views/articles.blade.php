@extends('layouts.main')
@section('title', 'Test Page | ' . $page_id)

@section('content')
    <!-- Page Content -->
    <div class="container">
        <!-- Jumbotron Header -->
        <header class="jumbotron my-4">
            <button type="button" class="btn btn-primary btn-lg float-right" data-toggle="modal" data-target="#add-article-modal">
                Add article
            </button>
        </header>

        <!-- Page Features -->
        <div class="row text-center articles">
            @if($articles)
                @foreach ($articles as $article)
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title text-left">{{$article->fields->title}}</h4>
                            <p class="card-text" title="{{$article->fields->description}}">
                                {{\Illuminate\Support\Str::limit($article->fields->description, $limit = 150, $end = '...')}}
                            </p>
                            <p class="text-left">Author: {{$article->fields->author}}</p>
                        </div>
                    </div>
                </div>
                @endforeach
            @endif
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container -->
    <!-- Modal HTML Markup -->
    <div id="add-article-modal" class="modal fade">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title">Add Article</h1>
                </div>
                <div class="modal-body">
                    <form id="add-article-form" class="needs-validation" novalidate data-page-id="{{$page_id}}">
                        <input type="hidden" name="_token" value="">
                        <div class="form-group">
                            <label class="control-label" for="article-title">Title</label>
                            <div>
                                <input type="text" name="title" id="article-title" class="form-control input-lg" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="article-author">Author</label>
                            <div>
                                <input type="text" name="author" id="article-author" class="form-control input-lg" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="article-description">Description</label>
                            <div>
                                <textarea name="description" id="article-description" class="form-control input-lg" required></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <div>
                                <button type="submit" class="btn btn-success float-right">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
@endsection
