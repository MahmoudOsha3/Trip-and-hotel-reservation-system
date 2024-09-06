    <!-- Add Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="exampleModalLabel">@lang('dashboard.add_room')</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('room.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="room_number">@lang('dashboard.number_room')</label>
                                    <input type="text" name="room_number" class="form-control" id="room_number"><br>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="room_type">@lang('dashboard.type_room')</label>
                                    <select name="room_type" id="room_type" class="form-control">
                                        <option value="{{ null }}" selected disabled>...</option>
                                        @foreach (\APP\Models\Room::ROOM_TYPES as $type )
                                            <option value="{{ $type }}">{{ $type }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="sub_description_ar">@lang('dashboard.ar.sub_description')</label>
                                    <input type="text" name="sub_description[ar]" class="form-control" id="sub_description_ar"><br>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="sub_description_en">@lang('dashboard.en.sub_description')</label>
                                    <input type="text" name="sub_description[en]" class="form-control" id="sub_description_en">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="description_ar">@lang('dashboard.ar.description')</label>
                                    <textarea name="description[ar]" id="description_ar" class="form-control" rows="5"></textarea>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="description_en">@lang('dashboard.en.description')</label>
                                    <textarea name="description[en]" id="description_ar" class="form-control" rows="5"></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="price">@lang('dashboard.price')</label>
                                    <input type="integer" name="price" class="form-control" id="price"><br>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="hotel">@lang('dashboard.hotel')</label>
                                    <select name="hotel_id" id="hotel" class="form-control">
                                        <option value="{{ null }}" selected disabled>...</option>
                                        <option value="{{ $hotel->id }}">{{ $hotel->name }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="files">@lang('dashboard.images_room')</label>
                                    <input type="file" name="files[]" multiple accept="image/*" id="files" class="form-control">
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
