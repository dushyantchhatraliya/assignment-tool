<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assignments-Tool</title>
    <script src="https://cdn.tailwindcss.com/3.4.16"></script>
    <script>tailwind.config={theme:{extend:{colors:{primary:'#4F46E5',secondary:'#10B981'},borderRadius:{'none':'0px','sm':'4px',DEFAULT:'8px','md':'12px','lg':'16px','xl':'20px','2xl':'24px','3xl':'32px','full':'9999px','button':'8px'}}}}</script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.5.0/fonts/remixicon.css" rel="stylesheet">
    <style>
        :where([class^="ri-"])::before { content: "\f3c2"; }
        body {
            font-family: 'Inter', sans-serif;
        }
        .toggle-checkbox:checked {
            right: 0;
            border-color: #4F46E5;
        }
        .toggle-checkbox:checked + .toggle-label {
            background-color: #4F46E5;
        }
        input[type="number"]::-webkit-inner-spin-button,
        input[type="number"]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
        .custom-checkbox {
            appearance: none;
            -webkit-appearance: none;
            width: 1.25rem;
            height: 1.25rem;
            border: 2px solid #d1d5db;
            border-radius: 4px;
            outline: none;
            cursor: pointer;
            position: relative;
            transition: all 0.2s;
        }
        .custom-checkbox:checked {
            background-color: #4F46E5;
            border-color: #4F46E5;
        }
        .custom-checkbox:checked::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 0.5rem;
            height: 0.5rem;
            border-radius: 1px;
            background-color: white;
        }
        .login-bg {
            background-image: url('https://readdy.ai/api/search-image?query=A%20modern%2C%20clean%20educational%20environment%20with%20soft%20blue%20and%20purple%20gradient%20background.%20Abstract%20geometric%20shapes%20suggesting%20growth%20and%20learning.%20Minimalist%20design%20with%20ample%20white%20space%20for%20text.%20Subtle%20patterns%20of%20books%2C%20graduation%20caps%2C%20and%20academic%20symbols%20in%20the%20background.&width=1920&height=1080&seq=login-bg&orientation=landscape');
            background-size: cover;
            background-position: center;
        }
    </style>
</head>
<body class="bg-gray-50 min-h-screen">
    <div class="min-h-screen flex flex-col">
        <!-- Login Section -->
        <div id="login-section" class="min-h-screen login-bg flex items-center justify-center p-4">
            <div class="bg-white rounded-xl shadow-xl w-full max-w-md p-8">
                <div class="text-center mb-8">
                    <h1 class="font-['Pacifico'] text-3xl text-primary">Assignments-Tool</h1>
                </div>
                
                <!-- Login Tabs -->
                <div class="flex border-b border-gray-200 mb-6">
                    <button id="email-tab" class="flex-1 py-3 text-primary border-b-2 border-primary font-medium">Register User</button>
                    </div>
                
                <!-- Email Login Form -->
                <form id="email-login-form" class="space-y-4">
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">User Name</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <div class="w-5 h-5 flex items-center justify-center text-gray-400">
                                    <i class="ri-user-line"></i>
                                </div>
                            </div>
                            <input type="text" id="name" class="pl-10 w-full h-12 border border-gray-300 rounded focus:ring-2 focus:ring-primary focus:border-primary text-sm" placeholder="Dushyant">
                        </div>
                    </div>
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <div class="w-5 h-5 flex items-center justify-center text-gray-400">
                                    <i class="ri-mail-line"></i>
                                </div>
                            </div>
                            <input type="email" id="email" class="pl-10 w-full h-12 border border-gray-300 rounded focus:ring-2 focus:ring-primary focus:border-primary text-sm" placeholder="your@email.com">
                        </div>
                    </div>
                    
                    <div>
                        <div class="flex justify-between mb-1">
                            <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                            <a href="#" class="text-sm text-primary hover:text-primary/80">Forgot password?</a>
                        </div>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <div class="w-5 h-5 flex items-center justify-center text-gray-400">
                                    <i class="ri-lock-line"></i>
                                </div>
                            </div>
                            <input type="password" id="password" class="pl-10 pr-10 w-full h-12 border border-gray-300 rounded focus:ring-2 focus:ring-primary focus:border-primary text-sm" placeholder="••••••••">
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                <button type="button" id="toggle-password" class="w-5 h-5 flex items-center justify-center text-gray-400 hover:text-gray-600">
                                    <i class="ri-eye-line"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    
                    <div id="register-message" class="mt-4 text-sm"></div>
                    
                    <div class="flex items-center">
                        <input type="checkbox" id="remember-me" class="custom-checkbox">
                        <label for="remember-me" class="ml-2 block text-sm text-gray-700">Remember me</label>
                    </div>
                    
                    <div>
                        <button type="submit" class="w-full bg-primary text-white py-3 rounded-button font-medium hover:bg-primary/90 transition duration-200 whitespace-nowrap">Sign In</button>
                    </div>
                </form>
            
                <div class="mt-6 text-center">
                    <p class="text-gray-600">have an account? <a href="{{ url('/') }}" class="text-primary hover:underline">Sign In Account</a></p>
                </div>
                
            </div>
        </div>
        
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/echarts/5.5.0/echarts.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Toggle password visibility
            const togglePassword = document.getElementById('toggle-password');
            const password = document.getElementById('password');
            
            if (togglePassword && password) {
                togglePassword.addEventListener('click', function() {
                    const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
                    password.setAttribute('type', type);
                    togglePassword.innerHTML = type === 'password' ? '<i class="ri-eye-line"></i>' : '<i class="ri-eye-off-line"></i>';
                });
            }
            
            // Login tabs
            const emailTab = document.getElementById('email-tab');
            const googleTab = document.getElementById('google-tab');
            const emailForm = document.getElementById('email-login-form');
            const googleForm = document.getElementById('google-login-form');
            
            if (emailTab && googleTab && emailForm && googleForm) {
                emailTab.addEventListener('click', function() {
                    emailTab.classList.add('text-primary', 'border-b-2', 'border-primary');
                    googleTab.classList.remove('text-primary', 'border-b-2', 'border-primary');
                    googleTab.classList.add('text-gray-500');
                    emailForm.classList.remove('hidden');
                    googleForm.classList.add('hidden');
                });
                
                googleTab.addEventListener('click', function() {
                    googleTab.classList.add('text-primary', 'border-b-2', 'border-primary');
                    emailTab.classList.remove('text-primary', 'border-b-2', 'border-primary');
                    emailTab.classList.add('text-gray-500');
                    googleForm.classList.remove('hidden');
                    emailForm.classList.add('hidden');
                });
            }
            
            // Role selection
            const roleBtns = document.querySelectorAll('.role-btn');
            
            roleBtns.forEach(btn => {
                btn.addEventListener('click', function() {
                    roleBtns.forEach(b => b.classList.remove('border-primary', 'bg-primary/5'));
                    this.classList.add('border-primary', 'bg-primary/5');
                });
            });
            
            // Login form submission
            const loginForm = document.getElementById('email-login-form');
            const loginSection = document.getElementById('login-section');
            const dashboardSection = document.getElementById('dashboard-section');
            
            if (loginForm && loginSection && dashboardSection) {
                loginForm.addEventListener('submit', function(e) {
                    e.preventDefault();
                    loginSection.classList.add('hidden');
                    dashboardSection.classList.remove('hidden');
                });
            }
            
            // Mobile menu toggle
            const mobileMenuButton = document.getElementById('mobile-menu-button');
            const mobileMenu = document.getElementById('mobile-menu');
            
            if (mobileMenuButton && mobileMenu) {
                mobileMenuButton.addEventListener('click', function() {
                    mobileMenu.classList.toggle('hidden');
                });
            }
            
            // Role dropdown toggle
            const roleSelector = document.getElementById('role-selector');
            const roleDropdown = document.getElementById('role-dropdown');
            
            if (roleSelector && roleDropdown) {
                roleSelector.addEventListener('click', function() {
                    roleDropdown.classList.toggle('hidden');
                });
                
                // Close dropdown when clicking outside
                document.addEventListener('click', function(e) {
                    if (!roleSelector.contains(e.target) && !roleDropdown.contains(e.target)) {
                        roleDropdown.classList.add('hidden');
                    }
                });
            }
            
            // AI Assistant modal
            const aiAssistantBtn = document.getElementById('ai-assistant-btn');
            const aiAssistantModal = document.getElementById('ai-assistant-modal');
            const closeAiModal = document.getElementById('close-ai-modal');
            
            if (aiAssistantBtn && aiAssistantModal && closeAiModal) {
                aiAssistantBtn.addEventListener('click', function() {
                    aiAssistantModal.classList.remove('hidden');
                });
                
                closeAiModal.addEventListener('click', function() {
                    aiAssistantModal.classList.add('hidden');
                });
                
                // Close modal when clicking outside
                aiAssistantModal.addEventListener('click', function(e) {
                    if (e.target === aiAssistantModal) {
                        aiAssistantModal.classList.add('hidden');
                    }
                });
            }
            
            // Initialize performance chart
            const performanceChart = document.getElementById('performance-chart');
            
            if (performanceChart) {
                const chart = echarts.init(performanceChart);
                
                const option = {
                    animation: false,
                    tooltip: {
                        trigger: 'axis',
                        backgroundColor: 'rgba(255, 255, 255, 0.9)',
                        borderColor: '#e2e8f0',
                        textStyle: {
                            color: '#1f2937'
                        }
                    },
                    legend: {
                        data: ['Math', 'Science', 'Reading', 'Social Studies'],
                        bottom: 0,
                        textStyle: {
                            color: '#1f2937'
                        }
                    },
                    grid: {
                        left: '3%',
                        right: '4%',
                        bottom: '15%',
                        top: '3%',
                        containLabel: true
                    },
                    xAxis: {
                        type: 'category',
                        boundaryGap: false,
                        data: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep'],
                        axisLine: {
                            lineStyle: {
                                color: '#e2e8f0'
                            }
                        },
                        axisLabel: {
                            color: '#1f2937'
                        }
                    },
                    yAxis: {
                        type: 'value',
                        axisLine: {
                            show: false
                        },
                        axisLabel: {
                            color: '#1f2937'
                        },
                        splitLine: {
                            lineStyle: {
                                color: '#e2e8f0'
                            }
                        }
                    },
                    series: [
                        {
                            name: 'Math',
                            type: 'line',
                            stack: 'Total',
                            smooth: true,
                            lineStyle: {
                                width: 3
                            },
                            showSymbol: false,
                            areaStyle: {
                                opacity: 0.1,
                                color: new echarts.graphic.LinearGradient(0, 0, 0, 1, [
                                    { offset: 0, color: 'rgba(87, 181, 231, 0.2)' },
                                    { offset: 1, color: 'rgba(87, 181, 231, 0.0)' }
                                ])
                            },
                            emphasis: {
                                focus: 'series'
                            },
                            data: [78, 80, 82, 85, 82, 86, 88, 90, 92],
                            color: 'rgba(87, 181, 231, 1)'
                        },
                        {
                            name: 'Science',
                            type: 'line',
                            stack: 'Total',
                            smooth: true,
                            lineStyle: {
                                width: 3
                            },
                            showSymbol: false,
                            areaStyle: {
                                opacity: 0.1,
                                color: new echarts.graphic.LinearGradient(0, 0, 0, 1, [
                                    { offset: 0, color: 'rgba(141, 211, 199, 0.2)' },
                                    { offset: 1, color: 'rgba(141, 211, 199, 0.0)' }
                                ])
                            },
                            emphasis: {
                                focus: 'series'
                            },
                            data: [82, 84, 85, 86, 88, 86, 85, 87, 90],
                            color: 'rgba(141, 211, 199, 1)'
                        },
                        {
                            name: 'Reading',
                            type: 'line',
                            stack: 'Total',
                            smooth: true,
                            lineStyle: {
                                width: 3
                            },
                            showSymbol: false,
                            areaStyle: {
                                opacity: 0.1,
                                color: new echarts.graphic.LinearGradient(0, 0, 0, 1, [
                                    { offset: 0, color: 'rgba(251, 191, 114, 0.2)' },
                                    { offset: 1, color: 'rgba(251, 191, 114, 0.0)' }
                                ])
                            },
                            emphasis: {
                                focus: 'series'
                            },
                            data: [75, 76, 78, 80, 82, 84, 85, 86, 88],
                            color: 'rgba(251, 191, 114, 1)'
                        },
                        {
                            name: 'Social Studies',
                            type: 'line',
                            stack: 'Total',
                            smooth: true,
                            lineStyle: {
                                width: 3
                            },
                            showSymbol: false,
                            areaStyle: {
                                opacity: 0.1,
                                color: new echarts.graphic.LinearGradient(0, 0, 0, 1, [
                                    { offset: 0, color: 'rgba(252, 141, 98, 0.2)' },
                                    { offset: 1, color: 'rgba(252, 141, 98, 0.0)' }
                                ])
                            },
                            emphasis: {
                                focus: 'series'
                            },
                            data: [80, 82, 84, 83, 82, 85, 86, 88, 90],
                            color: 'rgba(252, 141, 98, 1)'
                        }
                    ]
                };
                
                chart.setOption(option);
                
                window.addEventListener('resize', function() {
                    chart.resize();
                });
            }
        });
    </script>

<script>
    document.getElementById('email-login-form').addEventListener('submit', async function (e) {
        e.preventDefault();
    
        const name = document.getElementById('name').value.trim();
        const email = document.getElementById('email').value.trim();
        const password = document.getElementById('password').value;
        const messageEl = document.getElementById('register-message');
        messageEl.textContent = '';
        messageEl.className = 'mt-4 text-sm';
    
        try {
            const response = await fetch('/api/register', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                },
                body: JSON.stringify({
                    name: name,
                    email: email,
                    password: password,
                })
            });
    
            const data = await response.json();
    
            if (response.ok) {
                messageEl.textContent = 'Registration successful! Redirecting...';
                messageEl.classList.add('text-green-600');
                setTimeout(() => {
                    window.location.href = '/dashboard'; // change to your redirect page
                }, 1000);
            } else {
                // Display validation errors
                messageEl.textContent = data.errors || 'Registration failed.';
                messageEl.classList.add('text-red-600');
            }
        } catch (error) {
            messageEl.textContent = 'Something went wrong.';
            messageEl.classList.add('text-red-600');
        }
    });
    </script>
    
</body>
</html>
