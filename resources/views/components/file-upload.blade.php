@props([
    'label' => 'Upload File',
    'id' => 'file',
    'name' => 'file',
    'accept' => '',
    'required' => false,
    'multiple' => false,
])

<div>
    <x-input-label :for="$id" :value="$label" required/>
    <input
        type="file"
        id="{{ $id }}"
        name="{{ $name }}{{ $multiple ? '[]' : '' }}"
        {{ $accept ? "accept=$accept" : '' }}
        {{ $multiple ? 'multiple' : '' }}
        @if($required) required @endif
        {{ $attributes->merge(['class' => 'block w-full text-sm text-gray-700 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100']) }}
    >

    <x-input-error :messages="$errors->get($name)" class="mt-1" />

    <!-- Preview container -->
    <div id="{{ $id }}Preview" class="mt-4 flex flex-wrap gap-4"></div>
</div>

@once
    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                // Function to preview files for a given input and container
                function previewFiles(inputElement, previewContainerId) {
                    const previewContainer = document.getElementById(previewContainerId);
                    if (!previewContainer) return;
                    previewContainer.innerHTML = '';
                    const files = Array.from(inputElement.files);

                    files.forEach(file => {
                        const fileType = file.type;

                        if (fileType.startsWith('image/')) {
                            const reader = new FileReader();
                            reader.onload = e => {
                                const img = document.createElement('img');
                                img.src = e.target.result;
                                img.className = 'w-24 h-24 object-cover rounded-md border border-gray-300';
                                previewContainer.appendChild(img);
                            };
                            reader.readAsDataURL(file);
                        } else if (fileType.startsWith('video/')) {
                            const url = URL.createObjectURL(file);
                            const video = document.createElement('video');
                            video.src = url;
                            video.controls = true;
                            video.className = 'w-48 h-32 rounded-md border border-gray-300';
                            previewContainer.appendChild(video);
                        } else {
                            // Show file name for other types
                            const div = document.createElement('div');
                            div.textContent = file.name;
                            div.className = 'text-sm text-gray-700';
                            previewContainer.appendChild(div);
                        }
                    });
                }

                // Attach event listeners to all file inputs with id attribute
                document.querySelectorAll('input[type="file"][id]').forEach(input => {
                    input.addEventListener('change', () => {
                        previewFiles(input, input.id + 'Preview');
                    });
                });
            });
        </script>
    @endpush
@endonce
