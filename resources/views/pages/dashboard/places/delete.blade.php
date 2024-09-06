    <!-- Add Modal -->
    <div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="exampleModalLabel">@lang('site.delete-place')</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('places.destroy' , 'test') }}" method="post">
                    @csrf
                    @method('delete')
                    <div class="modal-body ">
                        <div class="row-auto">
                            <div class="form-group">
                                <label for="id">@lang('site.do-confirm-delete')</label>
                                <input type="hidden" name="id" class="form-control" id="id"><br>
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
