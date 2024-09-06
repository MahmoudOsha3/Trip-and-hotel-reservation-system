    <!-- Add Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="exampleModalLabel">@lang('dashboard.add_user')</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('users.store') }}" method="post">
                    @csrf
                    <div class="modal-body ">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="name">@lang('site.ar.name')</label>
                                    <input type="text" name="name_ar" class="form-control" id="name"><br>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="name">@lang('site.en.name')</label>
                                    <input type="text" name="name_en" class="form-control" id="name"><br>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="email">@lang('site.email')</label>
                                    <input type="email" name="email" class="form-control" id="email">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="phone">@lang('site.phone')</label>
                                    <input type="tel" name="phone" class="form-control" id="phone">
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="form-group">
                                <label for="password">@lang('site.password')</label>
                                <input type="password" name="password" class="form-control" id="password">
                                <input type="checkbox"  id="visiable_password" onclick="VisiblePassword()">
                                <br>
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
