<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Management Mobil') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 lg:p-8 bg-white border-b border-gray-200">
                    <h1 class="mt-8 text-2xl font-medium text-gray-900">
                        Management Mobil
                    </h1>

                    <p class="mt-6 text-gray-500 leading-relaxed">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Dignissimos quas quo veniam dolorem. Voluptas magnam ex aperiam est, mollitia quaerat ipsa aspernatur obcaecati voluptatibus doloribus laborum tempora quam consectetur ab.
                    </p>
                </div>
                <div class="bg-gray-200 bg-opacity-25 table-responsive p-4">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addCarModal">
                        Add New Car
                    </button>
                    <!-- Modal -->
                    <div class="modal fade" id="addCarModal" tabindex="-1" aria-labelledby="addCarModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="addCarModalLabel">Add New Car</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="{{ route('management.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="nama_mobil" class="form-label">Car Name</label>
                                            <input type="text" class="form-control" id="nama_mobil" name="nama_mobil" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="kapasitas_duduk" class="form-label">Seats</label>
                                            <select class="form-select" id="kapasitas_duduk" name="kapasitas_duduk" required>
                                                <option value="4">4 Seats</option>
                                                <option value="5">5 Seats</option>
                                                <option value="7">7 Seats</option>
                                                <option value="9">9 Seats</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="warna" class="form-label">Color</label>
                                            <input type="text" class="form-control" id="warna" name="warna" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="nomor_plat" class="form-label">License Plate Number</label>
                                            <input type="text" class="form-control" id="nomor_plat" name="nomor_plat" placeholder="B 1234 UTH" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="bulan_plat" class="form-label">License Plate Month</label>
                                            <select class="form-select" id="bulan_plat" name="bulan_plat" required>
                                                <option value="1">January</option>
                                                <option value="2">February</option>
                                                <option value="3">March</option>
                                                <option value="4">April</option>
                                                <option value="5">May</option>
                                                <option value="6">June</option>
                                                <option value="7">July</option>
                                                <option value="8">August</option>
                                                <option value="9">September</option>
                                                <option value="10">October</option>
                                                <option value="11">November</option>
                                                <option value="12">December</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="tahun_plat" class="form-label">License Plate Year</label>
                                            <input type="number" class="form-control" id="tahun_plat" name="tahun_plat" placeholder="2024" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="bahan_bakar" class="form-label">Fuel</label>
                                            <select class="form-select" id="bahan_bakar" name="bahan_bakar" required>
                                                <option value="bensin">Bensin</option>
                                                <option value="solar">Solar</option>
                                                <option value="baterai">Baterai</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="merek_id" class="form-label">Brand ID</label>

                                            <select class="form-select" id="merek_id" name="merek_id" required>
                                                @foreach($mereks as $merk)
                                                <option value="{{$merk->id}}">{{$merk->nama}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="model" class="form-label">Model</label>
                                            <select class="form-select" id="model" name="model" required>
                                                <option value="SUV">SUV</option>
                                                <option value="MPV">MPV</option>
                                                <option value="SEDAN">SEDAN</option>
                                                <option value="BUS">BUS</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="harga_sewa" class="form-label">Rental Price</label>
                                            <input type="number" step="0.01" class="form-control" id="harga_sewa" name="harga_sewa" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="gambar" class="form-label">Car Image</label>
                                            <input type="file" class="form-control" id="gambar" name="gambar" required>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Add Car</button>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Gambar</th>
                                <th scope="col">Nama Mobil</th>
                                <th scope="col">Warna</th>
                                <th scope="col">Nomor Plat</th>
                                <th scope="col">Merek</th>
                                <th scope="col">Bahan Bakar</th>
                                <th scope="col">Kapasitas</th>
                                <th scope="col">Harga Sewa</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach($mobils as $mobil)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td><img src="{{ asset('storage/gambar_mobil/qH7zk4EasNWsMJnry560OxOBkYE7tbBi5EeXloqZ.jpg') }}" alt="{{ $mobil->nama_mobil }}" style="max-width: 100px;"></td>
                                <td>{{ $mobil->nama_mobil }}</td>
                                <td>{{ $mobil->warna }}</td>
                                <td>{{ $mobil->nomor_plat }}</td>
                                <td>{{ $mobil->merek }}</td>
                                <td>{{ $mobil->bahan_bakar }}</td>
                                <td>{{ $mobil->kapasitas_duduk }}</td>
                                <td>{{ 'Rp ' . number_format($mobil->harga_sewa, 0, ',', '.') }}</td>
                                <td>
                                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editModal{{ $mobil->id }}">
                                        Edit
                                    </button>
                                    <form action="{{ route('management.destroy', $mobil->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm me-2" onclick="return confirm('Do you want to delete this one?')">
                                            <i class="fas fa-trash"></i> Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            <!-- Modal Edit Mobil -->
                            <div class="modal fade" id="editModal{{ $mobil->id }}" tabindex="-1" aria-labelledby="editModal{{ $mobil->id }}Label" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editCarModalLabel">Edit Car</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form action="{{ route('management.update', $mobil->id) }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label for="nama_mobil" class="form-label">Car Name</label>
                                                    <input type="text" class="form-control" id="nama_mobil" name="nama_mobil" value="{{ $mobil->nama_mobil }}" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="kapasitas_duduk" class="form-label">Seats</label>
                                                    <select class="form-select" id="kapasitas_duduk" name="kapasitas_duduk" required>
                                                        <option value="4" {{ $mobil->kapasitas_duduk == 4 ? 'selected' : '' }}>4 Seats</option>
                                                        <option value="5" {{ $mobil->kapasitas_duduk == 5 ? 'selected' : '' }}>5 Seats</option>
                                                        <option value="7" {{ $mobil->kapasitas_duduk == 7 ? 'selected' : '' }}>7 Seats</option>
                                                        <option value="9" {{ $mobil->kapasitas_duduk == 9 ? 'selected' : '' }}>9 Seats</option>
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="warna" class="form-label">Color</label>
                                                    <input type="text" class="form-control" id="warna" name="warna" value="{{ $mobil->warna }}" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="nomor_plat" class="form-label">License Plate Number</label>
                                                    <input type="text" class="form-control" id="nomor_plat" name="nomor_plat" value="{{ $mobil->nomor_plat }}" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="bulan_plat" class="form-label">License Plate Month</label>
                                                    <select class="form-select" id="bulan_plat" name="bulan_plat" required>
                                                        @for ($i = 1; $i <= 12; $i++) <option value="{{ $i }}" {{ $mobil->bulan_plat == $i ? 'selected' : '' }}>{{ date('F', mktime(0, 0, 0, $i, 1)) }}</option>
                                                            @endfor
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="tahun_plat" class="form-label">License Plate Year</label>
                                                    <input type="number" class="form-control" id="tahun_plat" name="tahun_plat" value="{{ $mobil->tahun_plat }}" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="bahan_bakar" class="form-label">Fuel</label>
                                                    <select class="form-select" id="bahan_bakar" name="bahan_bakar" required>
                                                        <option value="bensin" {{ $mobil->bahan_bakar == 'bensin' ? 'selected' : '' }}>Bensin</option>
                                                        <option value="solar" {{ $mobil->bahan_bakar == 'solar' ? 'selected' : '' }}>Solar</option>
                                                        <option value="baterai" {{ $mobil->bahan_bakar == 'baterai' ? 'selected' : '' }}>Baterai</option>
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="merek_id" class="form-label">Brand ID</label>

                                                    <select class="form-select" id="merek_id" name="merek_id" required>
                                                        @foreach($mereks as $merk)
                                                        <option value="{{$merk->id}}" {{ $mobil->merek_id == $merk->id ? 'selected' : '' }}>{{$merk->nama}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="model" class="form-label">Model</label>
                                                    <select class="form-select" id="model" name="model" required>
                                                        <option value="SUV" {{ $mobil->model == 'SUV' ? 'selected' : '' }}>SUV</option>
                                                        <option value="MPV" {{ $mobil->model == 'MPV' ? 'selected' : '' }}>MPV</option>
                                                        <option value="SEDAN" {{ $mobil->model == 'SEDAN' ? 'selected' : '' }}>SEDAN</option>
                                                        <option value="BUS" {{ $mobil->model == 'BUS' ? 'selected' : '' }}>BUS</option>
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="harga_sewa" class="form-label">Rental Price</label>
                                                    <input type="number" step="0.01" class="form-control" id="harga_sewa" name="harga_sewa" value="{{ $mobil->harga_sewa }}" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="gambar" class="form-label">Car Image</label>
                                                    <input type="file" class="form-control" id="gambar" name="gambar">
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Update Car</button>
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
            url: "{{ route('management.edit', ':id') }}".replace(':id', mobilId),
            type: "GET",
            success: function(response) {
                $('#modalEditMobil').html(response);
            }
        });
    });
</script>
@endsection