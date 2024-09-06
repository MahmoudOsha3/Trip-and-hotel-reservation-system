    <!-- Add Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="exampleModalLabel">@lang('dashboard.add_owner')</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('owners.store') }}" method="post">
                    @csrf
                    <div class="modal-body ">
                        <div class="row-auto">
                            <div class="form-group">
                                <label for="name">@lang('site.name')</label>
                                <input type="text" name="name" class="form-control" id="name"><br>
                            </div>
                            <div class="form-group">
                                <label for="email">@lang('site.email')</label>
                                <input type="email" name="email" class="form-control" id="email">
                            </div>
                        </div>
                        <div class="row-auto">
                            <div class="form-group">
                                <label for="phone">@lang('site.phone')</label>
                                <input type="tel" name="phone" class="form-control" id="phone"><br>
                            </div>
                            <div class="form-group">
                                <label for="password">@lang('site.password')</label>
                                <input type="password" name="password" class="form-control" id="password">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('site.close')</button>
                        <button type="submit" class="btn btn-primary">@lang('site.confirm')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
