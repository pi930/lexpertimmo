@auth
    @if(Auth::user()->Admin)
        <a href="{{ route('Admin.dashboard_Admin', ['id' => Auth::id()]) }}" class="btn btn-outline-dark">
            Retour Admin
        </a>
    @endif
@endauth<div>
    <!-- I have not failed. I've just found 10,000 ways that won't work. - Thomas Edison -->
</div>
