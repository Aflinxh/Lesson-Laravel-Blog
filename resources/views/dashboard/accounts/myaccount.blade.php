@extends('dashboard.layouts.main')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md nowrap align-items-center pt-3 pb-3 mb-3 border-bottom">
        <h2>My Account</h2>
    </div>

    <div class="row">
        <div class="col-md-5 mb-4 mb-md-0">
            <form action="{{ route('dashboard.myaccount.update') }}" method="POST">
                @method('put')
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $user->name) }}" required autofocus>
                    @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control @error('username') is-invalid @enderror" id="username" name="username" value="{{ old('username', $user->username) }}" required>
                    @error('username')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $user->email) }}" required>
                    @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                
                <button type="submit" class="btn btn-warning">Update</button>
            </form>
        </div>

        <div class="col-md-2"></div>

        <div class="col-md-4">
            <div class="btn-group mb-3" role="group" aria-label="Basic radio toggle button group">
                <input type="radio" class="btn-check" name="btnradio" id="changePassword" autocomplete="off">
                <label for="changePassword" class="btn btn-outline-danger">Change Password</label>

                <input type="radio" class="btn-check" name="btnradio" id="eraseAllData" autocomplete="off">
                <label for="eraseAllData" class="btn btn-outline-danger">Erase All Data</label>

                <input type="radio" class="btn-check" name="btnradio" id="deleteAccount" autocomplete="off">
                <label for="deleteAccount" class="btn btn-outline-danger">Delete Account</label>
            </div>

            <form method="POST" action="{{ route('dashboard.myaccount.password') }}" id="passwordForm" style="display: none;">
                @csrf
                <div id="methodForm"></div>
                <div class="mb-3">
                    <label for="password1" class="form-label" id="password1Lbl">Old Password</label>
                    <input type="password" name="password1" class="form-control bg-transparent @error('password1') is-invalid @enderror" id="password1" required autofocus>
                    @error('password1')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="password2" class="form-label" id="password2Lbl">New Password</label>
                    <input type="password" name="password2" class="form-control bg-transparent @error('password2') is-invalid @enderror" id="password2" required autofocus>
                    @error('password2')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                    <div id="caution" class="form-text text-danger"></div>
                </div>
                <button type="submit" class="btn btn-danger" id="passwordBtn" onclick="return confirm('Are you sure?')">Change Password</button>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        let changePassword = document.getElementById('changePassword');
        let eraseAllData = document.getElementById('eraseAllData');
        let deleteAccount = document.getElementById('deleteAccount');
        let passwordForm = document.getElementById('passwordForm');
        let password1Lbl = document.getElementById('password1Lbl');
        let password2Lbl = document.getElementById('password2Lbl');
        let passwordBtn = document.getElementById('passwordBtn');
        let password1 = document.getElementById('password1');
        let password2 = document.getElementById('password2');
        let methodForm = document.getElementById('methodForm');
        let caution = document.getElementById('caution');

        changePassword.addEventListener('click', function() {
            passwordForm.style.display = 'block';
            passwordForm.action = "{{ route('dashboard.myaccount.password') }}";
            passwordBtn.innerHTML = 'Change Password';
            password1Lbl.innerHTML = 'Old Password';
            password2Lbl.innerHTML = 'New Password';
            methodForm.innerHTML = '@method("put")';
            password1.value = '';
            password2.value = '';
            caution.innerHTML = '<strong>Please take caution!</strong> Remember your new password!';
        });

        eraseAllData.addEventListener('click', function() {
            passwordForm.style.display = 'block';
            passwordForm.action = "{{ route('dashboard.myaccount.erase') }}";
            passwordBtn.innerHTML = 'Erase All Data';
            password1Lbl.innerHTML = 'Password';
            password2Lbl.innerHTML = 'Confirm Password';
            methodForm.innerHTML = '@method("delete")';
            password1.value = '';
            password2.value = '';
            caution.innerHTML = '<strong>Please take caution!</strong> You will delete your data <strong>forever</strong> and will <strong>never</strong> be able to recover it.'
        });

        deleteAccount.addEventListener('click', function() {
            passwordForm.style.display = 'block';
            passwordForm.action = "{{ route('dashboard.myaccount.destroy') }}";
            passwordBtn.innerHTML = 'Delete Account';
            password1Lbl.innerHTML = 'Password';
            password2Lbl.innerHTML = 'Confirm Password';
            methodForm.innerHTML = '@method("delete")';
            password1.value = '';
            password2.value = '';
            caution.innerHTML = '<strong>Please take caution!</strong> You will delete your account <strong>forever</strong> and will <strong>never</strong> be able to recover it. Erase all data first!'
        });
    </script>
@endpush