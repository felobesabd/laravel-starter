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

        @if(Session::has('success'))
            <div class="alert alert-success">
                {{Session::get('success')}}
            </div>
        @endif


        @if(Session::has('error'))
            <div class="alert alert-danger">
                {{Session::get('error')}}
            </div>
        @endif

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
                <tr>
                    <th scope="row">{{$offer->id}}</th>
                    <td>{{$offer->name}}</td>
                    <td>{{$offer->price}}</td>
                    <td>{{$offer->details}}</td>
                    <td><img  style="width: 90px; height: 90px;" src="{{asset('images/offer/'.$offer->photo)}}"></td>
                    <td>
                        <a class="btn btn-info" href="{{url('offer/edit/'.$offer->id)}}">
                            {{__('offer.offer_edit')}}
                        </a>
                        <a class="btn btn-danger" href="{{route('offer.delete', $offer->id)}}">
                            {{__('offer.offer_delete')}}
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <div class="d-flex justify-content-center">
            {!! $offers->links() !!}
        </div>
    </body>
</html>
