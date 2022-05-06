@extends('layouts.app')

@section('content')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Categorias</li>
    </ol>
    <div class="container-fluid">
        <div class="animated fadeIn">
             @include('flash::message')
             <div class="row">
                 <div class="col-lg-12">
                     <div class="card">
                         <div class="card-header">
                             <a class="pull-right" href="{{ route('admin.categories.create') }}"><button type="button" class="btn btn-outline-info">Agregar</button></a>
                         </div>
                         <div class="card-body">
                             @include('admin.categories.table')
                              <div class="pull-right">
                                     
                              </div>
                         </div>
                     </div>
                  </div>
             </div>
         </div>
    </div>
@endsection

