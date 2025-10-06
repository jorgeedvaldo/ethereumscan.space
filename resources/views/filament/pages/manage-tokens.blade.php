<x-filament::page>
    <div class="space-y-4">
        <x-filament::button wire:click="generateToken" color="primary">
            Generate New Token
        </x-filament::button>

        @if (session('token'))
            <div class="p-4 bg-green-100 rounded-md">
                <strong>New Token:</strong>
                <pre class="mt-2 p-2 bg-white border rounded text-sm overflow-x-auto">{{ session('token') }}</pre>
                <x-filament::button
                    color="primary"
                    onclick="navigator.clipboard.writeText('{{ session('token') }}')">
                    Copy Token
                </x-filament::button>
            </div>
        @endif

        @if (session('message'))
            <div class="p-3 bg-blue-100 border border-blue-300 rounded-md">
                {{ session('message') }}
            </div>
        @endif

        <h2 class="text-lg font-bold mt-6">Active Tokens</h2>

        @if($tokens->count())
            <table class="min-w-full text-sm border">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-2 text-left">ID</th>
                        <th class="px-4 py-2 text-left">Name</th>
                        <th class="px-4 py-2 text-left">Created At</th>
                        <th class="px-4 py-2 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tokens as $token)
                        <tr class="border-b">
                            <td class="px-4 py-2">{{ $token->id }}</td>
                            <td class="px-4 py-2">{{ $token->name }}</td>
                            <td class="px-4 py-2">{{ $token->created_at->format('Y-m-d H:i') }}</td>
                            <td class="px-4 py-2 text-center">
                                <x-filament::button
                                    color="danger"
                                    wire:click="deleteToken({{ $token->id }})">
                                    Delete
                                </x-filament::button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p class="text-gray-600 mt-4">No tokens found. Generate one to get started.</p>
        @endif
    </div>
</x-filament::page>
