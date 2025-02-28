@php
$copyright = App\Models\SystemSetting::first()->copyright_text;
@endphp
<footer class="footer footer-static footer-light">
    <p class="clearfix mb-0">
        <span class="float-md-left d-block d-md-inline-block mt-25">
            COPYRIGHT &copy; {{ date('Y') }}
            <a class="ml-25" href="" target="_blank">
                {{ $copyright ? $copyright : 'Copyright text is null' }}
            </a>
            <span class="d-none d-sm-inline-block">  All rights Reserved</span>
        </span>
        <span class="float-md-right d-none d-md-block">
        </span>
    </p>
</footer>
