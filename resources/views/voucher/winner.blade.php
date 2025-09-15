@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Voucher Lookup</h2>

    {{-- Search Form --}}
    <form method="POST" action="{{ route('voucher.search') }}" class="mb-3">
        @csrf
        <div class="input-group">
            <input type="text" name="voucher_code" class="form-control" placeholder="Enter voucher code" required>
            <button class="btn btn-primary">Search</button>
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

                <form method="POST" action="{{ route('voucher.process') }}">
                    @csrf
                    <input type="hidden" name="voucher_code" value="{{ $voucher->voucher_code }}">

                    {{-- Dropdown Jenis Hadiah --}}
                    <div class="mb-3">
                        <label for="gift_type" class="form-label">Jenis Hadiah</label>
                        <select name="gift_type" id="gift_type" class="form-select" required>
                            <option value="">-- Pilih Hadiah --</option>
                            <option value="Mobil">Mobil</option>
                            <option value="Motor">Motor</option>
                            <option value="TV">TV</option>
                            <option value="Voucher Belanja">Voucher Belanja</option>
                        </select>
                    </div>

                    <button class="btn btn-success">Process Winner</button>
                </form>
            </div>
        </div>
    @endisset

    {{-- Winner Table --}}
    @if(isset($winners) && $winners->count() > 0)
        <div class="card mt-4">
            <div class="card-body">
                <h5>Daftar Pemenang</h5>
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
                                <td>{{ $winner->created_at->format('Y-m-d H:i') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif
</div>
@endsection
