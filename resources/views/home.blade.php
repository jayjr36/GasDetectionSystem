@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <h1>Welcome</h1>
                    <p>
                        This system continuously monitors the gas levels in your environment and alerts you in case of any fire hazards. Our goal is to ensure your safety by providing timely notifications of potential dangers.
                    </p>

                    <a href="{{ url('/display-page') }}" class="btn btn-primary">
                        View Gas Readings
                    </a>
                    <a href="{{ url('/gas-graph') }}" class="btn btn-primary">
                        Graph
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
