@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-sm-8">
                <div class="card">
                    <div class="card-header">
                        Money Log
                    </div>
                    <div class="card-body">

                        <div>Sell: <b>{{ $sell }}</b></div>
                        <div>Sell last 24Hrs: <b>{{ $sell_last_24hrs }}</b></div>

                        <div class="table-responsive mt-3">
                            <table class="table table-bordered table-hover table-sm">
                                <thead>
                                    <tr>
                                        <th>Value</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($money_logs as $money_log)
                                        <tr>
                                            <td>{{ $money_log->value }}</td>
                                            <td>
                                                @if ($money_log->status === config('vending_machine.money_statuses.insert'))
                                                    Insert
                                                @elseif ($money_log->status === config('vending_machine.money_statuses.change'))
                                                    Change
                                                @elseif ($money_log->status === config('vending_machine.money_statuses.refund'))
                                                    Refund
                                                @elseif ($money_log->status === config('vending_machine.money_statuses.sell'))
                                                    Sell
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            {{ $money_logs->links() }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
