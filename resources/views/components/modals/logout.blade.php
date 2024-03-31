<form action="{{ route('logout') }}" method="POST">
  @csrf
  <x-modals.confirm id="modal-logout" message="Are you sure to logout?"/>
</form>
