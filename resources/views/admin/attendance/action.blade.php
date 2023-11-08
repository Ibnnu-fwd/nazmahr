<div class="flex gap-x-2">
    <a type="button" href="{{ route('admin.attendance.edit', $data->id) }}"
        class="text-dark bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-md text-sm px-2.5 py-2.5 mb-2">
        <svg viewBox="0 0 24 24" class="w-3 h-3" fill="none" xmlns="http://www.w3.org/2000/svg">
            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
            <g id="SVGRepo_iconCarrier">
                <path d="M13 21H21" stroke="#323232" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                </path>
                <path
                    d="M20.0651 7.39423L7.09967 20.4114C6.72438 20.7882 6.21446 21 5.68265 21H4.00383C3.44943 21 3 20.5466 3 19.9922V18.2987C3 17.7696 3.20962 17.2621 3.58297 16.8873L16.5517 3.86681C19.5632 1.34721 22.5747 4.87462 20.0651 7.39423Z"
                    stroke="#323232" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                <path d="M15.3096 5.30981L18.7273 8.72755" stroke="#323232" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round"></path>
                <path opacity="0.1"
                    d="M18.556 8.90942L7.09967 20.4114C6.72438 20.7882 6.21446 21 5.68265 21H4.00383C3.44943 21 3 20.5466 3 19.9922V18.2987C3 17.7696 3.20962 17.2621 3.58297 16.8873L15.0647 5.35974C15.0742 5.4062 15.0969 5.45049 15.1329 5.48653L18.5506 8.90426C18.5524 8.90601 18.5542 8.90773 18.556 8.90942Z"
                    fill="#323232"></path>
            </g>
        </svg>
    </a>
    <a type="button" onclick="btnDelete({{ $data->id }})"
        class="text-dark bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-md text-sm px-2.5 py-2.5 mb-2">
        <svg viewBox="0 0 24 24" class="w-3 h-3" fill="none" xmlns="http://www.w3.org/2000/svg">
            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
            <g id="SVGRepo_iconCarrier">
                <path opacity="0.1"
                    d="M21 12C21 16.9706 16.9706 21 12 21C7.02944 21 3 16.9706 3 12C3 7.02944 7.02944 3 12 3C16.9706 3 21 7.02944 21 12Z"
                    fill="#323232"></path>
                <path
                    d="M21 12C21 16.9706 16.9706 21 12 21C7.02944 21 3 16.9706 3 12C3 7.02944 7.02944 3 12 3C16.9706 3 21 7.02944 21 12Z"
                    stroke="#323232" stroke-width="2"></path>
                <path d="M9 9L15 15" stroke="#323232" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                </path>
                <path d="M15 9L9 15" stroke="#323232" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                </path>
            </g>
        </svg>
    </a>
</div>
