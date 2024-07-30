<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
              integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>

        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="#">Navbar</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup"
                    aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)

                        <a class="nav-item nav-link active" hreflang="{{ $localeCode }}"
                           href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">

                            {{ $properties['native'] }}

                            <span class="sr-only">(current)</span>
                        </a>
                    @endforeach
                </div>
            </div>

        </nav>

        <div class="flex-center position-ref full-height">
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

                <form method="POST" action="{{route('offer.update', $offer->id)}}" enctype="multipart/form-data">
                    @csrf

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

                    <button type="submit" class="btn btn-primary">{{__('offer.submit')}}</button>
                </form>

            </div>
        </div>
    </body>
</html>
