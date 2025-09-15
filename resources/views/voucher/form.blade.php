@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Voucher Form</h3>

    <!-- Search Form -->
    <form action="{{ route('voucher.search') }}" method="POST">
        @csrf
        <label>Nomor Undian</label>
        <input type="text" name="voucher_code" required>
        <label>Jenis Hadiah</label>
        <select name="prize">
            <option value="Logam Mulia 50g">Logam Mulia 50g</option>
        </select>
        <button type="submit">Search</button>
    </form>

    @if(isset($voucher))
    <!-- Process Form -->
    <form action="{{ route('voucher.process') }}" method="POST">
        @csrf
        <input type="hidden" name="voucher_code" value="{{ $voucher->voucher_code }}">
        <input type="hidden" name="cl_club" value="CL0001">

        <label>CL Club</label>
        <input type="text" value="CL0001" readonly>
        <label>Nama</label>
        <input type="text" name="full_name" value="{{ $voucher->full_name }}" readonly>
        <label>No Undian</label>
        <input type="text" value="{{ $voucher->voucher_code }}" readonly>
        <label>No. KTP</label>
        <input type="text" name="ktp" value="111********1">
        <button type="submit">Proses</button>
    </form>
    @endif

    <!-- Winners Table -->
    @if(isset($winners) && count($winners) > 0)
    <h4>Winners</h4>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th></th>
                <th>Hadiah</th>
                <th>Pemenang ke-</th>
                <th>CL Club</th>
                <th>Nama</th>
                <th>No. Undian</th>
                <th>No. KTP</th>
            </tr>
        </thead>
        <tbody>
            @foreach($winners as $index => $winner)
            <tr>
                <td><input type="checkbox"></td>
                <td>{{ $winner->prize }}</td>
                <td>{{ $index + 1 }}</td>
                <td>{{ $winner->cl_club }}</td>
                <td>{{ $winner->full_name }}</td>
                <td>{{ $winner->voucher_code }}</td>
                <td>{{ $winner->ktp }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif
    {{-- Winner Table --}}

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
</div>
@endsection
