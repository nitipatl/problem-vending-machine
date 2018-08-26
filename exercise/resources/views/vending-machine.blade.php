@extends('layouts.app')

@section('content')
    <vending-machine-component :get_products_route="'{{ route('get-products')  }}'"
    ></vending-machine-component>
@endsection

@push('scripts')
    <script type="application/javascript" src="{{ mix('js/vending-machine.js') }}"></script>
@endpush
