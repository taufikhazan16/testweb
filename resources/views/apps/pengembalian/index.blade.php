<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Data Pengembalian') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 lg:p-8 bg-white border-b border-gray-200">
                    <h1 class="mt-8 text-2xl font-medium text-gray-900">
                        Data Pengembalian
                    </h1>

                    <p class="mt-6 text-gray-500 leading-relaxed">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Dignissimos quas quo veniam dolorem. Voluptas magnam ex aperiam est, mollitia quaerat ipsa aspernatur obcaecati voluptatibus doloribus laborum tempora quam consectetur ab.
                    </p>
                </div>
                <div class="bg-gray-200 bg-opacity-25 table-responsive p-4">

                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nama Mobil</th>
                                <th scope="col">Nomor Plat</th>
                                <th scope="col">ChekIN</th>
                                <th scope="col">Harga Sewa</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach($sewas as $sew)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $sew->nama_mobil }}</td>
                                <td>{{ $sew->nomor_plat }}</td>
                                <td>{{ $sew->tanggal_masuk }}</td>
                                <td>{{ 'Rp ' . number_format($sew->harga_sewa, 0, ',', '.') }}</td>
                                <td>{{ $sew->status_sewa }}</td>
                                <td>
                                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editModal{{ $sew->id }}">
                                        Lihat
                                    </button>
                                    <a href="{{ route('pengembalian.update', $sew->id) }}" class="btn btn-warning btn-sm me-2">
                                        Pengembalian
                                    </a>

                                </td>
                            </tr>
                            <!-- Modal Edit Mobil -->
                            <div class="modal fade" id="editModal{{ $sew->id }}" tabindex="-1" aria-labelledby="editModal{{ $sew->id }}Label" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editCarModalLabel">View Car</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form>
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    Nama Pengguna {{$sew->nama}} <br>
                                                    Nomor Tlpn : {{$sew->nomor_telepon}} <br>
                                                    Nomor SIM : {{$sew->nomor_sim}}
                                                    <br>
                                                    <br>
                                                    Mobil yang disewa adalah <br> <b>{{ $sew->nama_mobil }}</b> dengan Nomor <b>{{ $sew->nomor_plat }}</b> <br>
                                                    <br>
                                                    Keterangan : {{$sew->keterangan}}
                                                </div>

                                            </div>

                                        </form>
                                    </div>
                                </div>
                            </div>
                            @endforeach

                        </tbody>
                    </table>

                </div>

            </div>
        </div>
    </div>
</x-app-layout>

@section('scripts')
<script>
    // Ajax request untuk mengambil form edit mobil
    $(document).on('click', '.editBtn', function() {
        var mobilId = $(this).data('mobil-id');
        $.ajax({
            url: "{{ route('peminjaman.edit', ':id') }}".replace(':id', mobilId),
            type: "GET",
            success: function(response) {
                $('#modalEditMobil').html(response);
            }
        });
    });
</script>
@endsection