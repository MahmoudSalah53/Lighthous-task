<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 border-b border-gray-200">
                    <div class="flex items-center justify-between">
                        <div>
                            <h2 class="text-2xl font-bold text-gray-800">Submissions Dashboard</h2>
                            <p class="text-sm text-gray-600 mt-1">Total submissions: <span
                                    class="font-semibold">{{ $submissions->total() }}</span></p>
                        </div>
                        <div>
                            <span
                                class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                        clip-rule="evenodd" />
                                </svg>
                                Admin View
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            @if($submissions->count() === 0)
                <!-- Empty State -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-12 text-center">
                        <svg class="mx-auto h-16 w-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        <h3 class="mt-4 text-lg font-medium text-gray-900">No submissions yet</h3>
                        <p class="mt-2 text-sm text-gray-500">When users submit applications, they will appear here.</p>
                    </div>
                </div>
            @else
                <!-- Submissions List -->
                <div class="space-y-6">
                    @foreach($submissions as $submission)
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg hover:shadow-md transition-shadow">
                            <div class="p-6">
                                <!-- Header Section -->
                                <div class="flex items-start justify-between mb-4">
                                    <div class="flex items-center space-x-3">
                                        <div class="flex-shrink-0">
                                            <div class="w-12 h-12 rounded-full bg-indigo-100 flex items-center justify-center">
                                                <span
                                                    class="text-indigo-600 font-bold text-lg">{{ substr($submission->user->name, 0, 1) }}</span>
                                            </div>
                                        </div>
                                        <div>
                                            <h3 class="text-lg font-semibold text-gray-900">{{ $submission->user->name }}</h3>
                                            <p class="text-sm text-gray-500">Submitted
                                                {{ $submission->created_at->diffForHumans() }}</p>
                                        </div>
                                    </div>
                                    <div class="flex items-center space-x-2">
                                        <span class="text-xs text-gray-500">ID: #{{ $submission->id }}</span>
                                    </div>
                                </div>

                                <!-- Details Grid -->
                                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mb-4">
                                    <div class="border-l-4 border-indigo-500 pl-3">
                                        <p class="text-xs font-medium text-gray-500 uppercase tracking-wider">Contact Email</p>
                                        <p class="mt-1 text-sm font-medium text-gray-900">{{ $submission->contact_email }}</p>
                                    </div>
                                    <div class="border-l-4 border-green-500 pl-3">
                                        <p class="text-xs font-medium text-gray-500 uppercase tracking-wider">Contact Phone</p>
                                        <p class="mt-1 text-sm font-medium text-gray-900">{{ $submission->contact_phone }}</p>
                                    </div>
                                    <div class="border-l-4 border-blue-500 pl-3">
                                        <p class="text-xs font-medium text-gray-500 uppercase tracking-wider">Date of Birth</p>
                                        <p class="mt-1 text-sm font-medium text-gray-900">
                                            {{ \Carbon\Carbon::parse($submission->birth_date)->format('M d, Y') }}</p>
                                    </div>
                                    <div class="border-l-4 border-purple-500 pl-3">
                                        <p class="text-xs font-medium text-gray-500 uppercase tracking-wider">Gender</p>
                                        <p class="mt-1 text-sm font-medium text-gray-900 capitalize">{{ $submission->gender }}
                                        </p>
                                    </div>
                                    <div class="border-l-4 border-yellow-500 pl-3">
                                        <p class="text-xs font-medium text-gray-500 uppercase tracking-wider">Country</p>
                                        <p class="mt-1 text-sm font-medium text-gray-900">{{ $submission->country }}</p>
                                    </div>
                                    <div class="border-l-4 border-red-500 pl-3">
                                        <p class="text-xs font-medium text-gray-500 uppercase tracking-wider">Submission Date
                                        </p>
                                        <p class="mt-1 text-sm font-medium text-gray-900">
                                            {{ $submission->created_at->format('M d, Y - H:i') }}</p>
                                    </div>
                                </div>

                                <!-- Comments Section -->
                                @if($submission->comments)
                                    <div class="mb-4 bg-gray-50 rounded-lg p-4">
                                        <p class="text-xs font-medium text-gray-500 uppercase tracking-wider mb-2">Comments</p>
                                        <p class="text-sm text-gray-700 leading-relaxed">{{ $submission->comments }}</p>
                                    </div>
                                @endif

                                <!-- Files Section -->
                                @if($submission->files && count(json_decode($submission->files)) > 0)
                                    <div class="border-t pt-4">
                                        <p class="text-xs font-medium text-gray-500 uppercase tracking-wider mb-3">Attached Files
                                            ({{ count(json_decode($submission->files)) }})</p>
                                        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-3">
                                            @foreach(json_decode($submission->files) as $file)
                                                @php
                                                    $extension = pathinfo($file, PATHINFO_EXTENSION);
                                                    $fileName = basename($file);
                                                    $isImage = in_array(strtolower($extension), ['jpg', 'jpeg', 'png', 'gif', 'webp']);
                                                @endphp

                                                <div class="relative group">
                                                    @if($isImage)
                                                        <a href="{{ Storage::url($file) }}" target="_blank" class="block">
                                                            <img src="{{ Storage::url($file) }}" alt="{{ $fileName }}"
                                                                class="w-full h-24 object-cover rounded-lg border-2 border-gray-200 hover:border-indigo-500 transition">
                                                            <div
                                                                class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-30 transition rounded-lg flex items-center justify-center">
                                                                <svg class="w-6 h-6 text-white opacity-0 group-hover:opacity-100 transition"
                                                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                                </svg>
                                                            </div>
                                                        </a>
                                                    @else
                                                        <a href="{{ Storage::url($file) }}" download="{{ $fileName }}"
                                                            class="block border-2 border-gray-200 rounded-lg p-3 hover:border-indigo-500 hover:bg-indigo-50 transition">
                                                            <div class="flex flex-col items-center justify-center h-20">
                                                                <svg class="w-10 h-10 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                                                                    <path
                                                                        d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z" />
                                                                </svg>
                                                                <span class="text-xs font-medium text-gray-600 mt-1">PDF</span>
                                                            </div>
                                                        </a>
                                                    @endif
                                                    <p class="text-xs text-gray-600 text-center mt-1 truncate" title="{{ $fileName }}">
                                                        {{ Str::limit($fileName, 15) }}</p>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                    <!-- Pagination -->
                    <div class="mt-6">
                        {{ $submissions->links() }}
                    </div>

                </div>
            @endif
        </div>
    </div>
</x-app-layout>