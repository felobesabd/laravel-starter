@extends('layouts.app')

@section('content')
    <div class="flex-center position-ref full-height">

        <div class="alert alert-success" role="alert" id="alert_success" style="display: none;">
            updated successfully
        </div>
        <br>

        <div class="content">
            <div class="title m-b-md">
                {{__('offer.add_offer')}}
            </div>

            <form method="POST" id="form_update_offer" action="" enctype="multipart/form-data">
                @csrf

                <input type="number" style="display: none;" class="form-control" name="id" value="{{$offer->id}}">

                <div class="form-group">
                    <label for="name_en">{{__('offer.offer_name_en')}}</label>
                    <input
                        type="text" class="form-control" id="name_en" name="name_en"
                        value="{{$offer->name_en}}" placeholder="{{__('offer.offer_name_en')}}"
                    >
                    @error('name_en')
                    <small id="name_en" class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="name_ar">{{__('offer.offer_name_ar')}}</label>
                    <input
                        type="text" class="form-control" id="name_ar" name="name_ar"
                        value="{{$offer->name_ar}}"  placeholder="{{__('offer.offer_name_ar')}}"
                    >
                    @error('name_ar')
                    <small id="name_ar" class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="price1">{{__('offer.offer_price')}}</label>
                    <input type="number" class="form-control" id="price1" name="price"
                           value="{{$offer->price}}"  placeholder="{{__('offer.offer_price')}}">
                    @error('price')
                    <small id="price1" class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="details_en">{{__('offer.offer_details_en')}}</label>
                    <input type="text" class="form-control" id="details_en" name="details_en"
                           value="{{$offer->details_en}}"  placeholder="{{__('offer.offer_details_en')}}">
                    @error('details_en')
                    <small id="details1" class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="details_ar">{{__('offer.offer_details_ar')}}</label>
                    <input type="text" class="form-control" id="details_ar" name="details_ar"
                           value="{{$offer->details_ar}}"  placeholder="{{__('offer.offer_details_ar')}}">
                    @error('details_ar')
                    <small id="details_ar" class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>

                <button type="text" id="update_offer" class="btn btn-primary">{{__('offer.submit')}}</button>
            </form>

        </div>
    </div>
@stop

@section('scripts')
    <script>
        $(document).on('click', '#update_offer', function (e) {
            e.preventDefault();

            let formData = new FormData($('#form_update_offer')[0]);

            $.ajax({
                enctype: 'multipart/form-data',
                type: 'post',
                url: '{{route('ajax.offer.update')}}',
                data: formData,
                processData: false,
                contentType: false,
                cache: false,
                success: function (data) {
                    if(data.status == true) {
                        $('#alert_success').show();
                    }
                }, error: function (reject) {

                }
            });
        })
    </script>
@stop
