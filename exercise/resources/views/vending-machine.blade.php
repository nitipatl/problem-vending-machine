@extends('layouts.app')

@section('content')
    <vending-machine-component :available_coins="{{ json_encode(config('vending_machine.available_coins')) }}"
                               :get_products_route="'{{ route('get-products') }}'"
                               :money_log_route="'{{ route('money-log') }}'"
                               :money_statuses="{{ json_encode(config('vending_machine.money_statuses')) }}"
                               :un_refund="{{ $un_refund }}"
    ></vending-machine-component>
@endsection

@push('scripts')
    <script type="application/javascript" src="{{ mix('js/vending-machine.js') }}"></script>
@endpush
