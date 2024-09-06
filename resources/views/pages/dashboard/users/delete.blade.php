    <!-- Delete Modal -->
    <div class="modal fade" id="delete{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="exampleModalLabel">@lang('dashboard.delete_user')</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('users.destroy' , $user->id ) }}" method="post">
                    @csrf
                    @method('delete')
                    <div class="modal-body ">
                        <div class="row-auto">
                            <div class="form-group">
                                <label for="id">@lang('site.do-confirm-delete')</label>
                                <input type="text" name="id" value="{{ $user->name }}" readonly class="form-control" id="id"><br>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('site.close')</button>
                        <button type="submit" class="btn btn-danger">@lang('site.delete')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>