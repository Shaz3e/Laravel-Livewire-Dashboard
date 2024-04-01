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
                        <li class="breadcrumb-item"><a href="#">Users</a></li>
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
                <form class="app-search">
                    <div class="position-relative">
                        <input type="search" wire:model.live="search" class="form-control form-control-sm"
                            placeholder="Search Users">
                        <span class="ri-search-line"></span>
                    </div>
                </form>
            </div>
            <div class="col-md-2 col-sm-12">
                <div class="d-grid">
                    <button wire:click="create" type="button" class="btn btn-success btn-sm btn-flat btn-block"
                        data-toggle="modal" data-target="#createModal">
                        Create
                    </button>
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
                                    <button wire:click="edit({{ $user->id }})" class="btn btn-sm btn-flat btn-info"
                                        data-toggle="modal" data-target="#updateModal">
                                        Edit
                                    </button>
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

    @include('livewire.admin.user.create')
    @include('livewire.admin.user.edit')
    @include('livewire.admin.user.delete')
</div>
<!-- /.content-wrapper -->

@push('styles')
    <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
@endpush

@push('scripts')
@endpush
