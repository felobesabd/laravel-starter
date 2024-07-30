@extends('layouts.app')

@section('content')

    <div class="alert alert-success" role="alert" id="alert_success" style="display: none;">
        deleted successfully
    </div>
    <br>

    <table class="table table-dark">
        <thead>
        <tr>
            <th scope="col">{{__('offer.offer_id')}}</th>
            <th scope="col">{{__('offer.offer_name')}}</th>
            <th scope="col">{{__('offer.offer_price')}}</th>
            <th scope="col">{{__('offer.offer_details')}}</th>
            <th scope="col">{{__('offer.offer_photo')}}</th>
            <th scope="col">{{__('offer.offer_operation')}}</th>
        </tr>
        </thead>
        <tbody>
        @foreach($offers as $offer)
            <tr class="offer_row_{{$offer->id}}">
                <th scope="row">{{$offer->id}}</th>
                <td>{{$offer->name}}</td>
                <td>{{$offer->price}}</td>
                <td>{{$offer->details}}</td>
                <td><img  style="width: 90px; height: 90px;" src="{{asset('images/offer/'.$offer->photo)}}"></td>
                <td>
                    <a class="btn btn-info" href="{{route('ajax.offer.edit', $offer->id)}}">
                        {{__('offer.offer_edit')}}
                    </a>
                    <a class="btn btn-danger delete_offer" href="" offer_id="{{$offer->id}}">
                        {{__('offer.offer_delete')}}
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@stop

@section('scripts')
    <script>
        $(document).on('click', '.delete_offer', function (e) {
            e.preventDefault();

            let offer_id = $(this).attr('offer_id');

            $.ajax({
                type: 'post',
                url: '{{route('ajax.offer.delete')}}',
                data: {
                    '_token': '{{csrf_token()}}',
                    'id': offer_id,
                },
                success: function (data) {
                    if(data.status == true) {
                        $('#alert_success').show();
                        $('.offer_row_'+data.id).remove();
                    }
                }, error: function (reject) {

                }
            });
        })
    </script>
@stop
