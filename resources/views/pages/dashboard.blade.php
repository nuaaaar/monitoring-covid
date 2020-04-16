@extends('layouts.dashboard')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="">
                        <div class="form-group my-0">
                            <div class="row">
                                <div class="col-sm-10">
                                    <select name="country" class="form-control">
                                        <option value="">Semua Negara</option>
                                        @foreach ($countries as $country)
                                            @if(isset($_GET["country"]))
                                                <option value="{{ $country['alpha3Code'] }}" {{ $_GET['country'] == $country['alpha3Code'] ? 'selected' : ''}}>{{ $country['name'] }}</option>
                                            @else
                                                <option value="{{ $country['alpha3Code'] }}">{{ $country['name'] }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-sm-2">
                                    <button type="submit" class="btn btn-info block">Go !</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-1">
        <div class="col-4">
            <div class="card bg-yellow bg-darken-2 text-white py-2">
                <div class="card-body text-center">
                    <img src="/images/sick.png" alt="" height="100px">
                    <h3 class="card-text mb-0 mt-2">Dikonfirmasi</h3>
                    <h2 class="card-text font-weight-bold mt-0">{{ number_format($covids[0]["confirmed"]) }}</h2>
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="card bg-success text-white py-2">
                <div class="card-body text-center">
                    <img src="/images/heart.png" alt="" height="100px">
                    <h3 class="card-text mb-0 mt-2">Sembuh</h3>
                    <h2 class="card-text font-weight-bold mt-0">{{ number_format($covids[0]["recovered"]) }}</h2>
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="card bg-danger text-white py-2">
                <div class="card-body text-center">
                    <img src="/images/angel.png" alt="" height="100px">
                    <h3 class="card-text mb-0 mt-2">Meninggal</h3>
                    <h2 class="card-text font-weight-bold mt-0">{{ number_format($covids[0]["deaths"]) }}</h2>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-1">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th>Dikonfirmasi</th>
                                <th>Sembuh</th>
                                <th>Meninggal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($covids as $data)
                                <tr>
                                    <td>{{ $data["date"] }}</td>
                                    <td>{{ number_format($data["confirmed"]) }}</td>
                                    <td>{{ number_format($data["recovered"]) }}</td>
                                    <td>{{ number_format($data["deaths"]) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
