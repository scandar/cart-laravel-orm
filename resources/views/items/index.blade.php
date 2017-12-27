@extends('layout')
@section('title')
    Items
@endsection
@section('content')
    <a href="{{route('cart.index')}}" class="btn btn-primary">
        Go to cart
    </a>
    <a href="{{route('items.create')}}" class="btn btn-primary">
        create a new item
    </a>

    <div class="table-container">
        <table class="table table-bordered">
            @if(count($items))
                <thead>
                    <tr>
                        <th>name</th>
                        <th>price</th>
                        <th>on sale</th>
                        <th>edit</th>
                        <th>delete</th>
                    </tr>
                </thead>

                <tbody>
                        @foreach($items as $item)
                            <tr>
                                <td>{{$item->getName()}}</td>
                                <td>${{$item->getPrice()}}</td>
                                <td>
                                    @if($item->getSale())
                                        <span class="text-danger">
                                            Yes
                                        </span>
                                    @else
                                        <span>
                                            No
                                        </span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{route('items.edit',$item->getId()->toString())}}"
                                        class="btn btn-primary">
                                        Edit
                                    </a>
                                </td>
                                <td>
                                    {!! Form::open([
                                        'route' => [
                                            'items.destroy',
                                             $item->getId()->toString()
                                             ],
                                         'method' => 'DELETE'
                                         ]) !!}
                                         {!! Form::submit('Delete',['class'=>'btn btn-danger']) !!}
                                    {!! Form::close() !!}
                                </td>
                            </tr>
                        @endforeach
                </tbody>
            </table>
            @else
                <h3 class="text-center">
                    No Items,
                    <a href="{{route('items.create')}}" class="btn btn-primary">
                        create a new item
                    </a>
                </h3>
            @endif
    </div>


@endsection

@section('scripts')
@endsection
