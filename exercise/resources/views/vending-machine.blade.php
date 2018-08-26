@extends('layouts.app')

@section('content')
    <vending-machine-component :products="{{ json_encode($products)  }}"
    ></vending-machine-component>
@endsection

@push('scripts')
    <script type="application/javascript" src="{{ mix('js/vending-machine.js') }}"></script>
@endpush
