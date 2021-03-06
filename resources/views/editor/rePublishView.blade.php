@extends('layouts.app')

@section('title')
    <title>Republicar</title>
@endsection

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                {{-- // mostramos mensaje --}}
                @include('includes.message')
                <div class="card">
                    <div class="card-header">
                        Republicar
                    </div>
                    <div class="card-body">
                        <form action="{{ route('editor.rePublish') }}" method="POST" id="" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" value="{{ $article->id }}" name="id" id="" />
                            <input type="hidden" value="{{ $article->article_id }}" name="articleId" id="" />
                            <input type="hidden" value="{{ $article->edited_by }}" name="editedBy" id="" />

                            <div class="form-group row">
                                <label for="title" class="col-md-3 col-form-label text-md-right">Título</label>
                                <div class="col-md-8">
                                    <input type="text" value="{{ $article->title }}" id="title" name="title" class="form-control" required>


                                    {{-- // si se produce un error en la validacion hay una variable siponivble que es errors --}}
                                    @if ($errors->has('title'))
                                        <span class="alert-danger" role="alert">
                                    <strong>{{ $errors->first('title') }}</strong>
                                    </span>

                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="sub_title" class="col-md-3 col-form-label text-md-right">Subtítulo</label>
                                <div class="col-md-8">
                                    <input type="text" value="{{ $article->sub_title }}" id="sub_title" name="sub_title" class="form-control" required>

                                    {{-- // si se produce un error en la validacion hay una variable siponivble que es errors --}}
                                    @if ($errors->has('sub_title'))
                                        <span class="alert-danger" role="alert">
                                    <strong>{{ $errors->first('sub_title') }}</strong>
                                    </span>

                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="created_at" class="col-md-3 col-form-label text-md-right">Creado</label>
                                <div class="col-md-8">
                                    <input readonly value="{{ $article->created_at }}" type="text" id="created_at" name="created_at" class="form-control" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="section" class="col-md-3 col-form-label text-md-right">Sección</label>
                                <div class="col-md-8">
                                    <select  type="select" id="section" name="section" class="form-control" required>
                                        @foreach ($sections as $section)
                                            <option value="{{ $section->id }}"
                                                    @if ($section->id == $article->section_id)
                                                    selected
                                                @endif
                                            >{{ $section->name }}</option>
                                        @endforeach
                                    </select>

                                    {{-- // si se produce un error en la validacion hay una variable siponivble que es errors --}}
                                    @if ($errors->has('section'))
                                        <span class="alert-danger" role="alert">
                                    <strong>{{ $errors->first('section') }}</strong>
                                    </span>

                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-10 offset-md-1">
                                    <img class="preview-img avatar" src="{{ route('article.file', ['filename' => $article->image_path]) }}"  alt="Imagen de la noticia">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="image_path" class="col-md-3 col-form-label text-md-right">Cambiar imagen</label>
                                <div class="col-md-8">
                                    {{--                                    <input type="file" value="{{ $article->image_path }}" id="image_path" name="image_path" class="form-control  {{ $errors->has('image_path') ? 'is-invalid' : '' }}" required/>--}}
                                    <input type="file" id="image_path" name="image_path" class="form-control  {{ $errors->has('image_path') ? 'is-invalid' : '' }}" />

                                    {{-- // si se produce un error en la validacion hay una variable siponivble que es errors --}}
                                    @if ($errors->has('image_path'))
                                        <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('image_path') }}</strong>
                                    </span>

                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="keywords" class="col-md-3 col-form-label text-md-right">Tags</label>
                                <div class="col-md-8">
                                    <input type="text" value="{{ $article->keywords }}" id="keywords" name="keywords" class="form-control" required>

                                    {{-- // si se produce un error en la validacion hay una variable siponivble que es errors --}}
                                    @if ($errors->has('keywords'))
                                        <span class="alert-danger" role="alert">
                                    <strong>{{ $errors->first('keywords') }}</strong>
                                    </span>

                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="slug" class="col-md-3 col-form-label text-md-right">{{ __('Slug') }}</label>
                                <div class="col-md-8">
                                    <input type="text" value="{{ $article->slug }}" id="slug" name="slug" class="form-control" required>

                                    {{-- // si se produce un error en la validacion hay una variable siponivble que es errors --}}
                                    @if ($errors->has('slug'))
                                        <span class="alert-danger" role="alert">
                                    <strong>{{ $errors->first('slug') }}</strong>
                                    </span>

                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="text" class="col-md-3 col-form-label text-md-right">Texto</label>
                                <div class="col-md-8">
                                    <textarea id="text" name="text" class="form-control" required>{{ $article->text }}</textarea>
                                    {{--                                    CKEDITOR--}}
                                    <script src="{{ asset('vendor/unisharp/laravel-ckeditor/ckeditor.js') }}"></script>

                                    <script>
                                        // Replace the <textarea id="editor1"> with a CKEditor
                                        // instance, using default configuration.
                                        CKEDITOR.replace( 'text' );
                                    </script>

                                    {{-- // si se produce un error en la validacion hay una variable siponivble que es errors --}}
                                    @if ($errors->has('text'))
                                        <span class="alert-danger" role="alert">
                                    <strong>{{ $errors->first('text') }}</strong>
                                    </span>

                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="state" class="col-md-3 col-form-label text-md-right">Estado</label>
                                <div class="col-md-8">
                                    <input type="text" readonly value="{{ $article->state }}" id="state" name="" class="form-control" required>

                                    {{-- // si se produce un error en la validacion hay una variable siponivble que es errors --}}
                                    @if ($errors->has('state'))
                                        <span class="alert-danger" role="alert">
                                    <strong>{{ $errors->first('state') }}</strong>
                                    </span>

                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="editorComments" class="col-md-3 col-form-label text-md-right">Comentarios del editor</label>
                                <div class="col-md-8">
                                    <textarea @if (Auth::user() && Auth::user()->usertype != 'editor')
                                              readonly
                                              @endif id="editorComments" name="editorComments" class="form-control" required autofocus>{{$article->editor_comments }} </textarea>

                                    {{-- // si se produce un error en la validacion hay una variable siponivble que es errors --}}
                                    @if ($errors->has('editorComments'))
                                        <span class="alert-danger" role="alert">
                                    <strong>{{ $errors->first('editorComments') }}</strong>
                                    </span>

                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-6 offset-md-3">
                                    <input type="submit" value="Devolver al autor" id="" name="submitState" class="btn btn-primary" />
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-6 offset-md-3">
                                    <input type="submit" value="Republicar" id="" name="submitState" class="btn btn-primary" />
                                </div>
                            </div>

                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection
