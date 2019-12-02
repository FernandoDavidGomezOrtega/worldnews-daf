@extends('layouts.app')

@section('title')
    <title>{{ __('lang.create_article') }}</title>
@endsection

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        {{ __('lang.create_article') }}
                    </div>
                    <div class="card-body">
{{--                        <form action="{{ route('article.create') }}" method="POST" id="" enctype="multipart/form-data" >--}}
                            <form id="altaArticuloForm"  >
                            @csrf

                            <div class="form-group row">
                                <label for="authorReadOnly" class="col-md-3 col-form-label text-md-right">{{ __('lang.author') }}</label>
                                <div class="col-md-8">
                                    <input readonly value="{{ Auth::user()->name . ' '. Auth::user()->surname }}" type="text" id="authorReadOnly" name="authorReadOnly" class="form-control" required>

                                    <input type="hidden" name="author" value="{{ Auth::user()->id }}">
                                </div>

                            </div>

                            <div class="form-group row">
                                <label for="title" class="col-md-3 col-form-label text-md-right">{{ __('lang.title') }}</label>
                                <div class="col-md-8">
                                    <input type="text" id="title" name="title" class="form-control" required>

                                    {{-- // si se produce un error en la validacion hay una variable siponivble que es errors --}}
                                    @if ($errors->has('title'))
                                        <span class="alert-danger" role="alert">
                                    <strong>{{ $errors->first('title') }}</strong>
                                    </span>

                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="sub_title" class="col-md-3 col-form-label text-md-right">{{ __('lang.sub_title') }}</label>
                                <div class="col-md-8">
                                    <input type="text" id="sub_title" name="sub_title" class="form-control" required>

                                    {{-- // si se produce un error en la validacion hay una variable siponivble que es errors --}}
                                    @if ($errors->has('sub_title'))
                                        <span class="alert-danger" role="alert">
                                    <strong>{{ $errors->first('sub_title') }}</strong>
                                    </span>

                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="created_at" class="col-md-3 col-form-label text-md-right">{{ __('lang.created_at') }}</label>
                                <div class="col-md-8">
                                    <input readonly value="" type="text" id="created_at" name="created_at" class="form-control" required>


                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="section" class="col-md-3 col-form-label text-md-right">{{ __('lang.section') }}</label>
                                <div class="col-md-8">
                                    <select  type="select" id="section" name="section" class="form-control" required>
                                        @foreach ($sections as $section)
                                            <option value="{{ $section->id }}">{{ $section->name }}</option>
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
                                <label for="image_path" class="col-md-3 col-form-label text-md-right">{{ __('lang.image') }}</label>
                                <div class="col-md-8">
{{--                                    <input type="file" id="image_path" name="image_path" class="form-control  {{ $errors->has('image_path') ? 'is-invalid' : '' }}" required/>--}}
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
                                <label for="keywords" class="col-md-3 col-form-label text-md-right">{{ __('lang.keywords') }}</label>
                                <div class="col-md-8">
                                    <input type="text" id="keywords" name="keywords" class="form-control" required>

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
                                    <input type="text" id="slug" name="slug" class="form-control" required>

                                    {{-- // si se produce un error en la validacion hay una variable siponivble que es errors --}}
                                    @if ($errors->has('slug'))
                                        <span class="alert-danger" role="alert">
                                    <strong>{{ $errors->first('slug') }}</strong>
                                    </span>

                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="text" class="col-md-3 col-form-label text-md-right">{{ __('lang.text') }}</label>
                                <div class="col-md-8">
                                    <textarea id="text" name="text" class="form-control" required></textarea>

                                    <script src="{{ asset('vendor/unisharp/laravel-ckeditor/ckeditor.js') }}"></script>

                                    <script>
                                        // Replace the <textarea id="editor1"> with a CKEditor
                                        // instance, using default configuration.
                                        CKEDITOR.replace( 'text' );
                                    </script>

{{--                                     // si se produce un error en la validacion hay una variable siponivble que es errors--}}
                                    @if ($errors->has('text'))
                                        <span class="alert-danger" role="alert">
                                    <strong>{{ $errors->first('text') }}</strong>
                                    </span>

                                    @endif
                                </div>
                            </div>


                        </form>

                         <div class="form-group row justify-content-center">
                        <div class="form-group row">
                            <div class="col-md-6 offset-md-3">
                                <input type="button" value="{{ __('lang.exit_and_save') }}" id="in_process"  class="btn btn-primary" />
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-3">
                                <input type="submit" value="{{ __('lang.send_to_review') }}" id="for_review" class="btn btn-primary" />
{{--                                <input type="submit" value="{{ __('lang.send_to_review') }}" id="" class="btn btn-primary" />--}}
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script>
        let urlArticleSave = '{{ route('article.store') }}' ;
    </script>
@endsection



