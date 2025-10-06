<x-app-layout>
    <div class="max-w-lg mx-auto mt-10 bg-white p-6 rounded-lg shadow">
        <h2 class="text-xl font-bold mb-6 text-gray-800">Submit Your Application</h2>

        <form id="submission-form" enctype="multipart/form-data">
            @csrf

            <!-- Contact Email -->
            <div class="mb-4">
                <label for="contact_email" class="block text-sm font-medium text-gray-700 mb-1">Contact Email</label>
                <input type="email" id="contact_email" name="contact_email"
                    class="w-full border rounded-md px-3 py-2 focus:ring focus:ring-indigo-200 text-sm" required>
                <div class="error-message text-red-500 text-xs mt-1"></div>
            </div>

            <!-- Contact Phone -->
            <div class="mb-4">
                <label for="contact_phone" class="block text-sm font-medium text-gray-700 mb-1">Contact Phone</label>
                <input type="tel" id="contact_phone" name="contact_phone"
                    class="w-full border rounded-md px-3 py-2 focus:ring focus:ring-indigo-200 text-sm"
                    placeholder="+20 123456789" required>
                <div class="error-message text-red-500 text-xs mt-1"></div>
            </div>

            <!-- Date of Birth -->
            <div class="mb-4">
                <label for="birth_date" class="block text-sm font-medium text-gray-700 mb-1">Date of Birth</label>
                <input type="date" id="birth_date" name="birth_date"
                    class="w-full border rounded-md px-3 py-2 focus:ring focus:ring-indigo-200 text-sm" required>
                <div class="error-message text-red-500 text-xs mt-1"></div>
            </div>

            <!-- Gender -->
            <div class="mb-4">
                <label for="gender" class="block text-sm font-medium text-gray-700 mb-1">Gender</label>
                <select id="gender" name="gender"
                    class="w-full border rounded-md px-3 py-2 focus:ring focus:ring-indigo-200 text-sm" required>
                    <option value="">-- Select --</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                </select>
                <div class="error-message text-red-500 text-xs mt-1"></div>
            </div>

            <!-- Country -->
            <div class="mb-4">
                <label for="country" class="block text-sm font-medium text-gray-700 mb-1">Country</label>
                <input type="text" id="country" name="country"
                    class="w-full border rounded-md px-3 py-2 focus:ring focus:ring-indigo-200 text-sm" required>
                <div class="error-message text-red-500 text-xs mt-1"></div>
            </div>

            <!-- Files -->
            <div class="mb-4">
                <label for="files" class="block text-sm font-medium text-gray-700 mb-1">Upload Files</label>
                <input type="file" id="files" name="files[]" multiple accept="image/*,.pdf"
                    class="hidden">
                <button type="button" onclick="document.getElementById('files').click()" 
                    class="w-full border rounded-md px-3 py-2 focus:ring focus:ring-indigo-200 text-sm bg-white hover:bg-gray-50 text-left text-gray-700">
                    Choose Files
                </button>
                <p class="text-xs text-gray-500 mt-1">Upload images or PDFs (multiple allowed).</p>
                <div class="error-message text-red-500 text-xs mt-1"></div>
                
                <!-- File Preview Container -->
                <div id="file-preview-container" class="mt-3 grid grid-cols-2 gap-2"></div>
            </div>

            <!-- Comments -->
            <div class="mb-6">
                <label for="comments" class="block text-sm font-medium text-gray-700 mb-1">Comments</label>
                <textarea id="comments" name="comments" rows="3"
                    class="w-full border rounded-md px-3 py-2 focus:ring focus:ring-indigo-200 text-sm resize-none"></textarea>
                <div class="error-message text-red-500 text-xs mt-1"></div>
            </div>

            <!-- Submit -->
            <button type="submit" id="submit-btn"
                class="w-full bg-indigo-600 text-white text-sm font-semibold py-2 px-4 rounded-md hover:bg-indigo-700 transition">
                Submit Application
            </button>
        </form>
    </div>

    <!-- SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        let selectedFiles = [];

        document.getElementById('files').addEventListener('change', function (e) {
            let files = Array.from(e.target.files);
            let validTypes = ['image/jpeg', 'image/jpg', 'image/png', 'application/pdf'];
            let maxSize = 2048 * 1024;
            let previewContainer = document.getElementById('file-preview-container');

            files.forEach(file => {
                if (!validTypes.includes(file.type)) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Invalid File Type',
                        text: file.name + ' is not a valid file type.',
                        confirmButtonColor: '#ef4444'
                    });
                    return;
                }

                if (file.size > maxSize) {
                    Swal.fire({
                        icon: 'error',
                        title: 'File Too Large',
                        text: file.name + ' exceeds 2MB.',
                        confirmButtonColor: '#ef4444'
                    });
                    return;
                }

                selectedFiles.push(file);

                let previewItem = document.createElement('div');
                previewItem.className = 'relative border rounded-md p-2 bg-gray-50';

                if (file.type.startsWith('image/')) {
                    let reader = new FileReader();
                    reader.onload = function (event) {
                        previewItem.innerHTML = `
                            <img src="${event.target.result}" class="w-full h-24 object-cover rounded">
                            <p class="text-xs text-gray-600 mt-1 truncate">${file.name}</p>
                            <button type="button" class="absolute top-1 right-1 bg-red-500 text-white rounded-full w-5 h-5 text-xs hover:bg-red-600" onclick="removeFile(${selectedFiles.length - 1})">×</button>
                        `;
                    };
                    reader.readAsDataURL(file);
                } else {
                    previewItem.innerHTML = `
                        <div class="flex items-center justify-center h-24 bg-gray-200 rounded">
                            <svg class="w-10 h-10 text-gray-500" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z"/>
                            </svg>
                        </div>
                        <p class="text-xs text-gray-600 mt-1 truncate">${file.name}</p>
                        <button type="button" class="absolute top-1 right-1 bg-red-500 text-white rounded-full w-5 h-5 text-xs hover:bg-red-600" onclick="removeFile(${selectedFiles.length - 1})">×</button>
                    `;
                }

                previewContainer.appendChild(previewItem);
            });

            e.target.value = '';
        });

        window.removeFile = function(index) {
            selectedFiles.splice(index, 1);
            let previewContainer = document.getElementById('file-preview-container');
            previewContainer.innerHTML = '';
            
            selectedFiles.forEach((file, i) => {
                let previewItem = document.createElement('div');
                previewItem.className = 'relative border rounded-md p-2 bg-gray-50';

                if (file.type.startsWith('image/')) {
                    let reader = new FileReader();
                    reader.onload = function (event) {
                        previewItem.innerHTML = `
                            <img src="${event.target.result}" class="w-full h-24 object-cover rounded">
                            <p class="text-xs text-gray-600 mt-1 truncate">${file.name}</p>
                            <button type="button" class="absolute top-1 right-1 bg-red-500 text-white rounded-full w-5 h-5 text-xs hover:bg-red-600" onclick="removeFile(${i})">×</button>
                        `;
                    };
                    reader.readAsDataURL(file);
                } else {
                    previewItem.innerHTML = `
                        <div class="flex items-center justify-center h-24 bg-gray-200 rounded">
                            <svg class="w-10 h-10 text-gray-500" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z"/>
                            </svg>
                        </div>
                        <p class="text-xs text-gray-600 mt-1 truncate">${file.name}</p>
                        <button type="button" class="absolute top-1 right-1 bg-red-500 text-white rounded-full w-5 h-5 text-xs hover:bg-red-600" onclick="removeFile(${i})">×</button>
                    `;
                }

                previewContainer.appendChild(previewItem);
            });
        };

        document.getElementById('submission-form').addEventListener('submit', function (e) {
            e.preventDefault();

            document.querySelectorAll('.error-message').forEach(el => el.innerHTML = '');
            document.querySelectorAll('#submission-form input, #submission-form select, #submission-form textarea')
                .forEach(el => el.classList.remove('border-red-500'));

            let submitBtn = document.getElementById('submit-btn');
            submitBtn.disabled = true;
            submitBtn.innerHTML = 'Submitting...';

            let formData = new FormData(this);
            formData.delete('files[]');
            selectedFiles.forEach(file => {
                formData.append('files[]', file);
            });

            fetch("{{ route('submissions.store') }}", {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": document.querySelector('input[name="_token"]').value
                },
                body: formData
            })
                .then(response => {
                    if (!response.ok) throw response;
                    return response.json();
                })
                .then(data => {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: data.message || 'Your application has been submitted successfully!',
                        confirmButtonColor: '#4f46e5'
                    });
                    this.reset();
                    selectedFiles = [];
                    document.getElementById('file-preview-container').innerHTML = '';
                })
                .catch(async (error) => {
                    if (error.json) {
                        let errData = await error.json();

                        if (errData.errors) {
                            for (const [field, messages] of Object.entries(errData.errors)) {
                                let fieldName = field.split('.')[0];
                                let input = document.getElementById(fieldName);

                                if (input) {
                                    input.classList.add('border-red-500');
                                    let errorDiv = input.closest('div').querySelector('.error-message');
                                    if (errorDiv) {
                                        errorDiv.innerHTML = messages.join('<br>');
                                    }
                                }
                            }
                        }

                        Swal.fire({
                            icon: 'error',
                            title: 'Validation Error',
                            text: errData.message || 'Please check the form and try again.',
                            confirmButtonColor: '#ef4444'
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Something went wrong. Please try again later.',
                            confirmButtonColor: '#ef4444'
                        });
                    }
                })
                .finally(() => {
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = 'Submit Application';
                });
        });
    </script>
</x-app-layout>