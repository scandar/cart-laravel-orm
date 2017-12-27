@extends('layout')
@section('title')
    Items
@endsection
@section('content')
    <a href="{{route('cart.index')}}" class="btn btn-primary">
        Go to cart
    </a>
    <a href="{{route('items.index')}}" class="btn btn-primary">
        Item index
    </a>

    <div class="table-container">
        {!! Form::open(['route' => [
            'items.update',
            isset($item)?$item->getId()->tostring():null,
            ], 'method' => 'PATCH']) !!}

            {!! Form::label('name', 'Name') !!}
            {!! Form::text('name',
            isset($item)?$item->getName():old('name'),
            ['class'=>'form-control']) !!}

            {!! Form::label('price', 'Price') !!}
            {!! Form::text('price',
            isset($item)?$item->getPrice():old('price'),
            ['class'=>'form-control']) !!}

            {!! Form::label('sale', 'Sale') !!}
            {!! Form::select('sale', [
                0 => 'no',
                1 => 'yes',
            ],
            isset($item)?$item->getSale():old('sale'),
            ['class'=>'form-control']) !!}

            {!! Form::submit('Submit',[
                'class'=>'btn btn-success btn-block',
                'style'=> 'margin-top:20px;'
            ]) !!}
        {!! Form::close() !!}

    </div>


@endsection

@section('scripts')
@endsection
