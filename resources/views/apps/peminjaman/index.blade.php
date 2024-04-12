<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Data Peminjaman') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 lg:p-8 bg-white border-b border-gray-200">
                    <h1 class="mt-8 text-2xl font-medium text-gray-900">
                        Data Peminjaman
                    </h1>

                    <p class="mt-6 text-gray-500 leading-relaxed">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Dignissimos quas quo veniam dolorem. Voluptas magnam ex aperiam est, mollitia quaerat ipsa aspernatur obcaecati voluptatibus doloribus laborum tempora quam consectetur ab.
                    </p>
                </div>
                <div class="bg-gray-200 bg-opacity-25 table-responsive p-4">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addCarModal">
                        Add Penyewa
                    </button>
                    <!-- Modal -->
                    <div class="modal fade" id="addCarModal" tabindex="-1" aria-labelledby="addCarModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="addCarModalLabel">Add Sewa Car</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="{{ route('peminjaman.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="tanggal_masuk" class="form-label">Tanggal Sewa</label>
                                            <input type="date" class="form-control" id="tanggal_masuk" name="tanggal_masuk" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="keterangan" class="form-label">Keterangan</label>
                                            <input type="text" class="form-control" id="keterangan" name="keterangan" required>
                                        </div>
                                        
                                        <div class="mb-3">
                                            <label for="mobil_id" class="form-label">Mobil / Plat / Harga</label>
                                            <select class="form-select" id="mobil_id" name="mobil_id" required>
                                            @foreach($mobils as $mob)
                                                <option value="{{$mob->id}}">{{$mob->nama_mobil}} / {{$mob->nomor_plat}} / {{ 'Rp ' . number_format($mob->harga_sewa, 0, ',', '.') }}</option>
                                            @endforeach
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="pengguna_id" class="form-label">Pengguna</label>
                                            <select class="form-select" id="pengguna_id" name="pengguna_id" required>
                                            @foreach($pengguna as $peng)
                                                <option value="{{$peng->id}}">{{$peng->nama}}</option>
                                            @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Tambah Sewa</button>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
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
                                    <form action="{{ route('peminjaman.destroy', $sew->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm me-2" onclick="return confirm('Do you want to delete this one?')">
                                            <i class="fas fa-trash"></i> Delete
                                        </button>
                                    </form>
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
                                        <form >
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