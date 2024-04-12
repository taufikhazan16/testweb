<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Data Anggota') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 lg:p-8 bg-white border-b border-gray-200">
                    <h1 class="mt-8 text-2xl font-medium text-gray-900">
                        Data Anggota
                    </h1>

                    <p class="mt-6 text-gray-500 leading-relaxed">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Dignissimos quas quo veniam dolorem. Voluptas magnam ex aperiam est, mollitia quaerat ipsa aspernatur obcaecati voluptatibus doloribus laborum tempora quam consectetur ab.
                    </p>
                </div>
                <div class="bg-gray-200 bg-opacity-25 table-responsive p-4">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addCarModal">
                        Add Anggota
                    </button>
                    <!-- Modal -->
                    <div class="modal fade" id="addCarModal" tabindex="-1" aria-labelledby="addCarModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="addCarModalLabel">Add Anggota</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="{{ route('anggota.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="nama" class="form-label">Nama Anggota</label>
                                            <input type="text" class="form-control" id="nama" name="nama" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="alamat" class="form-label">Alamat</label>
                                            <input type="text" class="form-control" id="alamat" name="alamat" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="nomor_telepon" class="form-label">No Tlpon</label>
                                            <input type="text" class="form-control" id="nomor_telepon" name="nomor_telepon" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="nomor_sim" class="form-label">No SIM</label>
                                            <input type="text" class="form-control" id="nomor_sim" name="nomor_sim" required>
                                        </div>
                                        
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Tambah Anggota</button>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Nomor KTP</th>
                                <th scope="col">No SIM</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach($anggota as $anggot)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $anggot->nama }}</td>
                                <td>{{ $anggot->nomor_telepon }}</td>
                                <td>{{ $anggot->nomor_sim }}</td>
                                <td>
                                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editModal{{ $anggot->id }}">
                                        Lihat
                                    </button>
                                    <form action="{{ route('anggota.destroy', $anggot->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm me-2" onclick="return confirm('Do you want to delete this one?')">
                                            <i class="fas fa-trash"></i> Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            <!-- Modal Edit Mobil -->
                            <div class="modal fade" id="editModal{{ $anggot->id }}" tabindex="-1" aria-labelledby="editModal{{ $anggot->id }}Label" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editCarModalLabel">View Car</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form >
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    Nama Pengguna {{$anggot->nama}} <br>
                                                    Nomor Tlpn : {{$anggot->nomor_telepon}} <br>
                                                    Nomor SIM : {{$anggot->nomor_sim}}
                                                    <br>
                                                    <br>
                                                    Alamat : {{ $anggot->alamat }}<br>
                                                    <br>
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
            url: "{{ route('anggota.edit', ':id') }}".replace(':id', mobilId),
            type: "GET",
            success: function(response) {
                $('#modalEditMobil').html(response);
            }
        });
    });
</script>
@endsection