@auth
    @if(Auth::user()->IsAdmin)
        <a href="{{ route('IsAdmin.dashboard_IsAdmin', ['id' => Auth::id()]) }}" class="btn btn-outline-dark">
            Retour IsAdmin
        </a>
    @endif
@endauth<div>
    <!-- I have not failed. I've just found 10,000 ways that won't work. - Thomas Edison -->
</div>