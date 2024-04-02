<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Users</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a wire:navigate href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">View All Users</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="row mb-2">
            <div class="col-md-1 col-sm-12">
                <select wire:model.live="perPage" class="form-control form-control-sm form-control-border">
                    <option value="5">5</option>
                    <option value="10">10</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                </select>
            </div>
            <div class="col-md-9 col-sm-12">
                        <input type="search" wire:model.live="search" class="form-control form-control-sm"
                            placeholder="Search...">
            </div>
            <div class="col-md-2 col-sm-12">
                <div class="d-grid">
                    <a wire:navigate href="{{ route('admin.user.create') }}" class="btn btn-success btn-sm btn-flat btn-block">
                        <i class="ri-add-line"></i> Create
                    </a>
                </div>
            </div>
        </div>

        <!-- Default box -->
        <div class="card">
            <div class="card-body">
                <table id="data" class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr wire:key="{{ $user->id }}">
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    <div class="icheck-success d-inline">
                                        <input type="checkbox" wire:change="toggleUserStatus({{ $user->id }})"
                                            id="is_active_{{ $user->id }}" {{ $user->is_active ? 'checked' : '' }}>
                                        <label for="is_active_{{ $user->id }}"></label>
                                    </div>
                                </td>
                                <td class="text-right">
                                    <a wire:navigate href="{{ route('admin.user.show', $user->id) }}" class="btn btn-sm btn-flat btn-info">
                                        Show
                                    </a>
                                    <a wire:navigate href="{{ route('admin.user.edit', $user->id) }}" class="btn btn-sm btn-flat btn-info">
                                        Edit
                                    </a>
                                    <button wire:click="confirmDelete({{ $user->id }})"
                                        class="btn btn-sm btn-flat btn-danger" data-toggle="modal"
                                        data-target="#deleteModal">
                                        Delete
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                {{ $users->links() }}
            </div>
            <!-- /.card-footer-->
        </div>
        <!-- /.card -->

    </section>
    <!-- /.content -->
    @include('livewire.admin.user.delete')
</div>
<!-- /.content-wrapper -->

@push('styles')
    <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
@endpush

@push('scripts')
@endpush
