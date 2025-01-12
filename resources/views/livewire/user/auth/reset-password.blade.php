<div class="s3-container">
    <div class="s3-page">
        <div>
            <h2>Welcome to {{ config('app.name') }}</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed quis arcu ut dolor placerat tincidunt ut nec
                odio.</p>
        </div>
    </div>
    {{-- /.s3-page --}}

    <div class="s3-authbox">
        <div class="container">
            <div class="row m-2">
                <div class="col-12 text-center">
                    <h2>Change your password</h2>
                </div>
                {{-- /.col --}}
            </div>
            {{-- /.row --}}

            <form wire:submit="resetPassword">

                <div class="row mx-5">
                    <div class="col-12 mb-2">
                        <input type="password" wire:model.change="password" class="form-control" placeholder="password">
                        @error('password')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-12 mb-2">
                        <input type="password" wire:model.change="confirm_password" class="form-control"
                            placeholder="Confirm Password">
                        @error('confirm_password')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-12 mb-2">
                        <button type="submit" class="btn btn-primary">
                            Change Password
                        </button>
                    </div>

                    <div class="col-12 mb-">
                        <a wire:navigate href="{{ route('login') }}">Login</a>
                    </div>

                </div>

            </form>
        </div>
        {{-- /.container --}}
    </div>
    {{-- /.s3-authbox --}}
</div>
{{-- /.s3-container --}}


@push('styles')
@endpush


@push('scripts')
@endpush
