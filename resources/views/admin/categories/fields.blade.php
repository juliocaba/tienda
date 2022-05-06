<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Nombre:') !!}
    {!! Form::text('name', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
</div>
<!-- Image Field -->
<div class="form-group col-sm-6">
    {!! Form::label('image', 'Imagen:') !!}    
    <div class="image-wrapper">                                                 
        {!! Form::file('file', ['class' => 'form-control-file mt-1','accept' => 'image/*']) !!}                               
    </div>          
</div>    
<!-- Submit Field -->
<div class="form-group col-sm-12"style="text-align:center;">
    {!! Form::submit('Guardar', ['class' => 'btn btn-outline-info']) !!}
    <a type="button" href="{{ route('admin.categories.index') }}" class="btn btn-outline-dark">Cancelar</a>    
</div>
