    <!-- Edit Modal -->
    <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="exampleModalLabel">@lang('site.edit-place')</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('places.update' , 'test' ) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="row-auto">
                            <div class="form-group">
                                <label for="name_ar">@lang('site.ar.name')</label>
                                <input type="hidden"  name="id" class="form-control" id="id">
                                <input type="text" name="name_ar" class="form-control" id="name_ar"><br>
                            </div>
                            <div class="form-group">
                                <label for="name_en">@lang('site.en.name')</label>
                                <input type="text" name="name_en" class="form-control" id="name_en">
                            </div>
                        </div>
                        <input type="file" name="file" id="">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('site.close')</button>
                        <button type="submit" class="btn btn-primary">@lang('site.confirm')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
