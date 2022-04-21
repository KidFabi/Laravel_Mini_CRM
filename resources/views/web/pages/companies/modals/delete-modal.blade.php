<div class="modal fade" id="deleteCompany{{ $company->id }}" tabindex="-1" role="dialog" aria-labelledby="DeleteCompany" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">{{ __('Delete the company') }}</h5>
            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <p>{{ __('Are you sure you want to delete the company? This action cannot be reverted.') }}</p>
        </div>
        <div class="modal-footer">
            <form action="{{ route('companies.destroy', $company->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">{{ __('Delete') }}</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Close') }}</button>
            </form>
        </div>
        </div>
    </div>
</div>