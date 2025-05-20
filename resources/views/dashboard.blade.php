<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Students - Dashboard</title>
    <script src="https://cdn.tailwindcss.com/3.4.16"></script>
    <script>tailwind.config={theme:{extend:{colors:{primary:'#4f46e5',secondary:'#f97316'},borderRadius:{'none':'0px','sm':'4px',DEFAULT:'8px','md':'12px','lg':'16px','xl':'20px','2xl':'24px','3xl':'32px','full':'9999px','button':'8px'}}}}</script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.5.0/fonts/remixicon.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/echarts/5.5.0/echarts.min.js"></script>
    <style>
        :where([class^="ri-"])::before { content: "\f3c2"; }
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f9fafb;
        }
        input[type="number"]::-webkit-inner-spin-button,
        input[type="number"]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
        .custom-scrollbar::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb {
            background-color: #d1d5db;
            border-radius: 3px;
        }
        .custom-scrollbar::-webkit-scrollbar-track {
            background-color: #f3f4f6;
        }
        .custom-switch {
            position: relative;
            display: inline-block;
            width: 44px;
            height: 24px;
        }
        .custom-switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }
        .switch-slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #e5e7eb;
            transition: .4s;
            border-radius: 34px;
        }
        .switch-slider:before {
            position: absolute;
            content: "";
            height: 18px;
            width: 18px;
            left: 3px;
            bottom: 3px;
            background-color: white;
            transition: .4s;
            border-radius: 50%;
        }
        input:checked + .switch-slider {
            background-color: #4f46e5;
        }
        input:checked + .switch-slider:before {
            transform: translateX(20px);
        }
        .custom-radio {
            display: flex;
            align-items: center;
            cursor: pointer;
        }
        .custom-radio-input {
            appearance: none;
            width: 18px;
            height: 18px;
            border: 2px solid #d1d5db;
            border-radius: 50%;
            margin-right: 8px;
            position: relative;
            cursor: pointer;
        }
        .custom-radio-input:checked {
            border-color: #4f46e5;
        }
        .custom-radio-input:checked::after {
            content: "";
            position: absolute;
            top: 3px;
            left: 3px;
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background-color: #4f46e5;
        }
        .custom-checkbox {
            display: flex;
            align-items: center;
            cursor: pointer;
        }
        .custom-checkbox-input {
            appearance: none;
            width: 18px;
            height: 18px;
            border: 2px solid #d1d5db;
            border-radius: 4px;
            margin-right: 8px;
            position: relative;
            cursor: pointer;
        }
        .custom-checkbox-input:checked {
            background-color: #4f46e5;
            border-color: #4f46e5;
        }
        .custom-checkbox-input:checked::after {
            content: "";
            position: absolute;
            top: 2px;
            left: 5px;
            width: 5px;
            height: 10px;
            border: solid white;
            border-width: 0 2px 2px 0;
            transform: rotate(45deg);
        }
        .custom-range {
            -webkit-appearance: none;
            width: 100%;
            height: 6px;
            border-radius: 5px;
            background: #e5e7eb;
            outline: none;
        }
        .custom-range::-webkit-slider-thumb {
            -webkit-appearance: none;
            appearance: none;
            width: 18px;
            height: 18px;
            border-radius: 50%;
            background: #4f46e5;
            cursor: pointer;
            border: 2px solid white;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        }
        .custom-range::-moz-range-thumb {
            width: 18px;
            height: 18px;
            border-radius: 50%;
            background: #4f46e5;
            cursor: pointer;
            border: 2px solid white;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        }
        .student-modal {
            display: none;
            position: fixed;
            top: 0;
            right: 0;
            bottom: 0;
            width: 100%;
            max-width: 600px;
            background-color: white;
            z-index: 50;
            box-shadow: -5px 0 15px rgba(0, 0, 0, 0.1);
            overflow-y: auto;
        }
        .modal-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 40;
        }
        .add-student-modal {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 100%;
            max-width: 500px;
            background-color: white;
            z-index: 50;
            border-radius: 8px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
    <div class="flex h-screen bg-gray-50">
        <!-- Sidebar -->
        <div class="hidden md:flex md:flex-col md:w-64 bg-white shadow-sm">
            <div class="p-4 flex items-center">
                <span class="font-['Pacifico'] text-primary text-2xl">EduConnect</span>
            </div>
            <div class="p-4">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-12 h-12 rounded-full bg-primary/10 flex items-center justify-center">
                        <i class="ri-user-line text-primary ri-lg"></i>
                    </div>
                    <div>
                        <p class="font-medium">Emily Johnson</p>
                        <div class="flex items-center text-sm text-gray-500">
                            <span class="bg-green-100 text-green-800 text-xs px-2 py-0.5 rounded-full">Teacher</span>
                        </div>
                    </div>
                </div>
            </div>
            <nav class="flex-1 px-2 py-4 space-y-1 overflow-y-auto custom-scrollbar">
                <a href="{{ route('dashboard') }}"
                   class="flex items-center px-4 py-2.5 text-sm font-medium rounded-lg
                          {{ request()->routeIs('dashboard') ? 'text-primary bg-primary/10' : 'text-gray-600 hover:bg-gray-100' }}">
                    <div class="w-6 h-6 mr-3 flex items-center justify-center">
                        <i class="ri-dashboard-line"></i>
                    </div>
                    Dashboard
                </a>
            
                <a href="{{ route('students.index') }}"
                   class="flex items-center px-4 py-2.5 text-sm font-medium rounded-lg
                          {{ request()->routeIs('students.index') ? 'text-primary bg-primary/10' : 'text-gray-600 hover:bg-gray-100' }}">
                    <div class="w-6 h-6 mr-3 flex items-center justify-center">
                        <i class="ri-user-line"></i>
                    </div>
                    Students
                </a>
            </nav>
            
            <div class="p-4 border-t">
                <a href="#" class="flex items-center px-4 py-2.5 text-sm font-medium text-gray-600 hover:bg-gray-100 rounded-lg">
                    <div class="w-6 h-6 mr-3 flex items-center justify-center">
                        <i class="ri-logout-box-line"></i>
                    </div>
                    Logout
                </a>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Top Navigation -->
            <header class="bg-white shadow-sm z-10">
                <div class="flex items-center justify-between px-4 py-3">
                    <div class="flex items-center md:hidden">
                        <button type="button" class="text-gray-500 hover:text-gray-600 p-2 rounded-md">
                            <div class="w-6 h-6 flex items-center justify-center">
                                <i class="ri-menu-line"></i>
                            </div>
                        </button>
                        <span class="font-['Pacifico'] text-primary text-xl ml-2">EduConnect</span>
                    </div>
                    <div class="hidden md:flex items-center flex-1 px-4">
                        <div class="relative max-w-md w-full">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <div class="w-5 h-5 flex items-center justify-center text-gray-400">
                                    <i class="ri-search-line"></i>
                                </div>
                            </div>
                            <input type="text" class="bg-gray-50 border-none text-gray-900 text-sm rounded-lg block w-full pl-10 p-2.5 focus:ring-2 focus:ring-primary/20 focus:outline-none" placeholder="Search students, classes, or activities...">
                        </div>
                    </div>
                    <div class="flex items-center space-x-4">
                        <div class="relative">
                            <button type="button" class="relative p-2 text-gray-500 hover:text-gray-600 rounded-full">
                                <div class="w-6 h-6 flex items-center justify-center">
                                    <i class="ri-notification-3-line"></i>
                                </div>
                                <span class="absolute top-0 right-0 h-4 w-4 bg-red-500 rounded-full flex items-center justify-center text-xs text-white">3</span>
                            </button>
                        </div>
                        <div class="relative">
                            <button type="button" class="relative p-2 text-gray-500 hover:text-gray-600 rounded-full">
                                <div class="w-6 h-6 flex items-center justify-center">
                                    <i class="ri-message-2-line"></i>
                                </div>
                                <span class="absolute top-0 right-0 h-4 w-4 bg-primary rounded-full flex items-center justify-center text-xs text-white">5</span>
                            </button>
                        </div>
                        <div class="relative ml-2">
                            <button type="button" class="flex items-center text-sm rounded-full focus:outline-none">
                                <img class="h-8 w-8 rounded-full object-cover" src="https://readdy.ai/api/search-image?query=professional%2520portrait%2520of%2520a%2520female%2520teacher%2520with%2520brown%2520hair%252C%2520warm%2520smile%252C%2520business%2520casual%2520attire%252C%2520neutral%2520background%252C%2520high%2520quality%252C%2520photorealistic&width=200&height=200&seq=teacher1&orientation=squarish" alt="User">
                            </button>
                        </div>
                    </div>
                </div>
                <div class="border-b border-gray-200 px-4 py-2 flex items-center overflow-x-auto custom-scrollbar">
                    <div class="flex space-x-4">
                        <a href="https://readdy.ai/home/b8e20487-1c5f-4382-bb15-ebd7a3c4d48a/c7194a38-0291-4ef5-acc3-195b70ab57d1" data-readdy="true" class="whitespace-nowrap px-3 py-2 text-sm font-medium text-gray-500 border-b-2 border-transparent hover:text-gray-700 hover:border-gray-300">Overview</a>
                        <button class="whitespace-nowrap px-3 py-2 text-sm font-medium text-gray-500 border-b-2 border-transparent hover:text-gray-700 hover:border-gray-300">Class 8A</button>
                        <button class="whitespace-nowrap px-3 py-2 text-sm font-medium text-gray-500 border-b-2 border-transparent hover:text-gray-700 hover:border-gray-300">Class 9B</button>
                        <button class="whitespace-nowrap px-3 py-2 text-sm font-medium text-gray-500 border-b-2 border-transparent hover:text-gray-700 hover:border-gray-300">Class 10C</button>
                        <button class="whitespace-nowrap px-3 py-2 text-sm font-medium text-gray-500 border-b-2 border-transparent hover:text-gray-700 hover:border-gray-300">Class 11A</button>
                    </div>
                </div>
            </header>

            <!-- Main Content Area -->
            <main class="flex-1 overflow-y-auto bg-gray-50 p-4 custom-scrollbar">
                <div class="max-w-7xl mx-auto">
                    <!-- Breadcrumb -->
                    <nav class="flex mb-5" aria-label="Breadcrumb">
                        <ol class="inline-flex items-center space-x-1 md:space-x-3">
                            <li class="inline-flex items-center">
                                <a href="{{ route('dashboard') }}" data-readdy="true" class="inline-flex items-center text-sm font-medium text-gray-500 hover:text-primary">
                                    <div class="w-4 h-4 mr-2 flex items-center justify-center">
                                        <i class="ri-dashboard-line"></i>
                                    </div>
                                    Dashboard
                                </a>
                            </li>
                        </ol>
                    </nav>

                    <!-- Quick Stats Cards -->
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
                        <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-100">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 w-12 h-12 bg-primary/10 rounded-full flex items-center justify-center mr-4">
                                    <div class="w-6 h-6 flex items-center justify-center text-primary">
                                        <i class="ri-user-line"></i>
                                    </div>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-500">Total Students</p>
                                    <h3 class="text-2xl font-bold text-gray-900" id="total-students"></h3>
                                </div>
                            </div>
                            <div class="mt-4 flex items-center text-sm">
                                <div class="w-4 h-4 flex items-center justify-center text-green-500 mr-1">
                                    <i class="ri-arrow-up-line"></i>
                                </div>
                                <span class="text-green-500 font-medium">3.2%</span>
                                <span class="text-gray-500 ml-1">from last month</span>
                            </div>
                        </div>
                        <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-100">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center mr-4">
                                    <div class="w-6 h-6 flex items-center justify-center text-blue-600">
                                        <i class="ri-bar-chart-line"></i>
                                    </div>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-500">Average Performance</p>
                                    <h3 class="text-2xl font-bold text-gray-900" id="average-performance">0%</h3>
                                </div>
                            </div>
                            <div class="mt-4 flex items-center text-sm">
                                <div class="w-4 h-4 flex items-center justify-center text-green-500 mr-1">
                                    <i class="ri-arrow-up-line"></i>
                                </div>
                                <span class="text-green-500 font-medium">2.5%</span>
                                <span class="text-gray-500 ml-1">from last semester</span>
                            </div>
                        </div>
                        <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-100">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 w-12 h-12 bg-green-100 rounded-full flex items-center justify-center mr-4">
                                    <div class="w-6 h-6 flex items-center justify-center text-green-600">
                                        <i class="ri-calendar-check-line"></i>
                                    </div>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-500">Attendance Rate</p>
                                    <h3 class="text-2xl font-bold text-gray-900" id="attendance-rate">0%</h3>
                                </div>
                            </div>
                            <div class="mt-4 flex items-center text-sm">
                                <div class="w-4 h-4 flex items-center justify-center text-green-500 mr-1">
                                    <i class="ri-arrow-up-line"></i>
                                </div>
                                <span class="text-green-500 font-medium">1.8%</span>
                                <span class="text-gray-500 ml-1">from last month</span>
                            </div>
                        </div>
                        <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-100">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 w-12 h-12 bg-amber-100 rounded-full flex items-center justify-center mr-4">
                                    <div class="w-6 h-6 flex items-center justify-center text-amber-600">
                                        <i class="ri-flag-line"></i>
                                    </div>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-500">At-Risk Students</p>
                                    <h3 class="text-2xl font-bold text-gray-900" id="at-risk-students">0</h3>
                                </div>
                            </div>
                            <div class="mt-4 flex items-center text-sm">
                                <div class="w-4 h-4 flex items-center justify-center text-red-500 mr-1">
                                    <i class="ri-arrow-up-line"></i>
                                </div>
                                <span class="text-red-500 font-medium">2.1%</span>
                                <span class="text-gray-500 ml-1">from last month</span>
                            </div>
                        </div>
                    </div>

                    <!-- Performance Distribution Chart -->
                    <div class="bg-white rounded-lg shadow-sm p-4 mb-6 border border-gray-100">
                        <div class="flex items-center justify-between mb-4">
                            <h2 class="text-lg font-medium text-gray-900">Performance Distribution</h2>
                            <div class="relative">
                                 {{-- <select id="status" name="status"
                                class="appearance-none w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg p-2.5 pr-8 focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500">
                                <option value="active">All Class</option>
                                @for ($i = 1; $i <= 12; $i++)
                                    <option value="{{ $i }}">Class {{ $i }}</option>
                                @endfor
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-3 flex items-center text-gray-400">
                                <i class="ri-arrow-down-s-line text-lg"></i>
                            </div> --}}
                                {{-- <button class="text-gray-400 hover:text-gray-500 flex items-center text-sm">
                                    All Classes
                                    <div class="w-4 h-4 ml-1 flex items-center justify-center">
                                        <i class="ri-arrow-down-s-line"></i>
                                    </div>
                                </button> --}}

                                <!-- Alpine.js Dropdown -->
                    <div x-data="{
                            open: false,
                            selected: 'All Classes',
                            searchTerm: '',
                            classes: ['All Classes', ...Array.from({length: 12}, (_, i) => ({
                                display: `Class ${i+1}`,
                                value: i+1
                            }))]
                        }" 
                        class="relative inline-block text-left w-40">
                        
                        <!-- Dropdown Button -->
                        <button @click="open = !open"
                            class="text-gray-700 hover:text-gray-900 flex items-center text-sm focus:outline-none w-full justify-between">
                            <span x-text="selected" class="truncate"></span>
                            <div class="w-4 h-4 ml-1 flex items-center justify-center">
                                <i class="ri-arrow-down-s-line text-sm"></i>
                            </div>
                        </button>

                        <!-- Dropdown List -->
                        <div x-show="open" @click.outside="open = false"
                            class="absolute z-10 mt-1 w-48 rounded-md bg-white shadow-lg border border-gray-200">
                            
                            <!-- Search Box -->
                            <div class="p-1 border-b border-gray-200">
                                <input 
                                    x-model="searchTerm"
                                    type="text" 
                                    placeholder="Search class..."
                                    class="w-full px-2 py-1 text-xs border border-gray-300 rounded focus:outline-none focus:ring-1 focus:ring-blue-500"
                                    @click.stop
                                >
                            </div>
                            
                            <!-- Scrollable List -->
                            <ul class="py-1 text-xs text-gray-700 max-h-48 overflow-y-auto">
                                <template x-for="item in classes.filter(c => {
                                    if (c === 'All Classes') return 'All Classes'.toLowerCase().includes(searchTerm.toLowerCase());
                                    return c.display.toLowerCase().includes(searchTerm.toLowerCase());
                                })" :key="item === 'All Classes' ? 'All Classes' : item.value">
                                    <li 
                                        @click="
                                            selected = item === 'All Classes' ? 'All Classes' : item.display;
                                            open = false;
                                            const event = new CustomEvent('class-selected', { 
                                                detail: { 
                                                    className: item === 'All Classes' ? '' : item.value.toString() 
                                                } 
                                            });
                                            document.dispatchEvent(event);
                                        " 
                                        class="px-2 py-1 hover:bg-gray-100 cursor-pointer"
                                        :class="{'bg-blue-50': selected === (item === 'All Classes' ? 'All Classes' : item.display)}"
                                    >
                                        <span x-text="item === 'All Classes' ? 'All Classes' : item.display" class="truncate"></span>
                                    </li>
                                </template>
                            </ul>
                        </div>
                    </div>
                            </div>
                        </div>
                        <div class="h-80" id="performance-distribution-chart"></div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <!-- Mobile Bottom Navigation -->
    <div class="md:hidden fixed bottom-0 left-0 right-0 bg-white border-t border-gray-200 z-10">
        <div class="flex justify-around">
            <a href="https://readdy.ai/home/b8e20487-1c5f-4382-bb15-ebd7a3c4d48a/c7194a38-0291-4ef5-acc3-195b70ab57d1" data-readdy="true" class="flex flex-col items-center py-2 px-3 text-gray-500">
                <div class="w-6 h-6 flex items-center justify-center">
                    <i class="ri-dashboard-line"></i>
                </div>
                <span class="text-xs mt-1">Dashboard</span>
            </a>
            <a href="#" class="flex flex-col items-center py-2 px-3 text-primary">
                <div class="w-6 h-6 flex items-center justify-center">
                    <i class="ri-user-line"></i>
                </div>
                <span class="text-xs mt-1">Students</span>
            </a>
            <a href="#" class="flex flex-col items-center py-2 px-3 text-gray-500">
                <div class="w-6 h-6 flex items-center justify-center">
                    <i class="ri-calendar-line"></i>
                </div>
                <span class="text-xs mt-1">Schedule</span>
            </a>
            <a href="#" class="flex flex-col items-center py-2 px-3 text-gray-500">
                <div class="w-6 h-6 flex items-center justify-center">
                    <i class="ri-message-2-line"></i>
                </div>
                <span class="text-xs mt-1">Messages</span>
            </a>
            <a href="#" class="flex flex-col items-center py-2 px-3 text-gray-500">
                <div class="w-6 h-6 flex items-center justify-center">
                    <i class="ri-menu-line"></i>
                </div>
                <span class="text-xs mt-1">More</span>
            </a>
        </div>
    </div>

    <!-- Student Profile Modal -->
    <div class="modal-overlay" id="studentModalOverlay"></div>
    <div class="student-modal custom-scrollbar" id="studentProfileModal">
        <div class="p-4 border-b border-gray-200 flex items-center justify-between">
            <h2 class="text-xl font-bold text-gray-900">Student Profile</h2>
            <button id="closeStudentModal" class="text-gray-500 hover:text-gray-700">
                <div class="w-6 h-6 flex items-center justify-center">
                    <i class="ri-close-line"></i>
                </div>
            </button>
        </div>
        <div class="p-6">
            <!-- Student Basic Info -->
            <div class="flex flex-col items-center mb-6">
                <img class="w-24 h-24 rounded-full mb-4 object-cover" src="https://readdy.ai/api/search-image?query=portrait%2520of%2520a%2520teenage%2520boy%2520student%2520with%2520brown%2520hair%252C%2520smiling%252C%2520school%2520uniform%252C%2520classroom%2520background%252C%2520high%2520quality%252C%2520photorealistic&width=200&height=200&seq=student1&orientation=squarish" alt="Student">
                <h3 class="text-xl font-bold text-gray-900">Michael Anderson</h3>
                <p class="text-gray-500">STU-2025-001</p>
                <div class="flex mt-2 space-x-2">
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-primary/10 text-primary">
                        Class 8A
                    </span>
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                        Active
                    </span>
                </div>
                <div class="flex mt-4 space-x-3">
                    <button class="inline-flex items-center px-3 py-1.5 text-sm font-medium text-white bg-primary rounded-lg hover:bg-primary/90 !rounded-button whitespace-nowrap">
                        <div class="w-4 h-4 mr-2 flex items-center justify-center">
                            <i class="ri-message-2-line"></i>
                        </div>
                        Message
                    </button>
                    <button class="inline-flex items-center px-3 py-1.5 text-sm font-medium text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200 !rounded-button whitespace-nowrap">
                        <div class="w-4 h-4 mr-2 flex items-center justify-center">
                            <i class="ri-edit-line"></i>
                        </div>
                        Edit
                    </button>
                </div>
            </div>

            <!-- Student Details Tabs -->
            <div class="border-b border-gray-200 mb-6">
                <div class="flex space-x-8">
                    <button class="px-1 py-4 text-sm font-medium text-primary border-b-2 border-primary">Overview</button>
                    <button class="px-1 py-4 text-sm font-medium text-gray-500 border-b-2 border-transparent hover:text-gray-700 hover:border-gray-300">Academics</button>
                    <button class="px-1 py-4 text-sm font-medium text-gray-500 border-b-2 border-transparent hover:text-gray-700 hover:border-gray-300">Attendance</button>
                    <button class="px-1 py-4 text-sm font-medium text-gray-500 border-b-2 border-transparent hover:text-gray-700 hover:border-gray-300">Notes</button>
                </div>
            </div>

            <!-- Personal Information -->
            <div class="mb-8">
                <h4 class="text-lg font-medium text-gray-900 mb-4">Personal Information</h4>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <p class="text-sm text-gray-500">Date of Birth</p>
                        <p class="text-sm font-medium text-gray-900">June 12, 2010</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Gender</p>
                        <p class="text-sm font-medium text-gray-900">Male</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Email</p>
                        <p class="text-sm font-medium text-gray-900">michael.anderson@example.com</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Phone</p>
                        <p class="text-sm font-medium text-gray-900">+1 (555) 123-4567</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Address</p>
                        <p class="text-sm font-medium text-gray-900">123 Main Street, Anytown, CA 94321</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Enrollment Date</p>
                        <p class="text-sm font-medium text-gray-900">September 1, 2023</p>
                    </div>
                </div>
            </div>

            <!-- Parent/Guardian Information -->
            <div class="mb-8">
                <h4 class="text-lg font-medium text-gray-900 mb-4">Parent/Guardian Information</h4>
                <div class="space-y-4">
                    <div class="flex items-start p-4 bg-gray-50 rounded-lg">
                        <img class="w-10 h-10 rounded-full mr-4 object-cover" src="https://readdy.ai/api/search-image?query=professional%2520portrait%2520of%2520a%2520middle-aged%2520woman%2520with%2520blonde%2520hair%252C%2520warm%2520smile%252C%2520business%2520casual%2520attire%252C%2520neutral%2520background%252C%2520high%2520quality%252C%2520photorealistic&width=200&height=200&seq=parent1&orientation=squarish" alt="Parent">
                        <div>
                            <h5 class="text-sm font-medium text-gray-900">Rebecca Anderson (Mother)</h5>
                            <p class="text-sm text-gray-500">rebecca.anderson@example.com</p>
                            <p class="text-sm text-gray-500">+1 (555) 987-6543</p>
                            <div class="mt-2">
                                <button class="inline-flex items-center px-2 py-1 text-xs font-medium text-primary bg-primary/10 rounded-full !rounded-button whitespace-nowrap">
                                    <div class="w-3 h-3 mr-1 flex items-center justify-center">
                                        <i class="ri-message-2-line"></i>
                                    </div>
                                    Message
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="flex items-start p-4 bg-gray-50 rounded-lg">
                        <img class="w-10 h-10 rounded-full mr-4 object-cover" src="https://readdy.ai/api/search-image?query=professional%2520portrait%2520of%2520a%2520middle-aged%2520man%2520with%2520brown%2520hair%252C%2520warm%2520smile%252C%2520business%2520casual%2520attire%252C%2520neutral%2520background%252C%2520high%2520quality%252C%2520photorealistic&width=200&height=200&seq=parent2&orientation=squarish" alt="Parent">
                        <div>
                            <h5 class="text-sm font-medium text-gray-900">David Anderson (Father)</h5>
                            <p class="text-sm text-gray-500">david.anderson@example.com</p>
                            <p class="text-sm text-gray-500">+1 (555) 876-5432</p>
                            <div class="mt-2">
                                <button class="inline-flex items-center px-2 py-1 text-xs font-medium text-primary bg-primary/10 rounded-full !rounded-button whitespace-nowrap">
                                    <div class="w-3 h-3 mr-1 flex items-center justify-center">
                                        <i class="ri-message-2-line"></i>
                                    </div>
                                    Message
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Academic Performance -->
            <div class="mb-8">
                <div class="flex items-center justify-between mb-4">
                    <h4 class="text-lg font-medium text-gray-900">Academic Performance</h4>
                    <button class="text-sm font-medium text-primary">View Full Report</button>
                </div>
                <div class="h-64" id="student-performance-chart"></div>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-6">
                    <div class="bg-gray-50 p-3 rounded-lg">
                        <p class="text-sm text-gray-500">Mathematics</p>
                        <p class="text-lg font-medium text-gray-900">85%</p>
                        <div class="flex items-center text-xs mt-1">
                            <div class="w-3 h-3 flex items-center justify-center text-green-500 mr-1">
                                <i class="ri-arrow-up-line"></i>
                            </div>
                            <span class="text-green-500">+15%</span>
                        </div>
                    </div>
                    <div class="bg-gray-50 p-3 rounded-lg">
                        <p class="text-sm text-gray-500">Science</p>
                        <p class="text-lg font-medium text-gray-900">78%</p>
                        <div class="flex items-center text-xs mt-1">
                            <div class="w-3 h-3 flex items-center justify-center text-green-500 mr-1">
                                <i class="ri-arrow-up-line"></i>
                            </div>
                            <span class="text-green-500">+5%</span>
                        </div>
                    </div>
                    <div class="bg-gray-50 p-3 rounded-lg">
                        <p class="text-sm text-gray-500">English</p>
                        <p class="text-lg font-medium text-gray-900">92%</p>
                        <div class="flex items-center text-xs mt-1">
                            <div class="w-3 h-3 flex items-center justify-center text-green-500 mr-1">
                                <i class="ri-arrow-up-line"></i>
                            </div>
                            <span class="text-green-500">+3%</span>
                        </div>
                    </div>
                    <div class="bg-gray-50 p-3 rounded-lg">
                        <p class="text-sm text-gray-500">History</p>
                        <p class="text-lg font-medium text-gray-900">75%</p>
                        <div class="flex items-center text-xs mt-1">
                            <div class="w-3 h-3 flex items-center justify-center text-red-500 mr-1">
                                <i class="ri-arrow-down-line"></i>
                            </div>
                            <span class="text-red-500">-2%</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Attendance Record -->
            <div class="mb-8">
                <div class="flex items-center justify-between mb-4">
                    <h4 class="text-lg font-medium text-gray-900">Attendance Record</h4>
                    <button class="text-sm font-medium text-primary">View Full Record</button>
                </div>
                <div class="h-48" id="student-attendance-chart"></div>
                <div class="flex justify-between mt-4">
                    <div class="text-center">
                        <p class="text-sm text-gray-500">Present</p>
                        <p class="text-lg font-medium text-gray-900">92%</p>
                    </div>
                    <div class="text-center">
                        <p class="text-sm text-gray-500">Absent</p>
                        <p class="text-lg font-medium text-gray-900">5%</p>
                    </div>
                    <div class="text-center">
                        <p class="text-sm text-gray-500">Late</p>
                        <p class="text-lg font-medium text-gray-900">3%</p>
                    </div>
                </div>
            </div>

            <!-- Recent Notes -->
            <div class="mb-8">
                <div class="flex items-center justify-between mb-4">
                    <h4 class="text-lg font-medium text-gray-900">Recent Notes</h4>
                    <button class="text-sm font-medium text-primary">Add Note</button>
                </div>
                <div class="space-y-4">
                    <div class="p-4 bg-gray-50 rounded-lg">
                        <div class="flex items-center justify-between mb-2">
                            <h5 class="text-sm font-medium text-gray-900">Math Progress</h5>
                            <p class="text-xs text-gray-500">April 25, 2025</p>
                        </div>
                        <p class="text-sm text-gray-700">Michael has shown significant improvement in his math problem-solving skills. His approach to complex problems is becoming more methodical.</p>
                        <p class="text-xs text-gray-500 mt-2">Added by: Emily Johnson</p>
                    </div>
                    <div class="p-4 bg-gray-50 rounded-lg">
                        <div class="flex items-center justify-between mb-2">
                            <h5 class="text-sm font-medium text-gray-900">Science Project</h5>
                            <p class="text-xs text-gray-500">April 15, 2025</p>
                        </div>
                        <p class="text-sm text-gray-700">Michael demonstrated excellent teamwork skills during the group science project. He took initiative in coordinating tasks and helped other team members.</p>
                        <p class="text-xs text-gray-500 mt-2">Added by: Robert Chen</p>
                    </div>
                </div>
            </div>

            <!-- Back to Dashboard -->
            <div class="mt-8 text-center">
                <a href="https://readdy.ai/home/b8e20487-1c5f-4382-bb15-ebd7a3c4d48a/c7194a38-0291-4ef5-acc3-195b70ab57d1" data-readdy="true" class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200 !rounded-button whitespace-nowrap">
                    <div class="w-4 h-4 mr-2 flex items-center justify-center">
                        <i class="ri-arrow-left-line"></i>
                    </div>
                    Back to Dashboard
                </a>
            </div>
        </div>
    </div>

    <!-- Add Student Modal -->
    <div class="modal-overlay" id="addStudentModalOverlay"></div>
    <div class="add-student-modal" id="addStudentModal">
        <div class="p-4 border-b border-gray-200 flex items-center justify-between">
            <h2 class="text-xl font-bold text-gray-900">Add New Student</h2>
            <button id="closeAddStudentModal" class="text-gray-500 hover:text-gray-700">
                <div class="w-6 h-6 flex items-center justify-center">
                    <i class="ri-close-line"></i>
                </div>
            </button>
        </div>
        <div class="p-6">
            <form>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label for="firstName" class="block text-sm font-medium text-gray-700 mb-1">First Name</label>
                        <input type="text" id="firstName" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary focus:border-primary block w-full p-2.5" placeholder="Enter first name" required>
                    </div>
                    <div>
                        <label for="lastName" class="block text-sm font-medium text-gray-700 mb-1">Last Name</label>
                        <input type="text" id="lastName" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary focus:border-primary block w-full p-2.5" placeholder="Enter last name" required>
                    </div>
                    <div>
                        <label for="studentEmail" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                        <input type="email" id="studentEmail" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary focus:border-primary block w-full p-2.5" placeholder="Enter email address" required>
                    </div>
                    <div>
                        <label for="studentPhone" class="block text-sm font-medium text-gray-700 mb-1">Phone Number</label>
                        <input type="tel" id="studentPhone" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary focus:border-primary block w-full p-2.5" placeholder="Enter phone number">
                    </div>
                    <div>
                        <label for="dateOfBirth" class="block text-sm font-medium text-gray-700 mb-1">Date of Birth</label>
                        <input type="date" id="dateOfBirth" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary focus:border-primary block w-full p-2.5" required>
                    </div>
                    <div>
                        <label for="gender" class="block text-sm font-medium text-gray-700 mb-1">Gender</label>
                        <div class="relative">
                            <div class="flex items-center justify-between bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg w-full p-2.5">
                                <span>Select gender</span>
                                <div class="w-4 h-4 flex items-center justify-center">
                                    <i class="ri-arrow-down-s-line"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <label for="class" class="block text-sm font-medium text-gray-700 mb-1">Class</label>
                        <div class="relative">
                            <div class="flex items-center justify-between bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg w-full p-2.5">
                                <span>Select class</span>
                                <div class="w-4 h-4 flex items-center justify-center">
                                    <i class="ri-arrow-down-s-line"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <label for="enrollmentDate" class="block text-sm font-medium text-gray-700 mb-1">Enrollment Date</label>
                        <input type="date" id="enrollmentDate" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary focus:border-primary block w-full p-2.5" required>
                    </div>
                </div>

                <div class="mb-6">
                    <label for="address" class="block text-sm font-medium text-gray-700 mb-1">Address</label>
                    <input type="text" id="address" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary focus:border-primary block w-full p-2.5" placeholder="Enter full address">
                </div>

                <div class="mb-6">
                    <h3 class="text-md font-medium text-gray-900 mb-3">Parent/Guardian Information</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="parentName1" class="block text-sm font-medium text-gray-700 mb-1">Parent/Guardian 1 Name</label>
                            <input type="text" id="parentName1" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary focus:border-primary block w-full p-2.5" placeholder="Enter name">
                        </div>
                        <div>
                            <label for="relationship1" class="block text-sm font-medium text-gray-700 mb-1">Relationship</label>
                            <div class="relative">
                                <div class="flex items-center justify-between bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg w-full p-2.5">
                                    <span>Select relationship</span>
                                    <div class="w-4 h-4 flex items-center justify-center">
                                        <i class="ri-arrow-down-s-line"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div>
                            <label for="parentEmail1" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                            <input type="email" id="parentEmail1" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary focus:border-primary block w-full p-2.5" placeholder="Enter email address">
                        </div>
                        <div>
                            <label for="parentPhone1" class="block text-sm font-medium text-gray-700 mb-1">Phone Number</label>
                            <input type="tel" id="parentPhone1" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary focus:border-primary block w-full p-2.5" placeholder="Enter phone number">
                        </div>
                    </div>
                </div>

                <div class="flex justify-end space-x-3">
                    <button type="button" id="cancelAddStudent" class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200 !rounded-button whitespace-nowrap">Cancel</button>
                    <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-primary rounded-lg hover:bg-primary/90 !rounded-button whitespace-nowrap">Add Student</button>
                </div>
            </form>
        </div>
    </div>

    <script>
            document.addEventListener('DOMContentLoaded', () => {
            try {
                const chartEl = document.getElementById('performance-distribution-chart');
                if (!chartEl) {
                    console.error('Chart element not found');
                    return;
                }
                
                if (typeof echarts === 'undefined') {
                    console.error('ECharts library not loaded');
                    return;
                }

                const performanceChart = echarts.init(chartEl);

                const loadChart = async (classFilter = '') => {
                    try {
                        // Clear any existing chart data first
                        performanceChart.clear();
                        
                        const response = await fetch(`api/chart/performance?class=${encodeURIComponent(classFilter)}`);
                        if (!response.ok) throw new Error('Network response was not ok');
                        const data = await response.json();
                        const totalStudentsEl = document.getElementById('total-students'); 
                        const averagePerformanceEl = document.getElementById('average-performance'); 
                        const attendanceRateEl = document.getElementById('attendance-rate'); 
                        const isAtRiskEl = document.getElementById('at-risk-students'); 

                         totalStudentsEl.textContent = data.totalStudent; // Update the HTML element 
                         averagePerformanceEl.textContent = data.studentAvgPer;
                          attendanceRateEl.textContent = data.average_attendance_rate
                          isAtRiskEl.textContent = data.is_at_risk
                        const option = {
                            tooltip: {
                                trigger: 'axis',
                                backgroundColor: 'rgba(255,255,255,0.8)',
                                borderColor: '#E5E7EB',
                                textStyle: { color: '#1F2937' }
                            },
                            legend: {
                                data: data.series.map(s => s.name),
                                bottom: 0,
                                textStyle: { color: '#1F2937' }
                            },
                            grid: {
                                left: '3%', right: '3%', top: '3%', bottom: '15%',
                                containLabel: true
                            },
                            xAxis: {
                                type: 'category',
                                data: data.xAxis,
                                axisLine: { lineStyle: { color: '#E5E7EB' } },
                                axisLabel: { color: '#6B7280' }
                            },
                            yAxis: {
                                type: 'value',
                                name: 'Number of Students',
                                axisLine: { show: false },
                                axisLabel: { color: '#6B7280' },
                                splitLine: { lineStyle: { color: '#F3F4F6' } }
                            },
                            series: data.series.map(s => ({
                                name: s.name,
                                type: 'bar',
                                data: s.data,
                                itemStyle: {
                                    color: s.color,
                                    borderRadius: [4, 4, 0, 0]
                                },
                                emphasis: {
                                    itemStyle: { opacity: 0.8 }
                                },
                                // Animation configuration
                                animation: true,
                                animationDuration: 1000,
                                animationEasing: 'cubicOut'
                            }))
                        };
                        
                        // Apply new options
                        performanceChart.setOption(option, true); // true means not to merge with previous options
                        
                    } catch (error) {
                        console.error('Error loading chart data:', error);
                        // Optionally show an error state on the chart
                        performanceChart.showLoading('error', {
                            text: 'Failed to load data',
                            color: '#ff4d4f',
                            textColor: '#ff4d4f',
                            maskColor: 'rgba(255, 255, 255, 0.8)'
                        });
                    }
                };

                // Initial load
                loadChart();

                // Listen for Alpine.js dropdown selections
                document.addEventListener('class-selected', (e) => {
                    loadChart(e.detail.className);
                });

                // Resize on window resize
                window.addEventListener('resize', () => performanceChart.resize());
                
            } catch (error) {
                console.error('Error initializing chart:', error);
            }
});
    </script>
        
        <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>


    </body>
</html>
