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
                    {{-- <a href="{{route('send.email')}}">Send Email</a> --}}

                </div>
            </div>

            <div class="card pt-5">
                <div class="card-header text-center">
                    <h3>Notifications</h3>
                    <div class="card-body">
                        @if($emailLogs->isEmpty())
                        <p>No email notifications available.</p>
                    @else
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Message</th>
                                    <th>Received</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($emailLogs as $log)
                                    <tr>
                                        <td>{{ $log->message }}</td>
                                        <td>{{ $log->created_at }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
@endsection
