@extends('layouts.app')

@section('content')
    <div class="flex-center position-ref full-height">

        <div class="alert alert-success" role="alert" id="alert_success" style="display: none;">
            created successfully
        </div>
        <br>

        <div class="content">
            <div class="title m-b-md">
                {{__('offer.add_offer')}}
            </div>

            @if(Session::has('success'))
                <div class="alert alert-success" role="alert">
                    {{Session::get('success')}}
                </div>
                <br>
            @endif

            <form method="POST" id="offer_form_data" action="" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label for="photo1">add photo</label>
                    <input type="file" class="form-control" id="photo1" name="photo">
                </div>

                <div class="form-group">
                    <label for="name_en">{{__('offer.offer_name_en')}}</label>
                    <input type="text" class="form-control" id="name_en" name="name_en" placeholder="{{__('offer.offer_name_en')}}">
                    <small id="name_en_error" class="form-text text-danger"></small>
                </div>
                <div class="form-group">
                    <label for="name_ar">{{__('offer.offer_name_ar')}}</label>
                    <input type="text" class="form-control" id="name_ar" name="name_ar" placeholder="{{__('offer.offer_name_ar')}}">
                    <small id="name_ar_error" class="form-text text-danger"></small>
                </div>

                <div class="form-group">
                    <label for="price">{{__('offer.offer_price')}}</label>
                    <input type="number" class="form-control" id="price" name="price" placeholder="{{__('offer.offer_price')}}">
                    <small id="price_error" class="form-text text-danger"></small>
                </div>

                <div class="form-group">
                    <label for="details_en">{{__('offer.offer_details_en')}}</label>
                    <input type="text" class="form-control" id="details_en" name="details_en" placeholder="{{__('offer.offer_details_en')}}">
                    <small id="details_en_error" class="form-text text-danger"></small>
                </div>
                <div class="form-group">
                    <label for="details_ar">{{__('offer.offer_details_ar')}}</label>
                    <input type="text" class="form-control" id="details_ar" name="details_ar" placeholder="{{__('offer.offer_details_ar')}}">
                    <small id="details_ar_error" class="form-text text-danger"></small>
                </div>

                <button id="save_offer" class="btn btn-primary">{{__('offer.submit')}}</button>
            </form>

        </div>
    </div>
@stop
@section('scripts')
    <script>
        $(document).on('click', '#save_offer', function (e) {
            e.preventDefault();

            $('#name_en_error').text('')
            $('#name_ar_error').text('')
            $('#price_error').text('')
            $('#details_en_error').text('')
            $('#details_ar_error').text('')

            let formData = new FormData($('#offer_form_data')[0]);

            $.ajax({
                enctype: 'multipart/form-data',
                type: 'post',
                url: '{{route('ajax.offer.store')}}',
                data: formData,
                processData: false,
                contentType: false,
                cache: false,
                success: function (data) {
                    if(data.status == true) {
                        $('#alert_success').show();
                    }
                }, error: function (reject) {
                    let response = $.parseJSON(reject.responseText);
                    console.log(response);
                    $.each(response.errors, function (kay, val) {
                        $('#' + kay + '_error').text(val[0]);
                    });
                }
            });
        })
    </script>
@stop
