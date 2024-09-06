    <!-- Add Modal -->
    <div class="modal fade" id="addHotel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="exampleModalLabel">@lang('dashboard.add-hotel')</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('hotel.store') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="hotel_ar">@lang('dashboard.ar.hotel')</label>
                                    <input type="text" name="name[ar]" class="form-control" id="hotel_ar"><br>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="hotel_en">@lang('dashboard.en.hotel')</label>
                                    <input type="text" name="name[en]" class="form-control" id="hotel_en">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="location_ar">@lang('dashboard.ar.address')</label>
                                    <input type="text" name="location[ar]" class="form-control" id="location_ar"><br>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="loaction_en">@lang('dashboard.en.address')</label>
                                    <input type="text" name="location[en]" class="form-control" id="loaction_en">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="contact_number">@lang('dashboard.contact_number')</label>
                                    <input type="text" name="contact_number" class="form-control" id="contact_number"><br>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="company">@lang('dashboard.company')</label>
                                    <select name="company_id" id="company" class="form-control">
                                        <option value="{{ null }}" selected disabled>...</option>
                                        @foreach ($companies as $company)
                                            <option value="{{ $company->id }}">{{ $company->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
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
