<div class="modal fade" id="deleteEmployee{{ $employee->id }}" tabindex="-1" role="dialog" aria-labelledby="DeleteEmployee" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">{{ __('Delete the employee') }}</h5>
            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <p>{{ __('Are you sure you want to delete the employee? This action cannot be reverted.') }}</p>
        </div>
        <div class="modal-footer">
            <form action="{{ route('employees.destroy', $employee->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">{{ __('Delete') }}</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Close') }}</button>
            </form>
        </div>
        </div>
    </div>
</div>