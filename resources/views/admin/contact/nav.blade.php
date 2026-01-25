<div class="mb-6 border-b border-gray-200 dark:border-gray-700">
    <ul class="flex flex-wrap -mb-px text-sm font-medium text-center text-gray-500 dark:text-gray-400">
        <li class="mr-2">
            <a href="{{ route('admin.contact.messages.index') }}" 
               class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300 {{ request()->routeIs('admin.contact.messages.*') ? 'text-blue-600 border-blue-600 dark:text-blue-500 dark:border-blue-500' : 'border-transparent' }}">
                Messages
            </a>
        </li>
        <li class="mr-2">
            <a href="{{ route('admin.contact.info.index') }}" 
               class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300 {{ request()->routeIs('admin.contact.info.*') ? 'text-blue-600 border-blue-600 dark:text-blue-500 dark:border-blue-500' : 'border-transparent' }}">
                Information
            </a>
        </li>
        <li class="mr-2">
            <a href="{{ route('admin.contact.settings.index') }}" 
               class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300 {{ request()->routeIs('admin.contact.settings.*') ? 'text-blue-600 border-blue-600 dark:text-blue-500 dark:border-blue-500' : 'border-transparent' }}">
                Settings
            </a>
        </li>
    </ul>
</div>
