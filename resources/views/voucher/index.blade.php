@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Voucher Lookup</h2>

    {{-- Search Form --}}
    <form method="POST" action="{{ route('voucher.search') }}" class="mb-3">
        @csrf
        <div class="row g-2">
            {{-- Voucher Code Input --}}
            <div class="col-md-6">
                <input type="text" name="voucher_code" class="form-control" placeholder="Enter voucher code" required>
            </div>

            {{-- Jenis Hadiah Dropdown --}}
            <div class="col-md-4">
                <select name="jenis_hadiah" class="form-select" required>
                    <option value="" disabled selected>-- Pilih Jenis Hadiah --</option>
                    <option value="Logam Mulia 50g">Logam Mulia 50g</option>
                    <option value="Logam Mulia 25g">Logam Mulia 25g</option>
                    <option value="Logam Mulia 10g">Logam Mulia 10g</option>
                    <option value="Voucher Belanja">Voucher Belanja</option>
                </select>
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
</div>
@endsection
