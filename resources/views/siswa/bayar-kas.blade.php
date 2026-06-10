@extends('layouts.siswa')

@section('title','Bayar Kas')
@section('page-title','Pembayaran Kas')

@section('content')

<div class="card-box p-4">

    <h5 class="fw-bold mb-4">
        Pembayaran Kas
    </h5>

    <form method="POST" action="{{ route('siswa.bayar.store') }}">
        @csrf

        <div class="mb-3">
            <label class="form-label">
                Nominal
            </label>

            <input
                type="number"
                name="jumlah"
                class="form-control"
                required>
        </div>

        <div class="mb-3">
            <label class="form-label">
                Keterangan
            </label>

            <textarea
                name="keterangan"
                class="form-control"
                rows="3"></textarea>
        </div>

        <button
            type="submit"
            class="btn btn-primary">
            Kirim Pembayaran
        </button>

    </form>

</div>

@endsection