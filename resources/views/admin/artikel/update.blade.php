@extends('master')

@section('content')
<div class="col-md-12">
    <div class="card card-user">
        <div class="card-header">
            <h5 class="card-title">Update Artikel</h5>
        </div>
        <div class="card-body">
            <form method="POST" role="form" action="{{ url('/artikel/aksi_update/'.$artikel->id) }}" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Judul</label>
                            <input type="text" value="{{ $artikel->judul }}" name="judul" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Isi Artikel</label>
                            <textarea name="artikel" class="form-control" id="mytextarea" cols="30"
                                rows="35">{{ $artikel->artikel }}</textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <img src="{{ URL::asset('/uploads/image/artikel/'.$artikel->gambar) }}"
                                class="img-thumbnail" alt="" style="width: 240px;height: 320px;">
                            <br>
                            <label>Thumbnail</label>
                            <div class="custom-file" id="customFile" lang="es">
                                <input type="file" name="gambar" class="custom-file-input" id="exampleInputFile"
                                    aria-describedby="fileHelp">
                                <label class="custom-file-label" for="exampleInputFile">
                                    Select file...
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <button type="submit" class="form-control btn btn-primary">Submit</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@stop
