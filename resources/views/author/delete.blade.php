<div class="modal fade" id="delete-product-{{ $author->id }}">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title h2 fw-light">Delete Author</h3>
            </div>
            <div class="modal-body">
              <h4>Delete Author</h4>
              <p>Are you sure you want to delete 
                <strong>{{ $author->name}}</strong> ?
              </p>
            </div>
            <div class="modal-footer border-0">
                <form action="{{ route('author.destroy', $author->id) }}" method="post" class="w-100">
                    @csrf
                    @method('DELETE')
                    <div class="d-flex gap-3">
                        <button type="button" class="btn btn-outline-secondary flex-fill w-100" data-bs-dismiss="modal">
                            Cancel
                        </button>
                        <button type="submit" class="btn btn-danger flex-fill w-100">
                            Delete
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
