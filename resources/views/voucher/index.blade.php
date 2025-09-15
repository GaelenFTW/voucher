@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Voucher Lookup</h2>

    {{-- Search Form --}}
    <form method="POST" action="{{ route('voucher.search') }}" class="mb-3">
        @csrf
        <div class="row g-2">
            {{-- Voucher Code Input --}}
            <div class="col">
                <input type="text" name="voucher_code" class="form-control" placeholder="Enter voucher code" required>
            </div>


            {{-- Search Button --}}
            <div class="col-md-2">
                <button class="btn btn-primary w-100">Search</button>
            </div>
        </div>
    </form>

    {{-- Messages --}}
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Voucher Details --}}
    @isset($voucher)
        <div class="card mt-3">
            <div class="card-body">
                <h5>Voucher Details</h5>
                <p><strong>Full Name:</strong> {{ $voucher->full_name }}</p>
                <p><strong>Customer ID:</strong> {{ $voucher->customer_id }}</p>
                <p><strong>Promo:</strong> {{ $voucher->promo_name }}</p>
                <p><strong>Status:</strong> {{ $voucher->status }}</p>
                <p><strong>Jenis Hadiah:</strong> {{ $jenis_hadiah ?? '-' }}</p>

                <form method="POST" action="{{ route('voucher.process') }}">
                    @csrf
                    <input type="hidden" name="voucher_code" value="{{ $voucher->voucher_code }}">
                    <input type="hidden" name="jenis_hadiah" value="{{ $jenis_hadiah ?? '' }}">
                    <button class="btn btn-success">Process Winner</button>
                </form>
            </div>
        </div>
    @endisset
    {{-- Daftar Pemenang --}}
<div class="card mt-4">
    <div class="card-body">
        <h5>Daftar Pemenang</h5>

        @if($winners->isEmpty())
            <p class="text-muted">Belum ada pemenang.</p>
        @else
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Voucher Code</th>
                        <th>Full Name</th>
                        <th>Customer ID</th>
                        <th>Promo</th>
                        <th>Jenis Hadiah</th>
                        <th>Tanggal Menang</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($winners as $winner)
                        <tr>
                            <td>{{ $winner->voucher_code }}</td>
                            <td>{{ $winner->full_name }}</td>
                            <td>{{ $winner->customer_id }}</td>
                            <td>{{ $winner->promo_name }}</td>
                            <td>{{ $winner->gift_type }}</td>
                            <td>{{ $winner->created_at }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</div>

</div>
@endsection
