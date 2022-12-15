{{-- <header class="mt-2 position-fixed w-100 text-white">
    <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
        <img src="{{ asset(getSettingContents()->logo) }}" alt="logo" width="60" />
        {{-- get uuid from seesion (used for show user data in registration popup) --}}
        @php
            //use Illuminate\Support\Facades\Session;
           // $userUuid = Session::get('userUuid');
        @endphp
        {{-- <a class="position-absolute openBtn" href="javascript:void(0)" data-userUuid="{{ $userUuid }}"  data-bs-toggle="modal" data-bs-target="#exampleModal">
            <img src="{{ asset('images/register-modal-icon.svg') }}" />
        </a> --}}
    {{-- </div>
</header> --}} 

{{-- @push('custom-js')
    <script type="text/javascript" src="{{ asset('js/frontend/auth/registration_modal.js') }}"></script>
@endpush --}}