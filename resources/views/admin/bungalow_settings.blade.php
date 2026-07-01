<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
    <title>Bungalow Settings - Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body class="bg-gray-100">
    <div class="min-h-screen flex flex-col md:flex-row">
        <!-- Sidebar -->
        <div class="w-full md:w-64 bg-green-800 text-white p-4 md:p-6 md:min-h-screen">
            <h2 class="text-2xl font-bold mb-6 md:mb-8 flex items-center justify-center md:justify-start">
                <i class="fas fa-leaf mr-2"></i>Admin Panel
            </h2>
            <nav class="flex flex-wrap md:flex-col gap-2">
                <a href="{{ route('admin.dashboard') }}" class="block py-2 px-4 hover:bg-green-700 rounded-lg">
                    <i class="fas fa-chart-line mr-2"></i> Dashboard
                </a>
                <a href="{{ route('admin.bookings') }}" class="block py-2 px-4 hover:bg-green-700 rounded-lg">
                    <i class="fas fa-list mr-2"></i> Bookings
                </a>
                <a href="{{ route('admin.bungalow.settings') }}" class="block py-2 px-4 bg-green-700 rounded-lg">
                    <i class="fas fa-bed mr-2"></i> Bungalow Settings
                </a>
                <a href="{{ route('admin.offline.bookings') }}" class="block py-2 px-4 hover:bg-green-700 rounded-lg">
                    <i class="fas fa-user-plus mr-2"></i> Offline Booking
                </a>
                <a href="{{ route('admin.logout') }}" class="block py-2 px-4 hover:bg-red-700 rounded-lg text-red-300 hover:text-white">
                    <i class="fas fa-sign-out-alt mr-2"></i> Logout
                </a>
            </nav>
        </div>

        <!-- Content -->
        <div class="flex-1 p-4 md:p-8">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-6">
                <h1 class="text-2xl md:text-3xl font-bold">Pengaturan Bungalow</h1>
            </div>

            @if(session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-3 mb-4 rounded">
                {{ session('success') }}
            </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                @foreach($bungalows as $bungalow)
                <div class="bg-white rounded-lg shadow-md p-4">
                    <form method="POST" action="{{ route('admin.bungalow.update', $bungalow->id) }}">
                        @csrf
                        @method('PUT')
                        
                        <div class="flex items-center gap-2 mb-3">
                            <i class="fas fa-bed text-xl text-green-600"></i>
                            <span class="text-lg font-bold">{{ $bungalow->code }}</span>
                            <span class="text-sm px-2 py-0.5 rounded-full 
                                {{ $bungalow->status == 'active' ? 'bg-green-200 text-green-800' : 'bg-red-200 text-red-800' }}">
                                {{ $bungalow->status }}
                            </span>
                        </div>

                        <div class="mb-3">
                            <label class="block text-sm font-medium text-gray-700">Nama</label>
                            <input type="text" name="name" value="{{ $bungalow->name }}" 
                                class="w-full px-3 py-1 border rounded-lg text-sm">
                        </div>

                        <div class="mb-3">
                            <label class="block text-sm font-medium text-gray-700">Deskripsi</label>
                            <textarea name="description" rows="2" 
                                class="w-full px-3 py-1 border rounded-lg text-sm">{{ $bungalow->description }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label class="block text-sm font-medium text-gray-700">Harga (Rp)</label>
                            <input type="number" name="price" value="{{ $bungalow->price }}" 
                                class="w-full px-3 py-1 border rounded-lg text-sm">
                        </div>

                        <div class="mb-3">
                            <label class="block text-sm font-medium text-gray-700">Status</label>
                            <select name="status" class="w-full px-3 py-1 border rounded-lg text-sm">
                                <option value="active" {{ $bungalow->status == 'active' ? 'selected' : '' }}>Active</option>
                                <option value="inactive" {{ $bungalow->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                            </select>
                        </div>

                        <!-- Di bagian form, tambahkan field deskripsi 2 bahasa -->
                        <div class="mb-3">
                            <label class="block text-sm font-medium text-gray-700">Deskripsi (Indonesia)</label>
                            <textarea name="description_id" rows="2" class="w-full px-3 py-1 border rounded-lg text-sm">{{ $bungalow->description_id }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label class="block text-sm font-medium text-gray-700">Description (English)</label>
                            <textarea name="description_en" rows="2" class="w-full px-3 py-1 border rounded-lg text-sm">{{ $bungalow->description_en }}</textarea>
                        </div>

                        <button type="submit" class="w-full bg-green-600 text-white px-3 py-1 rounded-lg hover:bg-green-700 text-sm">
                            <i class="fas fa-save mr-1"></i> Update
                        </button>
                    </form>
                </div>
                @endforeach
            </div>

            <div class="mt-6 text-sm text-gray-500">
                <p><i class="fas fa-info-circle mr-1"></i> Perubahan harga dan deskripsi akan langsung terlihat di halaman booking.</p>
            </div>
        </div>
    </div>
</body>
</html>