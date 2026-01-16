@extends("admin.layouts.master-layouts.plain")

<title>Slider | Home Collection</title>

@push("script")
<script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#10b981',
                        secondary: '#1f2937'
                    }
                }
            }
        }
    </script>
@endpush


@push("style")
<style>
    #editSliderModal {
    transition: opacity 0.2s ease;
    opacity: 0;
    pointer-events: none;
}
#editSliderModal:not(.hidden) {
    opacity: 1;
    pointer-events: auto;
}

</style>
@endpush


@section("content")
<div 
    x-data="{ sidebarOpen: false }" 
    @close-sidebar.window="sidebarOpen = false" 
    class="flex h-screen overflow-hidden"
>

<button @click="sidebarOpen = true" 
        class="fixed top-4 left-4 z-40 p-2 bg-gray-900 text-white rounded-md lg:hidden">
        <i class="fas fa-bars"></i>
    </button>

    <!-- Mobile backdrop -->
    <div
        x-show="sidebarOpen"
        x-cloak
        x-transition.opacity
        class="fixed inset-0 z-20 bg-black bg-opacity-50 lg:hidden"
        @click="sidebarOpen = false"
    ></div>


    <!-- Sidebar -->
    <aside
        class="fixed inset-y-0 left-0 z-30 w-64 bg-gray-900 text-white transform transition-transform duration-300 ease-in-out lg:translate-x-0"
        :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
        x-cloak
    >
        @include("admin.layouts.partial.sidebar")
    </aside>


    <div class="flex-1 flex flex-col overflow-hidden lg:ml-64 bg-gradient-to-br from-gray-50 to-gray-100">
         <header class="bg-white shadow-sm z-10">
                <div class="flex justify-between items-center p-4">
                    <div>
                        <h2 class="text-xl font-semibold text-gray-800">Home Sliders Management</h2>
                        <nav class="text-sm text-gray-500">
                            <ol class="list-none p-0 inline-flex">
                                <li class="flex items-center">
                                    <a href="#" class="text-gray-500 hover:text-primary">Dashboard</a>
                                    <i class="fas fa-chevron-right mx-2 text-gray-400 text-xs"></i>
                                </li>
                                <li class="flex items-center">
                                    <span class="text-gray-700">Home Sliders</span>
                                </li>
                            </ol>
                        </nav>
                    </div>
                    <div class="flex items-center">
                        <button class="p-2 rounded-full hover:bg-gray-100 relative">
                            <i class="fas fa-bell text-gray-600"></i>
                            <span class="absolute top-0 right-0 w-2 h-2 bg-red-500 rounded-full"></span>
                        </button>
                        <div class="ml-4 relative">
                            <button class="flex items-center focus:outline-none">
                                <div class="w-8 h-8 rounded-full bg-primary flex items-center justify-center text-white">
                                    <i class="fas fa-user"></i>
                                </div>
                                <span class="ml-2 text-sm font-medium text-gray-700">Admin</span>
                                <i class="fas fa-chevron-down ml-1 text-gray-500 text-xs"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Main Content Area -->
            <main class="flex-1 overflow-y-auto p-6">
                <!-- Filter and Search Section -->
                <div class="bg-white rounded-lg shadow-sm p-4 mb-6">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                        <div class="flex flex-col md:flex-row md:items-center space-y-2 md:space-y-0 md:space-x-4 mb-4 md:mb-0">
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-search text-gray-400"></i>
                                </div>
                                <input type="text" class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary w-full md:w-64" placeholder="Search sliders...">
                            </div>
                            <div class="relative">
                                <select class="pl-3 pr-10 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary appearance-none w-full md:w-48">
                                    <option>All Status</option>
                                    <option>Active</option>
                                    <option>Inactive</option>
                                </select>
                                <div class="absolute inset-y-0 right-0 flex items-center px-2 pointer-events-none">
                                    <i class="fas fa-chevron-down text-gray-400"></i>
                                </div>
                            </div>
                        </div>
                        <div class="flex space-x-2">
                            <button class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-4 py-2 rounded-lg flex items-center justify-center transition duration-200">
                                <i class="fas fa-filter mr-2"></i>
                                Filter
                            </button>
                            <button id="addSliderBtn" class="bg-primary hover:bg-emerald-600 text-white px-4 py-2 rounded-lg flex items-center justify-center transition duration-200">
                                <i class="fas fa-plus mr-2"></i>
                                Add Slider
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Sliders Table -->
                <div class="bg-white rounded-lg shadow-sm overflow-hidden mb-6">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">#</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Preview</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Hero Text</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Description</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Position</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Created At</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
    @forelse ($sliders as $index => $slider)
        <tr class="hover:bg-gray-50">
            <!-- ID -->
            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                {{ $index + 1 }}
            </td>

            <!-- Preview -->
            <td class="px-6 py-4 whitespace-nowrap">
                <div class="w-20 h-12 rounded-md overflow-hidden bg-gray-200 flex items-center justify-center">
                    @if ($slider->image)
                        <img src="{{ asset('storage/' . $slider->image) }}" 
                             alt="Slider Image" 
                             class="object-cover w-full h-full">
                    @else
                        <i class="fas fa-image text-gray-400"></i>
                    @endif
                </div>
            </td>

            <!-- Hero Text -->
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 font-medium">
                {{ $slider->title ?? '—' }}
            </td>

            <!-- Description -->
            <td class="px-6 py-4 text-sm text-gray-500 max-w-xs truncate">
                {{ $slider->description ?? '—' }}
            </td>

            <!-- Position (optional) -->
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                {{ $slider->id }}
            </td>

            <!-- Status -->
            <td class="px-6 py-4 whitespace-nowrap">
                @if ($slider->status)
                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                        Active
                    </span>
                @else
                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                        Inactive
                    </span>
                @endif
            </td>

            <!-- Created At -->
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                {{ $slider->created_at->format('Y-m-d') }}
            </td>

            <!-- Actions -->
            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                <!-- Edit Button -->
                <button 
    type="button"
    class="text-indigo-600 hover:text-indigo-900 mr-3 edit-slider-btn"
    data-id="{{ $slider->id }}"
    data-title="{{ $slider->title ?? '' }}"
    data-type="{{ $slider->type ?? 'banner' }}"
    data-description="{{ $slider->description ?? '' }}"
    data-button_text="{{ $slider->button_text ?? '' }}"
    data-button_url="{{ $slider->button_url ?? '' }}"
    data-status="{{ $slider->status }}"
    data-image="{{ $slider->type === 'banner' && $slider->image ? asset('storage/'.$slider->image) : '' }}"
    data-video="{{ $slider->type === 'video' && $slider->video_path ? asset('storage/'.$slider->video_path) : '' }}"
>
    <i class="fas fa-edit"></i>
</button>



<form action="{{ route('admin.hero-sliders.destroy', $slider->id) }}" method="POST" class="inline">
    @csrf
    @method('DELETE')
    <button type="submit" class="text-red-600 hover:text-red-900"
        onclick="return confirm('Are you sure you want to delete this slider?')">
        <i class="fas fa-trash"></i>
    </button>
</form>

            </td>
        </tr>
    @empty
        <tr>
            <td colspan="8" class="text-center py-6 text-gray-500">No sliders found</td>
        </tr>
    @endforelse
</tbody>

                        </table>
                    </div>
                    
                    <!-- Pagination -->
                    <div class="bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6">
                        <div class="flex-1 flex justify-between sm:hidden">
                            <a href="#" class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50"> Previous </a>
                            <a href="#" class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50"> Next </a>
                        </div>
                        <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                            <div>
                                <p class="text-sm text-gray-700">
                                    Showing
                                    <span class="font-medium">1</span>
                                    to
                                    <span class="font-medium">3</span>
                                    of
                                    <span class="font-medium">3</span>
                                    results
                                </p>
                            </div>
                            <div>
                                <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px" aria-label="Pagination">
                                    <a href="#" class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                                        <span class="sr-only">Previous</span>
                                        <i class="fas fa-chevron-left"></i>
                                    </a>
                                    <a href="#" aria-current="page" class="z-10 bg-primary border-primary text-white relative inline-flex items-center px-4 py-2 border text-sm font-medium"> 1 </a>
                                    <a href="#" class="bg-white border-gray-300 text-gray-500 hover:bg-gray-50 relative inline-flex items-center px-4 py-2 border text-sm font-medium"> 2 </a>
                                    <a href="#" class="bg-white border-gray-300 text-gray-500 hover:bg-gray-50 relative inline-flex items-center px-4 py-2 border text-sm font-medium"> 3 </a>
                                    <a href="#" class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                                        <span class="sr-only">Next</span>
                                        <i class="fas fa-chevron-right"></i>
                                    </a>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Live Preview Section -->
               
                </div>
            </main>
        </div>
    </div>

    <!-- Add/ Slider Modal -->
    <div id="addSliderModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
        <div class="relative top-10 mx-auto p-5 border w-full max-w-3xl shadow-lg rounded-md bg-white">
            <div class="mt-3">
                <div class="flex justify-between items-center pb-3 border-b">
                    <h3 class="text-lg font-medium text-gray-900" id="modalTitle">Add New Slider</h3>
                    <button  id="addCloseModal class="text-gray-400 hover:text-gray-500">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                
                <form action="{{ route('admin.hero-sliders.store') }}" method="POST" enctype="multipart/form-data" class="mt-4 space-y-4">
    @csrf

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Form Inputs -->
        <div class="space-y-4">
            <div>
                <label for="sliderTitle" class="block text-sm font-medium text-gray-700">Hero Text</label>
                <input 
                    type="text" 
                    id="sliderTitle" 
                    name="title" 
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-primary focus:border-primary" 
                    placeholder="Enter hero text">
            </div>

            <div>
                <label for="sliderDescription" class="block text-sm font-medium text-gray-700">Description</label>
                <textarea 
                    id="sliderDescription" 
                    name="description" 
                    rows="3" 
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-primary focus:border-primary" 
                    placeholder="Enter slider description"></textarea>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label for="sliderPosition" class="block text-sm font-medium text-gray-700">Position</label>
                    <input 
                        type="number" 
                        id="sliderPosition" 
                        name="position"
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-primary focus:border-primary" 
                        min="1" max="10">
                </div>

                <div>
                    <label for="sliderStatus" class="block text-sm font-medium text-gray-700">Status</label>
                    <select 
                        id="sliderStatus" 
                        name="status"
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-primary focus:border-primary">
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                    </select>
                </div>
            </div>

            <div>
                <label for="buttonText" class="block text-sm font-medium text-gray-700">Button Text</label>
                <input 
                    type="text" 
                    id="buttonText" 
                    name="button_text"
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-primary focus:border-primary" 
                    placeholder="e.g. Shop Now">
            </div>

            <div>
                <label for="buttonLink" class="block text-sm font-medium text-gray-700">Button Link</label>
                <input 
                    type="text" 
                    id="buttonLink" 
                    name="button_url"
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-primary focus:border-primary" 
                    placeholder="e.g. /products">
            </div>
        </div>

        <div>
    <label class="block text-sm font-medium text-gray-700 mb-2">Slider Type</label>
    <select id="sliderType" name="type" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-primary focus:border-primary">
        <option value="banner" selected>Banner</option>
        <option value="video">Video</option>
    </select>
</div>

        <!-- Image Upload -->
        <!-- Banner Upload -->
<div id="bannerUploadSection">
    <label for="sliderImage" class="block text-sm font-medium text-gray-700">Slider Image</label>
    <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
        <div class="space-y-1 text-center">
            <i class="fas fa-cloud-upload-alt text-gray-400 text-3xl"></i>
            <div class="flex text-sm text-gray-600">
                <label for="sliderImage" class="relative cursor-pointer bg-white rounded-md font-medium text-primary hover:text-emerald-500">
                    <span>Upload an image</span>
                    <input id="sliderImage" name="image" type="file" class="sr-only" accept="image/*">
                </label>
                <p class="pl-1">or drag and drop</p>
            </div>
            <p class="text-xs text-gray-500">PNG, JPG, WEBP up to 10MB</p>
        </div>
    </div>
</div>

<!-- Video Upload (Hidden by default) -->
<div id="videoUploadSection" class="hidden">
    <label for="sliderVideo" class="block text-sm font-medium text-gray-700">Slider Video</label>
    <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
        <div class="space-y-1 text-center">
            <i class="fas fa-video text-gray-400 text-3xl"></i>
            <div class="flex text-sm text-gray-600">
                <label for="sliderVideo" class="relative cursor-pointer bg-white rounded-md font-medium text-primary hover:text-emerald-500">
                    <span>Upload a video</span>
                    <input id="sliderVideo" name="video" type="file" class="sr-only" accept="video/mp4,video/webm,video/ogg">
                </label>
                <p class="pl-1">or drag and drop</p>
            </div>
            <p class="text-xs text-gray-500">MP4, WEBM, OGG up to 50MB</p>
        </div>
    </div>
</div>

    <div class="flex justify-end space-x-3 pt-4 border-t">
        <button type="button" id="addCancelBtn" class="px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">
            Cancel
        </button>
        <button type="submit" class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-primary hover:bg-emerald-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">
            Save Slider
        </button>
    </div>
</form>

            </div>
        </div>
    </div>

</div>

   <!-- Edit Slider Modal -->
   <div id="editSliderModal"
     class="fixed inset-0 z-50 flex items-center justify-center bg-gray-900/70 hidden">
    <div class="bg-white rounded-lg shadow-xl w-full max-w-3xl p-6 relative">

        <div class="mt-3">
            <div class="flex justify-between items-center pb-3 border-b">
                <h3 class="text-lg font-medium text-gray-900">Edit Slider</h3>
                <button type="button" id="editCloseModal" class="text-gray-400 hover:text-gray-500">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <form id="editSliderForm" method="POST" enctype="multipart/form-data" class="mt-4 space-y-4">
                @csrf
                @method('PUT')

                <input type="hidden" id="editSliderId" name="id">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Left Inputs -->
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Hero Text</label>
                            <input type="text" name="title" id="editSliderTitle"
                                   class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Description</label>
                            <textarea name="description"  id="editSliderDescription" rows="3"
                                      class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3"></textarea>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Status</label>
                                <select name="status" id="editSliderStatus"
                                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3">
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Button Text</label>
                            <input type="text" name="button_text" id="editButtonText"
                                   class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Button Link</label>
                            <input type="text" name="button_url" id="editButtonLink"
                                   class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3">
                        </div>
                    </div>

                    <div>
    <label class="block text-sm font-medium text-gray-700 mb-2">Slider Type</label>
    <select id="editSliderType" name="type"
            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-primary focus:border-primary">
        <option value="banner">Banner</option>
        <option value="video">Video</option>
    </select>
</div>


                    <!-- Image Upload -->
               <!-- Banner Upload -->
<div id="editBannerUploadSection">
    <label class="block text-sm font-medium text-gray-700">Slider Image</label>
    <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
        <div class="space-y-1 text-center">
            <i class="fas fa-cloud-upload-alt text-gray-400 text-3xl"></i>
            <div class="flex text-sm text-gray-600">
                <label for="editSliderImage" class="relative cursor-pointer bg-white rounded-md font-medium text-primary hover:text-emerald-500">
                    <span>Upload a file</span>
                    <input id="editSliderImage" name="image" type="file" class="sr-only" accept="image/*">
                </label>
                <p class="pl-1">or drag and drop</p>
            </div>
            <p class="text-xs text-gray-500">PNG, JPG, WEBP up to 10MB</p>
        </div>
    </div>

    <div class="mt-4">
        <label class="block text-sm font-medium text-gray-700 mb-2">Preview</label>
        <div id="sliderImagePreview" class="w-full h-40 bg-gray-200 rounded-md flex items-center justify-center overflow-hidden">
            <i class="fas fa-image text-gray-400 text-3xl"></i>
        </div>
    </div>
</div>

<!-- Video Upload -->
<div id="editVideoUploadSection" class="hidden">
    <label class="block text-sm font-medium text-gray-700">Slider Video</label>
    <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
        <div class="space-y-1 text-center">
            <i class="fas fa-video text-gray-400 text-3xl"></i>
            <div class="flex text-sm text-gray-600">
                <label for="editSliderVideo" class="relative cursor-pointer bg-white rounded-md font-medium text-primary hover:text-emerald-500">
                    <span>Upload a video</span>
                    <input id="editSliderVideo" name="video" type="file" class="sr-only" accept="video/mp4,video/webm,video/ogg">
                </label>
                <p class="pl-1">or drag and drop</p>
            </div>
            <p class="text-xs text-gray-500">MP4, WEBM, OGG up to 50MB</p>
        </div>
    </div>

    <div class="mt-4">
        <label class="block text-sm font-medium text-gray-700 mb-2">Preview</label>
        <div id="editVideoPreview" class="w-full h-40 bg-gray-200 rounded-md flex items-center justify-center overflow-hidden">
            <i class="fas fa-video text-gray-400 text-3xl"></i>
        </div>
    </div>
</div>


                <div class="flex justify-end space-x-3 pt-4 border-t">
                    <button type="button"id="editCancelBtn"
                            class="px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                        Cancel
                    </button>
                    <button type="submit"
                            class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-primary hover:bg-emerald-600">
                        Update Slider
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

         </div>
@endsection


@push("script")
<script>
document.addEventListener('DOMContentLoaded', function () {

    /* -----------------------------
       ADD SLIDER MODAL FUNCTIONALITY
    ----------------------------- */
    const addSliderBtn = document.getElementById('addSliderBtn');
    const addSliderModal = document.getElementById('addSliderModal');
    const addCloseBtn = document.getElementById('addCloseModal');
    const addCancelBtn = document.getElementById('addCancelBtn');
    
    
    const openAddModal = () => {
        addSliderModal.classList.remove('hidden');
        document.body.classList.add('overflow-hidden');
    };


    /* -----------------------------
   SLIDER TYPE TOGGLE (Banner / Video)
----------------------------- */
const sliderType = document.getElementById('sliderType');
const bannerUploadSection = document.getElementById('bannerUploadSection');
const videoUploadSection = document.getElementById('videoUploadSection');

// All text input fields (to disable for video)
const textInputs = [
    'sliderTitle',
    'sliderDescription',
    'buttonText',
    'buttonLink',
    'sliderPosition',
].map(id => document.getElementById(id));

sliderType?.addEventListener('change', (e) => {
    const type = e.target.value;

    if (type === 'video') {
        // Hide text inputs
        textInputs.forEach(el => {
            if (el) {
                el.disabled = true;
                el.closest('div').classList.add('hidden');
            }
        });

        // Switch upload sections
        bannerUploadSection.classList.add('hidden');
        videoUploadSection.classList.remove('hidden');
    } else {
        // Show text inputs
        textInputs.forEach(el => {
            if (el) {
                el.disabled = false;
                el.closest('div').classList.remove('hidden');
            }
        });

        // Switch back to image
        bannerUploadSection.classList.remove('hidden');
        videoUploadSection.classList.add('hidden');
    }
});


    const closeAddModal = () => {
        addSliderModal.classList.add('hidden');
        document.body.classList.remove('overflow-hidden');
    };

    if (addSliderBtn) addSliderBtn.addEventListener('click', openAddModal);
    if (addCloseBtn) addCloseBtn.addEventListener('click', closeAddModal);
    if (addCancelBtn) addCancelBtn.addEventListener('click', closeAddModal);

    addSliderModal?.addEventListener('click', (e) => {
        if (e.target === addSliderModal) closeAddModal();
    });

    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && !addSliderModal.classList.contains('hidden')) closeAddModal();
    });
/* -----------------------------
   EDIT SLIDER MODAL FUNCTIONALITY
----------------------------- */
    /* -----------------------------
   EDIT SLIDER MODAL FUNCTIONALITY
----------------------------- */
    console.log("✅ Edit slider JS loaded");

    const editButtons = document.querySelectorAll('.edit-slider-btn');
    const editModal = document.getElementById('editSliderModal');
    const editCloseBtn = document.getElementById('editCloseModal');
    const editCancelBtn = document.getElementById('editCancelBtn');
    const editPreview = document.getElementById('sliderImagePreview');
    const editForm = document.getElementById('editSliderForm');

    // Type-based sections
    const editSliderType = document.getElementById('editSliderType');
    const editBannerUpload = document.getElementById('editBannerUploadSection');
    const editVideoUpload = document.getElementById('editVideoUploadSection');
    const editVideoPreview = document.getElementById('editVideoPreview');

    const editTextFields = [
        'editSliderTitle',
        'editSliderDescription',
        'editButtonText',
        'editButtonLink'
    ].map(id => document.getElementById(id));

    function handleEditTypeSwitch(type) {
        console.log("Switching type to:", type);
        if (type === 'video') {
            editTextFields.forEach(el => {
                if (el) {
                    el.disabled = true;
                    el.closest('div').classList.add('hidden');
                }
            });
            editBannerUpload.classList.add('hidden');
            editVideoUpload.classList.remove('hidden');
        } else {
            editTextFields.forEach(el => {
                if (el) {
                    el.disabled = false;
                    el.closest('div').classList.remove('hidden');
                }
            });
            editBannerUpload.classList.remove('hidden');
            editVideoUpload.classList.add('hidden');
        }
    }

    editSliderType?.addEventListener('change', (e) => {
        handleEditTypeSwitch(e.target.value);
    });

    // 🎯 Edit button click
    editButtons.forEach(btn => {

        btn.addEventListener('click', () => {
            console.log("Edit button clicked:", btn.dataset.id);

            const id = btn.dataset.id;
            const title = btn.dataset.title;
            const description = btn.dataset.description;
            const buttonText = btn.dataset.buttonText || btn.dataset.button_text;
            const buttonUrl = btn.dataset.buttonUrl || btn.dataset.button_url;
            const status = btn.dataset.status;
            const image = btn.dataset.image;
            const type = btn.dataset.type || 'banner';
            const video = btn.dataset.video;

            // Fill form
            editForm.action = `/admin/hero-sliders/update/${id}`;
            document.getElementById('editSliderTitle').value = title || '';
            document.getElementById('editSliderDescription').value = description || '';
            document.getElementById('editButtonText').value = buttonText || '';
            document.getElementById('editButtonLink').value = buttonUrl || '';
            document.getElementById('editSliderStatus').value = String(status ?? '0');
            editSliderType.value = type;

            // Type handling
            handleEditTypeSwitch(type);

            // Preview
            if (type === 'video' && video) {
                editVideoPreview.innerHTML = `
                    <video controls class="h-full w-full object-cover rounded-md">
                        <source src="${video}" type="video/mp4">
                    </video>`;
                editPreview.innerHTML = `<i class="fas fa-image text-gray-400 text-3xl"></i>`;
            } else if (image) {
                editPreview.innerHTML = `<img src="${image}" class="object-cover h-full w-full rounded-md" />`;
                editVideoPreview.innerHTML = '';
            } else {
                editPreview.innerHTML = `<i class="fas fa-image text-gray-400 text-3xl"></i>`;
                editVideoPreview.innerHTML = '';
            }

            console.log('Opening modal now:', editModal);


            // Open modal
            editModal.classList.remove('hidden');
            document.body.classList.add('overflow-hidden');
        });
    });

    // Close modal buttons
    [editCloseBtn, editCancelBtn].forEach(btn => {
        btn?.addEventListener('click', () => {
            editModal.classList.add('hidden');
            document.body.classList.remove('overflow-hidden');
        });
    });

    // Close on outside click
    editModal?.addEventListener('click', (e) => {
        if (e.target === editModal) {
            editModal.classList.add('hidden');
            document.body.classList.remove('overflow-hidden');
        }
    });
});

</script>

@endpush

