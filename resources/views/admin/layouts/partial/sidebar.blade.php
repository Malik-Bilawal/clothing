   <!-- Sidebar -->
   <div class="bg-gray-900 text-white w-64 h-screen p-0 flex flex-col shadow-lg">
       <div class="p-4 border-b border-gray-700">
           <h1 class="text-xl font-bold flex items-center">
               <i class="fas fa-store mr-2 text-red-500"></i>
               Home Collection 
           </h1>
       </div>

       <nav class="flex-1 p-4">
           <ul class="space-y-2">
               <li>
                   <a href=""
                       class="flex items-center p-2 rounded-lg 
       {{ request()->routeIs('admin.dashboard') ? 'bg-red-600 text-white' : 'hover:bg-gray-700' }}">
                       <i class="fas fa-tachometer-alt mr-3"></i>
                       Dashboard
                   </a>
               </li>



               <li>
                   <a href="{{ route('admin.categories') }}"
                       class="flex items-center p-2 rounded-lg 
       {{ request()->routeIs('admin.categories.*') ? 'bg-red-600 text-white' : 'hover:bg-gray-700' }}">
                       <i class="fas fa-sliders-h mr-3"></i>
                       Categories
                   </a>
               </li>

               <li>
                   <a href="{{ route('admin.users') }}"
                       class="flex items-center p-2 rounded-lg 
       {{ request()->routeIs('admin.users*') ? 'bg-red-600 text-white' : 'hover:bg-gray-700' }}">
                       <i class="fas fa-sliders-h mr-3"></i>
                       Users Management
                   </a>
               </li>

               
               <li>
                   <a href="{{ route('admin.orders.index') }}"
                       class="flex items-center p-2 rounded-lg 
       {{ request()->routeIs('admin.orders*') ? 'bg-red-600 text-white' : 'hover:bg-gray-700' }}">
                       <i class="fas fa-sliders-h mr-3"></i>
                       Orders Management
                   </a>
               </li>

               
               <li>
                   <a href="{{ route('admin.products') }}"
                       class="flex items-center p-2 rounded-lg 
       {{ request()->routeIs('admin.products*') ? 'bg-red-600 text-white' : 'hover:bg-gray-700' }}">
                       <i class="fas fa-sliders-h mr-3"></i>
                       Product
                   </a>
               </li>

               <li>
                   <a href="{{ route('admin.sliders') }}"
                       class="flex items-center p-2 rounded-lg 
       {{ request()->routeIs('admin.sliders*') ? 'bg-red-600 text-white' : 'hover:bg-gray-700' }}">
                       <i class="fas fa-sliders-h mr-3"></i>
                       Sliders
                   </a>
               </li>

               <li>
                   <a href="{{ route('admin.sales') }}"
                       class="flex items-center p-2 rounded-lg 
       {{ request()->routeIs('admin.sales*') ? 'bg-red-600 text-white' : 'hover:bg-gray-700' }}">
                       <i class="fas fa-sliders-h mr-3"></i>
                       Sale Management
                   </a>
               </li>

               <li>
                   <a href="{{ route('admin.contact') }}"
                       class="flex items-center p-2 rounded-lg 
       {{ request()->routeIs('admin.cntact*') ? 'bg-red-600 text-white' : 'hover:bg-gray-700' }}">
                       <i class="fas fa-sliders-h mr-3"></i>
                       Contact Messages
                   </a>
               </li>



           </ul>
       </nav>

       <div class="p-4 border-t border-gray-700">
           <div class="flex items-center">
               <div class="w-10 h-10 rounded-full bg-gray-600 flex items-center justify-center">
                   <i class="fas fa-user"></i>
               </div>
               <div class="ml-3">
                   <p class="text-sm font-medium">Admin User</p>
                   <p class="text-xs text-gray-400">admin@grocerystore.com</p>
               </div>
           </div>
       </div>
   </div>

