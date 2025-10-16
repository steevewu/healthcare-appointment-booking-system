<form action="{{ route('logout') }}" method="post">
    @csrf
    <button type="submit">log out</button>
</form>